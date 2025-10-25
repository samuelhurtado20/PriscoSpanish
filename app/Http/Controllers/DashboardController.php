<?php

namespace App\Http\Controllers;
use App\teacher_event;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\goals;
use App\Perfil_Profesor;
use App\session_offers;
use MaddHatter\LaravelFullcalendar\Event;
use MaddHatter\LaravelFullcalendar\SimpleEvent;
use Intervention\Image\Facades\Image;
use App\SessionConstants;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('register.incomplete',['only'=>'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        if ( !Auth::check() ) {
            return redirect('/');
        }
        $user = Auth::user();
        $g = goals::where('user_id', '=', $user->id)->first();
        
        $exams_current = 0;
        $group_sessions_current = 0;
        $private_sessions_current = 0;
        
        if(null!=$g){
            $exams_current = $this->getGoalAdvance($g->exams_attended,$g->exams_goal);
            $group_sessions_current = $this->getGoalAdvance($g->group_sessions_attended,$g->group_sessions_goal);
            $private_sessions_current = $this->getGoalAdvance($g->private_sessions_attended,$g->private_sessions_goal);
            //TODO esto debe actualizarce al establecer la relacion en la tabla
            //$oferta_sesiones = session_offers:::where('usuario', '=', $user->id);
        }

        $sesiones = $user->learningSessions;
	 //dd($sesiones);       
         $oferta_sesiones = $user->offers;
         //foreach ($offers as $offer) {
         //  echo '  -  ' . $offer->nombre .'<br>'; 
         //}
         
         
          //dd($offers);
         /** ---------- calendario ------------ **/
        $events = [];
        $sessions_as_teacher=[]; //sesiones COMO PROFESOR
        
        if($user->profesor){
            $events = teacher_event::all();
            $sessions_as_teacher = $user->teachingSessions;
        }
        
        
        $calendar = \Calendar::addEvents($events);
        
        $options = array('defaultView'=>'agendaWeek',
                         'aspectRatio'=>2,
                         'editable'=>true,
                         'droppable'=>true,
                         'defaultTimedEventDuration'=>'00:30',
                         'eventLimit'=>1);
        
        $options['header'] = array(
                                'left'=>"prev,next today",
                                'center'=>"title",
                                'right'=>'agendaWeek,month'
        );

        $options['views'] = array(
                                'agenda' => array('allDaySlot'=>FALSE),
                                'week' => array('allDaySlot'=>FALSE),
                                'day' => array('allDaySlot'=>FALSE,'eventLimit'=>2),
                            );
        
        //ventana de tiempo en la que se pueden colocar eventos
        $date_utc = new \DateTime();
        $st_t = $date_utc->format(\DateTime::ISO8601);
        $end_time = $date_utc->add(new \DateInterval('P3M'))->format(\DateTime::ISO8601);

        $options['eventConstraint'] = array(
                                'start' => $st_t,
                                'end'=>$end_time
                            );
 
        $callbacks = [];
        
        /* Importante: ps_calendar_Event[XXX]Handler, es un callback definido como una variable
         * "global", para permitir que la actualizacion del codigo sea mas sencilla
         *  ver archivo: teacher-availability-calendar.blade.php          
         */
        $callbacks['eventDrop'] = 'function( event, delta, revertFunc, jsEvent, ui, view )  { '
                . ' ps_calendar_EventDropHandler(event, delta, revertFunc, jsEvent, ui, view);'
                . '}';
         
        $callbacks['eventResize'] = 'function( event, delta, revertFunc, jsEvent, ui, view )  { '
                . ' ps_calendar_EventResizeHandler(event, delta, revertFunc, jsEvent, ui, view);'
                . '}';
        
        $callbacks['eventReceive'] = 'function( event, delta, revertFunc, jsEvent, ui, view )  { '
                . ' ps_calendar_EventReceiveHandler(event, delta, revertFunc, jsEvent, ui, view);'
                . '}';
        
        $callbacks['eventRender'] = 'function( event, element, view )  { '
                . ' ps_calendar_EventRenderHandler(event, element, view );'
                . '}';
        
        $calendar->setOptions($options);
        $calendar->setCallbacks($callbacks);

         /** **/
        return view('dashboard')->with(['user'=> $user,
                                        'exams_current'=> $exams_current,
                                        'group_sessions_current' =>  $group_sessions_current,
                                        'private_sessions_current'=>$private_sessions_current,
                                        'oferta_sesiones' => $oferta_sesiones,
                                        'calendar'=>$calendar,
                                        'sesiones'=>$sesiones,
                                        'sesiones_profesor' =>$sessions_as_teacher,
                                        'session_constants'=>\App\SessionConstants::STATUSES(),
                                       ]);
    }
    
    /**
    * 
    */
    private function getGoalAdvance($curren_value,$goal_value)
    {
        if(  $curren_value > 0 &&  $goal_value >0 ){
            return $curren_value * 100 / $goal_value;
        }
        return 0;
    }
    
    public function privateSessions()
    {
        return view('private_sessions');
    }
    
    public function profile()
    {
         $user = Auth::user();
         $is_teacher = $user->profesor;
         $public_profile_id = $user->profile_id;
         $teacher_profile = Perfil_Profesor::firstOrNew(['user_id'=> $user->id]);         
         return view('profile')->with(['teacher_profile' => $teacher_profile,'is_teacher' => $is_teacher,'public_profile_id' => $public_profile_id]);
    }
    
    public function settings()
    {
        
        $user = Auth::user();

        	return view('account_setting')->with('user', $user);
      
        
        
        
    }
    
    public function resources()
    {
        return view('resources');
    }
    
    public function goals()
    {
        $user = Auth::user();
        $g = goals::firstOrNew(['user_id'=>$user->id]);
        return view('goals')->with('goals',$g);
    }
    
    public function reservations()
    {
        //$events = [];
        /*
        $events[] = \Calendar::event(
                            "Valentine's Day",
                            true,
                            '2015-02-14',
                            '2015-02-14',
                            1
                            );
        */
        $teacher = 1; //id del usuario que es el profesor
        
        $events = teacher_event::where('user_id',$teacher)->get();
        
        // se agregan propiedades a los eventos aca (esto es para consumo del calendario)
        $events->map(function ($item, $key) {
                    return $item->setEventOption(['editable'=>FALSE,
                                                  'backgroundColor'=>'#700',
                                                  'rendering'=>'background']);
          });
        
        $offer = \App\session_offer::where('usuario',$teacher)->first();
          
          
        //
        
        $calendar = \Calendar::addEvents($events);
        
        $options = array('defaultView'=>'agendaWeek',
                         'aspectRatio'=>2,
                         'editable'=>true,
                         'droppable'=>true,
                         'defaultTimedEventDuration'=>'00:30',
                         'eventLimit'=>1);
        
        $options['header'] = array(
                                'left'=>"prev,next today",
                                'center'=>"title",
                                'right'=>'agendaWeek'
        );

        $options['views'] = array(
                                'agenda' => array('allDaySlot'=>FALSE),
                                'week' => array('allDaySlot'=>FALSE),
                                'day' => array('allDaySlot'=>FALSE,'eventLimit'=>2),
                            );
        
        //ventana de tiempo en la que se pueden colocar eventos
        //
        $date_utc = new \DateTime();

        $st_t = $date_utc->format(\DateTime::ISO8601);

        $end_time = $date_utc->add(new \DateInterval('P3M'))->format(\DateTime::ISO8601);

        $options['eventConstraint'] = array(
                                'start' => $st_t,
                                'end'=>$end_time
                            );
 
        $callbacks = [];
              
        

        $callbacks['eventDrop'] = 'function( event, delta, revertFunc, jsEvent, ui, view )  { '
                //. '       console.log("eventDragStop");'
                . '       var link_id= "ev_" + event._id;'
                . '       var sd = event.start.format("YYYY-MM-DD") ;'
                . '       var st = event.start.format("h:mm:ss a"); '
                . '       var et = event.end.format("h:mm:ss a"); '
                . '       var c = "<span>" + sd  + "</span>";'
                . '           c += "<span>" + st + " - " + et  + "</span>";'
                //. '       console.log("eventDragStop: ",$("#" + link_id));'
                . '$("#" + link_id).empty().append(c);'
                . '}';
        
        $callbacks['eventReceive']= 'function( event, delta, revertFunc, jsEvent, ui, view ){'
                . ' ps_calendar_EventReceiveHandler(event, delta, revertFunc, jsEvent, ui, view);'
                . '}';
        

         
        $calendar->setOptions($options);
        $calendar->setCallbacks($callbacks);
        return view('reservations',['calendar'=>$calendar,'ofertas'=>$offer]);
    }
    
    
    /****
    *  funciones para el manejo de los detalles de las cuentas
    */
    
    public function postAccountDetail(Request $request){
      
      
        $this->validate($request, [
                        'name' => 'required|max:255' ,
                        'LastName' => 'required|max:50',
                        'Sex' => 'required|max:1',  
                        'address' => 'required',
                        'city' => 'required|max:40',
                        'state' => 'required|max:40',
                        'PostalCode' => 'required|max:10',
                        'country' => 'required|max:2',
                        'skypeContact' => 'required|max:50',
                        'timezone' => 'required',
                    ]);
        $user = Auth::user();

         $user->name = $request->input('name');
         $user->apellido = $request->input('LastName');
         $user->sexo = $request->input('Sex');
         $user->direccion = $request->input('address');
         $user->ciudad = $request->input('city');
         $user->estado = $request->input('state');
         $user->codigo_postal= $request->input('PostalCode');
         $user->pais= $request->input('country');
         $user->zona_horaria= $request->input('timezone');
         $user->contacto_skype= $request->input('skypeContact');
        
        $m = "Operation Failed. Please try again later";
        if($user->save()){
            $m = 'Operation Successful!';
        }
        
          return back()->with('message',$m);
    }
    
    public function postAccountSettings(Request $request){
        
        $user = Auth::user();
        
        \Validator::extend('passcheck', function($attribute, $value, $parameters) {
                return \Hash::check($value, \Auth::user()->password); 
        });

        $messages = array(
            'passcheck' => 'Your Current password was incorrect',
        );

        
        $this->validate($request, [
                'claveActual' => 'required|passcheck' ,
                'nuevaClave' => 'required|confirmed|min:6'
        ], $messages);
        
        
        


       $credentials = $request->only(
            'nuevaClave'
        );

            
       $user->password = bcrypt($credentials['nuevaClave']);
       $user->save();
       return redirect('dashboard/');
        
    }


    public function postGoals(Request $request)
    {  
          $this->validate($request, [
                        'groupSessions' => 'required|digits_between:0,100' ,
                        'privateSessions' => 'required|digits_between:0,100',
                        'takenTests' => 'required|digits_between:0,100',  
                    ]);
        
            $user = Auth::user();


        $g= goals::firstOrNew(['user_id'=>$user->id]);
        $g->private_sessions_goal= $request->input('privateSessions');
        $g->exams_goal= $request->input('takenTests');
        $g->group_sessions_goal= $request->input('groupSessions');

        //dd($g);
        
        $m = "Operation Failed. Please try again later";
        if($g->save()){
            $m = 'Operation Successful!';
        }

        return back()->with('message',$m);
        
    }
    
    public function postTeacherProfile(Request $request)
    {
        
        $this->validate($request, [
                        'intro' => 'min:0,max:255' ,
                        'vid_url' => 'string',
                        'short_intro' => 'min:0,max:150',  
                    ]);
        
        $user = Auth::user();
        $teacher_profile = Perfil_Profesor::firstOrNew(['user_id'=> $user->id]);
        
        $teacher_profile->about = $request->input('intro');
        $teacher_profile->about_short = $request->input('short_intro');
        $teacher_profile->videoUrl = $request->input('vid_url');
            
        $m = "Operation Failed. Please try again later";
        if($teacher_profile->save()){
            $m = 'Operation Successful!';
        }
        return back()->with('message',$m);
           
        
        
    }
    
    public function postAccountPicture(Request $request){
         $user = Auth::user();
         
         
         if ($request->file('profilePicture')->isValid()) {
            $file = $request->file('profilePicture');
            $filename= date('Y-m-d-H:i:s')."-".$file->getClientOriginalName();
            $img = Image::make($file->getRealPath())->resize(300, 200)->save('profileImgs/'.$filename);
            $user->avatar = $filename;
            $user->save();
            return back();
        }
        

    }
}
