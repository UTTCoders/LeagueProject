<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //

    public function matches(){
        return $this->belongsToMany('App\League\Match')->withPivot('playing','has_left');
    }

    public function goals(){
        return $this::join('goals','players.id','=','goals.player_id')
                    ->join('matches','goals.match_id','=','matches.id')
                    ->join('goal_types as gt','gt.id','=','goals.type_id')
                    ->select('matches.id','players.*','goals.*','gt.description')->get();
    }
}
