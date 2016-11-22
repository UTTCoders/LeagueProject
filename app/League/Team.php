<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = ['name','logo','fundation_date','coach_id','stadium_id'];
    protected $dates = ['deleted_at'];

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
