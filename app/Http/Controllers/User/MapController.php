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
    	$thestadium=Stadium::find($id);
    	if ($thestadium) {
    		return view('user.stadiumview')
    		->with("stadium",$thestadium);
    	}
    	return view('errors.404error');
    }
}
