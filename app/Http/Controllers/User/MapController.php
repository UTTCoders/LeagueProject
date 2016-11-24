<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Stadium;
use App\League\Team;
use App\League\Match;
use Carbon\Carbon;

class MapController extends Controller
{
    public function getUserStadiums(){
    	$Stadiums=[];
    	$Teams=[];
    	foreach (Stadium::has('team')->get() as $key => $stadium) {
    		$Stadiums[]=$stadium;
    		$Teams[]=$stadium->team;
    	}
    	return [
    		"stadiums"=>$Stadiums,
    		"teams"=>$Teams
    	];
    }

    public function requestStadium(Request $r, $id){
    	$thestadium=Stadium::find($id);
    	if ($thestadium==null) {
    		return view('errors.404error');
    	}
    	if ($thestadium->team==null) {
    		return view('errors.404error');
    	}
    	if ($thestadium->team->matches->count() > 0) {
    		return "hola";
    		$res=self::checkStadiumMatches($thestadium);
    		if ($res["there_is"]) {
    			
    		}
	    	if ($thestadium->team->matches->where('start_date',$today)
	    		->count()>0) {
	    		return "hola";
	    	}
    	}
    	
    	return view('user.stadiumview')
    	->with("stadium",$thestadium);
    }

    private function checkStadiumMatches($thestadium){
    	$there_is=false;
    	$thematch;
    	foreach ($thestadium->team->matches as $key => $match) {
    		if ($match->state>0 && $match->state<4) {
    			$there_is=true;
    			$thematch=$match;
    		}
    	}
    	if ($there_is)
    		return[
    			"there_is"=>$there_is,"match"=>$thematch
    		];
    	return ["there_is"=>$there_is];
    }
}
