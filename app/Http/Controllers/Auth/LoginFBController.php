<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;
use Auth;

class LoginFBController extends Controller
{
    //
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request){
        if(array_key_exists('error',$request->toArray()))
          if($request->toArray()['error'] == 'access_denied')
            return redirect('/home')->with('msg','You have refused the app permissions');
        $user = Socialite::driver('facebook')->user();
        if(!$user->user['verified']) return redirect('/home')->with('msg','Your account is not activated yet... Complete your facebook activating process');
        if($localUser = User::where('email',$user->email)->first()){
          if(!$localUser->fb_account)
            return redirect('/home')->with('msg', 'There is an account registered with that email... Log in with your league-project account instead!');
          Auth::login($localUser);
          return redirect('/');
        }
        $admin = false;
        if(User::get()->count() < 1) $admin = true;
        $newUser = new User;
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->password = $user->id;
        $newUser->fb_account = true;
        $newUser->active = true;
        $newUser->type = $admin;
        $newUser->save();
        Auth::login($newUser);
        return redirect('/')->with('gonnaLogin',true);
    }
}
