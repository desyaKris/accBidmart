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
    return view('layouts/master');
});

Route::get('/OnlineEvent', 'OnlineEventController@show');
Route::get('/EditOnlineEvent', 'OnlineEventController@showById');
Route::get('/ShowCreateOnlineEvent', 'OnlineEventController@showCreateOnlineEvent');
Route::get('/SearchOnlineEvent', 'OnlineEventController@search');
Route::get('/CreateOnlineEvent','OnlineEventController@create');

Route::get('/MasterGCM', 'MasterGCMController@show');
Route::get('/ShowCreateMasterGCM', 'MasterGCMController@ShowCreateMasterGCM');
Route::get('/CreateMasterGCM', 'MasterGCMController@create');
Route::get('/DeleteMasterGCM','MasterGCMController@delete');
Route::get('/ShowEditMasterGCM','MasterGCMController@showById');
Route::get('/EditMasterGCM','MasterGCMController@edit');
Route::get('/ShowDataMasterGCM','MasterGCMController@showById');
Route::get('/excel','MasterGCMController@export');

Route::get('/home','blogController@getGuzzleRequest');
