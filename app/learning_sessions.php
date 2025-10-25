<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class learning_sessions extends Model{
   // protected $fillable = [ 'id','user_id','teacher_id','session_offer_id'];
    
     public function users(){
       return $this->belongsTo('App\User','user_id','id');
     }
    
    public function teachers(){
       return $this->belongsTo('App\User','teacher_id','id');
    }
    
    public function offer(){
       return $this->belongsTo('App\session_offer','teacher_id','id');
    }
}
