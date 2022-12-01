<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Fees;
use App\Exports\FeePayment;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\Admin\FeeSection;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreFeeSectionRequest;
use App\Http\Requests\UpdateFeeSectionRequest;

class FeeSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = AcademicYear::all();
        return view('admin.feepayment.index',compact('years'));
    }

    public function getfeeexcel(Request $request)
    {

        $data = Fees::join('school_infos','fees.beneficiary_id','=','school_infos.beneficiary_id')->join('fee_sections','school_infos.beneficiary_id','=','fee_sections.beneficiary_id')->where('fee_sections.year',$request->year)->select(['term1'])->get()->toArray();
        // 
    
        // return Excel::download(new FeePayment($request->year), 'feepayment-'.date('h.i.s.a').'.xlsx');
        dd($data);
        // return view('admin.feepayment.index',compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFeeSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeeSectionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\FeeSection  $feeSection
     * @return \Illuminate\Http\Response
     */
    public function show(FeeSection $feeSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\FeeSection  $feeSection
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeSection $feeSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeeSectionRequest  $request
     * @param  \App\Models\Admin\FeeSection  $feeSection
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeeSectionRequest $request, FeeSection $feeSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\FeeSection  $feeSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeSection $feeSection)
    {
        //
    }
}
