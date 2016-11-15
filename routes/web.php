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



//Crearé una nueva rama para hacer cambios a las rutas bro, subiré la rama
//al rato, para que cheques, es para poder hacer que no se reenvíe el formulario

//Here are the new routes (ok now I'll write everithing in english lol):


Route::group(['middleware' => ['checklog']], function(){

	Route::get('/home', function () {
	    return view('welcome');
	});

    Route::get('/signup',function(){
        return view('auth.signup');
    });
});

Route::group(['middleware' => ['authen']], function(){
    Route::get('/',function(){
        return "Here is supposed to be the principal layout";
        //what a shame jaja
    });
    //here must have to be all of the routes that needs authentication
});

Route::post('/','Authentication\LoginHomeController@FirstRequest');

//pruebas

Route::get('/prueba', function(){
    $match = \App\League\Match::find(1);
    return $match->goals()->count();
});