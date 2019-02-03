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
}
