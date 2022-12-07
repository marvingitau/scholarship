<?php

namespace App\Exports;

use App\Models\Admin\Fees;
use App\Models\Admin\SchoolInfo;
use Illuminate\Contracts\View\View;
use App\Models\Clerk\Beneficiaryform;
use Maatwebsite\Excel\Concerns\FromView;

class BeneficiariesList implements FromView
{

    // protected $year;

    public function __construct($institution,$gender) {
        $this->year = $institution;
        $this->term = $gender;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $users = "";
        // dd(isset($request->age));
        if (isset($this->gender) && isset($this->institution)) {
            $users = Beneficiaryform::query()
                ->where('gender', 'LIKE', "%{$this->gender}%")
                ->orWhere('Type', 'LIKE', "%{$this->institution}%")
                ->get();
        } elseif (!isset($this->gender) && isset($this->institution)) {
            $users = Beneficiaryform::query()
                ->where('Type', 'LIKE', "%{$this->institution}%")
                ->get();

        } elseif (isset($this->gender) && !isset($this->institution)) {
            $users = Beneficiaryform::query()
                ->where('gender', 'LIKE', "%{$this->gender}%")
                ->get();
 
        } else {
            $users = Beneficiaryform::all();

        }
        
        return view('exports.beneficiarieslist', [
            'slip' => $users
        ]);
    }
}
