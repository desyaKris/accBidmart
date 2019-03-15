<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Imports\UserImport;
use Illuminate\Pagination\LengthAwarePaginator;
use Excel;
use Session;

class OnlineEventController extends Controller
{
  public function show(Request $request)
   {
     $temp = $request->input('data');

     //untuk menghapus session alert sebelumnya
     Session::put('alert','null');

     if ($request->input('data') == null) {
       $client7 = new \GuzzleHttp\Client();
       // $request7 = $client7->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAll');
       $request7 = $client7->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_OnlineEvent/GetOnlineEvent');
       $response7 = $request7->getBody()->getContents();

       $response7 = collect(json_decode($response7,true));

      $response7 = $this->paginate($response7, '10');
      $response7->appends($request->only('data'));

       return view('layouts/OnlineEvent/showOnlineEvent')
       ->with('response',$response7);
     }else {

       $client3 = new \GuzzleHttp\Client();
       // $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/SearchOnlineEvent?OnlineEventSearch=$temp");
       $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_OnlineEvent/SearchOnlineEvent?searchKeyword=$temp");
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
       // $request4 = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAreaLelang');
       $request4 = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_OnlineEvent/GetAreaLelang');

       $response = $request4->getBody()->getContents();

       $client2 = new \GuzzleHttp\Client();
       // $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOlineEventBalaiLelang');
       $request2 = $client2->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_OnlineEvent/GetBalaiLelang');
       $response2 = $request2->getBody()->getContents();

       $client3 = new \GuzzleHttp\Client();
       // $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventId?GetOnlineEventId=$temp");
       $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_OnlineEvent/GetOnlineEventbyId?OnlineEventId=$temp");
       $response3 = $request3->getBody()->getContents();

       return view('layouts/OnlineEvent/editOnlineEvent')
         ->with('response3',json_decode($response3,true))
         ->with('response2',json_decode($response2,true))
         ->with('response',json_decode($response,true));
      }


    public function showCreateOnlineEvent()
     {

       $client = new \GuzzleHttp\Client();
       $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_OnlineEvent/GetAreaLelang');
       $response = $request->getBody()->getContents();

       $client2 = new \GuzzleHttp\Client();
       $request2 = $client2->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_OnlineEvent/GetBalaiLelang');
       $response2 = $request2->getBody()->getContents();


       return view('layouts/OnlineEvent/createOnlineEvent')
       ->with('response2',json_decode($response2,true))
       ->with('response',json_decode($response,true));
      }

    public function create(Request $request)
    {
      $areaLelangID=$request->input('AreaLelang');
      $balaiLelangID=$request->input('BalaiLelang');
      $eventName= $request->input('EventName');
      $client4 = new \GuzzleHttp\Client();
      // $request4 = $client4->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAreaLelang');
      $request4 = $client4->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMAreaLelangId?Chardesc1=$areaLelangID");
      $response4 = $request4->getBody()->getContents();
      $response4 = json_decode($response4,true);

      //cek exist event name
      $client7 = new \GuzzleHttp\Client();
      $request7 = $client7->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_OnlineEvent/CheckExistEventName?EventName=$eventName");
      $response7 = $request7->getBody()->getContents();


      $client5 = new \GuzzleHttp\Client();
      // $request5 = $client5->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOlineEventBalaiLelang');
      $request5 = $client5->get("https://acc-dev1.outsystemsenterprise.com/Lelang_CS/rest/LaravelAPIBalaiLelang/GetBalaiLelangId?BalaiLelang=$balaiLelangID");
      $response5 = $request5->getBody()->getContents();
      $response5 = json_decode($response5,true);

      if ($request->input('Id') != null)
      {
        $client = new \GuzzleHttp\Client();
        // $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
        $response = $client->request('POST','https://acc-dev1.outsystemsenterprise.com/Event_CS/rest/Laravel_OnlineEvent/CreateOrUpdateOnlineEvent',[
          'json'=>[
          'Id'=>$request->input('Id'),
          'AreaLelangId'=> $response4,
          'BalaiLelangIdMst'=> $response5,
          'EventCode'=>$request->input('EventCode'),
          'EventName'=> $request->input('EventName'),
          'StartDate'=> $request->input('StartDate'),
          'EndDate'=> $request->input('EndDate'),
          'OpenHouseStartDate'=> $request->input('OpenHouseStartDate'),
          'OpenHouseEndDate'=> $request->input('OpenHouseEndDate'),
          'AddedDate'=>$request->input('AddedDate'),
          'UserAdded'=>1234,
          'UpdatedDate'=>$request->input('UpdatedDate'),
          'UserUpdated'=>null,
          'IsActive'=> true
          ]
        ]);

        $message = "OnlineEvent ".$request->input('EventName')." was successfully updated";
        Session::put('alert','success');
        Session::put('message',$message);
      }
      else
      {
        if ($response7 == null)
        {
          $date=substr($request->input('AddedDate'),14,-3);
          $date2=substr($request->input('AddedDate'),17);
          $eventStr=strtoupper(substr($request->input('EventName'),0,3));
          $eventStr =$date.$date2.$eventStr;

          $client = new \GuzzleHttp\Client();
          // $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
            $response = $client->request('POST','https://acc-dev1.outsystemsenterprise.com/Event_CS/rest/Laravel_OnlineEvent/CreateOrUpdateOnlineEvent',[
            'json'=>[
              'AreaLelangId'=> $response4,
              'BalaiLelangIdMst'=> $response5,
              'EventCode'=>$eventStr,
              'EventName'=> $request->input('EventName'),
              'StartDate'=> $request->input('StartDate'),
              'EndDate'=> $request->input('EndDate'),
              'OpenHouseStartDate'=> $request->input('OpenHouseStartDate'),
              'OpenHouseEndDate'=> $request->input('OpenHouseEndDate'),
              'AddedDate'=>$request->input('AddedDate'),
              'UserAdded'=>1234,
              'UpdatedDate'=>null,
              'UserUpdated'=>null,
              'IsActive'=> true
            ]
          ]);
          $message = "OnlineEvent ".$request->input('EventName')." was successfully created";
          Session::put('alert','success');
          Session::put('message',$message);
        }
        else
        {
          $message = "Can't create online event because online event already exist.";
          Session::put('alert','error');
          Session::put('message',$message);
        }
      }

      $client = new \GuzzleHttp\Client();
      $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_OnlineEvent/GetOnlineEvent');
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

    public function showUpload(){
      return view('layouts/OnlineEvent/uploadOnlineEvent');
    }

    public function upload(Request $request)
    {
      dd($request->file('import_excel'));
      $this->validate($request, [
            'import_excel' => 'required|mimes:xls,xlsx'
        ]);

      if($request->hasFile('import_excel'))
      {
        $array = Excel::toArray(new UserImport, $request->file('import_excel')); //IMPORT FILE
        foreach ($array as $dt)
        {
          $dataExport=$dt;
        }
        $count=0;
        foreach ($dataExport as $dt2)
         {
            if ($count!=0)
            {
              $client4 = new \GuzzleHttp\Client();
              $request4 = $client4->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOnlineEventAreaLelang');
              $response4 = $request4->getBody()->getContents();
              $response4 = json_decode($response4,true);

              $client5 = new \GuzzleHttp\Client();
              $request5 = $client5->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/GetOlineEventBalaiLelang');
              $response5 = $request5->getBody()->getContents();
              $response5 = json_decode($response5,true);
              $client = new \GuzzleHttp\Client();

              foreach ($response4 as $dt4)
              {
                if ($dt4['AreaLelang'] == $dt2[0])
                {
                  foreach ($response5 as $dt5) {
                    if ($dt5['BalaiLelang'] == $dt2[1])
                    {
                      $date=substr($request->input('AddedDate'),14,-3);
                      $date2=substr($request->input('AddedDate'),17);
                      $eventStr=strtoupper(substr($request->input('EventName'),0,3));
                      $eventStr =$date.$date2.$eventStr;

                      $response = $client->request('POST','https://acc-dev1.outsystemsenterprise.com/Event_CS/rest/Laravel_OnlineEvent/CreateOrUpdateOnlineEvent',[
                        'json'=>[
                        'EventCode'=>$eventStr,
                        'CodeAreaLelang'=>$dt4['CodeAreaLelang'],
                        'AreaLelang'=> $dt2[0],
                        'CodeBalaiLelang'=> $dt5['CodeBalaiLelang'],
                        'BalaiLelang'=> $dt2[1],
                        'EventName'=> $dt2[2],
                        'StartDate'=> $dt2[3],
                        'EndDate'=> $dt2[4],
                        'OpenHouseStartDate'=> $dt2[5],
                        'OpenHouseEndDate'=> $dt2[6],
                        'AddDate'=>$request->input('AddDate'),
                        'IsActive'=> $dt2[7]
                        ]
                      ]);
                    }
                  }
                }
              }
            }
            $count++;
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
}
