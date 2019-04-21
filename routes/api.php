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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Unit
Route::get('/indexUnit','UnitController@index');
Route::get('/searchUnit','UnitController@search');
Route::post('/createUnit','UnitController@create'); //buat unit baru->post
Route::post('/updateUnit','UnitController@update');
Route::post('/uploadUnit','UnitController@upload'); //upload excel
Route::get('/updateAvailable/{id}','UnitController@gantiActive'); //event on-click
Route::get('/updateHotItem/{id}','UnitController@gantiHotItem'); //event on-click
Route::get('/deleteUnit/{id}','UnitController@destroy');

//Balai Lelang
Route::get('/indexBalaiLelang','BalaiLelangController@index');
Route::get('/searchBalaiLelang','BalaiLelangController@search');
Route::post('/createBalaiLelang','BalaiLelangController@create'); //buat balai lelang baru
Route::post('/updateBalaiLelang','BalaiLelangController@update');
Route::post('/uploadBalaiLelang','BalaiLelangController@upload'); //upload excel
Route::get('/deleteBalaiLelang/{id}','BalaiLelangController@destroy');

//Auction https://kevinantariksa.outsystemscloud.com/API/rest/AuctionAPI/
Route::get('/indexAuction','AuctionController@index');
Route::get('/searchAuction','AuctionController@search');
Route::post('/createAuction','AuctionController@create');

//DepositController
Route::get('/searchTop','DepositController@searchTop');
Route::post('/updateBalaiLelang','DepositController@updateTop');
Route::get('/searchPenarikan','DepositController@searchPnr');
Route::post('/updateBalaiLelang','DepositController@updatePnr');
