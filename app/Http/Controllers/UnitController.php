<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Excel;
use App\Imports\UserImport;

class UnitController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $client = new \GuzzleHttp\Client();

    $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetAllUnit');

    $response = $request->getBody()->getContents();

    $response =  collect(json_decode($response,true));

    //dd($response);
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 5;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);


    return view('Unit/viewUnit')->with('response',$results);

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $client = new \GuzzleHttp\Client();

    $picture = 'UnIT'. date('Ymd') .Carbon::today()->toDateString().$request->Brand.$request->Tahun;
      $counter = 0;
      // dd($request);
      if($request->hasfile('Pict'))
      {
          $file= $request->file('Pict');
              $size = filesize($file);
              if($size > 10485760)
              {
                  return redirect()->back()->with('alert', 'Cannot Upload more than 10MB Files!');
              }
              $extension = $file->getClientOriginalExtension();
              $name = $picture."_".$counter.".".$extension;

              $file->move(public_path().'/images/', strtolower($name));
              $data[] = strtolower($name);
              $counter++;
          // dd($file);
      }


    $response = $client->request('POST','https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/CreateOrUpdateUnit',[
      'json'=>[
        'NoKontrak'=> empty($request->NoKontrak)? "":$request->NoKontrak,
        'NoPolisi'=> $request->NoPolisi,
        'KodeBrand'=> $request->KodeBrand,
        'Brand'=> $request->Brand,
        'KodeType'=> $request->KodeType,
        'Type'=> $request->Type,
        'KodeModel'=> $request->KodeModel,
        'Model'=> $request->Model,
        'Tahun'=> $request->Tahun,
        'CakupanMesin'=> $request->CakupanMesin,
        'Transmisi'=> $request->Transmisi,
        'Penumpang'=> $request->Penumpang,
        'Kilometer'=> $request->Kilometer,
        'KodeWarna'=> $request->KodeWarna,
        'Warna'=> $request->Warna,
        'MinimumPrice'=> $request->MinimumPrice,
        'KodePool'=> $request->KodePool,
        'Pool'=> $request->Pool,
        'BalaiLelang'=> $request->BalaiLelang,
        'IsAvailable'=> $request->IsAvailable,
        'Pict' => $name,
        'HotItem'=>$request->HotItem,
        'NoBPKB' => $request->NoBPKB,
        'Disclaimer'=>$request->Disclaimer,
        'AreaLelang'=>$request->AreaLelang,
        'StatusUnit'=>$request->StatusUnit,
        'TransactionDate' => $request->TransactionDate,
        'StatusPayment' => $request->StatusPayment,
        'PaymentDate'=> $request->PaymentDate,
        'User' => $request->User,
        'TanggalMasukInventory'=>$request->TanggalMasukInventory,
        'NominalHargaPasar' => $request->NominalHargaPasar,
        'TypeLelang'=>$request->TypeLelang,
        'TanggalLelang'=>$request->TanggalLelang,
        'StatusFinalRegis'=>$request->StatusFinalRegis,
        'StatusRegis'=>$request->StatusRegis,
        'NomorChasis' => $request->NomorChasis,
        'NomorMesin'=> $request->NomorMesin,
        'JatuhTempoSTNK'=>$request->JatuhTempoSTNK
      ]
    ]);
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetAllUnit');
    $response = $request->getBody()->getContents();
    $response3 = collect(json_decode($response,true));
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 1;
     $currentResults = $response3->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response3->count(), $perPage);
    // dd($response[1]->Id);
    return view('Unit/viewUnit')->with('response',$results);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function search(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $query= $request->search;

    $req = $client->get("https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/SearchByQuerry?UnitID=$query");
    //$request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetAllUnit');
    $response = $req->getBody()->getContents();
    $response =  collect(json_decode($response,true));

    //dd($response);

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 5;
     $currentResults = $response->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response->count(), $perPage);


    return view('Unit/viewUnit')->with('response',$results);
  }

  public function buat(Unit $unit)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/BalaiLelangAPI/GetBalaiLelangAvailable');
    $response = $request->getBody()->getContents();
    return view('Unit/createUnit')->with('response',json_decode($response,true));
  }

  public function gantiActive($id)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetUnitByID?UnitID=$id");
    $response = $request->getBody()->getContents();
    $unit = collect( json_decode($response ,true));
    // dd($unit['Id']);

    if($unit['IsAvailable'] == "Y"){
      $status = "N";
    }
    else {
      $status="Y";
    }

    $response = $client->request('POST','https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/CreateOrUpdateUnit',[
      'json'=>[
        'Id'=>$unit['Id'],
        'NoKontrak'=> $unit['NoKontrak'],
        'NoPolisi'=> $unit['NoPolisi'],
        'KodeBrand'=> $unit['KodeBrand'],
        'Brand'=> $unit['Brand'],
        'KodeType'=> $unit['KodeType'],
        'Type'=> $unit['Type'],
        'KodeModel'=> $unit['KodeModel'],
        'Model'=> $unit['Model'],
        'Tahun'=> $unit['Tahun'],
        'CakupanMesin'=> $unit['CakupanMesin'],
        'Transmisi'=> $unit['Transmisi'],
        'Penumpang'=> $unit['Penumpang'],
        'Kilometer'=> $unit['Kilometer'],
        'KodeWarna'=> $unit['KodeWarna'],
        'Warna'=> $unit['Warna'],
        'MinimumPrice'=> $unit['MinimumPrice'],
        'KodePool'=> $unit['KodePool'],
        'Pool'=> $unit['Pool'],
        'BalaiLelang'=> $unit['BalaiLelang'],
        'IsAvailable'=> $status,
        'Pict' => $unit['Pict'],
        'TransactionDate' => $unit['TransactionDate'],
        'HotItem'=>$unit['HotItem'],
        'NoBPKB' => $unit['NoBPKB'],
        'Disclaimer'=>$unit['Disclaimer'],
        'AreaLelang'=>$unit['AreaLelang'],
        'StatusUnit'=>$unit['StatusUnit'],
        'StatusPayment' => $unit['StatusPayment'],
        'PaymentDate'=> $unit['PaymentDate'],
        'User' => $unit['User'],
        'TanggalMasukInventory'=>$unit['TanggalMasukInventory'],
        'NominalHargaPasar' => $unit['NominalHargaPasar'],
        'TypeLelang'=>$unit['TypeLelang'],
        'TanggalLelang'=>$unit['TanggalLelang'],
        'StatusFinalRegis'=>$unit['StatusFinalRegis'],
        'StatusRegis'=>$unit['StatusRegis'],
        'NomorChasis' => $unit['NomorChasis'],
        'NomorMesin'=> $unit['NomorMesin'],
        'JatuhTempoSTNK'=>$unit['JatuhTempoSTNK']
      ]
    ]);
    $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetAllUnit');
    $response = $request->getBody()->getContents();
    $response3 = collect(json_decode($response,true));
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 5;
     $currentResults = $response3->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response3->count(), $perPage);
     // dd($results);
    return view('Unit/viewUnit')->with('response',$results);
  }

  public function gantiHotItem($id)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetUnitByID?UnitID=$id");
    $response = $request->getBody()->getContents();
    $unit = collect( json_decode($response ,true));

    if($unit['HotItem'] == "Y"){
      $status = "N";
    }
    else {
      $status="Y";
    }

    $response = $client->request('POST','https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/CreateOrUpdateUnit',[
      'json'=>[
        'Id'=>$unit['Id'],
        'NoKontrak'=> $unit['NoKontrak'],
        'NoPolisi'=> $unit['NoPolisi'],
        'KodeBrand'=> $unit['KodeBrand'],
        'Brand'=> $unit['Brand'],
        'KodeType'=> $unit['KodeType'],
        'Type'=> $unit['Type'],
        'KodeModel'=> $unit['KodeModel'],
        'Model'=> $unit['Model'],
        'Tahun'=> $unit['Tahun'],
        'CakupanMesin'=> $unit['CakupanMesin'],
        'Transmisi'=> $unit['Transmisi'],
        'Penumpang'=> $unit['Penumpang'],
        'Kilometer'=> $unit['Kilometer'],
        'KodeWarna'=> $unit['KodeWarna'],
        'Warna'=> $unit['Warna'],
        'MinimumPrice'=> $unit['MinimumPrice'],
        'KodePool'=> $unit['KodePool'],
        'Pool'=> $unit['Pool'],
        'BalaiLelang'=> $unit['BalaiLelang'],
        'IsAvailable'=> $unit['IsAvailable'],
        'Pict' => $unit['Pict'],
        'TransactionDate' => $unit['TransactionDate'],
        'HotItem'=>$status,
        'NoBPKB' => $unit['NoBPKB'],
        'Disclaimer'=>$unit['Disclaimer'],
        'AreaLelang'=>$unit['AreaLelang'],
        'StatusUnit'=>$unit['StatusUnit'],
        'StatusPayment' => $unit['StatusPayment'],
        'PaymentDate'=> $unit['PaymentDate'],
        'User' => $unit['User'],
        'TanggalMasukInventory'=>$unit['TanggalMasukInventory'],
        'NominalHargaPasar' => $unit['NominalHargaPasar'],
        'TypeLelang'=>$unit['TypeLelang'],
        'TanggalLelang'=>$unit['TanggalLelang'],
        'StatusFinalRegis'=>$unit['StatusFinalRegis'],
        'StatusRegis'=>$unit['StatusRegis'],
        'NomorChasis' => $unit['NomorChasis'],
        'NomorMesin'=> $unit['NomorMesin'],
        'JatuhTempoSTNK'=>$unit['JatuhTempoSTNK']
      ]
    ]);
    $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetAllUnit');
    $response = $request->getBody()->getContents();
    $response3 = collect(json_decode($response,true));
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 5;
     $currentResults = $response3->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response3->count(), $perPage);
     // dd($results);
    return view('Unit/viewUnit')->with('response',$results);
  }

  public function upld()
  {
    return view('Unit/uploadUnit');
  }

  public function upload(Request $request)
  {
    $client = new \GuzzleHttp\Client();

    if($request->hasFile('Excel')){

      $file= $request->file('Pict');
      $size = filesize($file);
      if($size > 10485760)
      {
        return redirect()->back()->with('alert', 'Cannot Upload more than 10MB Files!');
      }
      $array = Excel::toArray(new UserImport, $request->file('Excel')); //IMPORT FILE
      foreach ($array as $dt)
      {
        $dataExport=$dt;
      }
      $count=0;
      foreach ($dataExport as $dat) {
        if($count>0)
        {
          $response = $client->request('POST','https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/CreateOrUpdateUnit',[
            'json'=>[
              'NoKontrak'=> $dat['0'],
              'NoPolisi'=> $dat['1'],
              'KodeBrand'=> $dat['2'],
              'Brand'=> $dat['3'],
              'KodeType'=>$dat['4'],
              'Type'=> $dat['5'],
              'KodeModel'=> $dat['6'],
              'Model'=> $dat['7'],
              'Tahun'=> $dat['8'],
              'CakupanMesin'=> $dat['9'],
              'Transmisi'=> $dat['10'],
              'Penumpang'=> $dat['11'],
              'Kilometer'=> $dat['12'],
              'KodeWarna'=>$dat['13'],
              'Warna'=> $dat['14'],
              'MinimumPrice'=> $dat['15'],
              'KodePool'=> $dat['16'],
              'Pool'=>$dat['17'],
              'BalaiLelang'=>$dat['18'],
              'IsAvailable'=> $dat['19'],
              'Pict' => "",
              'TransactionDate' => "",
              'HotItem'=>"",
              'NoBPKB' => "",
              'Disclaimer'=>"",
              'AreaLelang'=>"",
              'StatusUnit'=>"",
              'StatusPayment' =>"",
              'PaymentDate'=>"",
              'User' =>"",
              'TanggalMasukInventory'=>"",
              'NominalHargaPasar' =>"",
              'TypeLelang'=>"",
              'TanggalLelang'=>"",
              'StatusFinalRegis'=>"",
              'StatusRegis'=>"",
              'NomorChasis' =>"",
              'NomorMesin'=> "",
              'JatuhTempoSTNK'=>""
            ]
          ]);
        }
        $count++;
      }
      $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetAllUnit');
      $response = $request->getBody()->getContents();
      $response3 = collect(json_decode($response,true));
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $perPage = 5;
       $currentResults = $response3->slice(($currentPage - 1) * $perPage, $perPage)->all();
       $results = new LengthAwarePaginator($currentResults, $response3->count(), $perPage);
       // dd($results);
      return view('Unit/viewUnit')->with('response',$results);
    }
    // if no file detected then
    else{
      return redirect()->back()->with('response',$results)->with('alert', 'No excel file detected!');
    }
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Unit  $unit
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get("https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetUnitByID?UnitID=$id");
    $response = $request->getBody()->getContents();
    $req= $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/BalaiLelangAPI/GetBalaiLelangAvailable');
    $respon = $req->getBody()->getContents();
    // dd($response);
    return view('Unit/editUnit')->with('response',json_decode($response,true))->with('respon',json_decode($respon,true));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Unit  $unit
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $client = new \GuzzleHttp\Client();

    $picture = 'UnIT'. date('Ymd') .Carbon::today()->toDateString().$request->Brand.$request->Tahun;
      $counter = 0;
      // dd($request->Pict);
      if($request->hasfile('Pict'))
      {
          $file= $request->file('Pict');
              $size = filesize($file);
              if($size > 10485760)
              {
                  return redirect()->back()->with('alert', 'Cannot Upload more than 10MB Files!');
              }
              $extension = $file->getClientOriginalExtension();
              $name = $picture."_".$counter.".".$extension;
              // dd($name);
              $file->move(public_path().'/images/', strtolower($name));
              $data[] = strtolower($name);
              $counter++;
          // dd($file);
      }

    $response = $client->request('POST','https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/CreateOrUpdateUnit',[
      'json'=>[
        'Id'=>$request->Id,
        'NoKontrak'=> $request->NoKontrak,
        'NoPolisi'=> $request->NoPolisi,
        'KodeBrand'=> $request->KodeBrand,
        'Brand'=> $request->Brand,
        'KodeType'=> $request->KodeType,
        'Type'=> $request->Type,
        'KodeModel'=> $request->KodeModel,
        'Model'=> $request->Model,
        'Tahun'=> $request->Tahun,
        'CakupanMesin'=> $request->CakupanMesin,
        'Transmisi'=> $request->Transmisi,
        'Penumpang'=> $request->Penumpang,
        'Kilometer'=> $request->Kilometer,
        'KodeWarna'=> $request->KodeWarna,
        'Warna'=> $request->Warna,
        'MinimumPrice'=> $request->MinimumPrice,
        'KodePool'=> $request->KodePool,
        'Pool'=> $request->Pool,
        'BalaiLelang'=> $request->BalaiLelang,
        'IsAvailable'=> $request->IsAvailable,
        'Pict' => $name,
        'TransactionDate' => $request->TransactionDate,
        'HotItem'=>$request->HotItem,
        'NoBPKB' => $request->NoBPKB,
        'Disclaimer'=>$request->Disclaimer,
        'AreaLelang'=>$request->AreaLelang,
        'StatusUnit'=>$request->StatusUnit,
        'StatusPayment' => $request->StatusPayment,
        'PaymentDate'=> $request->PaymentDate,
        'User' => $request->User,
        'TanggalMasukInventory'=>$request->TanggalMasukInventory,
        'NominalHargaPasar' => $request->NominalHargaPasar,
        'TypeLelang'=>$request->TypeLelang,
        'TanggalLelang'=>$request->TanggalLelang,
        'StatusFinalRegis'=>$request->StatusFinalRegis,
        'StatusRegis'=>$request->StatusRegis,
        'NomorChasis' => $request->NomorChasis,
        'NomorMesin'=> $request->NomorMesin,
        'JatuhTempoSTNK'=>$request->JatuhTempoSTNK
      ]
    ]);
    $client = new \GuzzleHttp\Client();

    $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetAllUnit');
    $response = $request->getBody()->getContents();
    $response3 = collect(json_decode($response,true));
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 5;
     $currentResults = $response3->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response3->count(), $perPage);
    // dd($response[1]->Id);
    return view('Unit/viewUnit')->with('response',$results);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Unit  $unit
   * @return \Illuminate\Http\Response
   */
  public function destroy(Unit $unit, $id)
  {
    $client = new \GuzzleHttp\Client();

    $url = "https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/DeleteUnit?UnitID=$id";
    //dd($url);
    $response = $client->delete($url);
    $request = $client->get('https://kevinantariksa.outsystemscloud.com/API/rest/UNITAPI/GetAllUnit');
    $response = $request->getBody()->getContents();
    $response3 = collect(json_decode($response,true));
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 5;
     $currentResults = $response3->slice(($currentPage - 1) * $perPage, $perPage)->all();
     $results = new LengthAwarePaginator($currentResults, $response3->count(), $perPage);
    // dd($response[1]->Id);
    return view('Unit/viewUnit')->with('response',$results);
  }
}
