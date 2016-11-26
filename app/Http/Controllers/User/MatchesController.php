<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Match;
use Auth;
use Carbon\Carbon;

class MatchesController extends Controller
{
	public function MatchesRequest(Request $r){
		if (Auth::user()->teams->count()>0) {
			$res=self::checkMatches();
			if ($res["count"]>0) {
				return view('user.matchesuser')
				->with('favorites',$res);
			}
		}		
		return view('user.matchesuser')
		->with('matches',Match::where('state','>',0)
		->where('state','<',4)->get());
	}

	public function getMatchesForMenu(Request $r){
		if ($r->option=="favorites") {
			return view('user.favmatches')
			->with("favorites",self::checkMatches());
		}
		if ($r->option=="now") {
			return view('user.nowmatches')
			->with('matches',
			Match::where('state','>',0)->where('state','<',4)->get());
		}

		return "<h1>Heeeey</h1>";
	}

	private function checkMatches(){
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
    						$match["fav"]=$team;
    						$noteam=$match->teams->where('id','!=',$team->id)->first();
    						$match["nofav"]=$noteam;
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
