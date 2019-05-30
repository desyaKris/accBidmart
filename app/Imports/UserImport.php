<?php

namespace CMSBidmartACC\Imports;
use CMSBidmartACC\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class UserImport implements ToModel
{

    public function model(array $row)
    {
      dd($row);
        return $row;
    }
}
