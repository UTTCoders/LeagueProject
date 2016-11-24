<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League\Stadium;
use App\League\Team;
use App\League\Match;
use App\User;
use Carbon\Carbon;
use Auth;
use Session;

class MenuController extends Controller
{
    public function MenuRequest(Request $r){
    	if (Auth::user()->type)
            return view('admin.management');

        if (Auth::user()->teams->count()>0) {
        	if (self::checkTeamMatches() && !Session::has('first')) {
        		Session::put('first',1);
        		return redirect('/matches');
        	}
        }
        return view('user.mapview2');
    }

    private function checkTeamMatches(){
    	foreach (Auth::user()->teams as $team) {
    		if ($team->matches->count()>0) {
    			foreach ($team->matches as $match) {
    				$matchdate=date('Y-m-d', strtotime($match->start_date));
    				$today=Carbon::today('America/Monterrey')->toDateString();
    				if ($today==$matchdate) {
    					if ($match->state>0 && $match->state<4) {
    						return true;
    					}
    				}
    			}
    		}
    	}
    	return false;
    }
}
