<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Client;

class AuctionResultUnsoldController extends Controller
{
  public function show()
  {
    $date=date('Y-m-d');
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetOnlineEventUnsoldByDate?Unsold_BalaiLelang=&Unsold_FilterDate=$date");
    $response = $request->getBody()->getContents();
    $response = json_decode($response,true);

    return view('layouts/AuctionResult/Unsold/showUnsold')
    ->with('OnlineEventbyDate',$response);

  }

  public function filterOnlineEventByDate($data)
  {
    $data=date('Y-m-d', strtotime($data));

    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetOnlineEventUnsoldByDate?Unsold_BalaiLelang=&Unsold_FilterDate=$data");
    $response = $request->getBody()->getContents();
    $response = json_decode($response,true);
    return $response;
  }

  public function showDataUnsold($date)
  {

    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetUnsoldbyDate?Unsold_FilterUnsold=&Unsold_FilterDate=$date&Unsold_BalaiLelang=");
    $response = $request->getBody()->getContents();
    $response = json_decode($response,true);

    return $response;
  }

  public function showDataUnsoldByOnlineEvent($date,$OnlineEventName)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetUnsold?Unsold_FilterUnsold=&Unsold_FilterDate=$date&Unsold_BalaiLelang=&Unsold_FilterEvent=$OnlineEventName");
    $response = $request->getBody()->getContents();
    $response = json_decode($response,true);

    return $response;
  }
}
