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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UsersController');
Route::resource('groups', 'GroupsController');
Route::resource('bots', 'BotsController', ['only' => [
  'index', 'show'
]]);

Route::get('/groups/{group}/users',  'UsersController@indexGroup')->name('groups.users');
//Route::get('groups/{group}', ['as' =>'groups.users', 'UsersController@indexGroup']);
//Route::get('groups/{group}', 'UsersController@indexGroup');

Route::get('/home', 'HomeController@index')->name('home');
