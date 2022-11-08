<?php

namespace App\Http\Controllers\Clerk;

use App\Http\Controllers\Controller;
use App\Models\Clerk\FamilyProperty;
use App\Http\Requests\StoreFamilyPropertyRequest;
use App\Http\Requests\UpdateFamilyPropertyRequest;

class FamilyPropertyController extends Controller
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
     * @param  \App\Http\Requests\StoreFamilyPropertyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilyPropertyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clerk\FamilyProperty  $familyProperty
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyProperty $familyProperty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clerk\FamilyProperty  $familyProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyProperty $familyProperty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFamilyPropertyRequest  $request
     * @param  \App\Models\Clerk\FamilyProperty  $familyProperty
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamilyPropertyRequest $request, FamilyProperty $familyProperty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clerk\FamilyProperty  $familyProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyProperty $familyProperty)
    {
        //
    }
}
