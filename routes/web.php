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

Route::match(['get', 'post'], '/user', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::get('/dashboard', 'AuthController@index');
Route::get('/change','AuthController@change');


Route::get('/', 'WelcomeController@index');


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

Auth::routes();
