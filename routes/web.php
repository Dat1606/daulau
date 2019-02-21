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

Route::get('/','PagesController@index')->name('home');;

Auth::routes();

Route::middleware('auth')->group(function () {
	Route::get('/home', 'HomeController@index');
	Route::get('/my_rooms', 'RoomController@myrooms');
	Route::get('my_room/{id}', 'RoomController@myroom')->name('myroom');
	Route::resource('rooms', 'RoomController');
	Route::resource('user_rooms', 'RoomManagerController');
	Route::get('/groups/{id}/analytics', 'GroupController@analytics')->name('analytics');
	Route::resource('groups', 'GroupController');
	Route::resource('user_groups', 'UserGroupController');
	Route::resource('group_consumptions', 'GroupConsumptionController');
	Route::resource('group_requests', 'UserGroupRequestController');
	Route::resource('users', 'UserController');
});