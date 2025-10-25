<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil_Profesor extends Model
{
    protected $table = 'perfil_profesor';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id'];
}
