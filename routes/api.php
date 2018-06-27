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

Route::get('/', ['middleware' => 'guest', 'uses' => 'UserController@getLogin', 'as' => 'auth.login',]);
Route::get('login', ['middleware' => 'guest', 'uses' => 'UserController@getLogin', 'as' => 'auth.login',]);
Route::post('login', ['middleware' => 'guest', 'uses' => 'UserController@postLogin',]);
//Route::get('password/reset/{token?}', ['middleware' => 'guest', 'uses' => 'UserController@reset',]);
//Route::post('password/reset', ['middleware' => 'guest', 'uses' => 'UserController@resetPassword',]);
Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});
Route::get('register', ['middleware' => 'guest', 'uses' => 'UserController@getRegister', 'as' => 'auth.register',]);
Route::post('register', ['middleware' => 'guest', 'uses' => 'UserController@postRegister',]);