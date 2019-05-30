<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Excel;
use File;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use CMSBidmartACC\Exports\UsersExport;
use CMSBidmartACC\Imports\UserImport;

class MasterGCMController extends Controller
{

  public function searchbyCondition($data){

    $client3 = new \GuzzleHttp\Client();
    $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$data");
    // $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMbyCondition?GetMasterGCMCondition=$data");
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
     Session::put('alert','null');
     $client = new \GuzzleHttp\Client();
     $request2 = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
     // $request2 = $client2->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMCondition');
     $response2 = $request2->getBody()->getContents();

       if ($request->input('Condition') != '--Chosee Condition--' && $request->input('keyword') == null)
       {

         $data = $request->input('Condition');
         $request3 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$data");
         // $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMbyCondition?GetMasterGCMCondition=$data");
         $response3 = $request3->getBody()->getContents();
         $response3 = collect(json_decode($response3,true));

         $response3 = $this->paginate($response3, '10');
         $response3->appends($request->only('Condition','keyword'));

         return view('layouts/MasterGCM/showMasterGCM')
         ->with('response2',json_decode($response2,true))
         ->with('response3',$response3);
       }
       elseif($request->input('Condition2') != '--Chosee Condition--' && $request->input('keyword') != null)
       {
         $data1=$request->input('Condition2');
         $data2=$request->input('keyword');
         $request3 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMValue?MasterGCMCondition=$data1&MasterGCMValue=$data2");
         // $request3 = $client->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/SearchMasterGCM?MasterGCMCondition=$data1&MasterGCMValue=$data2");
         $response3 = $request3->getBody()->getContents();
         $response3 = collect(json_decode($response3,true));
         $response3 = $this->paginate($response3, '10');

         $response3->appends($request->only('Condition2','keyword'));
         return view('layouts/MasterGCM/showMasterGCM')
         ->with('response2',json_decode($response2,true))
         ->with('response3',$response3);
       }
    }

    public function searchMasterGCM(Request $request)
    {

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
      $client2 = new \GuzzleHttp\Client();
      $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
      $response2 = $request2->getBody()->getContents();

      $data = $request->input('Condition');
      $request3 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$data");
      // $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMbyCondition?GetMasterGCMCondition=$data");
      $response3 = $request3->getBody()->getContents();
      $response3 = collect(json_decode($response3,true));
      $response3 = $this->paginate($response3, '10');
      $response3->appends($request->only('Condition'));

      return view('layouts/MasterGCM/showMasterGCM')
      ->with('response2',json_decode($response2,true))
      ->with('response3',$response3);
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

      $client = new \GuzzleHttp\Client();
      $requestDelete = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/DeleteMasterGCM?MasterGCMId=$ID");
      $delete = $requestDelete->getBody()->getContents();
      $delete = json_decode($delete,true);

      $request2 = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
      $response2 = $request2->getBody()->getContents();
      $response2 = json_decode($response2,true);

      $request3 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$Condition");
      // $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMbyCondition?GetMasterGCMCondition=$data");
      $response3 = $request3->getBody()->getContents();
      $response3 = collect(json_decode($response3,true));
      $response3 = $this->paginate($response3, '10');
      $response3->appends($request->only('Condition'));

      File::delete('images/'.$request->input('dataImage'));
      $message = "Master GCM '".$delete[0]['Condition'].",".$delete[0]['CharValue1'].",".$delete[0]['CharDesc1']."' was successfully deleted.";
      Session::put('alert','success');
      Session::put('message',$message);

      return view('layouts/MasterGCM/showMasterGCM')
      ->with('response2',$response2)
      ->with('response3',$response3);
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
      // $request2 = $client2->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMCondition');
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
          // digunakan untuk kondisi edit gambar
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
      $ID=$request->input('id');
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

      $request2 = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
      $response2 = $request2->getBody()->getContents();

      $request3 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$Condition");
      // $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMbyCondition?GetMasterGCMCondition=$data");
      $response3 = $request3->getBody()->getContents();
      $response3 = collect(json_decode($response3,true));
      $response3 = $this->paginate($response3, '10');
      $response3->appends($request->only('Condition'));

      return view('layouts/MasterGCM/showMasterGCM')
      ->with('response2',json_decode($response2,true))
      ->with('response3',$response3);
    }

