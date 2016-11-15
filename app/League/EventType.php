<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    //
    public $timestamps = false;
    protected $table = "event_types";

    public function events(){
        return $this->hasMany('App\League\Event');
    }
}
