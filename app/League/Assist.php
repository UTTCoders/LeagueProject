<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Assist extends Model
{
    public $timestamps = false;

    protected $fillable = ['match_id','player_id'];

    public function player(){
        return $this->belongsTo('App\League\Player');
    }

    public function match(){
        return $this->belongsTo('App\League\Match');
    }
}
