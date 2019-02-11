<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
class OnlineEventController extends Controller
{
  public function show(Request $request)
   {
     $temp = $request->input('data');
     if ($request->input('data') == null) {
       $client7 = new \GuzzleHttp\Client();
       $request7 = $client7->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAll');
       $response7 = $request7->getBody()->getContents();
       $response7 = collect(json_decode($response7,true));

      $response7 = $this->paginate($response7, '10');
      $response7->appends($request->only('data'));

       return view('layouts/OnlineEvent/showOnlineEvent')
       ->with('response',$response7);
     }else {

       $client3 = new \GuzzleHttp\Client();
       $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/SearchOnlineEvent?OnlineEventSearch=$temp");
       $response3 = $request3->getBody()->getContents();
       $response3 = collect(json_decode($response3,true));
       $response3 = $this->paginate($response3, '10');
       $response3->appends($request->only('data'));

       return view('layouts/OnlineEvent/showOnlineEvent')->with('response',$response3);
     }
    }


    public function paginate($items,$perPage)
    {
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $currentResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
       return new LengthAwarePaginator($currentResults, $items->count(), $perPage);
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
       ->with('response2',json_decode($response2,true))
       ->with('response3',json_decode($response3,true))
       ->with('response',json_decode($response,true));
      }

    public function create(Request $request)
    {
      $client4 = new \GuzzleHttp\Client();
      $request4 = $client4->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAreaLelang');
      $response4 = $request4->getBody()->getContents();
      $response4 = json_decode($response4,true);

      $client5 = new \GuzzleHttp\Client();
      $request5 = $client5->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOlineEventBalaiLelang');
      $response5 = $request5->getBody()->getContents();
      $response5 = json_decode($response5,true);

      if ($request->input('Id') != null){
        foreach ($response4 as $dt4) {
          if ($dt4['AreaLelang'] == $request->input('AreaLelang'))
          {
            foreach ($response5 as $dt5)
            {
              if ($dt5['BalaiLelang'] == $request->input('BalaiLelang')) {
                //generate Event Code
                $date=substr($request->input('AddDate'),15,-3);
                $date2=substr($request->input('AddDate'),18);
                $eventStr=strtoupper(substr($request->input('EventName'),0,3));
                $eventStr =$date.$date2.$eventStr;

                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
                  'json'=>[
                  'Id'=>$request->input('Id'),
                  'EventCode'=>$eventStr,
                  'CodeAreaLelang'=>$dt4['CodeAreaLelang'],
                  'AreaLelang'=> $request->input('AreaLelang'),
                  'CodeBalaiLelang'=> $dt5['CodeBalaiLelang'],
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
              }
            }
          }
        }

        }else {
          foreach ($response4 as $dt4) {
            if ($dt4['AreaLelang'] == $request->input('AreaLelang'))
            {
              foreach ($response5 as $dt5)
              {
                if ($dt5['BalaiLelang'] == $request->input('BalaiLelang'))
                {
                  $date=substr($request->input('AddDate'),15,-3);
                  $date2=substr($request->input('AddDate'),18);
                  $eventStr=strtoupper(substr($request->input('EventName'),0,3));
                  $eventStr =$date.$date2.$eventStr;

                  $client = new \GuzzleHttp\Client();
                  $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
                    'json'=>[
                    'EventCode'=>$eventStr,
                    'CodeAreaLelang'=>$dt4['CodeAreaLelang'],
                    'AreaLelang'=> $request->input('AreaLelang'),
                    'CodeBalaiLelang'=> $dt5['CodeBalaiLelang'],
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
              }
            }
          }
        }

      $client = new \GuzzleHttp\Client();
      $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAll');
      $response = $request->getBody()->getContents();
      $response = collect(json_decode($response,true));
      $response = $this->paginate($response, '10');

      return view('layouts/OnlineEvent/showOnlineEvent')
      ->with('response',$response);

    }

    public function updateCondition(Request $request)
    {
      $temp = $request->input('id');
      $client3 = new \GuzzleHttp\Client();
      $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventId?GetOnlineEventId=$temp");
      $response3 = $request3->getBody()->getContents();
      $response3 = json_decode($response3,true);

      foreach ($response3 as $dt)
      {
        $date=substr($dt['AddDate'],15,-3);
        $date2=substr($dt['AddDate'],18);
        $eventStr=strtoupper(substr($dt['EventName'],0,3));
        $eventStr =$date.$date2.$eventStr;

        if ($dt['IsActive']=="Y") {
          $client = new \GuzzleHttp\Client();
          $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
            'json'=>[
            'Id'=>$dt['Id'],
            'EventCode'=>$eventStr,
            'CodeAreaLelang'=>$dt['CodeAreaLelang'],
            'AreaLelang'=> $dt['AreaLelang'],
            'CodeBalaiLelang'=> $dt['CodeBalaiLelang'],
            'BalaiLelang'=> $dt['BalaiLelang'],
            'EventName'=> $dt['EventName'],
            'StartDate'=> $dt['StartDate'],
            'EndDate'=> $dt['EndDate'],
            'OpenHouseStartDate'=> $dt['OpenHouseStartDate'],
            'OpenHouseEndDate'=> $dt['OpenHouseEndDate'],
            'AddDate'=>$dt['AddDate'],
            'IsActive'=> 'N'
            ]
          ]);
        }elseif ($dt['IsActive']=="N") {
          $client = new \GuzzleHttp\Client();
          $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
            'json'=>[
            'Id'=>$dt['Id'],
            'EventCode'=>$eventStr,
            'CodeAreaLelang'=>$dt['CodeAreaLelang'],
            'AreaLelang'=> $dt['AreaLelang'],
            'CodeBalaiLelang'=> $dt['CodeBalaiLelang'],
            'BalaiLelang'=> $dt['BalaiLelang'],
            'EventName'=> $dt['EventName'],
            'StartDate'=> $dt['StartDate'],
            'EndDate'=> $dt['EndDate'],
            'OpenHouseStartDate'=> $dt['OpenHouseStartDate'],
            'OpenHouseEndDate'=> $dt['OpenHouseEndDate'],
            'AddDate'=>$dt['AddDate'],
            'IsActive'=> 'Y'
            ]
          ]);
        }
      }

      $client = new \GuzzleHttp\Client();
      $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAll');
      $response = $request->getBody()->getContents();
      $response = collect(json_decode($response,true));
      $response = $this->paginate($response, '10');

      return view('layouts/OnlineEvent/showOnlineEvent')
      ->with('response',$response);
    }

    // public function search(Request $request)
    // {
    //   $temp = $request->input('data');
    //   $client3 = new \GuzzleHttp\Client();
    //   $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/SearchOnlineEvent?OnlineEventSearch=$temp");
    //   $response3 = $request3->getBody()->getContents();
    //   $response3 = collect(json_decode($response3,true));
    //   $response3 = $this->paginate($response3, '5');
    //   $response3->appends($request->only('data'));
    //
    //   return view('layouts/OnlineEvent/showOnlineEvent')->with('response',$response3);
    // }
}
