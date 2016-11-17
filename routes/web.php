<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['checklog']], function(){

	Route::get('/home', function () {
	    return view('welcome');
	});

    Route::match(['GET','POST'],'/signup',
    'Authentication\RegController@RegRequest');
});

Route::group(['middleware' => ['authen']], function(){
    Route::get('/',function(){
        if (Auth::user()->type)
            return "Here is supposed to be the admin's layout";
        return view('user.userhome');
    });
});

//Route for the login needs to get inside the app without middleware
Route::post('/','Authentication\LoginHomeController@FirstRequest');
//Activation route
Route::get('activate/{t}/{id}',
'Authentication\ActivationController@ActivationRequest');



//pruebas

Route::get('/prueba', function(){
    return view('admin.management');
});

Route::get('/prueba2', function(){
    return view('admin.calendar');
});