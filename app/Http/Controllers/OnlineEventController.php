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

       return view('layouts/OnlineEvent/showOnlineEvent')
       ->with('response',json_decode($response,true));
    }

    public function showById(Request $request)
     {
       $temp = $request->input('id');
       $client = new \GuzzleHttp\Client();
       $request4 = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAreaLelang');
       $response = $request4->getBody()->getContents();

       $client2 = new \GuzzleHttp\Client();
       $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOlineEventBalaiLelang');
       $response2 = $request2->getBody()->getContents();

       $client3 = new \GuzzleHttp\Client();
       $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventId?GetOnlineEventId=$temp");
       $response3 = $request3->getBody()->getContents();

       return view('layouts/OnlineEvent/editOnlineEvent')
         ->with('response3',json_decode($response3,true))
         ->with('response2',json_decode($response2,true))
         ->with('response',json_decode($response,true));
      }


    public function showCreateOnlineEvent()
     {

       $client = new \GuzzleHttp\Client();
       $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAreaLelang');
       $response = $request->getBody()->getContents();

       $client2 = new \GuzzleHttp\Client();
       $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOlineEventBalaiLelang');
       $response2 = $request2->getBody()->getContents();

       $client3 = new \GuzzleHttp\Client();
       $request3 = $client3->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAreaLelang');
       $response3 = $request3->getBody()->getContents();

       return view('layouts/OnlineEvent/createOnlineEvent')
       ->with('response3',json_decode($response3,true))
       ->with('response2',json_decode($response2,true))
       ->with('response',json_decode($response,true));
      }

    public function create(Request $request)
    {
      if ($request->input('Id') != null){
          $client = new \GuzzleHttp\Client();
          $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
            'json'=>[
            'Id'=>$request->input('Id'),
            'EventCode'=>'EventCode1',
            'CodeAreaLelang'=>$request->input('CodeAreaLelang'),
            'AreaLelang'=> $request->input('AreaLelang'),
            'BalaiLelang'=> $request->input('BalaiLelang'),
            'EventName'=> $request->input('EventName'),
            'StartDate'=> $request->input('StartDate'),
            'EndDate'=> $request->input('EndDate'),
            'OpenHouseStartDate'=> $request->input('OpenHouseStartDate'),
            'OpenHouseEndDate'=> $request->input('OpenHouseEndDate'),
            'AddDate'=>$request->input('AddDate'),
            'IsActive'=> $request->input('IsActive')
            ]
          ]);
          $alert = 'Data berhasil di edit';
        }else {
          $client = new \GuzzleHttp\Client();
          $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
            'json'=>[
            'EventCode'=>'EventCode1',
            'CodeAreaLelang'=>$request->input('CodeAreaLelang'),
            'AreaLelang'=> $request->input('AreaLelang'),
            'BalaiLelang'=> $request->input('BalaiLelang'),
            'EventName'=> $request->input('EventName'),
            'StartDate'=> $request->input('StartDate'),
            'OpenHouseStartDate'=> $request->input('OpenHouseStartDate'),
            'EndDate'=> $request->input('EndDate'),
            'OpenHouseEndDate'=> $request->input('OpenHouseEndDate'),
            'AddDate'=>$request->input('AddDate'),
            'IsActive'=> 'Y'
            ]
          ]);

          $alert = 'Data berhasil di tambahkan';
        }

      $client = new \GuzzleHttp\Client();
      $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAll');
      $response = $request->getBody()->getContents();

      return view('layouts/OnlineEvent/showOnlineEvent')
      ->with('response',json_decode($response,true));

    }

    public function search(Request $request)
    {
      $temp = $request->input('data');
      $client = new \GuzzleHttp\Client();
      $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/SearchOnlineEvent?OnlineEventSearch=$temp");
      $response = $request->getBody()->getContents();

      return view('layouts/OnlineEvent/showOnlineEvent')->with('response',json_decode($response,true));
    }
}
