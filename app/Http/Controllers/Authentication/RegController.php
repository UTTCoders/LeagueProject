<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use Hash;
use Mail;

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
    		return redirect('/signup')->with('msgsReg',$result->messages()->all())
            ->withInput($r->except('password','password2'));
    	}
    	$checkemail=User::where('email',$r->input('email'))->get()->count();
    	if ($checkemail>0) {
    		return redirect('/signup')
            ->with('msgsReg',["The email you typed is already registered!"])
            ->withInput($r->except('password','password2'));
    	}
    	$newuser=new User;
    	$newuser->name=$r->input('name');
    	$newuser->email=$r->input('email');
    	$newuser->password=Hash::make($r->input('password'));
    	$newuser->remember_token = $r->input('_token');
		$newuser->active = false;
		$newuser->type = false;
		$newuser->save();

		$maillink=url('/')."/activate"."/"
        .$newuser->remember_token."/".$newuser->id;
		
		Mail::send('emailviews.activation', ["link"=> $maillink], 
		function ($m) use ($newuser) {
			$m->from('isramaillaravel@gmail.com', 'League-Project.com');
			$m->to($newuser->email, "Destiny")
			->subject("Activation");
		});
		return redirect('/home')
		->with('emailreg',$newuser->email)
		->with('activate',["We've sent the activation email to your account!"]);
    }
}
