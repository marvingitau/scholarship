<?php

namespace App\Http\Controllers\Clerk;

use App\Http\Controllers\Controller;
use App\Models\Clerk\Beneficiaryform;
use App\Http\Requests\StoreBeneficiaryformRequest;
use App\Http\Requests\UpdateBeneficiaryformRequest;

class BeneficiaryformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clerk.beneficiaryform');
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
     * @param  \App\Http\Requests\StoreBeneficiaryformRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBeneficiaryformRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clerk\Beneficiaryform  $beneficiaryform
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiaryform $beneficiaryform)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clerk\Beneficiaryform  $beneficiaryform
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficiaryform $beneficiaryform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBeneficiaryformRequest  $request
     * @param  \App\Models\Clerk\Beneficiaryform  $beneficiaryform
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBeneficiaryformRequest $request, Beneficiaryform $beneficiaryform)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clerk\Beneficiaryform  $beneficiaryform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiaryform $beneficiaryform)
    {
        //
    }
}
