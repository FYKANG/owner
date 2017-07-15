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

// Route::any('mysql',[
// 	'uses'=>'OwnerController@mysql',
// 	'as'=>'mysql'

// 	]);

Route::group(['middleware'=>'wechat'], function() {
    Route::any('fromsave',[
	'uses'=>'OwnerController@fromsave',
	'as'=>'fromsave'

	]);
});



Route::any('session', [
	'uses'=>'OwnerController@session',
	'as'=>'session',
	]);
Route::auth();

Route::get('/home', [
	'uses'=>'HomeController@index',
	'as'=>'home',
	]);

Route::any('/wechat', [
	'uses'=>'WechatController@serve',
	'as'=>'wechat',
	]);

Route::any('/demo', [
	'uses'=>'WechatController@demo',
	'as'=>'demo',
	]);

Route::group(['middleware' => ['web', 'wechat.oauth:snsapi_userinfo']], function () {
    Route::any('/mysql',[
    	'uses'=>'OwnerController@mysql',
    	'as'=>'mysql',
    	]);
});

Route::group(['middleware' => ['web', 'wechat.oauth:snsapi_base']], function () {
    Route::any('test',[
    	'uses'=>'OwnerController@test',
    	'as'=>'test',
    	]);
    Route::any('person',[
    	'uses'=>'OwnerController@person',
    	'as'=>'person',
    	]);
    Route::any('showInfo',[
    	'uses'=>'OwnerController@showInfo',
    	'as'=>'showInfo',
    	]);
    Route::any('from', [
		'uses'=>'OwnerController@from',
		'as'=>'from',
	]);
    Route::any('showInfo',[
    	'uses'=>'OwnerController@showInfo',
    	'as'=>'showInfo',
    	]);
});