<?php

namespace App\Http\Controllers\Committee;

use App\Http\Controllers\Controller;
use App\Models\Admin\MentorshipSection;
use App\Http\Requests\StoreMentorshipSectionRequest;
use App\Http\Requests\UpdateMentorshipSectionRequest;

class CMentorshipSectionController extends Controller
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
     * @param  \App\Http\Requests\StoreMentorshipSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMentorshipSectionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\MentorshipSection  $mentorshipSection
     * @return \Illuminate\Http\Response
     */
    public function show(MentorshipSection $mentorshipSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\MentorshipSection  $mentorshipSection
     * @return \Illuminate\Http\Response
     */
    public function edit(MentorshipSection $mentorshipSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMentorshipSectionRequest  $request
     * @param  \App\Models\Admin\MentorshipSection  $mentorshipSection
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMentorshipSectionRequest $request, MentorshipSection $mentorshipSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\MentorshipSection  $mentorshipSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(MentorshipSection $mentorshipSection)
    {
        //
    }
}
