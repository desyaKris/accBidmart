<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Client;
use App\Exports\UsersExport;
use Excel;
use File;

class AuctionResultBatalLelangController extends Controller
{
  public function show(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $keyword=$request->input('keyword');
    if($keyword==null)
    {
        $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetBatalLelang');
        $response = $request->getBody()->getContents();
        $response = collect(json_decode($response,true));
        $response = $this->paginate($response, '10');
        return view('layouts/AuctionResult/BatalLelang/showBatalLelang')
        ->with('response',$response);
    }
    else
    {
      $request2 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/SearchBatalLelang?SearchKeyword=$keyword");
      $response2 = $request2->getBody()->getContents();
      $response2 = collect(json_decode($response2,true));
      $response2 = $this->paginate($response2, '10');
      $response2->appends($request->only('keyword'));
      return view('layouts/AuctionResult/BatalLelang/showBatalLelang')
      ->with('response',$response2);
    }
  }

  public function download(Request $request)
  {

    $data[] =
    array(
      'formName'=>$request->input('formName'),
      'firstPage'=>$request->input('firstPage'),
      'lastPage'=>$request->input('lastPage'),
    );

    $name="BidMart_AuctionResultBatalLelang".date('Y-m-d').".xlsx";
    return Excel::download(new UsersExport($data), $name);
  }

  public function paginate($items,$perPage)
  {
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $currentResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
     return new LengthAwarePaginator($currentResults, $items->count(), $perPage);
  }
}
