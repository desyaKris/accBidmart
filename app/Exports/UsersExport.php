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
    elseif($data[0]['formName'] == "MstHistoryDeposit")
    {
      $client = new \GuzzleHttp\Client();
      $request = $client->get('https://desya.outsystemscloud.com/API_MasterGCM/rest/ViewsHistoryAndTransaction/showMstDeposit');
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

          $array[] =
          array(
            'Username'=>$dt['Id'],
            'Email'=>$dt['Id'],
            'Id'=>$dt['Id'],
            'Transaction'=>$dt['TransactionId'],
            'Nominal'=>$dt['Nominal'],
            'Total Saldo'=>$dt['TotalSaldo'],
            'User'=>$dt['UserId'],
            'Mst BABalang'=>$dt['MstBABalang'],
            'Mst BACustomer'=>$dt['MstBACustomer'],
            'Status'=>$dt['Status'],
            'Type'=>$dt['Type'],
            'AddedDate'=>'AddedDate',
            'UpdatedDate'=>'AddedDate',
          );
        }
        else {
          $array[] =
          array(
            'Username'=>$dt['Id'],
            'Email'=>$dt['Id'],
            'Id'=>$dt['Id'],
            'Transaction'=>$dt['TransactionId'],
            'Nominal'=>$dt['Nominal'],
            'Total Saldo'=>$dt['TotalSaldo'],
            'User'=>$dt['UserId'],
            'Mst BABalang'=>$dt['MstBABalang'],
            'Mst BACustomer'=>$dt['MstBACustomer'],
            'Status'=>$dt['Status'],
            'Type'=>$dt['Type'],
            'AddedDate'=>'AddedDate',
            'UpdatedDate'=>'AddedDate',
          );
        }
        $counter++;
      }

      return collect($array);
    }
    elseif ($data[0]['formName']=="MasterManagementMasterGCM")
    {
      $counter=0;
      $Condition=$data[0]["condition"];
      $client3 = new \GuzzleHttp\Client();
      $request3 = $client3->get("https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/GetMasterGCMbyCondition?MasterGCMCondition=$Condition");
      $response3 = $request3->getBody()->getContents();
      $response3 = json_decode($response3,true);

      foreach ($response3 as $dt)
      {
        if ($counter>=0)
        {
          if(!empty($dt['CharValue2']))
          {
            $CharValue2= $dt['CharValue2'];
          }
          else
          {
              $CharValue2 = "";
          }

          if(!empty($dt['CharDesc2']))
          {
            $CharDesc2= $dt['CharDesc2'];
          }
          else
          {
              $CharDesc2 = "";
          }

          if(!empty($dt['CharValue3']))
          {
            $CharValue3= $dt['CharValue3'];
          }
          else
          {
              $CharValue3 = "";
          }

          if(!empty($dt['CharDesc3']))
          {
            $CharDesc3= $dt['CharDesc3'];
          }
          else
          {
              $CharDesc3 = "";
          }

          if(!empty($dt['CharValue4']))
          {
            $CharValue4= $dt['CharValue4'];
          }
          else
          {
              $CharValue4 = "";
          }

          if(!empty($dt['CharDesc4']))
          {
            $CharDesc4= $dt['CharDesc4'];
          }
          else
          {
              $CharDesc4 = "";
          }

          if(!empty($dt['CharValue5']))
          {
            $CharValue5= $dt['CharValue5'];
          }
          else
          {
              $CharValue5 = "";
          }

          if(!empty($dt['CharDesc5']))
          {
            $CharDesc5= $dt['CharDesc5'];
          }
          else
          {
              $CharDesc5 = "";
          }

          if(!empty($dt['UpdatedDate']))
          {
            $UpdatedDate = $dt['UpdatedDate'];
          }
          else
          {
            $UpdatedDate ="";
          }

          if(!empty($dt['UserUpdated']))
          {
            $UserUpdated = $dt['UserUpdated'];
          }
          else
          {
            $UserUpdated ="";
          }

          $array[] =
          array(
            'Condition'=>$dt['Condition'],
            'Char Value 1'=>$dt['CharValue1'],
            'Char Desc 1'=>$dt['CharDesc1'],
            'Char Value 2'=>$CharValue2,
            'Char Desc 2'=>$CharDesc2,
            'Char Value 3'=>$CharValue3,
            'Char Desc 3'=>$CharDesc3,
            'Char Value 4'=>$CharValue4,
            'Char Desc 4'=>$CharDesc4,
            'Char Value 5'=>$CharValue5,
            'Char Desc 5'=>$CharDesc5,
            'AddedDate'=>date('Y-m-d H:i:s', strtotime($dt['AddedDate'])),
            'UserAdded'=>$dt['UserAdded'],
            'UpdatedDate'=>date('Y-m-d H:i:s', strtotime($UpdatedDate)),
            'UserUpdated'=>$UserUpdated,
            'Is Active'=>$dt['IsActive'],
          );
        }
        else
        {

        }
          $counter++;
      }
        return collect($array);
    }
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
    elseif($data[0]['formName']=='MstHistoryDeposit')
    {
      $array=
      array(
        'Username',
        'Email',
        'Id',
        'Transaction',
        'Nominal',
        'Total Saldo',
        'User',
        'Mst BABalang',
        'Mst BACustomer',
        'Status',
        'Type',
        'AddedDate',
        'UpdatedDate',
      );
    }
    elseif($data[0]['formName']=='MstTransaction')
    {
      $array=
      array(
        'Username',
        'Name',
        'Lot No',
        'No Kontrak',
        'Unit',
        'BTMK',
        'No Polisi',
        'Min Price',
        'Offer Price',
        'Price',
        'Event Name',
        'Event Start',
        'Event End',
        'Bid Time',
        'Trans Date',
      );
    }
    elseif ($data[0]['formName']=="MasterManagementMasterGCM")
    {
      $array=
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
        'AddedDate',
        'UserAdded',
        'UpdatedDate',
        'UserUpdated',
        'Is Active',
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
