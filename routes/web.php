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
		Route::get('/admin/calendar', function () {
				return view('admin.calendar');
		})->middleware('admin');

		Route::get('/admin/teams/add', function () {
				return view('admin.management.teams.add');
		})->middleware('admin');

		Route::get('/admin/teams/edit', function () {
				return view('admin.management.teams.edit');
		})->middleware('admin');

		Route::get('/admin/teams/delete', function () {
				return view('admin.management.teams.delete');
		})->middleware('admin');

		Route::post('/getStadiums','Admin\League@getStadiums')->middleware('admin');

		Route::post('/addStadium','Admin\League@addStadium')->middleware('admin');

		Route::post('/getStadium','Admin\League@getStadiumByLocation')->middleware('admin');

		Route::post('/updateStadium','Admin\League@updateStadium')->middleware('admin');

		Route::post('/getStadiumById','Admin\League@getStadiumById')->middleware('admin');

		Route::post('/deleteStadium','Admin\League@deleteStadium')->middleware('admin');

		Route::post('/addCoach','Admin\League@addCoach')->middleware('admin');

		Route::post('/updateCoachNames','Admin\League@updateCoachNames')->middleware('admin');

		Route::post('/updateCoachPhoto','Admin\League@updateCoachPhoto')->middleware('admin');

		Route::post('/deleteCoach','Admin\League@deleteCoach')->middleware('admin');

		Route::post('/addTeam','Admin\League@addTeam');
		// end of Management by admin

});

//Route for the login needs to get inside the app without middleware
Route::post('/','Authentication\LoginHomeController@FirstRequest');
//Activation route
Route::get('activate/{t}',
'Authentication\ActivationController@ActivationRequest');
Route::get('/logout','Authentication\LoginHomeController@LogoutRequest')->middleware('auth');


//--------------------Routes for the user----------------------!
Route::group(['middleware' => ['authen']], function(){
	Route::post('/getuserstadiums','User\MapController@getUserStadiums');
	Route::get('/stadiums/{id}','User\MapController@requestStadium');
	Route::get('/matches','User\MatchesController@MatchesRequest');
	Route::post('/getmatches','User\MatchesController@getMatchesForMenu');
});

// fb
Route::get('/fbloginSocialite','Auth\LoginFBController@redirectToProvider');
Route::get('/callback','Auth\LoginFBController@handleProviderCallback');
Route::post('/fblogin','Auth\LoginFBController@loginAsync')->middleware('guest');
//


//pruebas

Route::get('/prueba2', function(){
    return view('admin.calendar');
});

Route::get('/prueba3',function(){
	return "cucu";
});
