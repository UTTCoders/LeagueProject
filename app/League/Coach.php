<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coach extends Model
{
	use SoftDeletes;

    public $timestamps = false;
    public $table = "coaches";
    protected $dates = ['deleted_at'];

    public function team(){
        return $this->hasOne('App\League\Team');
    }
}
