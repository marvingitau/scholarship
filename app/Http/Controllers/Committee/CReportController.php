<?php

namespace App\Http\Controllers\Committee;

use App\Exports\FeeExport;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Exports\BeneficiariesList;
use App\Exports\CommunicationList;
use App\Exports\SchoolResultExport;
use App\Models\Admin\Communication;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Clerk\Beneficiaryform;
use App\Models\Admin\SchoolReportHeader;
use App\Exports\ArchivedBeneficiariesList;

class CReportController extends Controller
{
    public function index()
    {
        return view('committee.reports.index');
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
            return view('committee.reports.schoolreportlist', compact('res', 'query'));
        } else {
            $res = SchoolReportHeader::join('beneficiaryforms', 'school_report_headers.beneficiary_id', '=', 'beneficiaryforms.id')->where('year', $request->year)->where('form', $request->form)->where('term', $request->term)->get();
            // dd($res);
            return view('committee.reports.schoolreportlist', compact('res', 'query'));
        }
    }

    public function excelreport(Request $request)
    {
        // return (new SchoolResultExport)->download('resultslip-'.date('H.i.s').'.xlsx');
        return Excel::download(new SchoolResultExport($request->year, $request->Type, $request->form, $request->academicyear, $request->term), 'resultslip-' . date('h.i.s.a') . '.xlsx');
        // dd($request->all());
    }

    public function contacts()
    {
        $contacts = Communication::join('beneficiaryforms', 'communications.beneficiary_id', '=', 'beneficiaryforms.id')->get();
        // dd($contacts);
        return view('committee.reports.contacts', compact('contacts'));
    }

    public function contactxcel()
    {
        return Excel::download(new CommunicationList, 'contacts-' . date('h.i.s.a') . '.xlsx');
    }

    public function filteractivebene()
    {

        return view('committee.reports.activebeneficiaryreport');
    }

    public function filteractiveget(Request $request)
    {
        return Excel::download(new BeneficiariesList( $request->institution,$request->gender), 'beneficiaries-' . date('h.i.s.a') . '.xlsx');
    }

    public function filterarchived(Request $request)
    {
        return Excel::download(new ArchivedBeneficiariesList( null,null), 'beneficiaries-' . date('h.i.s.a') . '.xlsx');
    }

    public function getfeeactive()
    {
        return Excel::download(new FeeExport, 'beneficiariesFee-' . date('h.i.s.a') . '.xlsx');
        // $academicYears = AcademicYear::all();
        // return view('committee.reports.activebeneficiaryfeereport',compact(['academicYears']));
    }

    public function fetchexcelfee(Request $request)
    {
    }
}
