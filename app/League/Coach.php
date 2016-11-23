<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    public $timestamps = false;
    public $table = "coaches";
    protected $fillable = [
      'name','last_name','photo'
    ];

    public function team(){
        return $this->hasOne('App\League\Team');
    }
}
