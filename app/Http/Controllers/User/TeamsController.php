<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\League\Team;

class TeamsController extends Controller
{
    public function TeamsRequest(Request $r){
    	return view('user.teams')
    	->with("teams",Team::all())
    	->with("favorites",self::userFavorites());
    }

    private function userFavorites(){
    	$fav=array();
    	if (Auth::user()->teams()->count() > 0) {
	    	foreach (Auth::user()->teams as $team) {
	    		$fav[]=$team->id;
	    	}
    	}
    	return $fav;
    }
}