<?php

namespace App\Http\Controllers\Clerk;

use App\Http\Controllers\Controller;
use App\Models\Clerk\AcademicInfo;
use App\Http\Requests\StoreAcademicInfoRequest;
use App\Http\Requests\UpdateAcademicInfoRequest;

class AcademicInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreAcademicInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcademicInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clerk\AcademicInfo  $academicInfo
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicInfo $academicInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clerk\AcademicInfo  $academicInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicInfo $academicInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAcademicInfoRequest  $request
     * @param  \App\Models\Clerk\AcademicInfo  $academicInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcademicInfoRequest $request, AcademicInfo $academicInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clerk\AcademicInfo  $academicInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicInfo $academicInfo)
    {
        //
    }
}
