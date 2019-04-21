<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UserImport;
use Carbon\Carbon;
use Excel;
use Illuminate\Pagination\LengthAwarePaginator;

class BalaiLelangController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $client = new \GuzzleHttp\Client();

    $request = $client->get('https://acc-dev1.outsystemsenterprise.com/Lelang_CS/rest/LaravelAPIBalaiLelang/GetBalaiLelang');

    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 10;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

    return view('layouts/BalaiLelang/indexBalai')->with('response',$results);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $client = new \GuzzleHttp\Client();
     // dd($request);
    $picture = date('Ymd').Carbon::today()->toDateString();
      $counter = 0;
      // dd($request->Pict);
      if($request->hasfile('Pict'))
      {
          $file= $request->file('Pict');
              $size = filesize($file);
              if($size > 10485760)
              {
                  return redirect()->back()->with('alert', 'Cannot Upload more than 10MB Files!');
              }
              $extension = $file->getClientOriginalExtension();
              $name = $picture."_".$counter.".".$extension;
              // dd($name);
              $file->move(public_path().'/images/', strtolower($name));
              $data[] = strtolower($name);
              $counter++;
          // dd($file);
      }
    $response = $client->request('POST','https://acc-dev1.outsystemsenterprise.com/Lelang_CS/rest/LaravelAPIBalaiLelang/CreateOrUpdateBalaiLelang',[
      'json'=>[
        'Code'=> $request->BALAI_CODE,
        'Description'=> $request->DESCRIPTION,
        'Address'=>$request->ADDRESS,
        'Email' => $request->EMAIL,
        'PhoneNumber' => $request->PHONE_NUM,
        'ContactName' => $request->NAME,
        'IsActive' => $request->IS_ACTIVE,
        'PICTURE' => 1234,
        'FaxNo'=> $request->FaxNo,
        'MailNo'=> $request->MailNo
      ]
    ]);

    $request = $client->get('https://acc-dev1.outsystemsenterprise.com/Lelang_CS/rest/LaravelAPIBalaiLelang/GetBalaiLelang');

    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 10;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

    return view('layouts/BalaiLelang/indexBalai')->with('response',$results);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function search(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $query= $request->search;

    $req = $client->get("https://kevinantariksa.outsystemscloud.com/API/rest/BalaiLelangAPI/SearchByQuerry?BalaiLelangID=$query");

    $response = $req->getBody()->getContents();
    $response =  collect(json_decode($response,true));
    // $response->appends($request->only('search'));
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 10;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

    return view('layouts/BalaiLelang/indexBalai')->with('response',$results);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\BalaiLelang  $balaiLelang
   * @return \Illuminate\Http\Response
   */
  public function buat(BalaiLelang $balaiLelang)
  {
      return  view('layouts/BalaiLelang/createBalaiLelang');
  }

  public function upld()
  {
    return view('layouts/BalaiLelang/uploadBalaiLelang');
  }

  public function upload(Request $request)
  {
    $client = new \GuzzleHttp\Client();

    $array = Excel::toArray(new UserImport, $request->file('Excel')); //IMPORT FILE

    foreach ($array as $dt)
    {
      $dataExport=$dt;
    }

    $count=0;
    foreach ($dataExport as $dat) {
      if($count>0)
      {
        $response = $client->request('POST','https://kevinantariksa.outsystemscloud.com/API/rest/BalaiLelangAPI/CreateOrUpdateBalaiLelang',[
          'json'=>[
            'BALAI_CODE'=> $dat[0],
            'DESCRIPTION'=> $dat[1],
            'ADDRESS'=>$dat[5],
            'EMAIL' => $dat[3],
            'PHONE_NUM' => $dat[4],
            'NAME' => $dat[2],
            'IS_ACTIVE' => $dat[8],
            'PICTURE' => "",
            'FaxNo'=> $dat[6],
            'MailNo'=> $dat[7]
          ]
        ]);
      }
      $count++;
    }

    $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/BalaiLelangAPI/GetAllBalaiLelang');

    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 10;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

    return view('layouts/BalaiLelang/indexBalai')->with('response',$results);

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\BalaiLelang  $balaiLelang
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $client = new \GuzzleHttp\Client();

    $request = $client->get("https://acc-dev1.outsystemsenterprise.com/Lelang_CS/rest/LaravelAPIBalaiLelang/GetBalaiLelangByID?id=$id");

    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 10;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

    return view('layouts/BalaiLelang/editBalaiLelang')->with('response',$results);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\BalaiLelang  $balaiLelang
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $client = new \GuzzleHttp\Client();
      // dd($request);
    $picture = date('Ymd') .Carbon::today()->toDateString().$request->DESCRIPTION;
      $counter = 0;

      if($request->hasfile('Pict'))
      {
          $file= $request->file('Pict');
              $size = filesize($file);
              if($size > 10485760)
              {
                  return redirect()->back()->with('alert', 'Cannot Upload more than 10MB Files!');
              }
              $extension = $file->getClientOriginalExtension();
              $name = $picture."_".$counter.".".$extension;
              // dd($name);
              $file->move(public_path().'/images/', strtolower($name));
              $data[] = strtolower($name);
              $counter++;
          // dd($file);
      }

    $response = $client->request('POST','https://acc-dev1.outsystemsenterprise.com/Lelang_CS/rest/LaravelAPIBalaiLelang/CreateOrUpdateBalaiLelang',[
      'json'=>[
        'Id'=>$request->Id,
        'Code'=> $request->BALAI_CODE,
        'Description'=> $request->DESCRIPTION,
        'Address'=>$request->ADDRESS,
        'Email' => $request->EMAIL,
        'PhoneNumber' => $request->PHONE_NUM,
        'ContactName' => $request->NAME,
        'IsActive' => $request->IS_ACTIVE,
        'PICTURE' => $request->Pict,
        'FaxNo'=> $request->FaxNo,
        'MailNo'=> $request->MailNo
      ]
    ]);

    $request = $client->get('https://acc-dev1.outsystemsenterprise.com/Lelang_CS/rest/LaravelAPIBalaiLelang/GetBalaiLelang');

    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 10;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

    return view('layouts/BalaiLelang/indexBalai')->with('response',$results);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\BalaiLelang  $balaiLelang
   * @return \Illuminate\Http\Response
   */
  public function destroy(BalaiLelang $balaiLelang, $id)
  {
    $client = new \GuzzleHttp\Client();

    $url = "https://kevinantariksa.outsystemscloud.com/API/rest/BalaiLelangAPI/DeleteBalaiLelang?BalaiLelangID=$id";
    //dd($url);
    $response = $client->delete($url);
    $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/BalaiLelangAPI/GetAllBalaiLelang');
    $response = $request->getBody()->getContents();
    $response =  collect(json_decode($response,true));
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 10;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);

    return view('BalaiLelang/indexBalai')->with('response',$results);
  }
}
