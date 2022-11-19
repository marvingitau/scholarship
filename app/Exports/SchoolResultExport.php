<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\Admin\SchoolReportHeader;
use Maatwebsite\Excel\Concerns\FromView;

class SchoolResultExport implements FromView
{


    public function __construct($year, $Type, $form, $academicyear, $term)
    {
        $this->year = $year;
        $this->Type = $Type;
        $this->form = $form;
        $this->academicyear = $academicyear;
        $this->term = $term;
    }

    public function view(): View
    {
        if ($this->Type !== "SECONDARY APPLICANTS") {
            $res = SchoolReportHeader::join('beneficiaryforms', 'school_report_headers.beneficiary_id', '=', 'beneficiaryforms.id')->where('year', $this->year)->where('form', $this->academicyear)->where('term', $this->term)->get();
        } else {
            $res = SchoolReportHeader::join('beneficiaryforms', 'school_report_headers.beneficiary_id', '=', 'beneficiaryforms.id')->where('year', $this->year)->where('form', $this->form)->where('term', $this->term)->get();
        }

        // $arr = SchoolReportHeader::all();
        return view('exports.reportslip', [
            'slip' => $res
        ]);
    }
}
