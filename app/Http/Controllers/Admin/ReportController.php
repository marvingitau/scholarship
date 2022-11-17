<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SchoolResultExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\SchoolReportHeader;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function viewreport(Request $request)
    {
        $request->validate([
            'year' => 'required'
        ]);

        $query = $request->all();
        // dump($request->all());
        if ($request->Type !== "SECONDARY APPLICANTS") {
            $res = SchoolReportHeader::join('beneficiaryforms', 'school_report_headers.beneficiary_id', '=', 'beneficiaryforms.id')->where('year', $request->year)->where('form', $request->academicyear)->where('term', $request->term)->get();
            // dd($res);
            return view('admin.reports.schoolreportlist', compact('res', 'query'));
        } else {
            $res = SchoolReportHeader::join('beneficiaryforms', 'school_report_headers.beneficiary_id', '=', 'beneficiaryforms.id')->where('year', $request->year)->where('form', $request->form)->where('term', $request->term)->get();
            // dd($res);
            return view('admin.reports.schoolreportlist', compact('res', 'query'));
        }
    }

    public function excelreport(Request $request)
    {
        // return (new SchoolResultExport)->download('resultslip-'.date('H.i.s').'.xlsx');
        return Excel::download(new SchoolResultExport($request->year, $request->Type, $request->form, $request->academicyear, $request->term), 'resultslip-'.date('h.i.s.a').'.xlsx');
        // dd($request->all());
    }
}
