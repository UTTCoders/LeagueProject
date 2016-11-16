<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;

class RegController extends Controller
{
    public function RegRequest(Request $r){
    	if ($r->isMethod('GET')) {
    		return view('auth.signup');
    	}
    	$rules=[
    		"name"=>"required",
    		"email"=>"required|email",
    		"password"=>"required",
    		"password2"=>"same:password"
    	];
    	$result=Validator::make($r->all(),$rules);
    	if ($result->fails()) {
    		return redirect('/signup')
    		->with('msgs',$result->messages()->all());
    	}
    	$checkemail=User::where('email',$r->input('email'))->get()->count();
    	if ($checkemail>0) {
    		return redirect('/signup')
    		->with('msgs',["The email you typed is already registered!"]);
    	}

    }
}
