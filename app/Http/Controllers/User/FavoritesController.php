<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class FavoritesController extends Controller
{
    public function AddRemove(Request $r){
    	if ($r->action) {
    		Auth::user()->teams()->attach($r->teamid);
    		return ["action"=>true];
    	}
    	Auth::user()->teams()->detach($r->teamid);
    	return ["action"=>false];
    }

    public function FavoritesRequest(Request $r){
    	return view('user.favorites');
    }
}
