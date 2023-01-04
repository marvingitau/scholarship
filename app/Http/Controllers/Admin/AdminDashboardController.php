<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Exports\FeeExport;
use App\Models\Admin\Fees;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\Clerk\Sibling;
use App\Imports\AnnualFeeImport;
use App\Models\Admin\FeeSection;
use App\Models\Admin\SchoolInfo;
use App\Models\Admin\SchoolSlip;
use Yajra\Datatables\Datatables;
use App\Models\Admin\ActionReason;
use App\Models\Clerk\AcademicInfo;
use App\Models\Clerk\FamilyDetail;
use Illuminate\Support\Facades\DB;
use App\Exports\Ongoingbeneficiary;
use App\Models\Admin\Communication;
use App\Models\Clerk\StatementNeed;
use App\Models\Clerk\SupportingDoc;
use App\Http\Controllers\Controller;
use App\Models\Clerk\FamilyProperty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\TransferHistory;
use App\Models\Clerk\Beneficiaryform;
use App\Models\Clerk\ExpectedTermFee;
use App\Models\Clerk\EmergencyContact;
use App\Models\Admin\DisplinarySection;
use App\Models\Admin\MentorshipSection;
use App\Models\Admin\SchoolReportHeader;

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

        return view('admin.index', compact('totalApp', 'pendingApp', 'approvedApp', 'expiredApp'));
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
            $academicSection = DB::table('academic_infos')->where('beneficiary_id', $id)->get()->toArray();
            $familySection = FamilyDetail::where('beneficiary_id', $id)->first()->toArray();
            $statementSection = StatementNeed::where('beneficiary_id', $id)->first()->toArray();
            $siblingSection = DB::table('siblings')->where('beneficiary_id', $id)->get()->toArray();
            $emergencySection = EmergencyContact::where('beneficiary_id', $id)->first()->toArray();
            $familyPropertySection = DB::table('family_properties')->where('beneficiary_id', $id)->get()->toArray();
            $expectedFee = ExpectedTermFee::where('beneficiary_id', $id)->first()->toArray();

            $feestructure = SupportingDoc::all()->filter(function ($value) {
                // $today = Carbon::now();
                // $value->created_at->year === $today->year && 
                return $value->type == "FEES"; // assuming, that your timestamp gets converted to a Carbon object.
            })->where('beneficiary_id',$id);

            $passport = SupportingDoc::all()->filter(function ($value) {
              
                return  $value->type == "PASSPORT"; 
            })->where('beneficiary_id',$id);

            $softcopy = SupportingDoc::all()->filter(function ($value) {
                return  $value->type == "FORM";
            })->where('beneficiary_id',$id);
            
            // dd($personalSection['Type']);
            if ($personalSection['Type'] == 'THEOLOGY') {
                return view('admin.theologyapplicant', compact(['personalSection', 'academicSection', 'familySection', 'statementSection', 'siblingSection', 'emergencySection', 'familyPropertySection', 'expectedFee','feestructure','passport','softcopy']));
            } elseif ($personalSection['Type'] == 'SPECIAL') {
                return view('admin.specialapplicant', compact(['personalSection', 'academicSection', 'familySection', 'statementSection', 'siblingSection', 'emergencySection', 'familyPropertySection', 'expectedFee','feestructure','passport','softcopy']));
            } else {
                return view('admin.applicant', compact(['personalSection', 'academicSection', 'familySection', 'statementSection', 'siblingSection', 'emergencySection', 'familyPropertySection', 'expectedFee','feestructure','passport','softcopy']));
            }
        } else {
            return back();
        }

        // dd($id);
    }

    public function approve(Request $request)
    {
        $user = Auth::user();
        $personalSection = Beneficiaryform::where('id', $request->applicant)->first();
        $personalSection->AdminStatus = "APPROVED";
        $personalSection->ApprovedBy = $user->id;
        $personalSection->AllocatedYealyFee = $request->AllocatedYealyFee;
        $personalSection->save();

        $activeYear = AcademicYear::where('status', 1)->first();
        $expTermfee = ExpectedTermFee::where('beneficiary_id', $request->applicant)->where('year', $activeYear->year)->first();
        $expTermfee->AllocatedYealyFee = $request->AllocatedYealyFee;
        $expTermfee->save();

        $fee = Fees::where('beneficiary_id', $request->applicant)->where('year', $activeYear->year)->first();
        $fee->AllocatedYealyFee = $request->AllocatedYealyFee;
        $fee->yearlyfeebal = $request->AllocatedYealyFee - $fee->yearlyfee;
        $fee->save();

        ActionReason::updateOrCreate(
            ['beneficiary_id' => $request->applicant],
            ['user_id' => $user->id, 'reason' => $request->applicantactionreason]
        );
        activity()->log("Beneficiary Approved:" . $personalSection->firstname . " " . $personalSection->lastname);
        alert('APPROVE', 'Beneficiary Approval was a Success', 'success')->autoClose(10000);
        return back();
    }


    public function reject(Request $request)
    {
        $user = Auth::user();
        $personalSection = Beneficiaryform::where('id', $request->applicant)->first();
        $personalSection->AdminStatus = "REJECTED";
        $personalSection->ApprovedBy = $user->id;
        $personalSection->save();

        ActionReason::updateOrCreate(
            ['beneficiary_id' => $request->applicant],
            ['user_id' => $user->id, 'reason' => $request->applicantactionreason]
        );
        activity()->log("Beneficiary Rejected:" . $personalSection->firstname . " " . $personalSection->lastname);
        alert('REJECT', 'Beneficiary Rejection was a Success', 'success')->autoClose(10000);
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
        $data = Beneficiaryform::where('id', $id)->first();
        $data->ClerkStatus = "CLOSED";
        $data->save();
        return back();
        // dd($data);

    }
    public function unarchivebeneficiaries($id)
    {
        $data = Beneficiaryform::where('id', $id)->first();
        $data->ClerkStatus = "OPEN";
        $data->save();
        return back();
    }
    public function unrejectedapplicants($id)
    {
        $data = Beneficiaryform::where('id', $id)->first();
        $data->AdminStatus = "PENDING";
        $data->save();
        return back();
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
    public function rejectedapplicants()
    {
        $data = DB::table('beneficiaryforms')->where('ClerkStatus', 'OPEN')->where('AdminStatus', 'REJECTED')->get()->toArray();
        // dd($data);
        return view('admin.rejectedapplicants', compact('data'));
    }


    public function selectbeneficiary($id)
    {
        $personalSectionAux = Beneficiaryform::where('id', $id)->first();
        if (!is_null($personalSectionAux)) {
            $personalSection = $personalSectionAux->toArray();
            $academicSection = DB::table('academic_infos')->where('beneficiary_id', $id)->get()->toArray();
            // $academicSection = AcademicInfo::where('beneficiary_id', $id)->first()->toArray();
            $familySection = FamilyDetail::where('beneficiary_id', $id)->first()->toArray();
            $statementSection = StatementNeed::where('beneficiary_id', $id)->first()->toArray();
            // $siblingSection = Sibling::where('beneficiary_id', $id)->first()->toArray(); 
            $siblingSection = DB::table('siblings')->where('beneficiary_id', $id)->get()->toArray();
            $emergencySection = EmergencyContact::where('beneficiary_id', $id)->first()->toArray();
            // $familyPropertySection = FamilyProperty::where('beneficiary_id', $id)->first()->toArray();
            $familyPropertySection = DB::table('family_properties')->where('beneficiary_id', $id)->get()->toArray();
            $reasonSection = ActionReason::where('beneficiary_id', $id)->first()->toArray();

            if ($personalSection['Type'] == 'SPECIAL') {
                return view('admin.beneficiaryspecial', compact(['personalSection', 'academicSection', 'familySection', 'statementSection', 'siblingSection', 'emergencySection', 'familyPropertySection', 'reasonSection']));
            } elseif ($personalSection['Type'] == 'THEOLOGY') {
                return view('admin.beneficiarytheology', compact(['personalSection', 'academicSection', 'familySection', 'statementSection', 'siblingSection', 'emergencySection', 'familyPropertySection', 'reasonSection']));
            } else {
                return view('admin.beneficiary', compact(['personalSection', 'academicSection', 'familySection', 'statementSection', 'siblingSection', 'emergencySection', 'familyPropertySection', 'reasonSection']));
            }
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
        $data = DB::table('fee_sections')->where('fees_id', $id)->get();
        $fee = DB::table('fees')->where('id', $id)->first();
        $personalSection=null;
        // $fees = DB::table('fees')->where('id', $data->fees_id)->get();
        $personalSectionAux = Beneficiaryform::where('id', $fee->beneficiary_id)->first();
        if (!is_null($personalSectionAux)) {
            $personalSection = $personalSectionAux->toArray();
        }
        // dd($personalSection);

        return view('admin.beneficiaryfee', compact('data', 'id', 'personalSection'));
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
        return view('admin.beneficiarymentor', compact('data', 'id'));
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

        $activeYear = AcademicYear::where('status', true)->first();
        if (is_null($activeYear)) {
            // activity()->log("Beneficiary Approved:".$personalSection->firstname." ".$personalSection->lastname);
            alert('DANGER', 'Active Academic Year is Missing!!', 'danger')->autoClose(10000);
            return back();
        }

        $annualFee = Fees::where('beneficiary_id', $id)->where('year', $activeYear->year)->first();

        // dd($annualFee->yearlyfee);
        return view('admin.feeform', compact('id', 'annualFee', 'activeYear'));
    }

    public function postnewfee(Request $request)
    {
        $request->validate([
            'yearlyfee' => 'required'
        ]);
        $usr = Auth::user();

        $activeYear = AcademicYear::where('status', true)->first();
        $annualFee = Fees::where('beneficiary_id', $request->id)->where('year', $activeYear->year)->first();
        $annualFee->yearlyfeebal = $annualFee->yearlyfeebal - $request->amount;
        $annualFee->save();

        if ($request->term == 'term1') {
            FeeSection::updateOrCreate(
                [
                    'beneficiary_id' => $request->id,
                    'year' => $request->year
                ],
                [
                    'user_id' => $usr->id,
                    'term1' => $request->amount,

                    'fees_id' => $annualFee->id,
                    'yearlyfee' => $request->yearlyfee - $request->amount,
                ]
            );
        }
        if ($request->term == 'term2') {
            FeeSection::updateOrCreate(
                [
                    'beneficiary_id' => $request->id,
                    'year' => $request->year
                ],
                [
                    'user_id' => $usr->id,
                    'term2' => $request->amount,
                    'fees_id' => $annualFee->id,
                    'yearlyfee' => $request->yearlyfee - $request->amount,
                ]
            );
        }

        if ($request->term == 'term3') {
            FeeSection::updateOrCreate(
                [
                    'beneficiary_id' => $request->id,
                    'year' => $request->year
                ],
                [
                    'user_id' => $usr->id,
                    'term3' => $request->amount,
                    'fees_id' => $annualFee->id,
                    'yearlyfee' => $request->yearlyfee - $request->amount,
                ]
            );
        }

        // FeeSection::updateOrCreate(
        //     [
        //         'beneficiary_id' => $request->id,
        //         'year'=>$request->year
        //     ],
        //     [
        //         'user_id' => $usr->id,
        //         'term1' => $request->term,
        //         'term2' => $request->term,
        //         'term3' => $request->term,
        //         'amount' => $request->amount,
        //         'yearlyfee'=>$request->yearlyfee-$request->amount,
        //     ]
        // );

        // $activeYear = AcademicYear::where('status',true)->first();
        // $annualFee = Fees::where('beneficiary_id',$request->id)->where('year',$activeYear->year)->first();
        // $annualFee->yearlyfeebal=$annualFee->yearlyfeebal - $request->amount;
        // $annualFee->save();

        return back()->with('message', 'Posted Successfully');
    }

    public function viewfee($id)
    {
        $dis = FeeSection::where('id', $id)->first();
        $yearfee = Fees::where('beneficiary_id', $dis->beneficiary_id)->first();
        $expectedarr = Fees::where('beneficiary_id', $dis->beneficiary_id)->select('expectedterm1', 'expectedterm2', 'expectedterm3')->first()->toArray();
        $expectedfee = array_sum($expectedarr);
        $pendingfee = $expectedfee - $yearfee->AllocatedYealyFee;
        //    dd($pendingfee);
        return view('admin.feeview', compact('dis', 'yearfee', 'pendingfee'));
    }


    public function newuser()
    {
        //dis = FeeSection::where('id', $id)->first();
        return view('admin.newuser');
    }

    public function createnewuser(Request $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        return back()->with('message', 'User Created');
    }

    public function userlist()
    {
        $usrs = User::all();
        return view('admin.userlist', compact('usrs'));
    }

    public function academicyears()
    {
        $data = AcademicYear::get();
        return view('admin.academicyears', compact('data'));
    }

    public function academicyearview()
    {
        return view('admin.academicyearform');
    }
    public function academicyear(Request $request)
    {

        $request->validate([
            'year' => 'unique:academic_years'
        ]);
        activity()->log('Academic Year Added');

        AcademicYear::where('status', 1)->update(['status' => 0]);
        AcademicYear::create($request->all());
        return back()->withInput();
    }

    public function academicyeardata()
    {
        // $feeyear = Fees::select(['beneficiary_id', 'beneficiary','yearlyfee' ,'year']);
        return Datatables::of(Fees::query())->make(true);
    }


    public function yearlyfees()
    {
        $activeYear = AcademicYear::where('status', true)->first();
        return view('admin.yearlyfeelist', compact('activeYear'));
    }

    public function yearlyfeesdata()
    {
        /*$feeyear = ExpectedTermFee::join('beneficiaryforms', 'expected_term_fees.beneficiary_id', '=', 'beneficiaryforms.id')->whereNotNull('expected_term_fees.AllocatedYealyFee')->select(
            [
                'expected_term_fees.beneficiary_id', 'beneficiaryforms.lastname', 'beneficiaryforms.firstname', 'expected_term_fees.AllocatedYealyFee', 'expected_term_fees.year'
            ]
        );*/

        $feeyear = Fees::select(['id','beneficiary_id', 'beneficiary','expectedterm1','expectedterm2','expectedterm3', 'AllocatedYealyFee', 'year']);
        // :select(['id', 'beneficiary_id', 'beneficiary', 'yearlyfee', 'year']);

        return Datatables::of($feeyear)
            ->addColumn('action', function ($feeyear) {
                return '
                
                <a href="/admin/beneficiary/fee/' . $feeyear->id . '" class="btn btn-md btn-info"><small>View</small></a>
                ';
            })
            // <a href="/admin/delete/yearlyfee/' . $feeyear->id . '" class="btn btn-sm btn-danger" onclick="return confirm("Are you sure want to Archive?")"><small>Delete</small></a>
            //<a href="/admin/view/yearlyfee/'.$feeyear->id.'" class="btn btn-xs btn-primary">Edit</a> 
            // ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function createyearlyfees()
    {
        $data = Beneficiaryform::select(['id', 'firstname', 'lastname'])->get();
        return view('admin.yearlyfeeform', compact('data'));
    }

    public function postyearlyfees(Request $request)
    {
        $valid = $request->validate([
            'beneficiary_id' => 'required',
            'yearlyfee' => ['required', 'numeric'],
            'year' => 'required'
        ]);

        //Check year is available and valid
        $academicYear = AcademicYear::where('year', $valid['year'])->where('status', true)->get()->count();
        if ($academicYear == 1) {
            $data = Beneficiaryform::where('id', $request->beneficiary_id)->first();
            $name = $data->firstname . " " . $data->lastname;

            Fees::updateOrCreate(
                ['beneficiary_id' => $request->beneficiary_id, 'year' => $request->year],
                [
                    'beneficiary' => $name, 'yearlyfee' => $request->yearlyfee,
                    'yearlyfeebal' => $request->yearlyfee, 'school' => $data->SecondaryAdmitted,
                    'expectedterm1' => $request->expectedterm1, 'expectedterm2' => $request->expectedterm2, 'expectedterm3' => $request->expectedterm3,
                ]
            );

            activity()->log("Yearly Fee added");
            alert('SUCCESS', 'Fees Added', 'success')->autoClose(10000);
            return back();
        } else {
            activity()->log("Academic Year Missing/Closed");
            alert('ERROR', 'Academic Year Missing/Closed', 'error')->autoClose(10000);
            return back();
            // return back()->with('errfee', 'Academic Year Missing/Closed');
        }
    }

    public function viewyearlyfees()
    {
        return back();
    }

    public function deleteyearlyfees($id)
    {
        Fees::where('id', $id)->delete();
        activity()->log("Yearly Fee Deleted");
        return back()->with('delfee', 'Record Deleted');
    }

    public function downloadyearlyfees($id = null)
    {
        return Excel::download(new FeeExport, 'fees-collection.xlsx');

        // Fees::where('id',$id)->delete();
        // activity()->log("Yearly Fee Deleted");
        // return back()->with('delfee','Record Deleted');
    }

    public function importyearlyfees()
    {
        $academicYear = AcademicYear::where('status', 1)->first();
        return view('admin.importyearlyfeeform', compact('academicYear'));
    }

    public function fileImport(Request $request)
    {
        // $academicYear = AcademicYear::where('status',1)->where('year',$request->y)->first();

        Excel::import(new AnnualFeeImport, $request->file('yearlydata')->store('temp'));
        activity()->log("Yearly Fee Uploaded");
        alert('IMPORTED', 'File Uploaded', 'success')->autoClose(10000);
        return back();
    }


    public function schoolreport($id)
    {
        //check if highschool or tertiary
        $schoolreport = SchoolReportHeader::where('beneficiary_id', $id)->get();
        return view('admin.schoolreportheader', compact('schoolreport', 'id'));
    }

    public function newschoolreport($id)
    {
        //check whether its collega or high school
        $beneficialLevel = Beneficiaryform::where('id', $id)->first()->Type;
        if ($beneficialLevel == 'TERTIARY') {
            return view('admin.tertiaryschoolreportheadernew', compact('id'));
        } elseif ($beneficialLevel == 'THEOLOGY') {
            return view('admin.tertiaryschoolreportheadernew', compact('id'));
        } elseif ($beneficialLevel == 'SPECIAL') {
            return view('admin.tertiaryschoolreportheadernew', compact('id'));
        } else {
            return view('admin.schoolreportheadernew', compact('id'));
        }
    }



    public function postschoolreport(Request $request)
    {
        $data = $request->all();
        $reportHeader = SchoolReportHeader::where('year', $request->year)->where('beneficiary_id', $request->id,)->where('term', $request->term)->where('form', $request->form)->first();
        if ($reportHeader != null) {
            $reportHeader->beneficiary_id = $request->id;
            $reportHeader->year = $request->year;
            $reportHeader->form = $request->form;
            $reportHeader->term = $request->term;
            $reportHeader->meangrade = $request->meangrade;
            $reportHeader->save();

            AcademicInfo::where('beneficiary_id', $request->id)->where('schoolreportheader_id', $reportHeader->id)->delete();
            foreach ($data['Subject1'] as $key => $value) {
                AcademicInfo::create(['beneficiary_id' => $request->id, 'schoolreportheader_id' => $reportHeader->id, 'Subject1' => $value, 'Grade' => $data['Marks1'][$key], 'TotalMarks' =>  $request->meangrade]);
            }

            $request->validate([
                'file' => 'mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:2048'
                // 'file' => 'required|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:2048'
            ]);
            SchoolSlip::where('schoolreportheader_id', $reportHeader->id)->delete();
            $fileModel = new SchoolSlip;
            if ($request->file()) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads/schoolslip', $fileName, 'public');
                $fileModel->name = $request->file->getClientOriginalName();
                $fileModel->filename = time() . '_' . $request->file->getClientOriginalName();
                $fileModel->path = $filePath;
                $fileModel->schoolreportheader_id =  $reportHeader->id;
                $fileModel->beneficiary_id =  $request->id;
                // $fileModel->file_path = '/storage/' . $filePath;

                $fileModel->save();
            }

            activity()->log("Result Slip Updated For: " . $request->id);
            alert('UPDATED', 'School Report Update was a Success', 'success')->autoClose(10000);
            return back();
        } else {
            $resp = SchoolReportHeader::create(['beneficiary_id' => $request->id, 'form' => $request->form, 'year' => $request->year, 'term' =>  $request->term, 'meangrade' => $request->meangrade]);

            if ($resp->id) {
                foreach ($data['Subject1'] as $key => $value) {
                    AcademicInfo::create(['beneficiary_id' => $request->id, 'schoolreportheader_id' => $resp->id, 'Subject1' => $value, 'Grade' => $data['Marks1'][$key], 'TotalMarks' =>  $request->meangrade]);
                }
            }

            $request->validate([
                'file' => 'mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:2048'
                // 'file' => 'required|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:2048'
            ]);
            $fileModel = new SchoolSlip;
            if ($request->file()) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads/schoolslip', $fileName, 'public');
                $fileModel->name = $request->file->getClientOriginalName();
                $fileModel->filename = time() . '_' . $request->file->getClientOriginalName();
                $fileModel->path = $filePath;
                $fileModel->schoolreportheader_id =  $resp->id;
                $fileModel->beneficiary_id =  $resp->beneficiary_id;
                // $fileModel->file_path = '/storage/' . $filePath;

                $fileModel->save();
            }

            activity()->log("Result Slip Added For: " . $request->id);
            alert('UPLOAD', 'School Report Upload was a Success', 'success')->autoClose(10000);
            return back();
        }
    }

    public function viewschoolreport($id)
    {
        $reporthead = SchoolReportHeader::where('id', $id)->first();

        $reportlist = AcademicInfo::where('schoolreportheader_id', $reporthead->id)->get()->toArray();
        return view('admin.schoolreportheaderview', compact('reporthead', 'reportlist'));
    }

    public function viewschoolslip($id)
    {
        $path = SchoolSlip::where('schoolreportheader_id', $id)->first()->path;
        return response()->download(storage_path('app/public/' . $path));
    }

    public function additionalinfo($id)
    {
        $commData = Communication::where('beneficiary_id', $id)->first();
        $schoolData = SchoolInfo::where('beneficiary_id', $id)->get();
        $transferData = TransferHistory::where('beneficiary_id', $id)->get();
        return view('admin.additionalinfo.index', compact('id', 'commData', 'schoolData', 'transferData'));
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
        return view('admin.additionalinfo.newschoolinfoform', compact('id'));
    }

    public function getschoolinfo($id)
    {
        $schrec = SchoolInfo::where('id', $id)->first();
        return view('admin.additionalinfo.editschoolinfoform', compact('schrec'));
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
        return view('admin.additionalinfo.newtransfer', compact('id', 'schoolList'));
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
        return view('admin.additionalinfo.edittransfer', compact('schrec', 'id'));
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


        /**
     * Show the form for ongoingbeneficiary.
     *
     * @return \Illuminate\Http\Response
     */
    public function ongoingbeneficiary()
    {
        $activeYear = AcademicYear::where('status', 1)->first();
        if (is_null($activeYear)) {
            activity()->log('Active Year is Null');
            toast('Active Year is Required !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        $continuing = Fees::join('beneficiaryforms','fees.beneficiary_id','=','beneficiaryforms.id')->where('fees.year',$activeYear->year)->where('fees.AllocatedYealyFee',0)->where('beneficiaryforms.AdminStatus','APPROVED')->get();
        
        return view('admin.continuingbeneficiaries',compact('continuing'));

    }

    public function ongoingbeneficiaryexcel()
    {
        return Excel::download(new Ongoingbeneficiary,'beneficiary-' . date('h.i.s.a') . '.xlsx');
    }

    public function ongoingfeeview($id)
    {
        $activeYear = AcademicYear::where('status', 1)->first();
        $beneficiary = Fees::where('beneficiary_id',$id)->where('year',$activeYear->year)->first();

        $feestructure = SupportingDoc::all()->filter(function ($value) {
            $today = Carbon::now();
            return $value->type == "FEES" && $value->created_at->year === $today->year; // assuming, that your timestamp gets converted to a Carbon object.
        })->where('beneficiary_id',$id);

        return view('admin.continuingfees',compact('activeYear','beneficiary','id','feestructure'));
    }

    
    public function postongoingfeeview(Request $request)
    {
        $request->validate([
            'AllocatedYealyFee'=>'required'
        ]);
        $activeYear = AcademicYear::where('status', 1)->first();
        $beneficiary = Beneficiaryform::where('id',$request->id)->first();

        Fees::updateOrCreate(
            ['beneficiary_id' =>$request->id, 'year' => $activeYear->year],
            [
                'AllocatedYealyFee' => $request->AllocatedYealyFee
            ]
        );
        //Fees::where('beneficiary_id',$request->id)->where('year','!=', $activeYear->year)->update(['status'=>0]);

        activity()->log('Beneficiary fee record creared:' . $request->firstname . " " . $request->lastname);
        alert('CREATED', 'Beneficiary fee Creation was a Success', 'success')->autoClose(10000);
        return back();
    }

    public function downloadsupportingdoc($id)
    {
        $path = SupportingDoc::where('id', $id)->first()->file_path;
        // dd(storage_path('app/public/'.$path));
        return response()->download(storage_path('app/public/' . $path));
    }
   
}
