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
Route::get('/SearchMasterGCM','MasterGCMController@searchMasterGCM');

//User Management
//Verifikasi Account Binding
Route::get('/VerifikasiAccountBidding','UserManagementVerifikasiAccountController@show');
Route::get('/searchVerifikasiAccountBidding','UserManagementVerifikasiAccountController@show');
Route::get('/showByIdAccountBidding','UserManagementVerifikasiAccountController@showById');
Route::post('/editVerifikasiAccountBidding','UserManagementVerifikasiAccountController@createOrupdate');
//Approval Change User
Route::get('/showApprovalChangesUser','UserManagementApprovalUserController@show');
Route::get('/searchApprovalChangesUserPending','UserManagementApprovalUserController@searchUserPending');
Route::get('/showByIdApprovalChangesUserPending','UserManagementApprovalUserController@showByIdUserPending');
Route::post('/editApprovalChangesUserPending','UserManagementApprovalUserController@editUserPending');

Route::get('/searchApprovalChangesUserExpired','UserManagementApprovalUserController@searchUserExpired');
Route::get('/showByIdApprovalChangesUserExpired','UserManagementApprovalUserController@showByIdUserExpired');
Route::post('/editApprovalChangesUserExpired','UserManagementApprovalUserController@editUserExpired');


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

//AuctionEvent
Route::get('/indexAuction','AuctionController@index');
Route::get('/searchAuction','AuctionController@search');
Route::post('/createAuction','AuctionController@create');

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
Route::get('/showUnsoldByOnlineEvent/{date}/{OnlineEventName}','AuctionResultUnsoldController@showDataUnsoldByOnlineEvent');

//ContentManagement
//Promo
Route::get('/showContentManagementPromo','ContentManagementPromoController@show');
Route::post('/createContentManagementPromo','ContentManagementPromoController@createOrUpdate');
Route::get('/showCreateContentManagementPromo','ContentManagementPromoController@showCreate');
Route::get('/showByIdContentManagementPromo','ContentManagementPromoController@showById');
Route::get('/deleteContentManagementPromo','ContentManagementPromoController@delete');
Route::get('/UpdateIsActive/{data}','ContentManagementPromoController@searchbyCondition');
//MasterContent
Route::get('/showContentManagementMasterContent','ContentManagementMasterContentController@show');
Route::post('/createContentManagementMasterContent','ContentManagementMasterContentController@createOrUpdate');
Route::get('/showCreateContentManagementMasterContent','ContentManagementMasterContentController@showCreate');
Route::get('/showByIdContentManagementMasterContent','ContentManagementMasterContentController@showById');
Route::get('/deleteContentManagementMasterContent','ContentManagementMasterContentController@delete');


//ViewHistoryAndTransaction
Route::get('/showViewHistoryAndTransaction','ViewHistoryAndTransactionController@show');
Route::get('/searchMstHistoryDeposit','ViewHistoryAndTransactionController@searchMstHistoryDeposit');
Route::get('/deleteMstHistoryDeposit','ViewHistoryAndTransactionController@deleteMstHistoryDeposit');
Route::get('/downloadMstHistoryDeposit','ViewHistoryAndTransactionController@downloadMstHistoryDeposit');
Route::get('/searchMstTransaction','ViewHistoryAndTransactionController@searchMstTransaction');
Route::get('/deleteMstTransaction','ViewHistoryAndTransactionController@deleteMstTransaction');
Route::get('/downloadMstTransaction','ViewHistoryAndTransactionController@downloadMstTransaction');

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

//DepositController
Route::get('/searchTop','DepositController@searchTop');
Route::post('/updateBalaiLelang','DepositController@updateTop');
Route::get('/searchPenarikan','DepositController@searchPnr');
Route::post('/updateBalaiLelang','DepositController@updatePnr');

//balai lelang
Route::get('/viewBalaiLelang','BalaiLelangController@index');
Route::get('/buatBalaiLelang','BalaiLelangController@buat');
Route::get('/updateBalaiLelang/{id}','BalaiLelangController@edit');
Route::get('/uploadBalaiLelang','BalaiLelangController@upld');
