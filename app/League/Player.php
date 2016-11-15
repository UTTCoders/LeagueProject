<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    public $timestamps = false;

    public function matches(){
        return $this->belongsToMany('App\League\Match')->withPivot('playing','has_left');
    }

    public function positions(){
        return $this->belongsToMany('App\League\Position')->withPivot('main');
    }

    public function goals(){
        //return $this::join('goals','players.id','=','goals.player_id')
        //            ->join('matches','goals.match_id','=','matches.id')
        //            ->join('goal_types as gt','gt.id','=','goals.type_id')
        //            ->select('matches.id','players.*','goals.*','gt.description')->get();
        return $this->hasMany('App\League\Goal')->withPivot('minute');
    }

    public function assists(){
        //return $this::join('assists','players.id','=','assists.player_id')
        //            ->join('matches','assists.match_id','=','matches.id')
        //            ->select('matches.id','players.*','assists.*','gt.description')->get();
        return $this->hasMany('App\League\Assist');
    }
}
