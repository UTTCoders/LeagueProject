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

Route::group(['middleware' => ['guest']], function(){
    
    Route::get('/',function(){
        return view('welcome');
    });

    Route::get('/signup',function(){
        return view('auth.signup');
    });

});

Route::group(['middleware' => ['auth']],function(){

    Route::get('/home', function () {
        return view('auth.login');
    });

});

//pruebas

Route::get('/prueba', function(){
    $match = \App\League\Match::find(1);
    return $match->goals()->count();
});