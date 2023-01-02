<?php

namespace App\Http\Controllers\Clerk;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\SchoolInfo;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Communication;
use App\Http\Controllers\Controller;
use App\Models\Admin\TransferHistory;
use App\Models\Clerk\Beneficiaryform;

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


    public function beneficiaries()
    {
        $beneficiaries = Beneficiaryform::where('ClerkStatus', 'OPEN')->where('AdminStatus', 'APPROVED')->get();
        return view('clerk.beneficiaries',compact(['beneficiaries']));
    }

    public function beneficiary($id)
    {
        $commData = Communication::where('beneficiary_id', $id)->first();
        $schoolData = SchoolInfo::where('beneficiary_id', $id)->get();
        $transferData = TransferHistory::where('beneficiary_id', $id)->get();
        return view('clerk.additionalinfo.index', compact('id', 'commData', 'schoolData', 'transferData'));
    }

    //Additional Info

    public function additionalinfo($id)
    {
        $commData = Communication::where('beneficiary_id', $id)->first();
        $schoolData = SchoolInfo::where('beneficiary_id', $id)->get();
        $transferData = TransferHistory::where('beneficiary_id', $id)->get();
        return view('clerk.additionalinfo.index', compact('id', 'commData', 'schoolData', 'transferData'));
    }

    public function updateadditionalinfo(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required',
        ]);
        //Check on this logic 
        //Something might be misssing
        //Missing a trail from whom the active number belongs
        // $count = Beneficiaryform::where('id',$id)->where('EmailActive',$request->email)->orWhere('MobileActive',$request->phone)->count();
        // if($count>1){

        // }
        $beneficiary = Beneficiaryform::where('id', $id)->first();
        $beneficiary->EmailActive = $request->email;
        $beneficiary->MobileActive = $request->phone;
        $beneficiary->save();

        $comm = Communication::where('beneficiary_id', $id)->first();
        if (is_null($comm)) {
            Communication::create(['beneficiary_id' => $id, 'email' => $request->email, 'phone' => $request->phone, 'belongsto' => $request->belongsto, 'beneficiary_type' => $beneficiary->Type]);
        } else {
            $comm->email = $request->email;
            $comm->phone = $request->phone;
            $comm->belongsto = $request->belongsto;
            $comm->beneficiary_type = $beneficiary->Type;
            $comm->save();
        }

        activity()->log("Communication Info Updated for usr: " . $id);
        alert('UPDATED', 'Communication Info Update was a Success', 'success')->autoClose(10000);
        return back();
    }


    public function newschoolinfo($id)
    {
        return view('clerk.additionalinfo.newschoolinfoform', compact('id'));
    }

    public function getschoolinfo($id)
    {
        $schrec = SchoolInfo::where('id', $id)->first();
        return view('clerk.additionalinfo.editschoolinfoform', compact('schrec'));
    }

    public function postnewschoolinfo(Request $request)
    {
        $schrec = SchoolInfo::create($request->all());
        $current = is_null($request->current) ? 0 : 1;
     
        if($current){
            Beneficiaryform::where('id',$request->beneficiary_id)->update(['SecondaryAdmitted'=>$request->name]);
        }
        activity()->log("School Info Creation for user: " . $request->beneficiary_id . " ,record:" . $schrec->id);
        alert('CREATED', 'School Information Creation was a Success', 'success')->autoClose(10000);
        return back();
    }

    public function updatenewschoolinfo(Request $request)
    {

        // dd($request->all()); 

        $schrec = SchoolInfo::where('id', $request->id)->first();
        $schrec->name = $request->name;
        $schrec->bankname = $request->bankname;
        $schrec->bankcode = $request->bankcode;
        $schrec->branch = $request->branch;
        $schrec->accountno = $request->accountno;
        $schrec->admissionno = $request->admissionno;
        $schrec->current = is_null($request->current) ? 0 : 1;
        $schrec->save();

        $current = is_null($request->current) ? 0 : 1;
     
        if($current){
            Beneficiaryform::where('id',$request->beneficiary_id)->update(['SecondaryAdmitted'=>$request->name]);
        }

        activity()->log("School Info Update for user: " . $request->beneficiary_id . " ,record:" . $schrec->id);
        alert('UPDATED', 'School Information Update was a Success', 'success')->autoClose(10000);
        return back();
    }

    public function delschoolinfo($id)
    {
        SchoolInfo::where('id', $id)->delete();

        activity()->log("School Info Deletion for record:" . $id);
        alert('DELETED', 'School Information Deletion was a Success', 'success')->autoClose(10000);
        return back();
    }

    public function newtransfer($id)
    {
        $schoolList = SchoolInfo::where('id', $id)->get();
        return view('clerk.additionalinfo.newtransfer', compact('id', 'schoolList'));
    }

    public function postnewtransfer(Request $request)
    {
        $schrec = TransferHistory::create($request->all());
        activity()->log("School Transfer Creation for user: " . $request->beneficiary_id . " ,record:" . $schrec->id);
        alert('CREATED', 'School Transfer Creation was a Success', 'success')->autoClose(10000);
        return back();
    }


    public function gettransfer($id)
    {
        $schrec = TransferHistory::where('id', $id)->first();
        return view('clerk.additionalinfo.edittransfer', compact('schrec', 'id'));
    }

    public function updatenewtransfer(Request $request)
    {

        // dd($request->all());

        $schrec = TransferHistory::where('id', $request->id)->first();
        $schrec->schoolname = $request->schoolname;
        $schrec->from = $request->from;
        $schrec->to = $request->to;
        $schrec->reason = $request->reason;
        $schrec->save();

        activity()->log("School Transfer Update for user: " . $request->beneficiary_id . " ,record:" . $schrec->id);
        alert('UPDATED', 'School Transfer Update was a Success', 'success')->autoClose(10000);
        return back();
    }

    public function deltransfer($id)
    {
        TransferHistory::where('id', $id)->delete();

        activity()->log("School Transfer Deletion for record:" . $id);
        alert('DELETED', 'School Transfer Deletion was a Success', 'success')->autoClose(10000);
        return back();
    }

    // End of Addional Info

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
