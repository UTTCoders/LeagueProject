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

    public function resultsRequest(Request $r,$id){
    	$thematch=Match::find($id);
    	if ($thematch==null) {
    		return view('errors.404error');
    	}
    	if ($thematch->state != 4) {
    		return view('errors.404error');	
    	}
    	return view('user.results')
    	->with("match",$thematch)
    	->with("teams",self::checkGoals($thematch));
    }

    private function checkGoals($match){
        $teams["local"]=$match->teams->where('pivot.local',true)->first();
        $teams["local"]["goals"]=0;
        $teams["visitor"]=$match->teams->where('pivot.local',false)->first();
        $teams["visitor"]["goals"]=0;
        foreach ($match->goals as $goal) {
            if ($goal->player->team->id == $teams["local"]->id) {
                $teams["local"]["goals"]+=1;
            }else{
                $teams["visitor"]["goals"]++;
            }
        }
        return $teams;
    }

    public function AskForState(Request $r){
    	$thematch=Match::find($r->matchid);
    	if ($thematch->state != $r->actualState) {
    		return [
    			"change"=>true,
    			"state"=>$thematch->state
    		];
    	}
    	return["change"=>false];
    }

    public function AskPossession(Request $r){
    	$thematch=Match::find($r->matchid);
    	if ($thematch->teams[0]->pivot->ball_possesion != $r->pos1) {
    		return [
    		"change"=>true,
    		"teams"=>$thematch->teams];
    	}
    	return ["change"=>false];
    }
}
