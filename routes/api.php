<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('token')->group(function(){
    Route::get('user', 'UserController@index');
});


Route::get('user/{id}', 'UserController@show');
Route::post('user', 'UserController@store');
Route::put('user/{id}', 'UserController@update');
Route::delete('user/{id}', 'UserController@delete');

Route::post('auth/register', 'Auth\AuthController@register');
Route::post('auth/login', 'Auth\AuthController@login');

