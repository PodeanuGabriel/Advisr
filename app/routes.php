<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

/* UserController routes*/
Route::any('/signup', 'UserController@signup');
Route::any('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');

/* DashboardController routes */
Route::any('/dashboard', 'DashboardController@index');

/* AppController routes */
Route::post('/app-add', 'AppController@addApp');
Route::post('/app-edit/{appID}', 'AppController@editApp');
Route::post('/app-categories-edit/{appID}', 'AppController@editAppCategories');
Route::get('/app-get/{appID}', 'AppController@getApp');
Route::get('/app-users/{appID}', 'AppController@getAppUsers');
Route::get('/app-recommendation/{appID}/{userID}/{category}', 'AppController@getAppRecommendation');

/* CategoryController routes */
Route::post('/category-add', 'CategoryController@addCategory');
Route::get('/categories/{appID}', 'CategoryController@getCategories');
