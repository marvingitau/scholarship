<?php

namespace App\Imports;

use App\Models\Admin\Fees;
use Maatwebsite\Excel\Concerns\ToModel;

class AnnualFeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Fees([
            'beneficiary_id'     => $row[0],
            'beneficiary'    => $row[1],
            'yearlyfee'    => $row[2],
            'yearlyfeebal'    => $row[3],
            'year'    => $row[4],
            'school'    => $row[5],
            'expectedterm1'    => $row[6],
            'expectedterm2'    => $row[7],
            'expectedterm3'    => $row[8],
        ]);
    }
}
