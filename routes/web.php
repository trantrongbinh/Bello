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

Route::get('/', ['middleware' => 'guest', 'uses' => 'UserController@getLogin', 'as' => 'auth.login',]); //guest - khach
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
Route::get('dashboard', ['middleware' => 'auth', 'uses' => 'UserController@getDashboard', 'as' => 'user.dashboard',]);
Route::get('profile', ['middleware' => 'auth', 'uses' => 'UserController@getProfile', 'as' => 'user.profile',]);
Route::get('activity', ['middleware' => 'auth', 'uses' => 'UserActivityController@getUserActivity', 'as' => 'user.activity',]);

Route::post('postBoard', ['middleware' => 'auth', 'uses' => 'BoardController@postBoard',]);
Route::post('update-board-favourite', ['middleware' => 'auth', 'uses' => 'BoardController@updateBoardFavourite',]);