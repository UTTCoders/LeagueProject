<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    protected $fillable = ['id','name'];
    public $timestamps = false;
    
    public function players(){
        return $this->belongsToMany('App\League\Players')->withPivot('main');
    }
}
