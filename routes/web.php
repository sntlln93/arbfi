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
	'/teams' => 'TeamController',
	'/institutions' => 'InstitutionController',
	'/tournaments' => 'TournamentController',
	'/fixtures' => 'FixtureController',
]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');