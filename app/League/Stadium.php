<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    protected $fillable = ['id','name','photo','location'];
    protected $table = "stadiums";
    public $timestamps = false;

    public function team(){
        return $this->hasOne('App\League\Team');
    }
}
