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

        }

        $today=Carbon::today('America/Monterrey')->toDateString();
        if (Match::whereDate('start_date',$today)->count()>0) {
        	$thematches=Match::whereDate('start_date',$today)
        	->where('state',1)->get();

        	if ($thematch) {

        	}
        }

        return view('user.mapview');
    }

    private function checkTeamMatches(){
    	$count=0;
    	foreach (Auth::user()->teams as $key => $team) {
    		if ($team->matches->count()>0) {

    		}
    	}
    }
}
