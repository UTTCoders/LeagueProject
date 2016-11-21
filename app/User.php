<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

<<<<<<< HEAD
=======
    public $timestamps=false;

>>>>>>> 5656ef3b7aa1c4f042c884ce4c8ecfca020537e5
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'email', 'password',
=======
        'name', 'email', 'password', 'type', 'active'
>>>>>>> 5656ef3b7aa1c4f042c884ce4c8ecfca020537e5
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
<<<<<<< HEAD
=======

    public function teams(){
        return $this->belongsToMany('App\League\Team');
    }

    public function comments(){
        return $this->belongsToMany('App\League\Match')->withPivot('content','date');
    }
>>>>>>> 5656ef3b7aa1c4f042c884ce4c8ecfca020537e5
}
