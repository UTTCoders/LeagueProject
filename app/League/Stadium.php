<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    protected $fillable = ['id','name','photo','location'];
    public $timestamps = false;
    
    public function team(){
        return $this->has('App\League\Team');
    }
}
