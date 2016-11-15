<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\User;

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
    	$checkemail=User::where('email',$r->input('email'))->get()->count();
    	if ($checkemail==0) {
    		return redirect('/home')
    		->with('msgs',["That email is not registered yet!"]);
    	}
    	$userData=[
    		"email"=>$r->input('email'),
    		"password"=>$r->input('password')
    	];
    	if (Auth::attempt()) {
    		return redirect('/');
    	}
    	return redirect('/home')
    	->with('msgs',["Wrong email or password!"]);
    }
}