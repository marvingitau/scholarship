<?php

namespace App\Http\Controllers\Committee;

use App\Http\Controllers\Controller;
use App\Models\Admin\DisplinarySection;
use App\Http\Requests\StoreDisplinarySectionRequest;
use App\Http\Requests\UpdateDisplinarySectionRequest;

class CDisplinarySectionController extends Controller
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
     * @param  \App\Http\Requests\StoreDisplinarySectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDisplinarySectionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\DisplinarySection  $displinarySection
     * @return \Illuminate\Http\Response
     */
    public function show(DisplinarySection $displinarySection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\DisplinarySection  $displinarySection
     * @return \Illuminate\Http\Response
     */
    public function edit(DisplinarySection $displinarySection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDisplinarySectionRequest  $request
     * @param  \App\Models\Admin\DisplinarySection  $displinarySection
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDisplinarySectionRequest $request, DisplinarySection $displinarySection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\DisplinarySection  $displinarySection
     * @return \Illuminate\Http\Response
     */
    public function destroy(DisplinarySection $displinarySection)
    {
        //
    }
}
