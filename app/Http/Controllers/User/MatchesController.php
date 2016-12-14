<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Match;
use App\League\Team;
use App\League\Season;
use Session;
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
				->with('matches',$res["matches"])
                ->with('currentSeason',self::checkSeason())
                ->with('theseasons',self::theSeasons());
			}
		}
		return view('user.matchesuser')
		->with('matches',
		Match::where('state','>',0)->where('state','<',4)->get())
        ->with('currentSeason',self::checkSeason())
        ->with('theseasons',self::theSeasons());
	}

    public function AskEvents(Request $r){
        $thematch=Match::find($r->matchid);
        if ($thematch->events()->count() != $r->ec) {
            return [
                "change"=>true,
                "view"=>view('user.events')->with("match",$thematch)->render()
            ];
        }
        return [
            "change"=>false
        ];
    }

    public function AskMatchesS(Request $r){
        return view('user.matches')
        ->with('matches',Session::get('seasons.'.$r->seasonid.'.'.$r->matchday))
        ->render();
    }

    private function generateSeasons($theseasons){
        Session::put('seasons');
        foreach ($theseasons as $season) {
            Session::put('seasons.'.$season->id,$season);
            $matchday=1;
            $count=1;
            foreach ($season->matches as $match) {
                $match["theteams"]=self::checkGoals($match);
                Session::push('seasons.'.$season->id.'.'.$matchday,$match);
                if (Session::has('current')) {
                    if (Session::get('current')->id == $season->id
                    && $match->state == 0 && !Session::has('def')) {
                        Session::put('def',$matchday);
                    }
                }
                $count++;
                if ($count==10) {
                    $matchday++;
                    $count=1;
                }
            }
        }
    }

    private function theSeasons(){
        $theseasons=Season::has('matches',">","0")->get();//here goes 380 too
        $count=Season::has('matches',">","0")->get()->count();//here goes 380 too
        if ($count>0) {
            self::generateSeasons($theseasons);
        }
        return $theseasons;
    }

    public function ChartStats(){
        $teams=self::TeamsSeason(self::checkSeason());
        return $teams;
    }

    public function StatsRequest(Request $r){
        return view('user.stats')
        ->with('currentSeason',self::checkSeason())
        ->with('teamsS',self::TeamsSeason(self::checkSeason()));
    }

    private function TeamsSeason($season){
        if ($season) {
            $teams=Team::all();
            foreach ($teams as $team) {
                $team["matchesCount"]=$team->matches()
                ->where('season_id',$season->id)->where('state',4)->get()->count();
                $team["points"]=0;
                $team["differGoals"]=0;
                if ($team["matchesCount"]>0) {
                    foreach ($team->matches()->where('season_id',$season->id)
                    ->where('state',4)->get() as $match) {
                        $team["points"]+=self::checkGoalsSeason($match,$team);
                    }
                    $team["differGoals"]=self::checkDifferGoals($team,$season->id);
                }
            }
            $teams=self::orderTeams($teams);
            return $teams;
        }
        return "nothing";
    }

    private function orderTeams($teams){
        if ($teams->count()>0) {
            $temp;
            for ($i=0; $i < $teams->count()-1; $i++) { 
                for ($j=0; $j < $teams->count()-1; $j++) { 
                    if ($teams[$j]["points"] < $teams[$j+1]["points"]) {
                        $temp=$teams[$j];
                        $teams[$j]=$teams[$j+1];
                        $teams[$j+1]=$temp;
                    }
                }
            }
        }
        return $teams;
    }

    private function checkDifferGoals($team,$seasonid){
        $goodGoals=0;
        $badGoals=0;
        foreach ($team->matches()->where('season_id',$seasonid)
        ->where('state',4)->get() as $match) {
            foreach ($match->goals as $goal) {
                if ($goal->player->team->id == $team->id) {
                    $goodGoals++;
                }else{
                    $badGoals++;
                }
            }
        }
        return $goodGoals-$badGoals;
    }

    private function checkGoalsSeason($match, $team){
        $teamgoals=0;
        $othergoals=0;
        foreach ($match->goals as $goal) {
            if ($goal->player->team->id == $team->id) {
                $teamgoals++;
            }else{
                $othergoals++;
            }
        }
        if ($teamgoals==$othergoals) {
            return 1;
        }else if($teamgoals>$othergoals){
            return 3;
        }else{
            return 0;
        }
    }

    private function checkSeason(){
        $d=Carbon::today('America/Monterrey');
        $season=Season::where('start_date','<=',$d)
        ->where('end_date','>=',$d)->get()->first();
        if ($season && $season->matches()->count() >0) { //here 380
            Session::put('current',$season);
            if (Session::has('def')) {
                Session::forget('def');
            }
            return $season;
        }
        return null;
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
                $teams["visitor"]["goals"]+=1;
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
