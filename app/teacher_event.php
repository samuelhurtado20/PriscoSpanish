<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

//id, user_id, start, end, title, all_day, created_at, updated_at, id, id
class teacher_event extends Model implements \MaddHatter\LaravelFullcalendar\IdentifiableEvent
{
    protected $ps_options=[];
    protected $dates = ['start', 'end'];
    
    public function getEnd() {
        return $this->end;
    }

    public function getStart() {
        return $this->start;
    }

    public function getTitle() {
        return $this->title;
    }

    public function isAllDay() {
        return $this->all_day;
    }

    public function getId() {
        return $this->id;
    }

    public function setEventOption($options){
        $this->ps_options =array_merge($this->ps_options,$options);
        //$this->ps_options[$opt_name] = $opt_val;       
    }
    
    public function getEventOptions()
    {
        return $this->ps_options;
    }   

//
}
