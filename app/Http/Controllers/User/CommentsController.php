<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Validator;
use Auth;
use App\League\Match;

class CommentsController extends Controller
{
    public function SendComment(Request $r){
    	$rules=["content"=>"required",
    			"matchid"=>"required"];
    	$result=Validator::make($r->all(),$rules);
    	if ($result->fails()) {
    		return ["result"=>false];
    	}
    	$thematch=Match::find($r->matchid);
    	if ($thematch==null) {
    		return ["result"=>false];
    	}
    	if (self::checkTeamsUser($thematch)) {
	    	Auth::user()->comments()
	    	->attach($r->matchid,[
	    	"content"=>$r->content,
	    	"date"=>Carbon::now('America/Monterrey')]);
	    	return ["result"=>true];
    	}
    	return ["result"=>false];
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
