<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    public function ActivationRequest(Request $r,$t,$id){
        $user=User::find($id);
    	if ($user==null) {
    		return redirect('/');
    	}
    	if ($user->active) {
    		return redirect('/');
    	}
    	if ($user->remember_token==null || $user->remember_token=="") {
    		return redirect('/');
    	}
    	$user->active=true;
    	$user->save();
    	return redirect('/home')->with('emailreg',$user->email)
        ->with('activate',["Your account has been activated! please login!"]);
    }
}
