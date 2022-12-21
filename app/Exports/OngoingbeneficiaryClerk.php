<?php

namespace App\Exports;

use App\Models\Admin\Fees;
use App\Models\AcademicYear;
use App\Models\Admin\FeeSection;
use App\Models\Admin\SchoolInfo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OngoingbeneficiaryClerk implements FromView
{

    // protected $year;

  
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        
        $activeYear = AcademicYear::where('status', 1)->first();
        if (is_null($activeYear)) {
            activity()->log('Active Year is Null');
            toast('Active Year is Required !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        $data = Fees::join('beneficiaryforms','fees.beneficiary_id','=','beneficiaryforms.id')->where('fees.year','!=',$activeYear->year)->where('fees.status',1)->get(); 
        return view('exports.ongoingbeneficiarytemplate', [
            'data' => $data
        ]);
    }
}
