<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['name','logo','fundation_date','coach_id','stadium_id'];

    public function stadium(){
        return $this->belongsTo('App\League\Stadium');
    }

    public function players(){
        return $this->hasMany('App\League\Player');
    }

    public function followers(){
        return $this->belongsToMany('App\League\User');
    }

    public function matches(){
        return $this->belongsToMany('App\League\Match')->withPivot('local','ball_possesion');
    }

    public function coach(){
        return $this->belongsTo('App\League\Coach');
    }
}
