<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class blogController extends Controller
{
    public function index()
     {
       return view('blog/home');
     }

     public function show($id)
     {
       $nilai = 'Ini isi varibabel = '.$id;
       return view('blog/home',['home'=>$nilai]);
     }

     public function getGuzzleRequest()
      {
          /*$client = new \GuzzleHttp\Client();
          $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMAll');
          $response = $request->getBody()->getContents();

          dd($response);
          */
          $client = new \GuzzleHttp\Client();
          $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetAllUnit');
          $response = $request->getBody()->getContents();
          echo '<pre>';
          return view('layouts/showOnlineEvent',['home'=>$response]);

        }
}
