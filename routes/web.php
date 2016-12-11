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
		//get
		Route::get('/admin/calendar', function () {
				return view('admin.calendar');
		})->middleware('admin');

		Route::get('/admin/teams/add', 'Admin\DataForViewsController@getForAddTeams')->middleware('admin');

		Route::get('/admin/teams/edit', 'Admin\DataForViewsController@getForEditTeams')->middleware('admin');

		Route::get('/admin/teams/delete', function () {
				return view('admin.management.teams.delete');
		})->middleware('admin');

		Route::get('/admin/players/add',function (){
			return view('admin.management.players.add');
		})->middleware('admin');

		Route::get('/admin/players/edit',function (){
			return view('admin.management.players.edit');
		})->middleware('admin');

		Route::get('/admin/players/delete',function (){
			return view('admin.management.players.delete');
		})->middleware('admin');

		Route::get('/admin/referees/add',function (){
			return view('admin.management.referees.add');
		})->middleware('admin');

		Route::get('/admin/seasons/add-matches','Admin\DataForViewsController@getForAddMatches')->middleware('admin');
		//post
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

		Route::post('/addTeam','Admin\League@addTeam')->middleware('admin');

		Route::post('/editTeam','Admin\League@editTeam')->middleware('admin');

		Route::post('/deleteTeam','Admin\League@deleteTeam')->middleware('admin');

		Route::post('/addPlayer','Admin\League@addPlayer')->middleware('admin');

		Route::post('/searchPlayersByNameOrTeam','Admin\League@searchPlayersByNameOrTeam')->middleware('admin');

		Route::post('/editPlayer','Admin\League@editPlayer')->middleware('admin');

		Route::post('/getPlayerPositions','Admin\League@getPlayerPositions');

		Route::post('/getPlayersPerTeam','Admin\League@getPlayersPerTeam')->middleware('admin');

		Route::post('/deletePlayer','Admin\League@deletePlayer');

		Route::post('/addReferee','Admin\League@addReferee');

		Route::post('/addMatch','Admin\League@addMatch');

		Route::post('/getMatchesPerMatchDay','Admin\League@getMatchesPerMatchDay');
		// end of Management by admin

});

//Route for the login needs to get inside the app without middleware
Route::post('/','Authentication\LoginHomeController@FirstRequest');
//Activation route
Route::get('activate/{t}',
'Authentication\ActivationController@ActivationRequest');
Route::get('/logout','Authentication\LoginHomeController@LogoutRequest')->middleware('authen');


//--------------------Routes for the user----------------------!
Route::group(['middleware' => ['authen']], function(){
	Route::post('/getuserstadiums','User\MapController@getUserStadiums');
	Route::get('/stadiums/{id}','User\MapController@requestStadium');
	Route::get('/matches','User\MatchesController@MatchesRequest');
	Route::post('/getmatches','User\MatchesController@getMatchesForMenu');
	Route::get('/results/{id}','User\MatchesController@resultsRequest');
	Route::post('/addremovefav','User\FavoritesController@AddRemove');
	Route::post('/sendcomment','User\CommentsController@SendComment');
	Route::post('/askcomments','User\CommentsController@AskForComments');
	Route::post('/askgoals','User\MapController@AskForGoals');
});

// fb
Route::get('/fbloginSocialite','Auth\LoginFBController@redirectToProvider');
Route::get('/callback','Auth\LoginFBController@handleProviderCallback');
Route::post('/fblogin','Auth\LoginFBController@loginAsync')->middleware('guest');
//


//pruebas

Route::get('/prueba2', function(){
	App\League\Player::onlyTrashed()->restore();	
	return "restored";
});

Route::get('/prueba3',function(){
	return "cucu";
});

Route::get('/emergencylogout',function(){
	\Auth::logout();
	return ":D";
});
