<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Stadium;
use App\League\Team;
use App\League\Match;
use Carbon\Carbon;

class MapController extends Controller
{
    public function getUserStadiums(){
    	return Stadium::has('team')->get();
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
    		$today=Carbon::today('America/Monterrey')->toDateString();
	    	if ($thestadium->team->matches->whereDate('start_date',$today)
	    		->count()>0) {

	    	}
    	}
    	
    	return view('user.stadiumview')
    	->with("stadium",$thestadium);
    }
}
