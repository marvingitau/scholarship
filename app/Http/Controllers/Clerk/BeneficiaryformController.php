<?php

namespace App\Http\Controllers\Clerk;

use DateTime;
use Carbon\Carbon;
use App\Models\Admin\Fees;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\Clerk\Sibling;
use App\Models\Clerk\AcademicInfo;
use App\Models\Clerk\FamilyDetail;
use Illuminate\Support\Facades\DB;
use App\Models\Clerk\StatementNeed;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Clerk\FamilyProperty;
use App\Models\Clerk\Beneficiaryform;
use App\Models\Clerk\EmergencyContact;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreBeneficiaryformRequest;
use App\Http\Requests\UpdateBeneficiaryformRequest;

// use GuzzleHttp\Psr7\Request;

class BeneficiaryformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clerk.beneficiaryform');
    }

    public function tertiary()
    {
        return view('clerk.tertiallybeneficiaryform');
    }

    public function theology()
    {
        return view('clerk.theologybeneficiaryform');
    }

    public function special()
    {
        return view('clerk.specialbeneficiaryform');
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
        return view('clerk.applications', compact('data'));
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
     * @param  \App\Http\Requests\StoreBeneficiaryformRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Makes sure on completing the upload u forget the this session value
        //$request->session()->forget('name')

        //Check whether father mother or guardian emails are available
        if (is_null($request->FatherMobile) && is_null($request->MotherMobile) && is_null($request->GuardianMobile)) {
            // $request->validate(
            //     [
            //         'FatherMobile' => ['required', 'unique:beneficiaryforms'],
            //         'MotherMobile' => ['required', 'unique:beneficiaryforms'],
            //         'GuardianMobile' => ['required', 'unique:beneficiaryforms'],
            //     ]
            // );

            // Session('message','One valid phone number is required');
            return back()->withInput();
        }

        $activeNo = ($request->FatherMobile != null) ? $request->FatherMobile : (($request->MotherMobile != null) ? $request->MotherMobile : ($request->GuardianMobile));

        $data = $request->all();

        $benObj = Beneficiaryform::where('MobileActive', $data['FatherMobile'])->orWhere('MobileActive', $data['MotherMobile'])->orWhere('MobileActive', $data['GuardianMobile'])->first();



        // dd($benObj);
        if ($benObj != null) {

            $bday = new DateTime($request->DOB);
            $today = new DateTime(date('y-m-d'));
            $dff = $today->diff($bday);

            $benObj->firstname = $request->firstname;
            $benObj->middlename = $request->middlename;
            $benObj->lastname = $request->lastname;
            $benObj->gender = $request->gender;
            $benObj->age = $dff->y;
            $benObj->DOB = $request->DOB;
            $benObj->KCPEIndex = $request->KCPEIndex;
            $benObj->SecondaryAdmitted = $request->SecondaryAdmitted;
            $benObj->CurrentForm = $request->CurrentForm;
            $benObj->FormJoining = $request->FormJoining;
            $benObj->CurrentAddress = $request->CurrentAddress;
            $benObj->PoBox = $request->PoBox;
            $benObj->PostalCode = $request->PostalCode;
            $benObj->CityTown = $request->CityTown;
            $benObj->County = $request->County;
            // $benObj->TelephoneGuardian = $request->TelephoneGuardian;
            // $benObj->EmailGuardian = $request->EmailGuardian;
            $benObj->AnotherSponship = $request->AnotherSponship;
            $benObj->AnotherSponshipRemark = $request->AnotherSponshipRemark;
            $benObj->save();

            AcademicInfo::where('beneficiary_id', $benObj->id)->delete();
            foreach ($data['Subject1'] as $key => $value) {
                AcademicInfo::create(['beneficiary_id' => $benObj->id, 'Subject1' => $value, 'Marks1' => $data['Marks1'][$key], 'TotalMarks' => $data['TotalMarks']]);
            }


            $famDetails = FamilyDetail::where('beneficiary_id', $benObj->id)->first();
            $famDetails->Father = $request->Father;
            $famDetails->FatherID = $request->FatherID;
            $famDetails->FatherMobile = $request->FatherMobile;
            $famDetails->FatherOccupation = $request->FatherOccupation;
            $famDetails->Mother = $request->Mother;
            $famDetails->MotherID = $request->MotherID;
            $famDetails->MotherMobile = $request->MotherMobile;
            $famDetails->MotherOccupation = $request->MotherOccupation;
            $famDetails->Guardian = $request->Guardian;
            $famDetails->GuardianID = $request->GuardianID;
            $famDetails->GuardianMobile = $request->GuardianMobile;
            $famDetails->GuardianOccupation = $request->GuardianOccupation;


            // $famDetails->FatherAlive = $request->FatherAlive;
            // $famDetails->MotherAlive = $request->MotherAlive;
            // $famDetails->FatherAge = $request->FatherAge;
            // $famDetails->MotherAge = $request->MotherAge;
            // $famDetails->FatherOtherSourceIncome = $request->FatherOtherSourceIncome;
            // $famDetails->MotherOtherSourceIncome = $request->MotherOtherSourceIncome;
            // $famDetails->FatherTelephone = $request->FatherTelephone;
            // $famDetails->MotherTelephone = $request->MotherTelephone;
            // $famDetails->FatherEmail = $request->FatherEmail;
            // $famDetails->MotherEmail = $request->MotherEmail;
            // $famDetails->ActivePhoneNumber = $request->ActivePhoneNumber;
            // $famDetails->LiveWithName = $request->LiveWithName;
            // $famDetails->LiveWitRelation = $request->LiveWitRelation;

            $famDetails->save();

            $stateOfNeed = StatementNeed::where('beneficiary_id', $benObj->id)->first();
            $stateOfNeed->StatementofNeed = $request->StatementofNeed;
            $stateOfNeed->save();

            Sibling::where('beneficiary_id', $benObj->id)->delete();
            foreach ($data['SiblingName1'] as $key => $value) {
                Sibling::create(['beneficiary_id' => $benObj->id, 'SiblingName1' => $value, 'SiblingRelation1' => $data['SiblingRelation1'][$key], 'SiblingAge1' => $data['SiblingAge1'][$key], 'SiblingOccupation1' => $data['SiblingOccupation1'][$key]]);
            }


            $emergence = EmergencyContact::where('beneficiary_id', $benObj->id)->first();
            $emergence->EmergencyName = $request->EmergencyName;
            $emergence->EmergencyRelationship = $request->EmergencyRelationship;
            $emergence->EmergencyPhysicalAddress = $request->EmergencyPhysicalAddress;
            $emergence->EmergencyPoBox = $request->EmergencyPoBox;
            $emergence->EmergencyTelephone = $request->EmergencyTelephone;
            $emergence->EmergencyMobile = $request->EmergencyMobile;
            $emergence->EmergencyEmail = $request->EmergencyEmail;
            $emergence->save();


            // FamilyProperty::where('beneficiary_id', $benObj->id)->delete();
            // foreach ($data['Type1'] as $key => $value) {
            //     FamilyProperty::create(['beneficiary_id' => $benObj->id, 'Type1' => $value, 'Size1' => $data['Size1'][$key], 'Location1' => $data['Location1'][$key]]);
            // }


            Session::put('personal_status', 'Information updated!');
            return back()->withInput();
        } else {
            $request->validate(
                [
                    // 'TelephoneGuardian'=>['required'],
                    'AnotherSponship' => ['required'],
                    'gender' => ['required'],
                    // 'Marks1'=>['required'],
                    // 'Marks2'=>['required'],
                    // 'Marks3'=>['required'], 
                    // 'Marks4'=>['required'],
                    // 'Marks5'=>['required'],
                    // 'Marks6'=>['required'],
                    // 'ActivePhoneNumber'=>['required'],
                    // 'Marks6'=>['required'],
                    // 'EmailGuardian'=>['required', 'string', 'email', 'max:255','unique:beneficiaryforms']  //
                ]
            );

            $bday = new DateTime($request->DOB);
            $today = new DateTime(date('y-m-d'));
            $dff = $today->diff($bday);


            $resp = Beneficiaryform::create($data + ['MobileActive' => $activeNo, 'age' => $dff->y]);

            if ($resp->id) {
                Session::forget('personal_status');

                $academyInfo = collect([$data['Subject1'], $data['Marks1']]);
                AcademicInfo::where('beneficiary_id', $resp->id)->delete();

                foreach ($data['Subject1'] as $key => $value) {
                    AcademicInfo::create(['beneficiary_id' => $resp->id, 'Subject1' => $value, 'Marks1' => $data['Marks1'][$key], 'TotalMarks' => $data['TotalMarks']]);
                }
                FamilyDetail::create($data + ['beneficiary_id' => $resp->id]);
                StatementNeed::create($data + ['beneficiary_id' => $resp->id]);
                foreach ($data['SiblingName1'] as $key => $value) {
                    Sibling::create(['beneficiary_id' => $resp->id, 'SiblingName1' => $value, 'SiblingRelation1' => $data['SiblingRelation1'][$key], 'SiblingAge1' => $data['SiblingAge1'][$key], 'SiblingOccupation1' => $data['SiblingOccupation1'][$key]]);
                }

                EmergencyContact::create($data + ['beneficiary_id' => $resp->id]);

                // foreach ($data['Type1'] as $key => $value) {
                //     FamilyProperty::create(['beneficiary_id' => $resp->id, 'Type1' => $value, 'Size1' => $data['Size1'][$key], 'Location1' => $data['Location1'][$key]]);
                // }

                //Populate Annual Fee on approval
                $academicYear = AcademicYear::where('status',1)->first();
                $name = $request->firstname ." ".$request->lastname;
                Fees::updateOrCreate(['beneficiary_id' => $resp->id, 'year' => $academicYear->year], ['beneficiary' => $name, 'yearlyfee' => $request->SchoolFees, 'yearlyfeebal' => $request->SchoolFees, 'school' => $request->SecondaryAdmitted]);

                Session::put('personal_status', 'Information Uploaded!');
                return back()->withInput();
            } else {
                // Session::put('beneficiary_id',$resp->id);
                // Session::put('personal_status', 'Information uploaded!');
                return back()->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clerk\Beneficiaryform  $beneficiaryform
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiaryform $beneficiaryform)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clerk\Beneficiaryform  $beneficiaryform
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficiaryform $beneficiaryform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBeneficiaryformRequest  $request
     * @param  \App\Models\Clerk\Beneficiaryform  $beneficiaryform
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBeneficiaryformRequest $request, Beneficiaryform $beneficiaryform)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clerk\Beneficiaryform  $beneficiaryform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiaryform $beneficiaryform)
    {
        //
    }
}
