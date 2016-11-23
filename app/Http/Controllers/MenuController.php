<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League\Stadium;
use App\League\Team;
use App\League\Match;
use App\User;
use Carbon\Carbon;
use Auth;

class MenuController extends Controller
{
    public function MenuRequest(Request $r){
    	if (Auth::user()->type)
            return view('admin.management');

        if (Auth::user()->teams->count()>0) {
        	$res=self::checkTeamMatches();
        	if ($res["count"]>0) {
        		
        	}
        }
        return view('user.mapview');
    }

    private function checkTeamMatches(){
    	$count=0;
    	$matches=[];
    	foreach (Auth::user()->teams as $key => $team) {
    		if ($team->matches->count()>0) {
    			foreach ($team->matches as $key => $match) {
    				$matchdate=date('Y-m-d', strtotime($match->start_date));
    				$today=Carbon::today('America/Monterrey')->toDateString();
    				if ($today==$matchdate) {
    					if ($match->state>0 && $match->state<4) {
    						$count++;
    						$matches[]=$match;
    					}
    				}
    			}
    		}
    	}
    	return [
    		"count"=>$count, "matches"=>$matches
    	];
    }
}
