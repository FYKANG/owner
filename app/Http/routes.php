<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function() {
    return 'test2';
});

Route::get('basic1', function () {
    return 'welcome';
});
Route::any('mysql',[
	'uses'=>'OwnerController@mysql',
	'as'=>'mysql'

	]);