<?php

namespace App\Http\Controllers\Finance;

use Carbon\Carbon;
use App\Models\Admin\Fees;
use App\Exports\FeePayment;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\Admin\FeeSection;
use Yajra\Datatables\Datatables;
use App\Imports\FeePaymentImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Clerk\Beneficiaryform;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Line Graph Stat
        $currentYear = Carbon::now()->format('Y');

        $totalApp = Beneficiaryform::all()->count();
        $pendingApp = Beneficiaryform::where('ClerkStatus', 'OPEN')->where('AdminStatus', 'PENDING')->get()->count();
        $approvedApp = Beneficiaryform::where('ClerkStatus', 'OPEN')->where('AdminStatus', 'APPROVED')->get()->count();
        $expiredApp = Beneficiaryform::where('ClerkStatus', 'CLOSED')->where('AdminStatus', 'APPROVED')->get()->count();

        return view('finance.index', compact('totalApp','pendingApp','approvedApp','expiredApp'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        //Line Graph Stat
        $currentYear = Carbon::now()->format('Y');
        $jan = Beneficiaryform::whereMonth('created_at', '1')->whereYear('created_at', $currentYear)->count();
        $feb = Beneficiaryform::whereMonth('created_at', '2')->whereYear('created_at', $currentYear)->count();
        $mar = Beneficiaryform::whereMonth('created_at', '3')->whereYear('created_at', $currentYear)->count();
        $apr = Beneficiaryform::whereMonth('created_at', '4')->whereYear('created_at', $currentYear)->count();
        $may = Beneficiaryform::whereMonth('created_at', '5')->whereYear('created_at', $currentYear)->count();
        $jun = Beneficiaryform::whereMonth('created_at', '6')->whereYear('created_at', $currentYear)->count();
        $jul = Beneficiaryform::whereMonth('created_at', '7')->whereYear('created_at', $currentYear)->count();
        $aug = Beneficiaryform::whereMonth('created_at', '8')->whereYear('created_at', $currentYear)->count();
        $sep = Beneficiaryform::whereMonth('created_at', '9')->whereYear('created_at', $currentYear)->count();
        $oct = Beneficiaryform::whereMonth('created_at', '10')->whereYear('created_at', $currentYear)->count();
        $nov = Beneficiaryform::whereMonth('created_at', '11')->whereYear('created_at', $currentYear)->count();
        $dec = Beneficiaryform::whereMonth('created_at', '12')->whereYear('created_at', $currentYear)->count();
        $lineData = [$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec];

        //Pie Chart
        $male = Beneficiaryform::where('gender', 'MALE')->count();
        $female = Beneficiaryform::where('gender', 'FEMALE')->count();
        $pieData = [$male, $female];

        // dd($lineDate);
        return response()->json(['linedata' => $lineData, 'piedata' => $pieData]);
    }

    public function yearlyfees()
    {
        $activeYear = AcademicYear::where('status', true)->first();
        $fee = Fees::select(['id','beneficiary_id', 'beneficiary','expectedterm1','expectedterm2','expectedterm3', 'AllocatedYealyFee', 'year'])->get();
       
        return view('finance.yearlyfeelist', compact('activeYear','fee'));
    }

    public function yearlyfeesdata()
    {
        $feeyear = Fees::select(['id','beneficiary_id', 'beneficiary','expectedterm1','expectedterm2','expectedterm3', 'AllocatedYealyFee', 'year']);
        
        return Datatables::of($feeyear)
            ->addColumn('action', function ($feeyear) {
                return '
                
                <a href="/admin/beneficiary/fee/' . $feeyear->id . '" class="btn btn-md btn-info"><small>View</small></a>
                ';
            })
            ->make(true);
    }
    


    public function viewstatement($id)
    {
        $feestruture = Fees::where('id',$id)->first();
        $feepayment = FeeSection::where('fees_id',$id)->first();
        return view('finance.viewstatement',compact('id','feestruture','feepayment'));
    }

    public function feepaymentview()
    {
        return view('finance.feepayment.feepaymentform');
    }

    public function importfeepayment(Request $request)
    {
        Excel::import(new FeePaymentImport, $request->file('feedata')->store('temp'));
        activity()->log("Fee Payment Uploaded");
        alert('IMPORTED', 'File Uploaded', 'success')->autoClose(10000);
        return back();
    }
    public function bankstatementview()
    {
        $years = AcademicYear::all();
        return view('finance.feepayment.index',compact('years'));
    }
    public function getfeeexcel(Request $request)
    {
        return Excel::download(new FeePayment($request->year,$request->term), 'feepayment-'.date('h.i.s.a').'.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
