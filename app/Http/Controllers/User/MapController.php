<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Stadium;

class MapController extends Controller
{
    public function getUserStadiums(){
    	return Stadium::all();
    }

    public function requestStadium(Request $r, $id){
    	return view('user.stadiumview');
    }
}
