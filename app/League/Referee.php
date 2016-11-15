<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    //
    protected $fillable = ['id','name','last_name','photo'];
    public $timestamps = false;
    
    public function matches(){
        return $this->hasMany('App\League\Match');
    } 
}
