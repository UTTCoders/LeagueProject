<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Player;
use App\League\Team;

class ExcelController extends Controller
{
	public function PlayersRequest(Request $r){
		return view('admin.management.players.addexcel');
	}

    public function PlayersAdd(Request $r){

    }
}
