<?php

Route::get('test', function(){
	$players = App\Player::all();
	return view('carnets')->with('players', $players);
});


//auth
Route::match(['get', 'post'], '/user', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::get('/dashboard', 'AuthController@index');
Route::get('/change','AuthController@change');

//web
Route::get('/', 'WelcomeController@index');
Route::get('/web/galery', 'WelcomeController@galery');
Route::get('/web/teams', 'WelcomeController@teams');
Route::get('/web/teams/{id}', 'WelcomeController@team');
Route::get('/web/tournament/{id}', 'WelcomeController@tournament');
Route::get('/web/fixtures', 'WelcomeController@fixtures');
Route::get('/web/contact', 'WelcomeController@contact');
Route::get('/web/regulation', 'WelcomeController@regulation');
Route::get('/web/partners', 'WelcomeController@partners');
Route::get('/web/board', 'WelcomeController@board');

//CRUDS
Route::resources([
	'/users' => 'UserController',
	'/players' => 'PlayerController',
	'/categories' => 'CategoryController',
	'/types' => 'TournamentTypeController',
	'/teams' => 'TeamController',
	'/institutions' => 'InstitutionController',
	'/tournaments' => 'TournamentController',
	'/fixtures' => 'FixtureController',
	'/posts' => 'PostController',
	'/chapters' => 'ChapterController',
	'/articles' => 'ArticleController',
	'/subsections' => 'SubsectionController'
]);

//regulation
Route::get('/regulation', 'RegulationController@index');

//tournaments
Route::put('/tournaments/playoffs/{id}', 'TournamentController@playoffMaker');
Route::put('/tournaments/groups/{id}', 'TournamentController@faseGroupMaker');
Route::put('/tournaments/league/{id}', 'TournamentController@leagueMaker');
Route::put('/tournaments/groups/{id}/make', 'TournamentController@groupMaker');

//Helpers
Route::get('/categories/{id}/enable', 'CategoryController@enable');
Auth::routes();

//pdf
Route::get('/teams/{id}/pdf', 'TeamController@htmlToPdf');
Route::get('/fixtures/{id}/pdf', 'FixtureController@htmlToPdf');
Route::get('tournaments/{id}/pdf', 'PdfController@htmlToPdf');

//validate credential
Route::get('/players/{id}/validate', 'PlayerController@validate');
