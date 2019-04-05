<?php

namespace CMSBidmartACC\Http\Controllers;

use Illuminate\Http\Request;
use CMSBidmartACC\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use CMSBidmartACC\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ExcelController extends Controller
{
    public function Export()
    {
      return Excel::download(new UsersExport, 'users.xlsx');
    }
}
