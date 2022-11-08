<?php

namespace App\Http\Controllers\Clerk;

use App\Models\Clerk\FamilyDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFamilyDetailRequest;
use App\Http\Requests\UpdateFamilyDetailRequest;

class FamilyDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreFamilyDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilyDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clerk\FamilyDetail  $familyDetail
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyDetail $familyDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clerk\FamilyDetail  $familyDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyDetail $familyDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFamilyDetailRequest  $request
     * @param  \App\Models\Clerk\FamilyDetail  $familyDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamilyDetailRequest $request, FamilyDetail $familyDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clerk\FamilyDetail  $familyDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyDetail $familyDetail)
    {
        //
    }
}
