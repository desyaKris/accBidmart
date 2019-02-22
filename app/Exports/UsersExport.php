<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\view\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Concerns\FromView;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

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
    $temp=$this->data;

    $client3 = new \GuzzleHttp\Client();
    $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$temp");
    $response3 = $request3->getBody()->getContents();
    $response3 = json_decode($response3,true);
    // foreach ($response3 as $arr) {
    //   $row = (object)[];
    //         $row->STATUS_TICKET = $arr['Condition'];
    // }
    //
    // dd($row);
    foreach ($response3 as $dt)
    {$array[] =
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
      return [
          'Condition',
          'Char Value 1',
          'Char Desc 1',
          'Char Value 2',
          'Char Desc 2',
          'Char Value 3',
          'Char Desc 3',
          'Char Value 4',
          'Char Desc 4',
          'Char Value 5',
          'Char Desc 5',
          'Is Active',
          'TimeStamp1',
          'TimeStamp1',
      ];
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
