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

    Route::match(['GET','POST'],'/signup','Authentication\RegController@RegRequest');
});

Route::group(['middleware' => ['authen']], function(){
    Route::get('/',function(){
        return "Here is supposed to be the principal layout";

        /*Well bro, it seems that here we could put a condition, and then
        return a view or another depending of the user's type which is
        logged in
        */
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