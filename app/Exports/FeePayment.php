<?php

namespace App\Exports;

use App\Models\Admin\Fees;
use App\Models\Admin\FeeSection;
use App\Models\Admin\SchoolInfo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FeePayment implements FromView
{

    // protected $year;

    public function __construct($year,$term) {
        $this->year = $year;
        $this->term = $term;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
      
        // $data = Fees::join('school_infos','fees.beneficiary_id','=','school_infos.beneficiary_id')->
        // join('fee_sections','school_infos.beneficiary_id','=','fee_sections.beneficiary_id')->
        // where('fees.year',$this->year)->get();

        $data = Fees::join('fee_sections','fees.id','=','fee_sections.fees_id')->join('school_infos','fee_sections.beneficiary_id','=','school_infos.beneficiary_id')->where('fee_sections.year',$this->year)->select(['admissionno','school','bankname','accountno','branch','bankcode',$this->term])->get();

        // $data = FeeSection::where('fee_sections.year',$this->year)->join('fees','fee_sections.beneficiary_id','=','fees.beneficiary_id')->join('school_infos','fee_sections.beneficiary_id','=','school_infos.beneficiary_id')->get();

        // ->select(['admissionno','school','bankname','accountno','branch','bankcode',$this->term])
     
        return view('exports.feepayment', [
            'slip' => $data
        ]);
    }
}
