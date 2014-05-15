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

Route::group(['prefix' => 'api'], function() {
	Route::get('posts', 'Api\\Posts@index');
	Route::post('posts', 'Api\\Posts@store');
	Route::get('posts/{id}', 'Api\\Posts@show');
	Route::put('posts/{id}', 'Api\\Posts@update');
});

Route::get('{data?}', function()
{
	return View::make('home');
})->where('data', '.*');
