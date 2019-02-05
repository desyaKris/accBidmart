<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ExcelController extends Controller
{
    public function Export()
    {
      return Excel::download(new UsersExport, 'users.xlsx');
    }
}
