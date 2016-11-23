<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Stadium;
use App\League\Team;
use App\League\Match;

class MapController extends Controller
{
    public function getUserStadiums(){
    	return Stadium::has('team')->get();
    }

    public function requestStadium(Request $r, $id){
    	$thestadium=Stadium::find($id);
    	if ($thestadium==null) {

    		return view('errors.404error');
    	}


    	return view('user.stadiumview')
    	->with("stadium",$thestadium);
    }
}
