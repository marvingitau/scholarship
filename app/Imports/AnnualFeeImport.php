<?php

namespace App\Imports;

use App\Models\AcademicYear;
use App\Models\Admin\Fees;
use App\Models\Admin\FeeSection;
use App\Models\Clerk\Beneficiaryform;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class AnnualFeeImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        $activeYear = AcademicYear::where('status',1)->first()->year;
        $usr = auth()->user();
        foreach ($rows as $row) 
        {
            if($row[3] !== $activeYear){
                continue;
            }
            $beneficiary=Beneficiaryform::where('id',$row[0])->first();
            $beneficiaryName = $beneficiary->firstname." ".$beneficiary->lastname;
            $feemodel =Fees::create([
                'beneficiary_id'     => $row[0],
                'beneficiary'    => $beneficiaryName,
                'yearlyfee'    => $row[1],
                'yearlyfeebal'    => $row[2],
                'year'    => $row[3],
                'school'    => $beneficiary->SecondaryAdmitted,
                'expectedterm1'    => $row[4],
                'expectedterm2'    => $row[5],
                'expectedterm3'    => $row[6],
            ]);
            FeeSection::create([
                'beneficiary_id'  => $row[0],
                'user_id' =>$usr->id,
                'fees_id' => $feemodel->id,
                'year' =>$row[3],
                'yearlyfee'=>$row[2],
                'term1'=>$row[7],
                'term2'=>$row[8],
                'term3'=>$row[9],
            ]);

        }
    }


    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    // public function model(array $row)
    // {
    //     return new Fees([
    //         'beneficiary_id'     => $row[0],
    //         'beneficiary'    => $row[1],
    //         'yearlyfee'    => $row[2],
    //         'yearlyfeebal'    => $row[3],
    //         'year'    => $row[4],
    //         'school'    => $row[5],
    //         'expectedterm1'    => $row[6],
    //         'expectedterm2'    => $row[7],
    //         'expectedterm3'    => $row[8],
    //     ]);
    // }

  
}
