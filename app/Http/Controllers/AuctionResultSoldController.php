<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Client;

class AuctionResultSoldController extends Controller
{

  public function show()
  {
    $date=date('Y-m-d');
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetOnlineEventByDate?Sold_BalaiLelang=&Sold_FilterWaitingDate=$date");
    $response = $request->getBody()->getContents();
    $response = json_decode($response,true);

    return view('layouts/AuctionResult/Sold/showSold')
    ->with('OnlineEventbyDate',$response);

  }

  public function filterOnlineEventByDate($data)
  {
    $data=date('Y-m-d', strtotime($data));

    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetOnlineEventByDate?Sold_BalaiLelang=&Sold_FilterWaitingDate=$data");
    $response = $request->getBody()->getContents();
    $response = json_decode($response,true);
    return $response;
  }

  public function showDataUnsold($date,$data)
  {

    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetUnsold?Unsold_FilterUnsold=&Unsold_FilterDate=$date&Unsold_BalaiLelang=$data");
    $response = $request->getBody()->getContents();
    $response = json_decode($response,true);

    return $response;

  }
}
