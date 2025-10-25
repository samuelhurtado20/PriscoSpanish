<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class session_offer extends Model
{
//$table->integer('usuario');
    protected $fillable = [
        'usuario','idioma', 'nombre', 'descripcion','precio_individual_60'
    ];
    
    public function learning_sesion(){
        return $this->hasOne('App\learning_sessions','usuario','teacher_id');
    }
    
}
