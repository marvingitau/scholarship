<?php

namespace App\Exports;

use App\Models\Admin\Fees;
use App\Models\Admin\FeeSection;
use App\Models\Admin\SchoolInfo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymasterFeeData implements FromView
{

    // protected $year;

  
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        
        $data = Fees::leftJoin('fee_sections', 'fees.id', '=', 'fee_sections.fees_id')->select(['fees.id', 'fees.beneficiary_id', 'fees.beneficiary', 'fees.expectedterm1', 'fees.expectedterm2', 'fees.expectedterm3', 'fees.AllocatedYealyFee', 'fees.year', 'fee_sections.term1', 'fee_sections.term2', 'fee_sections.term3'])->get();
        // ->where('fees.year', $this->year)
    //   dd($data);
        return view('exports.paymasterfeesitory', [
            'data' => $data
        ]);
    }
}
