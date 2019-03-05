<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

class BankAccountBalangController extends Controller
{
  public function show(Request $request)
  {
    $searchKeyword=$request->input('searchKeyword');
    //untuk menghapus session sebelumnya
    Session::put('alert','null');

    //kondisi untuk menampilkan tabel dan menampilkan data berdasarkan keyword
    if($searchKeyword == null)
    {
      $client1 = new \GuzzleHttp\Client();
      $request1 = $client1->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetBalaiLelang');
      $response1 = $request1->getBody()->getContents();
      $response1 = collect(json_decode($response1,true));
      $response1 = $this->paginate($response1, '10');
      $response1->appends($request->only('searchKeyword'));

      return view('layouts/BankAccount/BalaiLelang/showBalaiLelang')
      ->with('response',$response1);
    }else{
      $client2 = new \GuzzleHttp\Client();
      $request2 = $client2->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/SearchBalaiLelang?SearchKeyword=$searchKeyword");
      $response2 = $request2->getBody()->getContents();
      $response2 = collect(json_decode($response2,true));
      $response2 = $this->paginate($response2, '10');
      $response2->appends($request->only('searchKeyword'));
      Session::put('test', "tommy");
      return view('layouts/BankAccount/BalaiLelang/showBalaiLelang')
      ->with('response',$response2);
    }
  }

  public function paginate($items,$perPage)
  {
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $currentResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
     return new LengthAwarePaginator($currentResults, $items->count(), $perPage);
  }

  public function showCreateBalaiLelang()
  {
    $client3 = new \GuzzleHttp\Client();
    $request3 = $client3->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetBalaiLelangDescription');
    $response3 = $request3->getBody()->getContents();
    $response3 = json_decode($response3,true);

    $client4 = new \GuzzleHttp\Client();
    $request4 = $client4->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetBank');
    $response4 = $request4->getBody()->getContents();
    $response4 = json_decode($response4,true);

    return view('layouts/BankAccount/BalaiLelang/createBalaiLelang')
    ->with('response1',$response3)
    ->with('response2',$response4);
  }


  public function showid(Request $request)
  {

    $id = $request->input('id');
    $client3 = new \GuzzleHttp\Client();
    $request3 = $client3->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetBalaiLelangDescription');
    $response3 = $request3->getBody()->getContents();
    $response3 = json_decode($response3,true);

    $client4 = new \GuzzleHttp\Client();
    $request4 = $client4->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetBank');
    $response4 = $request4->getBody()->getContents();
    $response4 = json_decode($response4,true);

    $client5 = new \GuzzleHttp\Client();
    $request5 = $client5->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetBalaliLelangById?ID=$id");
    $response5 = $request5->getBody()->getContents();
    $response5 = json_decode($response5,true);

    return view('layouts/BankAccount/BalaiLelang/editBalaiLelang')
    ->with('response1',$response3)
    ->with('response2',$response4)
    ->with('response3',$response5);
  }


  public function createOrEdit(Request $request)
  {
    $balaiLelangId=$request->input('BalaiLelangId');
    $GCMId=$request->input('GCMId');

    $client6 = new \GuzzleHttp\Client();
    $request6 = $client6->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/ExistBalaiLelang?BalaiLelang=$balaiLelangId");
    $response6 = $request6->getBody()->getContents();
    $response6 = json_decode($response6,true);


    $client4 = new \GuzzleHttp\Client();
    $request4 = $client4->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetBankId?BankName=$GCMId");
    $response4 = $request4->getBody()->getContents();
    $GCMId=json_decode($response4,true);

    $client5 = new \GuzzleHttp\Client();
    $request5 = $client5->get("https://acc-dev1.outsystemsenterprise.com/Lelang_CS/rest/LaravelAPIBalaiLelang/GetBalaiLelangId?BalaiLelang=$balaiLelangId");
    $response5 = $request5->getBody()->getContents();
    $balaiLelangId = json_decode($response5,true);

    $id = $request->input('id');
    $client3 = new \GuzzleHttp\Client();
    $request3 = $client3->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetBalaiLelang');
    $response3 = $request3->getBody()->getContents();
    $response3 = json_decode($response3,true);

    if(empty($id))
    {
      if ($response6 == null)
      {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST','https://acc-dev1.outsystemsenterprise.com/BankAccount_CS/rest/Laravel_BankAccount/CreateOrUpdateBalaiLelang',[
          'json'=>[
          'BalaiLelangId'=> $balaiLelangId,
          'GCMId'=> $GCMId,
          'NoRekening'=> $request->input('NoRekening'),
          'NamaRekening'=> $request->input('NamaRekening'),
          'AddedDate'=> $request->input('AddedDate'),
          'UserAdded'=> 1234,
          'UpdatedDate'=>null,
          'UserUpdated'=>null,
          ]
        ]);
        $message = "Bank Account Balang ".$request->input('NamaRekening')." was successfully created";
        Session::put('alert','success');
        Session::put('message',$message);
      }
      else {
        Session::put('alert','error');
        Session::put('message',"Can't create new bank account because bank account with that bank already exist.");
      }
    }
    else
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST','https://acc-dev1.outsystemsenterprise.com/BankAccount_CS/rest/Laravel_BankAccount/CreateOrUpdateBalaiLelang',[
          'json'=>[
          'Id'=>$request->input('id'),
          'BalaiLelangId'=> $balaiLelangId,
          'GCMId'=> $GCMId,
          'NoRekening'=> $request->input('NoRekening'),
          'NamaRekening'=> $request->input('NamaRekening'),
          'AddedDate'=> $request->input('AddedDate'),
          'UserAdded'=> 1234,
          'UpdatedDate'=>$request->input('UpdatedDate'),
          'UserUpdated'=>null,
          ]
        ]);

        $message = "Bank Account Balang ".$request->input('NamaRekening')." was successfully updated";
        Session::put('alert','success');
        Session::put('message',$message);

    }

    $client1 = new \GuzzleHttp\Client();
    $request1 = $client1->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetBalaiLelang');
    $response1 = $request1->getBody()->getContents();
    $response1 = collect(json_decode($response1,true));
    $response1 = $this->paginate($response1, '10');
    $response1->appends($request->only('searchKeyword'));

    return view('layouts/BankAccount/BalaiLelang/showBalaiLelang')
    ->with('response',$response1);
  }

  public function delete(Request $request)
  {

    $id=$request->input('id');
    $client2 = new \GuzzleHttp\Client();
    $request2 = $client2->get("https://acc-dev1.outsystemsenterprise.com/BankAccount_CS/rest/Laravel_BankAccount/DeleteBankAccountBalang?MstBankAccountBalangId=$id");
    $response2 = $request2->getBody()->getContents();
    $response2 = json_decode($response2,true);

    $client1 = new \GuzzleHttp\Client();
    $request1 = $client1->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_BankAccount/GetBalaiLelang');
    $response1 = $request1->getBody()->getContents();
    $response1 = collect(json_decode($response1,true));
    $response1 = $this->paginate($response1, '10');
    $response1->appends($request->only('searchKeyword'));


    Session::put('message', "The mst bank account balang was successfully deleted.");
    Session::put('alert', "success");

    return view('layouts/BankAccount/BalaiLelang/showBalaiLelang')
    ->with('response',$response1);
  }

}
