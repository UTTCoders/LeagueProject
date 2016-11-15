<?php

namespace App\League;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = ['id','start_date','end_date'];
    public $timestamps = false;
    
    public function matches(){
        return $this->hasMany('App\League\Match');
    }
}
