<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Excel;
use File;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exports\UsersExport;
use App\Imports\UserImport;

class MasterGCMController extends Controller
{

  public function searchbyCondition($data){

    // $data = $request->input('Condition');


    $client3 = new \GuzzleHttp\Client();
    $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMbyCondition?GetMasterGCMCondition=$data");
    $response3 = $request3->getBody()->getContents();
    // $response3 = collect(json_decode($response3,true));
    //
    // $response3 = $this->paginate($response3, '10');
    // $response3->appends($request->only('Condition','ValueDesc'));

    // return view('layouts/MasterGCM/showMasterGCM')
    // ->with('response3',$response3);
    return json_encode($response3);
  }

  public function show(Request $request)
   {

     $client2 = new \GuzzleHttp\Client();
     $request2 = $client2->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMCondition');
     $response2 = $request2->getBody()->getContents();

       if ($request->input('Condition') != '--Chosee Condition--' && $request->input('ValueDesc') == null)
       {
         $data = $request->input('Condition');
         $client3 = new \GuzzleHttp\Client();
         $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMbyCondition?GetMasterGCMCondition=$data");
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
         $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/SearchMasterGCM?MasterGCMCondition=$data1&MasterGCMValue=$data2");
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
         dd($request->input('Condition'));
         $client3 = new \GuzzleHttp\Client();
         // $request3 = $client3->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMAll');
         $request3 = $client3->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCM');
         $response3 = $request3->getBody()->getContents();
         $response3 = collect(json_decode($response3,true));

         $response3 = $this->paginate($response3, '10');
         $response3->appends($request->only('Condition'));
         return view('layouts/MasterGCM/showMasterGCM')
         ->with('response2',json_decode($response2,true))
         ->with('response3',$response3)
         ->with('response4',$data);
       }
    }


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
          $name = $this->FileImage($request);
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
              'Image1'=>$name,
              'TimeStamp1'=>$request->input('TimeStamp1'),
              'TimeStamp2'=>$request->input('TimeStamp2'),
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
          $name = $this->FileImage($request);
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
              'Image1'=>$name,
              'TimeStamp1'=>$request->input('TimeStamp1'),
              'TimeStamp2'=>$request->input('TimeStamp2'),
            ]
          ]);
      }

      $client2 = new \GuzzleHttp\Client();
      $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
      $response2 = $request2->getBody()->getContents();

      $tempDelete=$this->tempDelete($request);

      return view('layouts/MasterGCM/showMasterGCM')
      ->with('response2',json_decode($response2,true))
      ->with('response3',$tempDelete);
    }

    public function FileImage($request)
    {
      $picture = 'Image'.date('dMYHis');
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
          return $name;
      }
    }

    public function delete(Request $request)
    {
      $ID=$request->input('id');
      $Condition=$request->input('Condition');

      $client13 = new \GuzzleHttp\Client();
      $request13 = $client13->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/DeleteMasterGCM?MasterGCMId=$ID");
      $response13 = $request13->getBody()->getContents();

      $client5 = new \GuzzleHttp\Client();
      $request5 = $client5->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/SearchMasterGCMCondition2?Condition=$Condition");
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
              $client8 = new \GuzzleHttp\Client();
              $request8 = $client8->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/DeleteMasterGCMCondition?MasterGCMCondition=$ID");
              $response8 = $request8->getBody()->getContents();
            }
          }
        }
        $client2 = new \GuzzleHttp\Client();
        $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
        $response2 = $request2->getBody()->getContents();

        $tempDelete=$this->tempDelete($request);
        File::delete('images/'.$request->input('dataImage'));

        return view('layouts/MasterGCM/showMasterGCM')
        ->with('response2',json_decode($response2,true))
        ->with('response3',$tempDelete);
    }

    public function tempDelete(Request $request)
    {
      $temp=$request->input('Condition');
      $client10 = new \GuzzleHttp\Client();
      $request10 = $client10->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$temp");
      $response10 = $request10->getBody()->getContents();

      $response10 = collect(json_decode($response10,true));
      $response10 = $this->paginate($response10, '10');
      $response10->appends($request->only('Condition'));

      return $response10;
    }

    public function showById(Request $request)
    {
      $id=$request->input('id');
      $cek=$request->input('temp');
      $client = new \GuzzleHttp\Client();
      $request = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMbyId?MasterGCMId=$id");
      $response = $request->getBody()->getContents();

      $client2 = new \GuzzleHttp\Client();
      $request2 = $client2->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMCondition');
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
          if($request->input('dataImage') != null && $request->hasfile('Pict')==false)
          {
            $name= (string)$request->input('dataImage');
            return $this->updateData($request,$name);

          }
          elseif($request->input('dataImage') == null && $request->hasfile('Pict')==false)
          {
            $name= (string)$request->input('dataImage');
            return $this->updateData($request,$name);
          }elseif ($request->hasfile('Pict')==true)
          {
            $name = (string)$this->FileImage($request);

            File::delete('images/'.$request->input('dataImage'));
            return $this->updateData($request,$name);
          }
    }

    public function updateData(Request $request,string $name)
    {
      $Condition=$request->input('Condition');
      $client5 = new \GuzzleHttp\Client();
      $request5 = $client5->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$Condition");
      $response5 = $request5->getBody()->getContents();
      $dataCondition= json_decode($response5,true);

      $ID=$request->input('id');
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
            'IsActive'=>$request->input('IsActive'),
            'Image1'=>$name,
            'TimeStamp1'=>$request->input('TimeStamp1'),
            'TimeStamp2'=>$request->input('TimeStamp2'),
          ]
        ]);

        $client2 = new \GuzzleHttp\Client();
        $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
        $response2 = $request2->getBody()->getContents();

        $client2 = new \GuzzleHttp\Client();
        $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
        $response2 = $request2->getBody()->getContents();

        $tempDelete=$this->tempDelete($request);

        return view('layouts/MasterGCM/showMasterGCM')
        ->with('response2',json_decode($response2,true))
        ->with('response3',$tempDelete);

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
          $name = $this->FileImage($request);
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
              'IsActive'=>$request->input('IsActive'),
              'Image1'=>$name,
              'TimeStamp1'=>$request->input('TimeStamp1'),
              'TimeStamp2'=>$request->input('TimeStamp2'),
            ]
          ]);

          $client2 = new \GuzzleHttp\Client();
          $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
          $response2 = $request2->getBody()->getContents();

          $client3 = new \GuzzleHttp\Client();
          $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMValue?MasterGCMCondition=&MasterGCMValue=");
          $response3 = $request3->getBody()->getContents();

          $response3 = collect(json_decode($response3,true));
          $response3 = $this->paginate($response3, '10');
          $response3->appends($request->only('Condition'));

          return view('layouts/MasterGCM/showMasterGCM')
          ->with('response2',json_decode($response2,true))
          ->with('response3',$response3);
      }

    }

    public function export(Request $request)
    {
      $data=$request->input('Condition2');

      $client3 = new \GuzzleHttp\Client();
      $request3 = $client3->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMAll');
      $response3 = $request3->getBody()->getContents();
      // $data=json_decode($response3,true);
      $name="BidMart_MST_GCM_".strtoupper($data)."_".date('Y-m-d').".xlsx";
      return Excel::download(new UsersExport($data), $name);
      // return Excel::download(new UsersExport($request), 'users.xlsx');
      // $data_array[] = array('data','data2');
      // foreach ($data as $dt)
      // {
      //   $data_array[] = array('data' => $dt['Id'],'data2'=>$dt['Condition']);
      // }
      // Excel::download('Customer Data',function($excel) use($data_array){
      //   $excel->setTitle('Customer Data');
      //   $excel->sheet('Customer Data',function($sheet)
      //           use($data_array)
      //           {
      //           $sheet->fromArray($data_array,null,'A1',false,false);
      //         });
      // })->download('xlsx');
    }

    public function showUpload()
    {
      return view('layouts/MasterGCM/uploadMaterGCM');
    }

    public function upload(Request $request)
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
              $Condition=$dt2[0];
              $client5 = new \GuzzleHttp\Client();
              $request5 = $client5->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$Condition");
              $response5 = $request5->getBody()->getContents();
              $dataCondition= json_decode($response5,true);

                if ($dataCondition != null)
                {

                  $client = new \GuzzleHttp\Client();
                  $name = $this->FileImage($request);
                  $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/CreateOrUpdateMasterGCM',[
                    'json'=>[
                      'Condition'=>$dt2[0],
                      'CharValue1'=>$dt2[1],
                      'CharDesc1'=>$dt2[2],
                      'CharValue2'=>$dt2[3],
                      'CharDesc2'=>$dt2[4],
                      'CharValue3'=>$dt2[5],
                      'CharDesc3'=>$dt2[6],
                      'CharValue4'=>$dt2[7],
                      'CharDesc4'=>$dt2[8],
                      'CharValue5'=>$dt2[9],
                      'CharDesc5'=>$dt2[10],
                      'AddedDate'=>$request->input('AddedDate'),
                      'UpdatedDate'=>"",
                      'UserUpdated'=>"",
                      'IsActive'=>$dt2[11],
                      'TimeStamp1'=>$dt2[12],
                      'TimeStamp2'=>$dt2[13],
                    ]
                  ]);

                }
                elseif($dataCondition == null)
                {

                  $client = new \GuzzleHttp\Client();
                  $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/CreateOrUpdateConditionMasterGCM',[
                    'json'=>[
                      'Condition'=>$dt2[0],
                    ]
                  ]);

                  $client = new \GuzzleHttp\Client();
                  $name = $this->FileImage($request);
                  $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/CreateOrUpdateMasterGCM',[
                    'json'=>[
                      'Condition'=>$dt2[0],
                      'CharValue1'=>$dt2[1],
                      'CharDesc1'=>$dt2[2],
                      'CharValue2'=>$dt2[3],
                      'CharDesc2'=>$dt2[4],
                      'CharValue3'=>$dt2[5],
                      'CharDesc3'=>$dt2[6],
                      'CharValue4'=>$dt2[7],
                      'CharDesc4'=>$dt2[8],
                      'CharValue5'=>$dt2[9],
                      'CharDesc5'=>$dt2[10],
                      'AddedDate'=>$request->input('AddedDate'),
                      'UpdatedDate'=>"",
                      'UserUpdated'=>"",
                      'IsActive'=>$dt2[11],
                      'TimeStamp1'=>$dt2[12],
                      'TimeStamp2'=>$dt2[13],
                    ]
                  ]);
              }
            }
            $count++;
        }

        $client2 = new \GuzzleHttp\Client();
        $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
        $response2 = $request2->getBody()->getContents();

        $tempDelete=$this->tempDelete($request);

        return view('layouts/MasterGCM/showMasterGCM')
        ->with('response2',json_decode($response2,true))
        ->with('response3',$tempDelete);
    }
}
