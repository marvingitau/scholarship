<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Clerk\Sibling;
use App\Models\Admin\ActionReason;
use App\Models\Clerk\AcademicInfo;
use App\Models\Clerk\FamilyDetail;
use Illuminate\Support\Facades\DB;
use App\Models\Clerk\StatementNeed;
use App\Http\Controllers\Controller;
use App\Models\Admin\DisplinarySection;
use App\Models\Admin\FeeSection;
use App\Models\Admin\MentorshipSection;
use App\Models\Clerk\FamilyProperty;
use Illuminate\Support\Facades\Auth;
use App\Models\Clerk\Beneficiaryform;
use App\Models\Clerk\EmergencyContact;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $totalApp = Beneficiaryform::all()->count();
        $pendingApp = Beneficiaryform::where('ClerkStatus', 'OPEN')->where('AdminStatus', 'PENDING')->get()->count();
        $approvedApp = Beneficiaryform::where('ClerkStatus', 'OPEN')->where('AdminStatus', 'APPROVED')->get()->count();
        $expiredApp = Beneficiaryform::where('ClerkStatus', 'CLOSED')->where('AdminStatus', 'APPROVED')->get()->count();

        return view('admin.index',compact('totalApp','pendingApp','approvedApp','expiredApp'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applicationlist()
    {
        $data = DB::table('beneficiaryforms')->where('ClerkStatus', 'OPEN')->where('AdminStatus', 'PENDING')->get()->toArray();
        // dd($data);
        return view('admin.applications', compact('data'));
    }

    /**
     * Display an applicant resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applicant($id)
    {
        $personalSectionAux = Beneficiaryform::where('id', $id)->first();
        if (!is_null($personalSectionAux)) {
            $personalSection = $personalSectionAux->toArray();
            $academicSection = AcademicInfo::where('beneficiary_id', $id)->first()->toArray();
            $familySection = FamilyDetail::where('beneficiary_id', $id)->first()->toArray();
            $statementSection = StatementNeed::where('beneficiary_id', $id)->first()->toArray();
            $siblingSection = Sibling::where('beneficiary_id', $id)->first()->toArray();
            $emergencySection = EmergencyContact::where('beneficiary_id', $id)->first()->toArray();
            $familyPropertySection = FamilyProperty::where('beneficiary_id', $id)->first()->toArray();
            return view('admin.applicant', compact(['personalSection', 'academicSection', 'familySection', 'statementSection', 'siblingSection', 'emergencySection', 'familyPropertySection']));
        } else {
            return back();
        }

        // dd($id);
    }

    public function approve(Request $request)
    {
        $personalSection = Beneficiaryform::where('id', $request->applicant)->first();
        $personalSection->AdminStatus = "APPROVED";
        $personalSection->save();

        $user = Auth::user();
        ActionReason::updateOrCreate(
            ['beneficiary_id' => $request->applicant],
            ['user_id' => $user->id, 'reason' => $request->applicantactionreason]
        );

        return back()->with('message', 'Approval Success');
    }


    public function reject(Request $request)
    {
        $personalSection = Beneficiaryform::where('id', $request->applicant)->first();
        $personalSection->AdminStatus = "REJECTED";
        $personalSection->save();

        $user = Auth::user();
        ActionReason::updateOrCreate(
            ['beneficiary_id' => $request->applicant],
            ['user_id' => $user->id, 'reason' => $request->applicantactionreason]
        );
        return back()->with('message', 'Rejection Success');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approvedbeneficiaries()
    {
        $data = DB::table('beneficiaryforms')->where('ClerkStatus', 'OPEN')->where('AdminStatus', 'APPROVED')->get()->toArray();
        // dd($data);
        return view('admin.beneficiaries', compact('data'));
    }
    public function archivebeneficiaries($id)
    {
        $data = Beneficiaryform::where('id',$id)->first();
        $data->ClerkStatus = "CLOSED";
        $data->save();
        return back();
        // dd($data);
      
    }
    public function unarchivebeneficiaries($id)
    {
        $data = Beneficiaryform::where('id',$id)->first();
        $data->ClerkStatus = "OPEN";
        $data->save();
        return back();
        // dd($data);
      
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archivedbeneficiaries()
    {
        $data = DB::table('beneficiaryforms')->where('ClerkStatus', 'CLOSED')->where('AdminStatus', 'APPROVED')->get()->toArray();
        // dd($data);
        return view('admin.archivedbeneficiaries', compact('data'));
    }

    public function selectbeneficiary($id)
    {
        $personalSectionAux = Beneficiaryform::where('id', $id)->first();
        if (!is_null($personalSectionAux)) {
            $personalSection = $personalSectionAux->toArray();
            $academicSection = AcademicInfo::where('beneficiary_id', $id)->first()->toArray();
            $familySection = FamilyDetail::where('beneficiary_id', $id)->first()->toArray();
            $statementSection = StatementNeed::where('beneficiary_id', $id)->first()->toArray();
            $siblingSection = Sibling::where('beneficiary_id', $id)->first()->toArray();
            $emergencySection = EmergencyContact::where('beneficiary_id', $id)->first()->toArray();
            $familyPropertySection = FamilyProperty::where('beneficiary_id', $id)->first()->toArray();
            $reasonSection = ActionReason::where('beneficiary_id', $id)->first()->toArray();

            return view('admin.beneficiary', compact(['personalSection', 'academicSection', 'familySection', 'statementSection', 'siblingSection', 'emergencySection', 'familyPropertySection', 'reasonSection']));
        } else {
            return back();
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beneficiarydisciplinary($id)
    {
        $data = DB::table('displinary_sections')->where('beneficiary_id', $id)->get();
        // dd($data);
        return view('admin.beneficiarydiscipline', compact('data', 'id'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beneficiaryfee($id)
    {
        $data = DB::table('fee_sections')->where('beneficiary_id', $id)->get();
        // dd($data);
        return view('admin.beneficiaryfee', compact('data','id'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beneficiarymentorship($id)
    {
        $data = DB::table('mentorship_sections')->where('beneficiary_id', $id)->get();
        // dd($data);
        return view('admin.beneficiarymentor', compact('data','id'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newmentor($id)
    {
        // $data = DB::table('mentorship_sections')->where('beneficiary_id', $id)->get();
        // dd($data);
        return view('admin.mentorform', compact('id'));
    }

    public function postnewmentor(Request $request)
    {
        $usr = Auth::user();
        MentorshipSection::create(
            [
                'beneficiary_id' => $request->id,
                'user_id' => $usr->id,
                'name' => $request->name,
                'subject' => $request->subject,
                'remark' => $request->remark
            ]
        );
        return back()->with('message', 'Posted Successfully');
    }

    public function viewmentor($id)
    {
        $dis = MentorshipSection::where('id', $id)->first();
        return view('admin.mentorview', compact('dis'));
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newdisciplinary($id)
    {
        // $data = DB::table('mentorship_sections')->where('beneficiary_id', $id)->get();
        // dd($data);
        return view('admin.disciplineform', compact('id'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postnewdisciplinary(Request $request)
    {
        $usr = Auth::user();
        DisplinarySection::create(
            [
                'beneficiary_id' => $request->id,
                'user_id' => $usr->id,
                'subject' => $request->subject,
                'date' => $request->date,
                'recommendation' => $request->recommendation
            ]
        );
        return back()->with('message', 'Posted Successfully');
    }

    public function viewdisciplinary($id)
    {
        $dis = DisplinarySection::where('id', $id)->first();
        return view('admin.disciplineview', compact('dis'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newfee($id)
    {
        // $data = DB::table('mentorship_sections')->where('beneficiary_id', $id)->get();
        // dd($data);
        return view('admin.feeform', compact('id'));
    }

    public function postnewfee(Request $request)
    {
        $usr = Auth::user();
        FeeSection::create(
            [
                'beneficiary_id' => $request->id,
                'user_id' => $usr->id,
                'date' => $request->date,
                'term' => $request->term,
                'amount' => $request->amount
            ]
        );
        return back()->with('message', 'Posted Successfully');
    }

    public function viewfee($id)
    {
        $dis = FeeSection::where('id', $id)->first();
        return view('admin.feeview', compact('dis'));
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
