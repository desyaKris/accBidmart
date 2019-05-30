<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

class UserManagementVerifikasiAccountController extends Controller
{
    public function show(Request $request)
    {
      $keyword=$request->input('keyword');
      Session::put('alert','null');
      $client = new \GuzzleHttp\Client();
      if($keyword != null)
      {
          $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement/SearchVerifikasiAccount?Keyword=$keyword");
          $response = $request->getBody()->getContents();
          $response= collect(json_decode($response,true));
          $response = $this->paginate($response, '10');
      }
      else
      {
        $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement/getVerifikasiAccountBidding');
        $response = $request->getBody()->getContents();
        $response= collect(json_decode($response,true));
        $response = $this->paginate($response, '10');
      }

      return view('layouts/UserManagement/VerifikasiAccountBidding/showVerifikasiAccountBidding')
      ->with('response',$response);
    }

    public function showById(Request $request)
    {
      $id=$request->input('id');
      $client = new \GuzzleHttp\Client();
      $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement/ShowByIdVerifikasiAccount?Id=$id");
      $response = $request->getBody()->getContents();
      $response= json_decode($response,true);

      return view('layouts/UserManagement/VerifikasiAccountBidding/editVerifikasiAccountBidding')
      ->with('response',$response);
    }

    public function createOrUpdate(Request $request)
    {
        $status;
        $reason;
        $id=$request->input('Id');
        $client = new \GuzzleHttp\Client();
        $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement/ShowByIdVerifikasiAccount?Id=$id");
        $response2 = $request2->getBody()->getContents();
        $response2= json_decode($response2,true);

        if($request->input('action') == "Verify")
        {
          $status = "Verified";
          $reason="";
          $message = "User ".$request->input('Name')." was successfully Veryfied";
        }
        else {
          $status = "DiBatalkan";
          $reason = $request->input('Reason');
          $message = "User ".$request->input('Name')." was successfully Rejected";
        }

        foreach($response2 as $dt)
        {
          $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement/CreateVerifikasiAccountBidding',[
            'json'=>[
            'Id'=>$request->input('Id'),
            'Name'=> $dt['Name'],
            'Fullname' => $dt['FullName'],
            'Status' => $status,
            'Username' => $dt['Username'],
            'Email' => $dt['Email'],
            'NIK' => $dt['NIK'],
            'NPWP' => $dt['NPWP'],
            'TanggalLahir' => $dt['TanggalLahir'],
            'Alamat' => $dt['Alamat'],
            'NamaKTP' => $dt['NamaKTP'],
            'Reason' => $reason,
            'MobilePhone' => $dt['MobilePhone'],
            'Role' => $dt['Role'],
            'UserCategory' => $dt['UserCategory'],
            'Organization' => $dt['Organization'],
            'AddedDate' => $request->input('AddedDate'),
            'UserAdded' => 12312,
            'UpdatedDate' => $request->input('UpdatedDate'),
            ]
          ]);
        }


        Session::put('alert','success');
        Session::put('message',$message);


      $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement/getVerifikasiAccountBidding');
      $response = $request->getBody()->getContents();
      $response= collect(json_decode($response,true));
      $response = $this->paginate($response, '10');

      return view('layouts/UserManagement/VerifikasiAccountBidding/showVerifikasiAccountBidding')
      ->with('response',$response);
    }

    public function paginate($items,$perPage)
    {
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $currentResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
       return new LengthAwarePaginator($currentResults, $items->count(), $perPage);
    }
}
