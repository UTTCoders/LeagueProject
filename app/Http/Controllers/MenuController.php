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

        return Stadium::has('team')->whereNull('deleted_at')->get();
        return Team::has('matches')->get();

        return Auth::user()->teams->first()->matches->count();
        if (Auth::user()->teams->count()>0) {
        	self::checkTeamMatches();
        }

        $today=Carbon::today('America/Monterrey')->toDateString();
        if (Match::whereDate('start_date',$today)->count()>0) {
        	$thematches=Match::whereDate('start_date',$today)
        	->where('state',1)->get();

        	if ($thematch) {

        	}
        }

        return view('user.mapview')
        ->with('thereAreStadiums',self::thereAreStadiums());
    }

    public function thereAreStadiums(){
    	foreach (Stadium::has('team')->whereNull('deleted_at')
    		->get() as $key => $stadium) {
    		if ($stadium->team->deleted_at==null || $stadium->team->deleted_at=="") {
    			return true;
    		}
    	}
    	return false;
    }

    private function checkTeamMatches(){
    	foreach (Auth::user()->teams as $key => $team) {
    		if ($team->matches->count()>0) {

    		}
    	}
    }
}
