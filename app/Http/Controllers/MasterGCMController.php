<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Excel;
use Illuminate\Pagination\LengthAwarePaginator;
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
         $response3 = collect(json_decode($response3,true));

         $response3 = $this->paginate($response3, '10');
         $response3->appends($request->only('Condition','ValueDesc'));

         return view('layouts/MasterGCM/showMasterGCM')
         ->with('response2',json_decode($response2,true))
         ->with('response3',$response3);
       }
       elseif($request->input('Condition') != '--Chosee Condition--' && $request->input('ValueDesc') != null)
       {
         $data1=$request->input('Condition');
         $data2=$request->input('ValueDesc');
         $client3 = new \GuzzleHttp\Client();
         $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMValue?MasterGCMCondition=$data1&MasterGCMValue=$data2");
         $response3 = $request3->getBody()->getContents();
         $response3 = collect(json_decode($response3,true));
        $response3 = $this->paginate($response3, '10');

        $response3->appends($request->only('Condition','ValueDesc'));
         return view('layouts/MasterGCM/showMasterGCM')
         ->with('response2',json_decode($response2,true))
         ->with('response3',$response3);
       }
       elseif($request->input('Condition') == '--Chosee Condition--')
       {

         $client3 = new \GuzzleHttp\Client();
         $request3 = $client3->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMAll');
         $response3 = $request3->getBody()->getContents();
         $response3 = collect(json_decode($response3,true));

         $response3 = $this->paginate($response3, '10');
         $response3->appends($request->only('Condition'));
         return view('layouts/MasterGCM/showMasterGCM')
         ->with('response2',json_decode($response2,true))
         ->with('response3',$response3);

       }
    }

    // public function showSearchCondition(Request $request)
    //  {
    //    $client2 = new \GuzzleHttp\Client();
    //    $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
    //    $response2 = $request2->getBody()->getContents();
    //
    //    $data = $request->input('Condition');
    //    $client3 = new \GuzzleHttp\Client();
    //    $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$data");
    //    $response3 = $request3->getBody()->getContents();
    //    $response3 = collect(json_decode($response3,true));
    //
    //    $response3 = $this->paginate($response3,'10');
    //    $response3->appends($request->only('Condition'));
    //    return view('layouts/MasterGCM/showMasterGCMbyCondition')
    //    ->with('response2',json_decode($response2,true))
    //    ->with('response3',$response3);
    //   }

    public function paginate($items,$perPage)
    {
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $currentResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
       return new LengthAwarePaginator($currentResults, $items->count(), $perPage);
    }

    public function ShowCreateMasterGCM(Request $request)
    {
      $client3 = new \GuzzleHttp\Client();
      $request3 = $client3->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
      $response3 = $request3->getBody()->getContents();



      return view('layouts/MasterGCM/createMasterGCM')->with('response3',json_decode($response3,true));
    }

    public function create(Request $request)
    {
      // dd($request['Pict']);
      $Condition=$request->input('Condition');
      $client5 = new \GuzzleHttp\Client();
      $request5 = $client5->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$Condition");
      $response5 = $request5->getBody()->getContents();
      $dataCondition= json_decode($response5,true);

        if ($dataCondition != null)
        {

          $client = new \GuzzleHttp\Client();
          $picture = 'Tommy'.date('dMYHis');
          $counter = 0;
          if($request->hasfile('Pict'))
          {
              $file = $request->file('Pict');
              $size = filesize($file);
              if($size > 10485760)
              {
                  return redirect()->back()->with('alert', 'Cannot Upload more than 10MB Files!');
              }
              $extension = $file->getClientOriginalExtension();
              $name = $picture."_".$counter.".".$extension;
              $file->move(public_path().'/images/',strtolower($name));
              $data[] = strtolower($name);
              $counter++;

          }
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
              'IsActive'=>$request->input('IsActive'),
              'Image'=>$name
            ]
          ]);

        }
        elseif($dataCondition == null)
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
              'IsActive'=>$request->input('IsActive')
            ]
          ]);
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
      $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$Condition");
      $response3 = $request3->getBody()->getContents();

      return view('layouts/MasterGCM/showMasterGCM')
      ->with('response2',json_decode($response2,true))
      ->with('response3',json_decode($response3,true))->with('alert','data berhasil di hapus');
    }


    public function showById(Request $request)
    {
      $id=$request->input('id');
      $cek=$request->input('temp');
      $client = new \GuzzleHttp\Client();
      $request = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMId?MasterGCMId=$id");
      $response = $request->getBody()->getContents();

      $client2 = new \GuzzleHttp\Client();
      $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
      $response2 = $request2->getBody()->getContents();


      if($cek=='Y')
      {
        return view('layouts/MasterGCM/ShowDataMasterGCM')
        ->with('response',json_decode($response,true))
        ->with('response2',json_decode($response2,true));
      }else {
        return view('layouts/MasterGCM/editMasterGCM')
        ->with('response',json_decode($response,true))
        ->with('response2',json_decode($response2,true));
      }


    }


    public function edit(Request $request)
    {
      $ID=$request->input('id');
      $Condition=$request->input('Condition');
      $client5 = new \GuzzleHttp\Client();
      $request5 = $client5->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$Condition");
      $response5 = $request5->getBody()->getContents();
      $dataCondition= json_decode($response5,true);

        if ($dataCondition != null)
        {

          $client = new \GuzzleHttp\Client();
          $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/CreateOrUpdateMasterGCM',[
            'json'=>[
              'Id'=>$ID,
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
              'IsActive'=>$request->input('IsActive')
            ]
          ]);

        }
        elseif($dataCondition == null)
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
              'Id'=>$ID,
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
              'IsActive'=>$request->input('IsActive')
            ]
          ]);
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

    public function export()
    {
      $client3 = new \GuzzleHttp\Client();
      $request3 = $client3->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
      $response3 = $request3->getBody()->getContents();
      $data=json_decode($response3,true);
      $data_array[] = array('data','data2');
      foreach ($data as $dt)
      {
        $data_array[] = array('data' => $dt['Id'],'data2'=>$dt['Condition']);
      }
      Excel::create('Customer Data',function($excel) use($data_array){
        $excel->setTitle('Customer Data');
        $excel->sheet('Customer Data',function($sheet)
                use($data_array)
                {
                $sheet->fromArray($data_array,null,'A1',false,false);
              });
      })->download('xlsx');
    }
}
