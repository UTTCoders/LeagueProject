<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class GoalType extends Model
{
    public $timestamps = false;
    protected $table = "goal_types";

    public function goals(){
        return $this->hasMany('App\League\Goal');
    }
}
