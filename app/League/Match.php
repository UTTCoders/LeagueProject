<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = "matches";
    public $timestamps = false;
    protected $fillable = ['start_date','state','season_id','referee_id'];

    public function teams(){
        return $this->belongsToMany('App\League\Team')->withPivot('local','ball_possesion');
    }

    public function comments(){
        return $this->belongsToMany('App\User','match_user','matche_id')->withPivot('content','date');
    }

    public function season(){
        return $this->belongsTo('App\League\Season');
    }

    public function referee(){
        return $this->belongsTo('App\League\Referee');
    }

    public function events(){
        return $this->hasMany('App\League\Event');
    }

    public function players(){
        return $this->belongsToMany('App\League\Player')->withPivot('playing','has_left');
    }

    public function goals(){
        //return $this::join('goals','matches.id','=','goals.match_id')
        //            ->join('players','goals.player_id','=','players.id')
        //            ->join('goal_types as gt','gt.id','=','goals.type_id')
        //            ->select('matches.id','players.*','goals.*','gt.description')->get();
        return $this->hasMany('App\League\Goal');
    }

    public function assists(){
        return $this->hasMany('App\League\Assist');
    }
}
