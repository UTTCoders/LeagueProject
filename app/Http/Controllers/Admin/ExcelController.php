<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Player;
use App\League\Team;
use Excel;

class ExcelController extends Controller
{
	public function PlayersRequest(Request $r){
		return view('admin.management.players.addexcel');
	}

    public function PlayersAdd(Request $r){
    	if (!$r->hasFile('excelFile')) {
    		return back()->with('msg.content',"You must select a file!");
    	}
    	if ($r->file('excelFile')->getClientOriginalExtension() != 'xlsx' &&
    		$r->file('excelFile')->getClientOriginalExtension() != 'xls' &&
    		$r->file('excelFile')->getClientOriginalExtension() != 'csv' &&
    		$r->file('excelFile')->getClientOriginalExtension() != 'ods' &&
    		$r->file('excelFile')->getClientOriginalExtension() != 'ots') {
    		return back()->with('msg.content',"The file format is invalid!");
    	}
    	$excel=Excel::load($r->file('excelFile'))->get();
    	return $excel;
    	return $r->file('excelFile')->getClientOriginalExtension();
    }
}
