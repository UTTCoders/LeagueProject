<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class LoginHomeController extends Controller
{
    public function FirstRequest(Request $r){
    	$rules=[
    		"email"=>"email|required",
    		"password"=>"required"
    	];
    	$result=Validator::make($r->all(),$rules);
    	if ($result->fails()) {
    		return redirect('/home')
    		->with('msgs',$result->messages()->all());
    	}
    	
    	return $r->all();

    }
}
