<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ActionReason;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActionReasonRequest;
use App\Http\Requests\UpdateActionReasonRequest;

class ActionReasonController extends Controller
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
     * @param  \App\Http\Requests\StoreActionReasonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActionReasonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\ActionReason  $actionReason
     * @return \Illuminate\Http\Response
     */
    public function show(ActionReason $actionReason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\ActionReason  $actionReason
     * @return \Illuminate\Http\Response
     */
    public function edit(ActionReason $actionReason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActionReasonRequest  $request
     * @param  \App\Models\Admin\ActionReason  $actionReason
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActionReasonRequest $request, ActionReason $actionReason)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\ActionReason  $actionReason
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActionReason $actionReason)
    {
        //
    }
}
