<?php

namespace CMSBidmartACC\Imports;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToModel
{

    public function model(array $row)
    {
      dd($row);
        return $row;
    }
}
