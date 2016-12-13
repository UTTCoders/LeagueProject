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
    	$m=array();
    	Excel::load($r->file('excelFile'), function($reader){
    		$reader->each(function($sheet){
    			if ($sheet->getTitle() === "players") {
                    $sheet->each(function($row){
                    	$theteam=Team::where('name',$row["team"])->first();
                    	if ($theteam) {
                    		$theplayer=Player::where("shirt_number",
                    		$row["shirt_number"])->first();
                    		if (!$theplayer) {
		                        $p=new Player;
		                        $p->name=$row["name"];
		                        $p->last_name=$row["last_name"];
		                        $p->team_id=$theteam->id;
		                        $p->shirt_number=$row["shirt_number"];
		                        $p->nationality=$row["nationality"];
		                        $p->save();
                    		}else{
                    			$m[]="cucu";
                    		}
                    	}else{
                    		$m[]="cucu2";
                    	}
                    });
                }
    		});
    	});

    	return $m;
    	$excel=Excel::load($r->file('excelFile'))->get();
    	return $excel;
    	return $r->file('excelFile')->getClientOriginalExtension();
    }
}
