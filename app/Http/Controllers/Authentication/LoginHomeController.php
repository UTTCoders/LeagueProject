<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\User;
use App\League\Stadium;

class LoginHomeController extends Controller
{
    public function FirstRequest(Request $r){
        return Stadium::all();
    	$rules=[
    		"email"=>"email|required",
    		"password"=>"required"
    	];
    	$result=Validator::make($r->all(),$rules);
    	if ($result->fails()) {
    		return back()->with('msgs',$result->messages()->all())
            ->withInput($r->except('password'));
    	}
    	$checkemail=User::where('email',$r->input('email'))->get()->count();
    	if ($checkemail==0) {
    		return back()->with('msgs',["That email is not registered yet!"])
            ->withInput($r->except('password'));
    	}
        $state=User::where('email',$r->input('email'))->get()->first()->active;
        if (!$state) {
            return back()->with('msgs',["Your account is not activated yet!"])
            ->withInput($r->except('password'));
        }
    	$userData=[
    		"email"=>$r->input('email'),
    		"password"=>$r->input('password')
    	];
    	if (Auth::attempt($userData)) {
    		return redirect('/');
    	}
    	return back()->with('msgs',["Wrong email or password!"])
        ->withInput($r->except('password'));
    }

    public function LogoutRequest(){
        Auth::logout();
        return redirect('/home');
    }
}
