<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;
use Illuminate\Pagination\LengthAwarePaginator;

class DepositController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function indexTop()
  {
    $client = new \GuzzleHttp\Client();

    $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/GetTopUpWaiting');

    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 10;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

    $request2 = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/GetTopUpCompleted');

     $response2 = $request2->getBody()->getContents();
     $response2 =  collect(json_decode($response2,true));

     $currentPage2 = LengthAwarePaginator::resolveCurrentPage();
      $perPage2 = 10;
      $currentResults2 = $response2->slice(($currentPage2 - 1) * $perPage2, $perPage2)->all();
      $results2 = new LengthAwarePaginator($currentResults2, $response2->count(), $perPage2);

      return view('Deposit/TopUpWaiVerif')->with('response',$results)->with('response2',$results2);
  }

  public function indexPenarikan()
  {
    $client = new \GuzzleHttp\Client();

    $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/GetPenarikanWaiting');

    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 10;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

     $request2 = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/GetPenarikanCompleted');

     $response2 = $request2->getBody()->getContents();
     $response2 =  collect(json_decode($response2,true));
     // dd($response2);

     $currentPage2 = LengthAwarePaginator::resolveCurrentPage();
      $perPage2 = 10;
      $currentResults2 = $response2->slice(($currentPage2 - 1) * $perPage2, $perPage2)->all();
      $results2 = new LengthAwarePaginator($currentResults2, $response2->count(), $perPage2);

      return view('Deposit/PenarikanWaitVerif')->with('response',$results)->with('response2',$results2);
  }




  public function verifyTopUp(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $id= $request->input('id');

    $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/ViewSpecificTopUpCompleted?TopUpID=$id");
    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    if (empty($response)) {
      $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/ViewSpecificTopUpWaiting?TopUpID=$id");
      $response = $request->getBody()->getContents();
      $response =  collect(json_decode($response,true));
    }

    if (empty($response)) {
      $response = "no Data to show";
    }
      return view('Deposit/TopUpVerify')->with('response',$response);
  }

  public function verifyPenarikan(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $id= $request->input('id');


    $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/ViewSpecificPenarikanCompleted?PenarikanID=$id");
    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    if (empty($response)) {

      $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/ViewSpecificPenarikanWaiting?PenarikanID=$id");
      $response = $request->getBody()->getContents();
      $response =  collect(json_decode($response,true));

    }
      return view('Deposit/PenarikanVerif')->with('response',$response);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function searchTop(Request $request)
  {
    $query= $request->search;
    $cnd = $request->pageInfo;
    $client = new \GuzzleHttp\Client();

    if ($cnd == 'waitTopUp') {
      //search untuk top Up waiting
      $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/SearchTopUpWaiting?SearchQuerry=$query");
      $response = $request->getBody()->getContents();
      $response =  collect(json_decode($response,true));

      $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $perPage = 10;
       $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
       $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

       $request2 = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/GetTopUpCompleted');

        $response2 = $request2->getBody()->getContents();
        $response2 =  collect(json_decode($response2,true));

        $currentPage2 = LengthAwarePaginator::resolveCurrentPage();
         $perPage2 = 10;
         $currentResults2 = $response2->slice(($currentPage2 - 1) * $perPage2, $perPage2)->all();
         $results2 = new LengthAwarePaginator($currentResults2, $response2->count(), $perPage2);

        return view('Deposit/TopUpWaiVerif')->with('response',$results)->with('response2',$results2);
    }
    else {
      //search untuk top up completed, IF pageInfo = topUpcompleted then redirect kesiini
      $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/GetTopUpWaiting');
      $response = $request->getBody()->getContents();
      $response =  collect(json_decode($response,true));

      $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $perPage = 10;
       $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
       $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

       $request2 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/SearchTopUpCompleted?SearchQuerry=$query");

        $response2 = $request2->getBody()->getContents();
        $response2 =  collect(json_decode($response2,true));

        $currentPage2 = LengthAwarePaginator::resolveCurrentPage();
         $perPage2 = 10;
         $currentResults2 = $response2->slice(($currentPage2 - 1) * $perPage2, $perPage2)->all();
         $results2 = new LengthAwarePaginator($currentResults2, $response2->count(), $perPage2);

        return view('Deposit/TopUpWaiVerif')->with('response',$results)->with('response2',$results2);
    }
  }

  public function searchPnr(Request $request)
  {
    $query= $request->search;
    $cnd= $request->pageInfo; //mengambil data page info dari view penarikan, dicari apakah dia completed/wait for verification
    $client = new \GuzzleHttp\Client();

    if ($cnd == 'PenarikanCompleted') {
      //requsest untuk PNR completed
        $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/GetPenarikanWaiting');
        $response = $request->getBody()->getContents();
        $response =  collect(json_decode($response,true));

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
         $perPage = 10;
         $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
         $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);
         $request2 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/SearchPenarikanCompleted?SearchQuerry=$query");

         $response2 = $request2->getBody()->getContents();
         $response2 =  collect(json_decode($response2,true));

         $currentPage2 = LengthAwarePaginator::resolveCurrentPage();
          $perPage2 = 10;
          $currentResults2 = $response2->slice(($currentPage2 - 1) * $perPage2, $perPage2)->all();
          $results2 = new LengthAwarePaginator($currentResults2, $response2->count(), $perPage2);
          return view('Deposit/PenarikanWaitVerif')->with('response',$results)->with('response2',$results2);
    }

    else {
      //request untuk pnr GetTopUpWaiting, kasi IF, jika pageInfo=PnrWait maka ambil link ini
      $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/SearchPenarikanWaiting?SearchQuerry=$query");
      $response = $request->getBody()->getContents();
      $response =  collect(json_decode($response,true));

      $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $perPage = 10;
       $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
       $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);
       $request2 = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_Deposit/GetPenarikanCompleted');

       $response2 = $request2->getBody()->getContents();
       $response2 =  collect(json_decode($response2,true));

       $currentPage2 = LengthAwarePaginator::resolveCurrentPage();
        $perPage2 = 10;
        $currentResults2 = $response2->slice(($currentPage2 - 1) * $perPage2, $perPage2)->all();
        $results2 = new LengthAwarePaginator($currentResults2, $response2->count(), $perPage2);
        return view('Deposit/PenarikanWaitVerif')->with('response',$results)->with('response2',$results2);
    }



  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */


   public function update(Request $request, Deposit $deposit)
   {
       return view('Deposit/PenarikanVerif');
   }


  /**
   * Display the specified resource.
   *
   * @param  \App\Deposit  $deposit
   * @return \Illuminate\Http\Response
   */
  public function show(Deposit $deposit)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Deposit  $deposit
   * @return \Illuminate\Http\Response
   */
  public function edit(Deposit $deposit)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Deposit  $deposit
   * @return \Illuminate\Http\Response
   */


  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Deposit  $deposit
   * @return \Illuminate\Http\Response
   */
  public function destroy(Deposit $deposit)
  {
      //
  }
}
