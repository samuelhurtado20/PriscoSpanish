<?php
namespace App\Http\Controllers;

use App\teacher_event;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

/**
 * CalendarEventsController
 * Se encarga de manejar las acciones de los calendarios de profesor y
 * de compra.
 * @author Gustavo Vivas
 */
class CalendarEventsController extends Controller {
    //id, user_id, start, end, title, all_day, created_at, updated_at
    
    public function saveEvent(Request $request){
        $user = Auth::user();

        $evento = json_decode($request->input('evento'));

        $te = null;
        if(!isset($evento->id )){
            $te =  new teacher_event;
        }else{
            $te =  teacher_event::firstOrNew(['id'=>$evento->id]);
        }
        if(null == $te){
            echo "Error- no se ha podido guardar";
            exit();
        }
 
        $te->user_id = $user->id;
        $te->title = $evento->title;
        $te->start = $evento->start;
        $te->end = $evento->end;
        $te->all_day = $evento->allDay;
        $te->save();

        
        
        //echo "hola aca se guardan los eventos " . $request->input('events');
        echo $te->id;
        exit();
    }
    
    public function saveEvents(Request $request){
        //dd();
        $user = Auth::user();
        //echo json_decode($request->input('events'), true);
        $eventos = json_decode($request->input('events'));
        //var_dump($eventos);
        //dd($eventos);
        
        foreach($eventos as $ev){
            
            $te = new teacher_event;
            $te->user_id = $user->id;
            $te->title = $ev->title;
            $te->start = $ev->start;
            $te->end = $ev->end;
            $te->all_day = $ev->allDay;
            $te->save();
        
        }
        
        
        //echo "hola aca se guardan los eventos " . $request->input('events');
        exit();
    }
    
    /**
     * elimina el evento que se ha pasado si encuentra su id
     * si algo falla retorna 404
     * @param Request $request
     */
    public function removeEvent(Request $request){

        $user = Auth::user();
        $evento = json_decode($request->input('evento'));
        //no hay id de evento, se devuelve ok porque el evento no
        //existio en primer lugar
        if(!isset($evento->id)){
             echo "ok";
             exit();
        }
        //Nota: se elimina de esta manera pues aparentemente hay un glitch
        //en el fullcalendar - no confirmado - pero no funciona con teacher_event::firstOrFail()
        $te =  teacher_event::where('id','=',$evento->id)->firstOrFail();
        $te->delete();
        
        echo "ok";
        exit();
    }
}
