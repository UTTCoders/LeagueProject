<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stadium extends Model
{
    //use SoftDeletes;
    
    protected $fillable = ['id','name','photo','location'];
    protected $table = "stadiums";
    public $timestamps = false;
    //protected $dates = ['deleted_at'];

    public function team(){
        return $this->hasOne('App\League\Team');
    }
}
