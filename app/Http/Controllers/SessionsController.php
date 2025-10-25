<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\session_offer;
use App\Perfil_Profesor;
use App\learning_sessions;
use App\SessionConstants;
use Carbon\Carbon;
class SessionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('register.incomplete',['only'=>'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function addSession(Request $request)
    {

    	$this->validate($request, [
    	    'input_idioma_sesion' => 'required|max:255',
        	'input_nombre_sesion' => 'required|max:255',
        	'input_descripcion_sesion' => 'required|max:255',
        	'input_precio_sesion' => 'numeric|min:5|max:999',
        	//'input_precio_sesion_1' => 'numeric|min:5|max:999',
        	'input_precio_sesion_2' => 'numeric|required|min:5|max:999',
        	//'input_precio_sesion_paquete_1' => 'numeric|min:5|max:999',
        	'input_precio_sesion_paquete_2' => 'numeric|min:5|max:999',
    	]);	
         
        $user = Auth::user();

    
       $s = session_offer::firstOrNew(['usuario' => $user->id,
                                       'idioma' => $request->input('input_idioma_sesion'), 
        							   'nombre' =>  $request->input('input_nombre_sesion'),
         							   'descripcion' => $request->input('input_descripcion_sesion'),
         							   'precio_individual_60' => $request->input('input_precio_sesion_2')
         													]);

        $s->precio_individual_20=$request->input('input_precio_sesion');
        $s->precio_individual_30=0;//$request->input('input_precio_sesion_1');
        $s->precio_paquete_a=0;//$request->input('input_precio_sesion_paquete_1');
        $s->precio_paquete_b=$request->input('input_precio_sesion_paquete_2');

    	if($s->save()){
    		return response()->json(['msg' => 'ok']);
    	}
    	    	
    }
    
    /**
     * get a  class session
     */
    public function getSessionOffer(Request $request){
        $this->validate($request, [
            "id" => 'required|numeric|min:1'
        ]);
        
        $id_session=$request->input('id');
        $user = Auth::user();
        $resp =  $user->offers()->where('id','=', $id_session)->first();
        
        if(null != $resp){
            return $resp->toJson();
        }
        
        return json_encode(['error'=>'not found']);
        
    }
    
    public function removeSessionOffer(Request $request){
        $this->validate($request, [
            "id" => 'required|numeric|min:1'
        ]);
        
        $id_session=$request->input('id');
        $res = session_offer::destroy($id_session);
        return json_encode(['result'=>$res]);
    }
    
    public function updateSessionOffer(Request $request){
        $this->validate($request, [
                'id' => 'required|numeric|min:1',
                'input_idioma_sesion' => 'required|max:255',
        	'input_nombre_sesion' => 'required|max:255',
        	'input_descripcion_sesion' => 'required|max:255',
        	'input_precio_sesion' => 'numeric|min:5|max:999',
        	//'input_precio_sesion_1' => 'numeric|min:5|max:999',
        	'input_precio_sesion_2' => 'numeric|required|min:5|max:999',
        	//'input_precio_sesion_paquete_1' => 'numeric|min:5|max:999',
        	'input_precio_sesion_paquete_2' => 'numeric|min:5|max:999',
    	]);	
         
        $user = Auth::user();
        $id_session = $request->input('id');
        $s = session_offer::where(['id'=>$id_session,'usuario' => $user->id])->firstOrFail();
        
        $s->idioma =   $request->input('input_idioma_sesion'); 
        $s->nombre =   $request->input('input_nombre_sesion');
        $s->descripcion =  $request->input('input_descripcion_sesion');
        $s->precio_individual_60 = $request->input('input_precio_sesion_2');
        $s->precio_individual_20 = $request->input('input_precio_sesion');
        $s->precio_individual_30 = 0;//$request->input('input_precio_sesion_1');
        $s->precio_paquete_a =     0;//$request->input('input_precio_sesion_paquete_1');
        $s->precio_paquete_b =     $request->input('input_precio_sesion_paquete_2');
        
        
        if($s->save()){
    		return response()->json(['msg' => 'ok']);
    	}
        return json_encode(['error'=>'---']);
    }
    
    
    public function updateLearningSession(Request $request){
        $this->validate($request, [
            "ls" => 'required|numeric|min:1',
            "st" => 'required|boolean'
        ]);
  
        $id_session=$request->input('ls');
        $user = Auth::user();
        $session =  $user->learningSessions->find(  $id_session)->first();
        $session->new_status_user =$request->input('st');
        $session->user_status_update= Carbon::now();
        return $session->save()?'ok':'error';
        
    }
    
    public function getLearningSession(Request $request){
        $this->validate($request, [
            "ls" => 'required|numeric|min:1'
        ]);
        
        $id_session=$request->input('ls');
        $user = Auth::user();
        $session =  $user->learningSessions->find(  $id_session)->first();
        $teacher =  $session->teachers->find( $session->teacher_id)->first();
        
        $current_status ="error"; //default status
        if(array_key_exists($session->status,  SessionConstants::STATUSES())){
            $current_status =SessionConstants::STATUSES()[$session->status];
        }
        
        $resp=[
                'language'=>$session->language,
                'teacher'=>$teacher->name,
                'status'=>$current_status,
                'inicio'=>$session->start,
                'final'=>$session->end,
                'precio'=>$session->price,
                'completed_T'=>$session->new_status_teacher,
                'completed_A'=>$session->new_status_user
            ];
        
        if(null != $resp){
            return json_encode($resp);
        }
        
        return json_encode(['error'=>'not found']);
    }
    
}
