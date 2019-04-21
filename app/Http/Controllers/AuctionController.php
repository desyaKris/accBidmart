<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AuctionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $client = new \GuzzleHttp\Client();

    $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionEvent/GetAllAuctionEvent');

    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 10;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);
     // dd($results);
    return view('AuctionEvent/indexAuction')->with('response',$results);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */

   public function buat()
   {
     $client = new \GuzzleHttp\Client();
     $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionEvent/GetAreaLelang');
     $response2 = $request->getBody()->getContents();

     $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionEvent/GetBalaiLelang');
     $response = $request->getBody()->getContents();

     // dd($response);



     return view('AuctionEvent/createAuction')->with('response',json_decode($response,true))->with('response2',json_decode($response2,true));
   }

  public function create(Request $request)
  {
      $client = new \GuzzleHttp\Client();
      $response = $client->request('POST','https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionEvent/CreateAuctionEvent',[
        'json'=>[
            'UnitId'=> $request->UnitId,
            'EventId'=> $request->EventId,
            'UserAdded'=> $request->BALAI_CODE,
            'AddedDate'=> $request->BALAI_CODE
          ]
      ]);

      $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/AuctionAPI/GetAllAuction');

      $response = $request->getBody()->getContents();
      $response =  collect(json_decode($response,true));

      $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $perPage = 10;
       $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
       $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);
       // dd($results);
      return view('AuctionEvent/indexAuction')->with('response',$results);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
  }

  public function data(Request $request)
  {
    $client = new \GuzzleHttp\Client();
      $balang= $request->BalaiLelang;
      $area=$request->AreaLelang;


      //ambil ID balai lelang
      $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionEvent/GetBalangID?BalangDesc=$balang");
      $response = $request->getBody()->getContents();
      //ambil ID area lelang
      $request2 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionEvent/GetAreaLelangID?AreaLelangDesc=$area");
      $response2 = $request2->getBody()->getContents();
      //Ambil Event lelang yang available
      $request3 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionEvent/GetEventLelangByID?Balang=$response&AreaLelangID=$response2");
      $response3 = $request3->getBody()->getContents();
      $response3 =  collect(json_decode($response3,true));
      //Ambil Unit yang available
      $request4 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionEvent/GetUnitData?Balang=$response&AreaLelang=$response2");
      $response4 = $request4->getBody()->getContents();
      $response4 =  collect(json_decode($response4,true));
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $perPage = 10;
       $currentResults = $response4->slice(($currentPage - 1) * $perPage, $perPage)->all();
       $response4 = new LengthAwarePaginator($currentResults, $response4->count(), $perPage);
       // dd($response4);
      return view('AuctionEvent/createAuctionFinal')->with('response3',$response3)->with('response4',$response4);

  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Auction  $auction
   * @return \Illuminate\Http\Response
   */
  public function show(Auction $auction)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Auction  $auction
   * @return \Illuminate\Http\Response
   */
  public function edit(Auction $auction)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Auction  $auction
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Auction $auction)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Auction  $auction
   * @return \Illuminate\Http\Response
   */
  public function destroy(Auction $auction)
  {
      //
  }
}
