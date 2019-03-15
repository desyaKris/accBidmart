<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Client;

class AuctionResultSoldController extends Controller
{

  public function show()
  {
    return view('layouts/AuctionResult/Sold/showSold');
  }

}
