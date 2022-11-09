<?php

namespace App\Http\Controllers\Clerk;

use App\Http\Controllers\Controller;
use App\Models\Clerk\Beneficiaryform;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClerkDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Line Graph Stat
        $currentYear = Carbon::now()->format('Y');

        $totalApp = Beneficiaryform::all()->count();
        $pendingApp = Beneficiaryform::where('ClerkStatus', 'OPEN')->where('AdminStatus', 'PENDING')->get()->count();
        $approvedApp = Beneficiaryform::where('ClerkStatus', 'OPEN')->where('AdminStatus', 'APPROVED')->get()->count();
        $expiredApp = Beneficiaryform::where('ClerkStatus', 'CLOSED')->where('AdminStatus', 'APPROVED')->get()->count();

        return view('clerk.index', compact('totalApp','pendingApp','approvedApp','expiredApp'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        //Line Graph Stat
        $currentYear = Carbon::now()->format('Y');
        $jan = Beneficiaryform::whereMonth('created_at', '1')->whereYear('created_at', $currentYear)->count();
        $feb = Beneficiaryform::whereMonth('created_at', '2')->whereYear('created_at', $currentYear)->count();
        $mar = Beneficiaryform::whereMonth('created_at', '3')->whereYear('created_at', $currentYear)->count();
        $apr = Beneficiaryform::whereMonth('created_at', '4')->whereYear('created_at', $currentYear)->count();
        $may = Beneficiaryform::whereMonth('created_at', '5')->whereYear('created_at', $currentYear)->count();
        $jun = Beneficiaryform::whereMonth('created_at', '6')->whereYear('created_at', $currentYear)->count();
        $jul = Beneficiaryform::whereMonth('created_at', '7')->whereYear('created_at', $currentYear)->count();
        $aug = Beneficiaryform::whereMonth('created_at', '8')->whereYear('created_at', $currentYear)->count();
        $sep = Beneficiaryform::whereMonth('created_at', '9')->whereYear('created_at', $currentYear)->count();
        $oct = Beneficiaryform::whereMonth('created_at', '10')->whereYear('created_at', $currentYear)->count();
        $nov = Beneficiaryform::whereMonth('created_at', '11')->whereYear('created_at', $currentYear)->count();
        $dec = Beneficiaryform::whereMonth('created_at', '12')->whereYear('created_at', $currentYear)->count();
        $lineData = [$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec];

        //Pie Chart
        $male = Beneficiaryform::where('gender', 'MALE')->count();
        $female = Beneficiaryform::where('gender', 'FEMALE')->count();
        $pieData = [$male, $female];

        // dd($lineDate);
        return response()->json(['linedata' => $lineData, 'piedata' => $pieData]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
