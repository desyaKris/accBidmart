<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

class ContentManagementPromoController extends Controller
{
  public function show(Request $request)
  {
        $keyword=$request->input('keyword');
        Session::put('alert','null');
        $client = new \GuzzleHttp\Client();

        if($keyword != null)
        {
            $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementPromo/SearchPromo?Keyword=$keyword");
            $response = $request->getBody()->getContents();
            $response= collect(json_decode($response,true));
            $response = $this->paginate($response, '10');
        }
        else
        {
          $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementPromo/ShowPromo');
          $response = $request->getBody()->getContents();
          $response= collect(json_decode($response,true));
          $response = $this->paginate($response, '10');
        }

        return view('layouts/ContentManagement/Promo/showPromo')
        ->with('response',$response);

  }

  public function showById(Request $request)
  {
    $id=$request->input('id');
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementPromo/ShowById?Id=$id");
    $response = $request->getBody()->getContents();
    $response= json_decode($response,true);

    return view('layouts/ContentManagement/Promo/editPromo')
    ->with('response',$response);
  }

  public function showcreate()
  {
    return view('layouts/ContentManagement/Promo/createPromo');
  }

  public function createOrUpdate(Request $request)
  {
    // dd($request);

    if ($request->input('Id') != null)
    {
      $isActive;
      if($request->input('IsActive') == "Y")
      {
        $isActive = true;
      }
      else {
        $isActive = false;
      }
      $client = new \GuzzleHttp\Client();
      // $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
      $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementPromo/CreateOrUpdatePromo',[
        'json'=>[
        'Id'=>$request->input('Id'),
        'Name'=> $request->input('Name'),
        'PromoCode' => $request->input('PromoCode'),
        'Description' => $request->input('Description'),
        'IsActive' => $isActive,
        'AddedDate' => $request->input('AddedDate'),
        'UserAdded' => 123,
        'UpdatedDate' => $request->input('UpdatedDate'),
        'UserUpdated' => 123,
        'StartDate' => $request->input('StartDate'),
        'EndDate' => $request->input('EndDate'),
        'SyaratDanKetentuan' => $request->input('SyaratDanKetentuan'),
        'PromoType' => $request->input('PromoType'),
        'PromoAmount' => $request->input('PromoAmount'),
        'ProductOwner' => null
        ]
      ]);

      $message = "Promo ".$request->input('Name')." was successfully updated";
      Session::put('alert','success');
      Session::put('message',$message);
    }
    else
    {
      // if ($response7 == null)
      // {

      $isActive;
      if($request->input('IsActive') == "Y")
      {
        $isActive = true;
      }
      else {
        $isActive = false;
      }
        $client = new \GuzzleHttp\Client();
        // $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
        $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementPromo/CreateOrUpdatePromo',[
          'json'=>[
            'Name'=> $request->input('Name'),
            'PromoCode' => $request->input('PromoCode'),
            'Description' => $request->input('Description'),
            'IsActive' => $isActive,
            'AddedDate' => $request->input('AddedDate'),
            'UserAdded' => 123,
            'UpdatedDate' =>null,
            'UserUpdated' => null,
            'StartDate' => $request->input('StartDate'),
            'EndDate' => $request->input('EndDate'),
            'SyaratDanKetentuan' => $request->input('SyaratDanKetentuan'),
            'PromoType' => $request->input('PromoType'),
            'PromoAmount' => $request->input('PromoAmount'),
            'ProductOwner' => null
          ]
        ]);
        $message = "Promo ".$request->input('Name')." was successfully created";
        Session::put('alert','success');
        Session::put('message',$message);
      // }
      // else
      // {
      //   $message = "Can't create online event because online event already exist.";
      //   Session::put('alert','error');
      //   Session::put('message',$message);
      // }
    }

    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementPromo/ShowPromo");
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');

  return view('layouts/ContentManagement/Promo/showPromo')
  ->with('response',$response);
  }

  public function delete(Request $request)
  {
    $id = $request->input('id');
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementPromo/DeletePromo?Id=$id");
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');
    $name;
    foreach ($response as $dt) {
      $name = $dt['Name'];
    }

    $message = "Promo ".$name." was successfully deleted";
    Session::put('alert','success');
    Session::put('message',$message);
    return view('layouts/ContentManagement/Promo/showPromo')
    ->with('response',$response);
  }

  public function UpdateIsActive($IsChecked,$Id)
  {
    if ($IsChecked == "")
    {

    }
  }
  public function paginate($items,$perPage)
  {
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $currentResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
     return new LengthAwarePaginator($currentResults, $items->count(), $perPage);
  }
}
