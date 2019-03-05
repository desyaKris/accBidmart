<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class BankAccountCustomerController extends Controller
{
    public function show(Request $request)
    {
      $searchKeyword=$request->input('searchKeyword');

      if($searchKeyword == null)
      {
        $client1 = new \GuzzleHttp\Client();
        $request1 = $client1->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetCustomer');
        $response1 = $request1->getBody()->getContents();
        $response1 = collect(json_decode($response1,true));
        $response1 = $this->paginate($response1, '10');
        $response1->appends($request->only('searchKeyword'));

        return view('layouts/BankAccount/Customer/showCustomer')
        ->with('response',$response1);
      }else{
        $client4 = new \GuzzleHttp\Client();
        $request4 = $client4->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/SearchCustomer?SearchKeyword=$searchKeyword");
        $response4 = $request4->getBody()->getContents();
        $response4 = collect(json_decode($response4,true));
        $response4 = $this->paginate($response4, '10');
        $response4->appends($request->only('searchKeyword'));


        return view('layouts/BankAccount/Customer/showCustomer')
        ->with('response',$response4);
      }
    }

    public function paginate($items,$perPage)
    {
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $currentResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
       return new LengthAwarePaginator($currentResults, $items->count(), $perPage);
    }
}