    public function export(Request $request)
    {

      $data[] =
      array(
        'formName'=>$request->input('formName'),
        'firstPage'=>$request->input('firstPage'),
        'lastPage'=>$request->input('lastPage'),
        'condition'=>$request->input('Condition2')
      );

      $client3 = new \GuzzleHttp\Client();
      $request3 = $client3->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMAll');
      $response3 = $request3->getBody()->getContents();
      // $data=json_decode($response3,true);
      $name="BidMart_MST_GCM_".strtoupper($data[0]["condition"])."_".date('Y-m-d').".xlsx";
      return Excel::download(new UsersExport($data), $name);
    }

    public function showUpload()
    {
      Session::put('alert','null');
      return view('layouts/MasterGCM/uploadMaterGCM');
    }

    public function upload(Request $request)
    {
      $counter=0;
      $nullIdentifier=0;

      $request->file('import_excel');
      $this->validate($request, [
            'import_excel' => 'required|mimes:xls,xlsx'
        ]);

        if($request->hasFile('import_excel'))
        {
          $array = Excel::toArray(new UserImport, $request->file('import_excel')); //IMPORT FILE
        }

        foreach ($array as $dt)
        {
          $dataExport=$dt;
        }

        $columsUtama=
        array(
          'Condition',
          'CharValue1',
          'CharDesc1',
          'CharValue2',
          'CharDesc2',
          'CharValue3',
          'CharDesc3',
          'CharValue4',
          'CharDesc4',
          'CharValue5',
          'CharDesc5',
          'IsActive',
          'TimeStamp1',
          'TimeStamp2',
        );
        //membuat array baru untuk menyimpan hasil upload
        $columns=$dataExport[0];
        //menghilangkan spasi
        $columns=str_replace(' ','',$columns);
        //mencari perbedaan array
        $diff=array_diff($columsUtama,$columns);
        // if ($diff!=null)
        // {
        //   foreach ($diff as $dt)
        //   {
        //     array_push($columns,$dt);
        //   }
        // }

        foreach ($dataExport as $dt)
        {
          if ($counter!=0)
          {
            $data=$dataExport[$counter];
            $addArray=array_combine($columns,$data);
            if($addArray['Condition'] == null || $addArray['CharValue1'] == null || $addArray['CharDesc1'] == null)
            {
              $nullIdentifier++;
            }
            else
            {
                $Export[] = $addArray;
            }
          }
          $counter++;
        }

        foreach ($Export as $dt2)
         {
           if ($nullIdentifier<1 && $diff == null)
           {
             $client = new \GuzzleHttp\Client();
             $response = $client->request('POST','https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/CreateOrUpdateMasterGCM',[
               'json'=>[
                 'Condition'=>$dt2['Condition'],
                 'CharValue1'=>$dt2['CharValue1'],
                 'CharDesc1'=>$dt2['CharDesc1'],
                 'CharValue2'=>$dt2['CharValue2'],
                 'CharDesc2'=>$dt2['CharDesc2'],
                 'CharValue3'=>$dt2['CharValue3'],
                 'CharDesc3'=>$dt2['CharDesc3'],
                 'CharValue4'=>$dt2['CharValue4'],
                 'CharDesc4'=>$dt2['CharDesc4'],
                 'CharValue5'=>$dt2['CharValue5'],
                 'CharDesc5'=>$dt2['CharDesc5'],
                 'AddedDate'=>$request->input('AddDate'),
                 'UserAdded'=>"super_admin",
                 'IsActive'=>$dt2['IsActive'],
                 'TimeStamp1'=>$dt2['TimeStamp1'],
                 'TimeStamp2'=>$dt2['TimeStamp2'],
               ]
             ]);
             $message = "GCM was successfully upload";
             Session::put('alert','success');
             Session::put('message',$message);
           }
           else
           {
             $message = "Can't Upload because ".json_encode($diff)." was empty";
             Session::put('alert','error');
             Session::put('message',$message);
             return $this->showUpload();
           }
        }

        $client2 = new \GuzzleHttp\Client();
        $request2 = $client2->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition');
        $response2 = $request2->getBody()->getContents();

        $data = $request->input('Condition');
        $request3 = $client->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$data");
        // $request3 = $client3->get("https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_MstMasterGCM/GetMasterGCMbyCondition?GetMasterGCMCondition=$data");
        $response3 = $request3->getBody()->getContents();
        $response3 = collect(json_decode($response3,true));
        $response3 = $this->paginate($response3, '10');
        $response3->appends($request->only('Condition'));

        return view('layouts/MasterGCM/showMasterGCM')
        ->with('response2',json_decode($response2,true))
        ->with('response3',$response3);

        return view('layouts/MasterGCM/showMasterGCM')
        ->with('response2',json_decode($response2,true))
        ->with('response3',$response3);
    }
}
