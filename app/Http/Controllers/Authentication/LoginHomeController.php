<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\User;
use App\League\Stadium;
use Session;

class LoginHomeController extends Controller
{
    public function FirstRequest(Request $r){
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
      $isFbAccount = User::where('email',$r->input('email'))->get()->first()->fb_account;
      if($isFbAccount){
        return back()->with('msgs',["There is already an account registered with facebook using that email. Login with that instead."])
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
        if (Session::has('first')) {
            Session::forget('first');
        }
        $fbAccount = Auth::user()->fb_account;
        Auth::logout();
        if($fbAccount) redirect('/home')->with('gonnaLogOut',true);
        return redirect('/home');
    }
}
