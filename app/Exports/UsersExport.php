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
      return collect($response3);
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
          'Added Date',
          'User Added',
          'Updated Date',
          'Is Active',
      ];
  }



    // public function view(): View
    // {
    //     return view('/', [
    //         'data' => $this->data
    //     ]);
    // }
}
