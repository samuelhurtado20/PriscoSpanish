<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialLogon extends Model
{
    protected $table = 'SocialLogons';
    protected $fillable = ['provider','provider_id'];
}
