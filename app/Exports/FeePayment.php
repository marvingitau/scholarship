<?php

namespace App\Exports;

use App\Models\Admin\Fees;
use App\Models\Admin\SchoolInfo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FeePayment implements FromView
{

    // protected $year;

    public function __construct($year) {
        $this->year = $year;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
      
        $data = Fees::join('school_infos','fees.beneficiary_id','=','school_infos.beneficiary_id')->where('year',$this->year)->get();
      
        return view('exports.feepayment', [
            'slip' => $data
        ]);
    }
}
