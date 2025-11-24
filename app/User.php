<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',''
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function social()
    {
        return $this->hasMany('App\SocialLogon');
    }
    
    public function offers()
    {
        return $this->hasMany('App\session_offer','usuario','id');
    }
    
    public function learningSessions()
    {
       return $this->hasMany('App\learning_sessions','user_id','id');
    }
    
    public function teachingSessions()
    {
       return $this->hasMany('App\learning_sessions','teacher_id','id');
    }
}
