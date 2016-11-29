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
			$res=self::favoriteMatches();
			if ($res["count"]>0) {
				return view('user.matchesuser')
				->with('favorites',$res["favorites"])
				->with('matches',
				Match::where('state','>',0)->where('state','<',4)->get());
			}
		}
		return view('user.matchesuser')
		->with('matches',
		Match::where('state','>',0)->where('state','<',4)->get());
	}

	private function favoriteMatches(){
		$favorites=[];
		$count=0;
		$theresTable=false;
		foreach (Auth::user()->teams as $team) {
			if ($team->matches->count()>0) {
				foreach ($team->matches as $match) {
					if ($match->state>0 && $match->state<4) {
						$count++;
						$match["fav"]=$team;
						$noteam=$match->teams->where('id','!=',$team->id)->first();
						$match["nofav"]=$noteam;
						$favorites[$match->id]=$match;
					}
				}
			}
		}
		if ($count>0) {
			foreach (Match::where('state','>',0)->where('state','<',4)->get()
			 as $match) {
			 	if (!in_array($match->id, array_keys($favorites))) {
			 		$theresTable=true;
			 	}
			}
		}
		return [
			"count"=>$count,"favorites"=>$favorites,"table",$theresTable
		];
	}
}
