<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

class UserManagementApprovalUserController extends Controller
{
  public function show(Request $request)
  {
    Session::put('alert','null');

    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/getApprovalChangeUserPending");
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');

    $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/getApprovalChangeUserExpired");
    $response2 = $request2->getBody()->getContents();
    $response2= collect(json_decode($response2,true));
    $response2 = $this->paginate($response2, '10');

    return view('layouts/UserManagement/ApprovalChangesUser/showApprovalChangesUser')
    ->with('response',$response)
    ->with('response2',$response2);
  }

  public function showByIdUserExpired(Request $request)
  {
    $id=$request->input('id');
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/showByIdApprovalChangeUserExpired?Id=$id");
    $response = $request->getBody()->getContents();
    $response= json_decode($response,true);

    return view('layouts/UserManagement/ApprovalChangesUser/editApprovalChangesUserExpired')
    ->with('response',$response);
  }

  public function showByIdUserPending(Request $request)
  {
    $id=$request->input('id');
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/showByIdApprovalChangeUserPending?ID=$id");
    $response = $request->getBody()->getContents();
    $response= json_decode($response,true);

    return view('layouts/UserManagement/ApprovalChangesUser/editApprovalChangesUserPending')
    ->with('response',$response);
  }

  public function editUserPending(Request $request)
  {
      $status;
      $reason="";
      $id=$request->input('Id');
      $client = new \GuzzleHttp\Client();
      $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/showByIdApprovalChangeUserPending?ID=$id");
      $response2 = $request2->getBody()->getContents();
      $response2= json_decode($response2,true);

      if($request->input('action') == "Verify")
      {
        $status = "Verified";
        $message = "User ".$request->input('Name')." was successfully Veryfied";
      }
      else {
        $status = "DiBatalkan";
        $message = "User ".$request->input('Name')." was successfully Rejected";
      }

      foreach($response2 as $dt)
      {
        $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/editApprovalChangeUserPending',[
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


    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/getApprovalChangeUserPending");
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');

    $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/getApprovalChangeUserExpired");
    $response2 = $request2->getBody()->getContents();
    $response2= collect(json_decode($response2,true));
    $response2 = $this->paginate($response2, '10');

    return view('layouts/UserManagement/ApprovalChangesUser/showApprovalChangesUser')
    ->with('response',$response)
    ->with('response2',$response2);
  }

  public function editUserExpired(Request $request)
  {
      $status;
      $id=$request->input('Id');
      $client = new \GuzzleHttp\Client();
      $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/showByIdApprovalChangeUserExpired?Id=$id");
      $response2 = $request2->getBody()->getContents();
      $response2= json_decode($response2,true);

      if($request->input('action') == "Renew")
      {
        $reason="";
        $status = "Verified";
        $message = "Email was successfully Send ".$request->input('Name')."";
      }

      foreach($response2 as $dt)
      {
        $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/editApprovalChangeUserExpired',[
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


    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/getApprovalChangeUserPending");
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');

    $request2 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/UserManagement2/getApprovalChangeUserExpired");
    $response2 = $request2->getBody()->getContents();
    $response2= collect(json_decode($response2,true));
    $response2 = $this->paginate($response2, '10');

    return view('layouts/UserManagement/ApprovalChangesUser/showApprovalChangesUser')
    ->with('response',$response)
    ->with('response2',$response2);
  }

  public function paginate($items,$perPage)
  {
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $currentResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
     return new LengthAwarePaginator($currentResults, $items->count(), $perPage);
  }
}
