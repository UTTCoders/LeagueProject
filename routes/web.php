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
        /*Bro here is where we have to return a view that extends master
        or we can also return the welcome view now that I think so :s 
        however we'll see what we gonna do later
        */
    });
});

Route::post('/','Authentication\LoginHomeController@FirstRequest');

//pruebas

Route::get('/prueba', function(){
    return view('admin.management');
});

Route::get('/prueba2', function(){
    return view('admin.calendar');
});