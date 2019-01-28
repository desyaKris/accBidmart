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
}
