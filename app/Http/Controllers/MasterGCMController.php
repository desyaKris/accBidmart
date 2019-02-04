<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class MasterGCMController extends Controller
{
  public function show(Request $request)
   {

     $client2 = new \GuzzleHttp\Client();
     $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
     $response2 = $request2->getBody()->getContents();

       if ($request->input('Condition') != '--Chosee Condition--' && $request->input('ValueDesc') == null)
       {
         $data = $request->input('Condition');
         $client3 = new \GuzzleHttp\Client();
         $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$data");
         $response3 = $request3->getBody()->getContents();

         return view('layouts/MasterGCM/showMasterGCM')
         ->with('response2',json_decode($response2,true))
         ->with('response3',json_decode($response3,true));
       }
       elseif($request->input('Condition') != '--Chosee Condition--' && $request->input('ValueDesc') != null)
       {
         $data1=$request->input('Condition');
         $data2=$request->input('ValueDesc');
         $client3 = new \GuzzleHttp\Client();
         $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMValue?MasterGCMCondition=$data1&MasterGCMValue=$data2");
         $response3 = $request3->getBody()->getContents();

         return view('layouts/MasterGCM/showMasterGCM')
         ->with('response2',json_decode($response2,true))
         ->with('response3',json_decode($response3,true));
       }
       else
       {
         $client3 = new \GuzzleHttp\Client();
         $request3 = $client3->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
         $response3 = $request3->getBody()->getContents();

         return view('layouts/MasterGCM/showMasterGCM')
         ->with('response2',json_decode($response2,true))
         ->with('response3',json_decode($response3,true));
       }
    }


    public function ShowCreateMasterGCM(Request $request)
    {
      return view('layouts/MasterGCM/createMasterGCM');
    }

    public function create(Request $request)
    {
      $client5 = new \GuzzleHttp\Client();
      $request5 = $client5->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
      $response5 = $request5->getBody()->getContents();
      $dataCondition= json_decode($response5,true);

      foreach ($dataCondition as $dt)
      {
        if ($dt['Condition'] == $request->input('Condition')) {
          $client = new \GuzzleHttp\Client();
          $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/CreateOrUpdateMasterGCM',[
            'json'=>[
              'Condition'=>$request->input('Condition'),
              'CharValue1'=>$request->input('CharValue1'),
              'CharDesc1'=>$request->input('CharDesc1'),
              'CharValue2'=>$request->input('CharValue2'),
              'CharDesc2'=>$request->input('CharDesc2'),
              'CharValue3'=>$request->input('CharValue3'),
              'CharDesc3'=>$request->input('CharDesc3'),
              'CharValue4'=>$request->input('CharValue4'),
              'CharDesc4'=>$request->input('CharDesc4'),
              'CharValue5'=>$request->input('CharValue5'),
              'CharDesc5'=>$request->input('CharDesc5'),
              'AddedDate'=>$request->input('AddedDate'),
              'UserAdded'=>$request->input('UserAdded'),
              'UpdatedDate'=>$request->input('UpdatedDate'),
              'UserUpdated'=>$request->input('UserUpdated'),
              'IsActive'=>'N'
            ]
          ]);
        }
        elseif($dt['Condition'] != $request->input('Condition'))
        {
          $client = new \GuzzleHttp\Client();
          $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/CreateOrUpdateConditionMasterGCM',[
            'json'=>[
              'Condition'=>$request->input('Condition'),
            ]
          ]);

          $client = new \GuzzleHttp\Client();
          $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/CreateOrUpdateMasterGCM',[
            'json'=>[
              'Condition'=>$request->input('Condition'),
              'CharValue1'=>$request->input('CharValue1'),
              'CharDesc1'=>$request->input('CharDesc1'),
              'CharValue2'=>$request->input('CharValue2'),
              'CharDesc2'=>$request->input('CharDesc2'),
              'CharValue3'=>$request->input('CharValue3'),
              'CharDesc3'=>$request->input('CharDesc3'),
              'CharValue4'=>$request->input('CharValue4'),
              'CharDesc4'=>$request->input('CharDesc4'),
              'CharValue5'=>$request->input('CharValue5'),
              'CharDesc5'=>$request->input('CharDesc5'),
              'AddedDate'=>$request->input('AddedDate'),
              'UserAdded'=>$request->input('UserAdded'),
              'UpdatedDate'=>$request->input('UpdatedDate'),
              'UserUpdated'=>$request->input('UserUpdated'),
              'IsActive'=>'N'
            ]
          ]);
          break;
        }
      }

      $client2 = new \GuzzleHttp\Client();
      $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
      $response2 = $request2->getBody()->getContents();

      $client3 = new \GuzzleHttp\Client();
      $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMValue?MasterGCMCondition=&MasterGCMValue=");
      $response3 = $request3->getBody()->getContents();

      return view('layouts/MasterGCM/showMasterGCM')
      ->with('response2',json_decode($response2,true))
      ->with('response3',json_decode($response3,true));
    }

    public function delete(Request $request)
    {
      $ID=$request->input('id');
      $Condition=$request->input('Condition');

      $client = new \GuzzleHttp\Client();
      $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/DeleteMasterGCM?MasterGCMId=$ID");
      $response = $request->getBody()->getContents();

      $client5 = new \GuzzleHttp\Client();
      $request5 = $client5->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$Condition");
      $response5 = $request5->getBody()->getContents();
      $tempCondition= json_decode($response5,true);

        if($tempCondition == null)
        {
          $client4 = new \GuzzleHttp\Client();
          $request4 = $client4->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
          $response4 = $request4->getBody()->getContents();
          $tempCondition2=json_decode($response4,true);
          foreach ($tempCondition2 as $dt2)
          {
            if($dt2['Condition']==$Condition)
            {
              $ID=$dt2['Id'];
              dd($ID);
              $client = new \GuzzleHttp\Client();
              $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/DeleteMasterGCMCondition?MasterGCMCondition=$ID");
              $response = $request->getBody()->getContents();
            }
          }
        }



      $client2 = new \GuzzleHttp\Client();
      $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
      $response2 = $request2->getBody()->getContents();

      $client3 = new \GuzzleHttp\Client();
      $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMValue?MasterGCMCondition=&MasterGCMValue=");
      $response3 = $request3->getBody()->getContents();

      return view('layouts/MasterGCM/showMasterGCM')
      ->with('response2',json_decode($response2,true))
      ->with('response3',json_decode($response3,true));
    }

}
