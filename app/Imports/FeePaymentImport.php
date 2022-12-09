<?php

namespace App\Imports;

use App\Models\Admin\Fees;
use App\Models\AcademicYear;
use App\Models\Admin\FeeSection;
use Illuminate\Support\Collection;
use App\Models\Admin\FeePaymentEntry;
use App\Models\Clerk\Beneficiaryform;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;


class FeePaymentImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        $activeYear = AcademicYear::where('status', 1)->first()->year;
        $usr = auth()->user();
        foreach ($rows as $row) {
            if ($row[1] != $activeYear) {
                continue;
            }
            
            FeePaymentEntry::create(
                [
                    'beneficiary_id' => $row[0],
                    'year'    => $row[1],
                    'term'    => $row[2],
                    'amount'    => $row[3],
                    'creator'    => $usr->id,
                    'comment'=> isset($row[4])?$row[4]:''
                ]
            );
 
            $fee = Fees::where('beneficiary_id', $row[0])->where('year', $row[1])->first();
            /* $fee->increment('yearlyfee', $row[3]);$fee->decrement('yearlyfeebal', $row[3]);*/
            // $fee->yearlyfee= $fee->yearlyfee+$row[3];
            // $fee->yearlyfeebal =  (($fee->expectedterm1+$fee->expectedterm2+$fee->expectedterm3)-$row[3])+$fee->yearlyfeebal;
            // $fee->save();

            // $beneficiaryName = $beneficiary->firstname . " " . $beneficiary->lastname;
            if ($row[2] == 1) {
                FeeSection::updateOrCreate(
                    [
                        'beneficiary_id' => $row[0],
                        'year' => $row[1],

                    ],
                    [
                        'fees_id' => $fee->id,
                        'user_id'    => $usr->id,
                        'yearlyfee' => $fee->yearlyfee,
                       
                    ]
                )->increment('term1', $row[3]);
            } elseif ($row[2] == 2) {
                FeeSection::updateOrCreate(
                    [
                        'beneficiary_id' => $row[0],
                        'year' => $row[1]
                    ],
                    [
                        'fees_id' => $fee->id,
                        'user_id'    => $usr->id,
                        'yearlyfee' => $fee->yearlyfee,
                       
                    ]
                )->increment('term2', $row[3]);
            } elseif ($row[2] == 3) {
                FeeSection::updateOrCreate(
                    [
                        'beneficiary_id' => $row[0],
                        'year' => $row[1]
                    ],
                    [
                        'fees_id' => $fee->id,
                        'user_id'    => $usr->id,
                        'yearlyfee' => $fee->yearlyfee,
                       
                    ]
                )->increment('term3', $row[3]);
            }

          
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
