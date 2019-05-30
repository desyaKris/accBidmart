<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

class ContentManagementMasterContentController extends Controller
{
  public function show(Request $request)
  {
        $contentType = $request->input('ContentType');
        $keyword=$request->input('keyword');
        Session::put('alert','null');
        $client = new \GuzzleHttp\Client();

        $request2 = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/ShowContentType');
        $response2 = $request2->getBody()->getContents();
        $response2 = collect(json_decode($response2,true));
        $response2 = $this->paginate($response2, '10');

        if($contentType != "--Chose Content Type--")
        {

          if($contentType != "--Chose Content Type--" && $keyword != null)
          {
            $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/SearchbyContentType?ContenType=$contentType&Description=$keyword");
            $response = $request->getBody()->getContents();
            $response= collect(json_decode($response,true));
            $response = $this->paginate($response, '10');
          }
          else
          {
            $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/SearchbyContentType?ContenType=$contentType&Description=");
            $response = $request->getBody()->getContents();
            $response= collect(json_decode($response,true));
            $response = $this->paginate($response, '10');
          }
        }
        else
        {
          $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/SearchbyContentType?ContenType=&Description=");
          $response = $request->getBody()->getContents();
          $response= collect(json_decode($response,true));
          $response = $this->paginate($response, '10');
        }

        return view('layouts/ContentManagement/MasterContent/showMasterContent')
        ->with('response',$response)->with('response2',$response2);

  }

  public function showById(Request $request)
  {
    $id=$request->input('id');
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/ShowbyId?ID=$id");
    $response = $request->getBody()->getContents();
    $response= json_decode($response,true);

    $request2 = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/ShowContentType');
    $response2 = $request2->getBody()->getContents();
    $response2 = json_decode($response2,true);

    return view('layouts/ContentManagement/MasterContent/editMasterContent')
    ->with('response',$response)->with('response2',$response2);
  }

  public function showcreate()
  {
    $client = new \GuzzleHttp\Client();
    $request2 = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/ShowContentType');
    $response2 = $request2->getBody()->getContents();
    $response2 = collect(json_decode($response2,true));
    $response2 = $this->paginate($response2, '10');
    return view('layouts/ContentManagement/MasterContent/createMasterContent')
    ->with('response2',$response2);
  }

  public function createOrUpdate(Request $request)
  {
      $client = new \GuzzleHttp\Client();
    $request2 = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/ShowContentType');
    $response2 = $request2->getBody()->getContents();
    $response2 = collect(json_decode($response2,true));
    $response2 = $this->paginate($response2, '10');

    if ($request->input('Id') != null)
    {
      $isActive;
      $Detail;
      if($request->input('IsActive') == "Y")
      {
        $isActive = true;
        $Detail = $request->input('DetailTextEditor');
      }
      else {
        $isActive = false;
        $Detail = strip_tags($request->input('DetailTextArea'));
      }

      $client = new \GuzzleHttp\Client();
      // $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
      $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/CreateOrUpdateMasterContent',[
        'json'=>[
        'Id'=>$request->input('Id'),
        'ContentType'=> $request->input('ContentType'),
        'Order' => $request->input('Order'),
        'Title' => $request->input('Title'),
        'Snipset' => $request->input('Snippet'),
        'Detail' => $Detail,
        'Category' => $request->input('Category'),
        'idImage' => 1,
        'Status' => $request->input('Status'),
        'FileType' => "string",
        'AddedDate' => $request->input('AddedDate'),
        'UserAdded' => "string",
        'UpdatedDate' => $request->input('AddedDate'),
        'UserUpdated' => "string",
        'ProductOwner' => "string"
        ]
      ]);

      $message = "MasterContent ".$request->input('Title')." was successfully updated";
      Session::put('alert','success');
      Session::put('message',$message);
    }
    else
    {
      // if ($response7 == null)
      // {
      // document.getElementsByClassName("note-editable")[0].textContents

        $isActive;
        $Detail;
        if($request->input('IsActive') == "Y")
        {
          $isActive = true;
          $Detail = $request->input('DetailTextEditor');
        }
        else {
          $isActive = false;
          $Detail = strip_tags($request->input('DetailTextArea'));
        }

        $client = new \GuzzleHttp\Client();
        // $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent',[
        $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/CreateOrUpdateMasterContent',[
          'json'=>[
          // 'Id'=>$request->input('Id'),
          'ContentType'=> $request->input('ContentType'),
          'Order' => $request->input('Order'),
          'Title' => $request->input('Title'),
          'Snipset' => $request->input('Snippet'),
          'Detail' => $Detail,
          'Category' => $request->input('Category'),
          'idImage' => 1,
          'Status' => $request->input('Status'),
          'FileType' => "string",
          'AddedDate' => $request->input('AddedDate'),
          'UserAdded' => "string",
          'UpdatedDate' => null,
          'UserUpdated' => "string",
          'ProductOwner' => "string"
          ]
        ]);
        $message = "MasterContent ".$request->input('Title')." was successfully created";
        Session::put('alert','success');
        Session::put('message',$message);
      // }
      // else
      // {
      //   $message = "Can't create online event because online event already exist.";
      //   Session::put('alert','error');
      //   Session::put('message',$message);
      // }
    }

    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/SearchbyContentType?ContenType=&Description=");
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');

  return view('layouts/ContentManagement/MasterContent/showMasterContent')
  ->with('response',$response)->with('response2',$response2);
  }

  public function delete(Request $request)
  {
    $id = $request->input('id');
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/DeleteMasterContent?Id=$id");
    $response = $request->getBody()->getContents();
    $response= collect(json_decode($response,true));
    $response = $this->paginate($response, '10');

    $request2 = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/ContentManagementMasterContent/ShowContentType');
    $response2 = $request2->getBody()->getContents();
    $response2 = collect(json_decode($response2,true));
    $response2 = $this->paginate($response2, '10');

    $name;
    foreach ($response as $dt) {
      $name = $dt['Title'];
    }

    $message = "Promo ".$name." was successfully deleted";
    Session::put('alert','success');
    Session::put('message',$message);

    return view('layouts/ContentManagement/MasterContent/showMasterContent')
    ->with('response',$response)->with('response2',$response2);
  }

  public function paginate($items,$perPage)
  {
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $currentResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
     return new LengthAwarePaginator($currentResults, $items->count(), $perPage);
  }
}
