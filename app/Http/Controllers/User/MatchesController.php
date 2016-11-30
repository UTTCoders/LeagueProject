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
		if (Auth::user()->teams->count()>0 && 
		Match::where('state','>',0)->where('state','<',4)->count()>0) {
			$res=self::checkMatches();
			if ($res["thereAre"]) {
				//return $res["matches"];
				return view('user.matchesuser')
				->with('matches',$res["matches"]);
			}
		}
		return view('user.matchesuser')
		->with('matches',
		Match::where('state','>',0)->where('state','<',4)->get());
	}

	private function checkMatches(){
		$thereAre=false;
		$matches=Match::where('state','>',0)
    	->where('state','<',4)->get();
    	foreach ($matches as $match) {
    		if (Auth::user()->teams->find($match->teams[0]->id)) {
    			$match->teams[0]["favorite"]="itIs";
    			$thereAre=true;
    		}
    		if (Auth::user()->teams->find($match->teams[1]->id)) {
    			$match->teams[1]["favorite"]="itIs";
    			$thereAre=true;
    		}
    	}
    	return [
    		"thereAre"=>$thereAre,"matches"=>$matches
    	];
    }
}
