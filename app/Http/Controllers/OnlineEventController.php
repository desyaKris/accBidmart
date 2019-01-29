<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class OnlineEventController extends Controller
{
  public function show()
   {
       $client = new \GuzzleHttp\Client();
       $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAll');
       $response = $request->getBody()->getContents();

       return view('layouts/OnlineEvent/showOnlineEvent')->with('response',json_decode($response,true));
    }

    public function create()
     {


       $client = new \GuzzleHttp\Client();
       $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAreaLelang');
       $response = $request->getBody()->getContents();

       /*$client2 = new \GuzzleHttp\Client();
       $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOlineEventBalaiLelang');
       $response2 = $request2->getBody()->getContents();*/
       return view('layouts/OnlineEvent/createOnlineEvent')->with('response',json_decode($response,true));
      }

    public function update(Request $request)
    {
      $client = new \GuzzleHttp\Client();

      $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
        'json'=>[
        'EventCode'=> $request->EventCode,
        'AreaLelang'=> $request->AreaLelang,
        'BalaiLelang'=> $request->BalaiLelang,
        'EventName'=> $request->EventName,
        'StartDate'=> $request->StartDate,
        'EndDate'=> $request->EndDate,
        'OpenHouseStartDate'=> $request->OpenHouseStartDate,
        'OpenHouseEndDate'=> $request->OpenHouseEndDate,
        'AddDate'=> '2014-12-31',
        'IsActive'=> 'Y'
        ]
      ]);
    }
}
