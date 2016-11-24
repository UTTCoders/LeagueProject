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

    	Route::get('/','MenuController@MenuRequest');

		// Management by admin
		Route::get('/manage_calendar', function () {
				return view('admin.calendar');
		})->middleware('admin');

		Route::post('/getStadiums','Admin\League@getStadiums')->middleware('admin');

		Route::post('/addStadium','Admin\League@addStadium')->middleware('admin');

		Route::post('/getStadium','Admin\League@getStadiumByLocation')->middleware('admin');

		Route::post('/updateStadium','Admin\League@updateStadium')->middleware('admin');

		Route::post('/getStadiumById','Admin\League@getStadiumById')->middleware('admin');

		Route::post('/deleteStadium','Admin\League@deleteStadium')->middleware('admin');

		Route::post('/addCoach','Admin\League@addCoach');

		Route::post('/updateCoachNames','Admin\League@updateCoachNames');
		// end of Management by admin

});

//Route for the login needs to get inside the app without middleware
Route::post('/','Authentication\LoginHomeController@FirstRequest');
//Activation route
Route::get('activate/{t}',
'Authentication\ActivationController@ActivationRequest');
Route::get('/logout','Authentication\LoginHomeController@LogoutRequest');


//--------------------Routes for the user----------------------!
Route::group(['middleware' => ['authen']], function(){
	Route::post('/getuserstadiums','User\MapController@getUserStadiums');
	Route::get('/stadiums/{id}','User\MapController@requestStadium');
	Route::get('/matches','User\MatchesController@MatchesRequest');
	Route::post('/getmatches','User\MatchesController@getMatchesForMenu');
});


//pruebas
Route::get('/prueba1','Admin\League@addStadium');
Route::get('/prueba2', function(){
    return view('admin.calendar');
});

Route::get('/prueba3',function(){
	return "cucu";
});
