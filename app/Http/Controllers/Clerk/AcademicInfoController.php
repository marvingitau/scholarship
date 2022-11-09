<?php

namespace App\Http\Controllers\Clerk;

use Illuminate\Http\Request;
use App\Models\Clerk\AcademicInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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
    public function store(Request $request)
    {
        $dataArr = $request->all();
        $request->validate(
            [
                'Marks1'=>['required'],
                'Marks2'=>['required'],
                'Marks3'=>['required'],
                'Marks4'=>['required'],
                'Marks5'=>['required'],
                'Marks6'=>['required']
            ]
        );
        $beneficiary_id = Session::get('beneficiary_id');
        $rec = AcademicInfo::where('beneficiary_id', $beneficiary_id)->first();
        // dd($rec);
        if ($rec !== null) {
          
            $rec->beneficiary_id =$beneficiary_id;
            $rec->Subject1 =$request-> Subject1;
            $rec->Marks1 =$request-> Marks1;
            $rec->Subject2 =$request-> Subject2;
            $rec->Marks2 =$request-> Marks2;
            $rec->Subject3 =$request-> Subject3;
            $rec->Marks3 =$request-> Marks3;
            $rec->Subject4 =$request-> Subject4;
            $rec->Marks4 =$request-> Marks4;
            $rec->Subject5 =$request-> Subject5;
            $rec->Marks5 =$request-> Marks5;
            $rec->Subject6 =$request-> Subject6;
            $rec->Marks6 =$request-> Marks6;
            $rec->TotalMarks =$request-> TotalMarks;

            $rec->save();
            Session::put('academic_status', 'Academic Information updated!');
            // return response()->json($request->all());
            return back()->withInput();
        } else {
            $rec = AcademicInfo::create($dataArr + ['beneficiary_id' => $beneficiary_id]);
            Session::put('academic_status', 'Academic Information uploaded!');
            // return response()->json($request->all());
            return back()->withInput();
        }
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
