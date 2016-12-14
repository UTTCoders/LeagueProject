<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Player;

class ImgPlayersController extends Controller
{
    public function imagePlayer(Request $r){

    	if ($r->file('newphoto')->getClientOriginalExtension() != 'jpg' &&
    		$r->file('newphoto')->getClientOriginalExtension() != 'jpeg' &&
    		$r->file('newphoto')->getClientOriginalExtension() != 'png') {
    		return [
    			"mess"=>"File format must have to be an image!",
    			"success"=>false
    		];
    	}
    	$theplayer=Player::find($r->playerid);
    	$theplayer->photo=$r->newphoto->store('img/players','public');
    	$theplayer->save();
    	return [
    		"success"=>true
    	];
    }
}
