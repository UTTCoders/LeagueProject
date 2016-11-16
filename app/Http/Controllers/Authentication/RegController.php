<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use Hash;

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
    	$newuser=new User;
    	$newuser->name=$r->input('name');
    	$newuser->email=$r->input('email');
    	$newuser->password=Hash::make($r->input('password'));
    	$newuser->remember_token = $r->input('_token');
		$newuser->active = false;
		$newuser->type = false;
		$newuser->save();

		$maillink="http://league-project.com/activate/"
		.$newuser->remember_token."/".$newuser->id;
		
		Mail::send('emailviews.activation', ["link"=> $maillink], 
		function ($m) use ($newuser) {
			$m->from('isramaillaravel@gmail.com', 'MusicRecords!');
			$m->to($newuser->email, "Destiny")
			->subject("Activation");
		});
		return redirect('/login')
		->with('emailreg',$newuser->email)
		->with('msg',["We've sent the activation email to your account!"]);
    }
}
