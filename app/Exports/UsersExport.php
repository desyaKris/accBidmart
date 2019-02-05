<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use GuzzleHttp\Client;

class UsersExport implements FromView
{
    public function view(): View
    {
      return view('exports.invoices', [
            'invoices' => Invoice::all()
        ]);
      
    }
}
