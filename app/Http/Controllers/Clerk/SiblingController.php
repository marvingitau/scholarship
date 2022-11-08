<?php

namespace App\Http\Controllers\Clerk;

use App\Models\Clerk\Sibling;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSiblingRequest;
use App\Http\Requests\UpdateSiblingRequest;

class SiblingController extends Controller
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
     * @param  \App\Http\Requests\StoreSiblingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiblingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clerk\Sibling  $sibling
     * @return \Illuminate\Http\Response
     */
    public function show(Sibling $sibling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clerk\Sibling  $sibling
     * @return \Illuminate\Http\Response
     */
    public function edit(Sibling $sibling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiblingRequest  $request
     * @param  \App\Models\Clerk\Sibling  $sibling
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiblingRequest $request, Sibling $sibling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clerk\Sibling  $sibling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sibling $sibling)
    {
        //
    }
}
