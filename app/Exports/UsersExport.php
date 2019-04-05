<?php

namespace CMSBidmartACC\Exports;

use CMSBidmartACC\User;
use Illuminate\Contracts\view\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Concerns\FromView;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersExport implements FromCollection, WithHeadings
// class UsersExport implements FromView
{
  use Exportable;
  private $data;

  public function __construct($data)
  {
      $this->data = $data;
  }


  public function collection()
  {
    $data=$this->data;
    if ($data[0]['formName'] == 'AuctionResultBatalLelang')
    {
      $client = new \GuzzleHttp\Client();
      $request = $client->get('https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionResult/GetBatalLelang');
      $response = $request->getBody()->getContents();
      $response = json_decode($response,true);

      $counter=0;
      $array=[];
      $firstPage=$data[0]['firstPage']-1;
      $lastPage=$data[0]['lastPage']-1;


      foreach ($response as $dt)
      {
        if($counter>=$firstPage && $counter<=$lastPage)
        {



          if(!empty($dt['MstUnit']['NomorChasis']))
          {
            $nomorChasis= $dt['MstUnit']['NomorChasis'];
          }
          else
          {
            $nomorChasis="";
          }

          if (!empty($dt['MstUnit']['NomorMesin']))
          {
            $nomorMesin=$dt['MstUnit']['NomorMesin'];
          }
          else
          {
            $nomorMesin="";
          }

          if(!empty($dt['MstUnit']['Pool']))
          {
            $pool=$dt['MstUnit']['Pool'];
          }
          else
          {
            $pool="";
          }
          $array[] =
          array(
            'Event Name'=>$dt['MstOnlineEvent']['EventName'],
            'Event Date'=>date('Y-m-d', strtotime($dt['MstOnlineEvent']['StartDate'])),
            'Lot No'=>$dt['MstUnit']['LotNo'],
            'No Kontrak'=>$dt['MstUnit']['NoKontrak'],
            'No Polisi'=>$dt['MstUnit']['NoPolisi'],
            'Brand'=>$dt['MstUnit']['Brand'],
            'Type'=>$dt['MstUnit']['Type'],
            'Model'=>$dt['MstUnit']['Model'],
            'Tahun'=>$dt['MstUnit']['Tahun'],
            'Warna'=>$dt['MstUnit']['Warna'],
            'No Rangka'=>$nomorChasis,
            'No Mesin'=>$nomorMesin,
            'Pool'=>$pool,
            'Minimum Price'=>$dt['MstUnit']['MinimumPrice'],
          );
        }
        $counter++;
      }

      return collect($array);
    }


    $client3 = new \GuzzleHttp\Client();
    $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$temp");
    $response3 = $request3->getBody()->getContents();
    $response3 = json_decode($response3,true);

    foreach ($response3 as $dt)
    {
      $array[] =
      array(
        'Condition'=>$dt['Condition'],
        'Char Value 1'=>$dt['CharValue1'],
        'Char Desc 1'=>$dt['CharDesc1'],
        'Char Value 2'=>$dt['CharValue2'],
        'Char Desc 2'=>$dt['CharDesc2'],
        'Char Value 3'=>$dt['CharValue3'],
        'Char Desc 3'=>$dt['CharDesc3'],
        'Char Value 4'=>$dt['CharValue4'],
        'Char Desc 4'=>$dt['CharDesc4'],
        'Char Value 5'=>$dt['CharValue5'],
        'Char Desc 5'=>$dt['CharDesc5'],
        'Is Active'=>$dt['IsActive'],
        'TimeStamp1'=>$dt['TimeStamp1'],
        'TimeStamp2'=>$dt['TimeStamp2'],
      );
  }

      return collect($array);
  }

  public function headings(): array
  {
    $data=$this->data;
    if ($data[0]['formName'] == 'AuctionResultBatalLelang')
    {
      $array=
      array(
        'Event Name',
        'Event Date',
        'Lot No',
        'No Kontrak',
        'No Polisi',
        'Brand',
        'Type',
        'Model',
        'Tahun',
        'Warna',
        'No Rangka',
        'No Mesin',
        'Pool',
        'MinimumPrice',
      );
    }
      return $array;
  }

  // public function postExcel(Request $request)
  //     {
  //         if($request->hasFile('import_file')){
  //             $path = $request->file('import_file')->getRealPath();
  //             $data = Excel::load($path)->get();
  //
  //             if($data->count()){
  //                 foreach ($data as $key => $value) {
  //                     $arr[] = [
  //                                 'country'      => $value->Country
  //                                 'country_code' => $value->CountryCode,
  //                             ];
  //                 }
  //
  //                 if( ! empty($arr)){
  //                     DB::table('products')->insert($arr);
  //                 }
  //             }
  //         }
  //
  //         return back()->with(['arr' => $arr]);
  //     }

    // public function view(): View
    // {
    //     return view('/', [
    //         'data' => $this->data
    //     ]);
    // }
}
