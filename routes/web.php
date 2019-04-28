<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
//Route::get('/web/categories', 'WelcomeController@categories'); la necesito??
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
]);

//tournaments
Route::put('/tournaments/playoffs/{id}', 'TournamentController@playoffMaker');
Route::put('/tournaments/group/{id}', 'TournamentController@faseGroupMaker');
Route::put('/tournaments/league/{id}', 'TournamentController@leagueMaker');

//Helpers
Route::get('/categories/{id}/enable', 'CategoryController@enable');
Auth::routes();
