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
Route::post('/app-delete', 'AppController@deleteApp');
Route::post('/app-categories-edit/{appID}', 'AppController@editAppCategories');
Route::get('/app-get/{appID}', 'AppController@getApp');
Route::get('/app-users/{appID}', 'AppController@getAppUsers');
Route::get('/app-recommendation/{appID}/{userID}/{category}', 'AppController@getAppRecommendation');
Route::get('/app-statistics-access/{appID}', 'AppController@getAppStatisticsByAccessNumber');
Route::get('/app-statistics-preference/{appID}', 'AppController@getAppStatisticsByPreferenceNumber');

/* CategoryController routes */
Route::post('/category-add', 'CategoryController@addCategory');
Route::get('/categories/{appID}', 'CategoryController@getCategories');

Route::get('/test', function()
{
    return View::make('test');
});

/*demo*/
Route::get('/demo/page1', 'DemoController@page1');
Route::get('/demo/page2', 'DemoController@page2');
Route::get('/demo/page3', 'DemoController@page3');
Route::get('/demo/page4', 'DemoController@page4');
Route::get('/demo/page5', 'DemoController@page5');
Route::get('/demo/page6', 'DemoController@page6');
Route::get('/demo/page7', 'DemoController@page7');
Route::get('/demo/page8', 'DemoController@page8');
Route::get('/demo/page', 'DemoController@page');

