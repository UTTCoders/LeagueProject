<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League\Stadium;
use App\League\Team;
use App\League\Match;
use App\User;
use Carbon\Carbon;
use Auth;
use Session;

class MenuController extends Controller
{
    public function MenuRequest(Request $r){
    	if (Auth::user()->type)
            return view('admin.management.management');

        if (Match::where('state','>',0)->where('state','<',4)->count()>0) {
        	if (!Session::has('first')) {
        		Session::put('first',1);
        		return redirect('/matches');
        	}
        }
        
        return view('user.mapview2');
    }
}
