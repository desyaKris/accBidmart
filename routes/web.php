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

// Route::get('/', function () {
//     return view('layouts/master');
// });

Route::get('/', function () {
    return view('/layouts/master');
    // return view('welcome');
});

Route::get('/OnlineEvent', 'OnlineEventController@show');
Route::get('/EditOnlineEvent', 'OnlineEventController@showById');
Route::get('/ShowCreateOnlineEvent', 'OnlineEventController@showCreateOnlineEvent');
Route::get('/SearchOnlineEvent', 'OnlineEventController@show');
Route::get('/CreateOnlineEvent','OnlineEventController@create');
Route::get('/UpdateCondition','OnlineEventController@updateCondition');
Route::post('/UploadOnlineEvent','OnlineEventController@upload');
Route::get('/ShowUploadOnlineEvent','OnlineEventController@showUpload');


Route::get('/MasterGCM', 'MasterGCMController@show');
Route::get('/ShowCreateMasterGCM', 'MasterGCMController@ShowCreateMasterGCM');
Route::post('/CreateMasterGCM', 'MasterGCMController@create');
Route::get('/DeleteMasterGCM','MasterGCMController@delete');
Route::get('/ShowEditMasterGCM','MasterGCMController@showById');
Route::post('/EditMasterGCM','MasterGCMController@edit');
Route::get('/ShowDataMasterGCM','MasterGCMController@showById');
Route::post('/Excel','MasterGCMController@export');
Route::post('/UploadMasterGCM','MasterGCMController@upload');
Route::get('/ShowUploadMasterGCM','MasterGCMController@showUpload');
Route::get('/Search/{data}','MasterGCMController@searchbyCondition');

//bank Account
//Bank Account Customer
Route::get('/searchBankAccountCustomer','BankAccountCustomerController@show');
Route::get('/BankAccountCustomer','BankAccountCustomerController@show');
//Bank Account BalaiLelang
Route::get('/BankAccountBalaiLelang','BankAccountBalangController@show');
Route::get('/searchBankAccountBalaiLelang','BankAccountBalangController@show');
Route::get('/showCreateBalaiLelang','BankAccountBalangController@showCreateBalaiLelang');
Route::get('/editBalaiLelang','BankAccountBalangController@showid');
Route::get('/createBalaiLelang','BankAccountBalangController@createOrEdit');
Route::get('/deteleBalaiLelang','BankAccountBalangController@delete');

//Auction Result
//Batal Lelang
Route::get('/AuctionResultBatalLelang','AuctionResultBatalLelangController@show');
Route::get('/SearchBatalLelang','AuctionResultBatalLelangController@show');
Route::get('/DownloadAuctionResultBatalLelang','AuctionResultBatalLelangController@download');
//sold
Route::get('/AuctionResultSold','AuctionResultSoldController@show');
Route::get('/OnlineEventByDate/{data}','AuctionResultSoldController@filterOnlineEventByDate');
Route::get('/OnlineEventByDate2','AuctionResultSoldController@show');

//Unsold
Route::get('/AuctionResultUnsold','AuctionResultUnsoldController@show');
Route::get('/OnlineEventUnsoldByDate/{data}','AuctionResultUnsoldController@filterOnlineEventByDate');
Route::get('/showAllUnsoldData/{date}','AuctionResultUnsoldController@showDataUnsold');
