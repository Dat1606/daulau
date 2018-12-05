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

Route::get('/home', 'HomeController@index');
Route::get('/my_rooms', 'RoomController@myrooms')->middleware('auth');
Route::get('my_room/{id}', 'RoomController@myroom')->middleware('auth')->name('myroom');
Route::resource('rooms', 'RoomController');
Route::resource('user_rooms', 'RoomManagerController')->middleware('auth');
Route::get('/groups/{id}/analytics', 'GroupController@analytics')->middleware('auth');
Route::resource('groups', 'GroupController')->middleware('auth');
Route::resource('user_groups', 'UserGroupController')->middleware('auth');
Route::resource('group_consumptions', 'GroupConsumptionController')->middleware('auth');
