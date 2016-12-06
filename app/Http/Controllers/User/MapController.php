<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Stadium;
use App\League\Team;
use App\League\Match;
use Auth;

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
    		$res=self::checkStadiumMatches($thestadium);
    		if ($res["there_is"]) {
    			if (self::checkLocalTeam($res["match"],$thestadium->team)) {
    				return view('user.stadiumview')
	    			->with("stadium",$thestadium)
	    			->with("match",$res["match"])
                    ->with("teams",self::checkGoals($res["match"]))
                    ->with("allowComment",self::checkTeamsUser($res["match"]))
                    ->with("isFav",self::checkStadiumTeam($thestadium->team));
    			}
    		}
    	}
    	return view('user.stadiumview')
    	->with("stadium",$thestadium)
        ->with("isFav",self::checkStadiumTeam($thestadium->team));
    }

    public function AskForGoals(Request $r){
        $thematch=Match::find($r->matchid);
        if ($thematch->goals()->count() > $r->gc) {
            return ["newgoals"=>true,
                "marker"=>view('user.goals')
                ->with("teams",self::checkGoals($thematch))
                ->with("match",$thematch)->render()
            ];
        }
        return ["newgoals"=>false];
    }

    public function checkGoals($match){
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

    private function checkLocalTeam($match,$theStadiumsTeam){
    	foreach ($match->teams as $team) {
    		if ($team->pivot->local) {
    			if ($team->id==$theStadiumsTeam->id) {
    				return true;
    			}
    		}
    	}
    	return false;
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

    private function checkStadiumTeam($team){
        foreach (Auth::user()->teams as $t) {
            if ($t->id==$team->id) {
                return true;
            }
        }
        return false;
    }

    private function checkTeamsUser($match){
        foreach ($match->teams as $team) {
            if (Auth::user()->teams->find($team->id)) {
                return true;
            }
        }
        return false;
    }
}
