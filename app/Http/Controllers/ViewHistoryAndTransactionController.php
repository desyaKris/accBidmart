<?php

namespace CMSBidmartACC\Http\Controllers;

use Session;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use CMSBidmartACC\Exports\UsersExport;
use Excel;

class ViewHistoryAndTransactionController extends Controller
{
  public function show(Request $request)
  {
        $keyword=$request->input('keyword');
        Session::put('alert','null');
        Session::put('alert2','null');

        $date=date('Y-m-d');
        $client = new \GuzzleHttp\Client();
        $request3 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetOnlineEventByDate?Sold_BalaiLelang=&Sold_FilterWaitingDate=$date");
        $response3 = $request3->getBody()->getContents();
        $response3 = json_decode($response3,true);

        $client = new \GuzzleHttp\Client();
        $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/searchMstTransaction?byDate=$date&ByOnlineEvent=&Keyword=");
        $response2 = $request2->getBody()->getContents();
        $response2= collect(json_decode($response2,true));
        $response2 = $this->paginate($response2, '10');

        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/showMstDeposit');
        $response = $request->getBody()->getContents();
        $response= collect(json_decode($response,true));
        $response = $this->paginate($response, '10');

        return view('layouts/ViewHistoryAndTransaction/showMstHistoryAndTransaction')
        ->with('response',$response)
        ->with('response2',$response2)
        ->with('response3',$response3);
  }

  public function searchMstHistoryDeposit(Request $request)
  {
    $keyword2=$request->input('keyword');
    Session::put('alert','null');
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/searchMstDeposit?keyword=$keyword2");
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');

    $date=date('Y-m-d');
    $client = new \GuzzleHttp\Client();
    $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/searchMstTransaction?byDate=$date&ByOnlineEvent=&Keyword=");
    $response2 = $request2->getBody()->getContents();
    $response2= collect(json_decode($response2,true));
    $response2 = $this->paginate($response2, '10');

    $date=date('Y-m-d');
    $client = new \GuzzleHttp\Client();
    $request3 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetOnlineEventByDate?Sold_BalaiLelang=&Sold_FilterWaitingDate=$date");
    $response3 = $request3->getBody()->getContents();
    $response3 = json_decode($response3,true);

    return view('layouts/ViewHistoryAndTransaction/showMstHistoryAndTransaction')
    ->with('response',$response)
    ->with('response2',$response2)
    -with('response3',$response3);
  }

  public function deleteMstHistoryDeposit(Request $request)
  {
    $id = $request->input('id');
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/DeleteMstDeposit?Id=$id");
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');
    $name;
    foreach ($response as $dt) {
      $name = $dt['UserId'];
    }

    $date=date('Y-m-d');
    $client = new \GuzzleHttp\Client();
    $request3 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetOnlineEventByDate?Sold_BalaiLelang=&Sold_FilterWaitingDate=$date");
    $response3 = $request3->getBody()->getContents();
    $response3 = json_decode($response3,true);

    $client = new \GuzzleHttp\Client();
    $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/searchMstTransaction?byDate=$date&ByOnlineEvent=&Keyword=");
    $response2 = $request2->getBody()->getContents();
    $response2= collect(json_decode($response2,true));
    $response2 = $this->paginate($response2, '10');

    $message = "History Deposit ".$name." was successfully deleted";
    Session::put('alert','success');
    Session::put('message',$message);
    return view('layouts/ViewHistoryAndTransaction/showMstHistoryAndTransaction')
    ->with('response',$response)
    ->with('response2',$response2)
    ->with('response3',$response3);
  }

  public function searchMstTransaction(Request $request)
  {
    $keyword=$request->input('keyword');
    $date=$request->input('StartDate');
    $OnlineEventName=$request->input('OnlineEvent');

    if($OnlineEventName == "--All Online Event--")
    {
      $OnlineEventName="";
    }
    else {
     $OnlineEventName=$request->input('OnlineEvent');
    }

    $client = new \GuzzleHttp\Client();
    $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/searchMstTransaction?byDate=$date&ByOnlineEvent=$OnlineEventName&Keyword=$keyword");
    $response2 = $request2->getBody()->getContents();
    $response2= collect(json_decode($response2,true));
    $response2 = $this->paginate($response2, '10');

    $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/showMstDeposit');
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');

    $date=date('Y-m-d');
    $client = new \GuzzleHttp\Client();
    $request3 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetOnlineEventByDate?Sold_BalaiLelang=&Sold_FilterWaitingDate=$date");
    $response3 = $request3->getBody()->getContents();
    $response3 = json_decode($response3,true);

    return view('layouts/ViewHistoryAndTransaction/showMstHistoryAndTransaction')
    ->with('response',$response)
    ->with('response2',$response2)
    ->with('response3',$response3);

  }
  public function deleteMstTransaction(Request $request)
  {
    $id = $request->input('id');
    $client = new \GuzzleHttp\Client();
    $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/deleteMstTransaction?Id=$id");
    $response2 = $request2->getBody()->getContents();
    $response2= collect(json_decode($response2,true));
    $response2 = $this->paginate($response2, '10');
    $name;
    foreach ($response2 as $dt) {
      $name = $dt['UserId'];
    }

    $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/showMstDeposit');
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');

    $date=date('Y-m-d');
    $client = new \GuzzleHttp\Client();
    $request3 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetOnlineEventByDate?Sold_BalaiLelang=&Sold_FilterWaitingDate=$date");
    $response3 = $request3->getBody()->getContents();
    $response3 = json_decode($response3,true);

    $message = "History Transaction ".$name." was successfully deleted";
    Session::put('alert2','success2');
    Session::put('message2',$message);
    return view('layouts/ViewHistoryAndTransaction/showMstHistoryAndTransaction')
    ->with('response',$response)
    ->with('response2',$response2)
    ->with('response3',$response3);
  }

  public function downloadMstHistoryDeposit(Request $request)
  {
    $data[] =
    array(
      'formName'=>$request->input('formName'),
      'firstPage'=>$request->input('firstPage'),
      'lastPage'=>$request->input('lastPage'),
    );

    $name="BidMart_MstHistoryDeposit".date('Y-m-d').".xlsx";
    return Excel::download(new UsersExport($data), $name);
  }

  public function downloadMstTransaction(Request $request)
  {
    dd($request);
    $data[] =
    array(
      'formName'=>$request->input('formName'),
      'firstPage'=>$request->input('firstPage'),
      'lastPage'=>$request->input('lastPage'),
      // 'keyword'=>
      // 'date'=>
      // 'onlineEvent'=>
    );

    $name="BidMart_MstTransaction".date('Y-m-d').".xlsx";
    return Excel::download(new UsersExport($data), $name);
  }

  public function paginate($items,$perPage)
  {
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $currentResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
     return new LengthAwarePaginator($currentResults, $items->count(), $perPage);
  }
}
