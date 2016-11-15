<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    //
    public $timestamps = false;

    protected $fillable = ['minute','match_id','player_id','goal_type_id'];

    public function player(){
        return $this->belongsTo('App\League\Player');
    }

    public function match(){
        return $this->belongsTo('App\League\Match');
    }
}
