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
use App\Exports\Ongoingbeneficiary;
use App\Models\Admin\Communication;
use App\Models\Clerk\StatementNeed;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Clerk\FamilyProperty;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Clerk\Beneficiaryform;
use App\Models\Clerk\ExpectedTermFee;
use App\Models\Clerk\EmergencyContact;
use Illuminate\Support\Facades\Session;
use App\Exports\OngoingbeneficiaryClerk;
use App\Http\Requests\StoreBeneficiaryformRequest;
use App\Http\Requests\UpdateBeneficiaryformRequest;
use App\Models\Clerk\SupportingDoc;

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

        return view('clerk.applications', compact('data'));
    }


    public function editapplication($id)
    {
        $personalInfo = Beneficiaryform::where('id', $id)->first();
        $academicInfo = AcademicInfo::where('beneficiary_id', $id)->get();
        $famDetails = FamilyDetail::where('beneficiary_id', $id)->first();
        $siblingsDetails = Sibling::where('beneficiary_id', $id)->get();
        $stateOfNeed = StatementNeed::where('beneficiary_id', $id)->first();
        $emergence = EmergencyContact::where('beneficiary_id', $id)->first();
        $expectedfee = ExpectedTermFee::where('beneficiary_id', $id)->first();

        if ($personalInfo->Type == "THEOLOGY") {
            return view('clerk.edittheologybeneficiaryform', compact('id', 'personalInfo', 'academicInfo', 'famDetails', 'siblingsDetails', 'stateOfNeed', 'emergence', 'expectedfee'));
        } elseif ($personalInfo->Type == "TERTIARY") {
            return view('clerk.edittertiarybeneficiaryform', compact('id', 'personalInfo', 'academicInfo', 'famDetails', 'siblingsDetails', 'stateOfNeed', 'emergence', 'expectedfee'));
        } elseif ($personalInfo->Type == "SPECIAL") {
            return view('clerk.editspecialbeneficiaryform', compact('id', 'personalInfo', 'academicInfo', 'famDetails', 'siblingsDetails', 'stateOfNeed', 'emergence', 'expectedfee'));
        } else {

            return view('clerk.editbeneficiaryform', compact('id', 'personalInfo', 'academicInfo', 'famDetails', 'siblingsDetails', 'stateOfNeed', 'emergence', 'expectedfee'));
        }
    }

    public function updatetheologyform(Request $request)
    {
        $activeYear = AcademicYear::where('status', 1)->first();
        if (is_null($activeYear)) {
            activity()->log('Active Year is Null:' . $request->firstname . " " . $request->middlename);
            toast('Active Year is Required !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }
        //Check whether father mother or guardian emails are available
        if (is_null($request->MobileActive)) {
            toast('Active Phone Number is Required !!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            $request->validate(
                [
                    'MobileActive' => ['required', 'unique:beneficiaryforms'],
                ]
            );
            return back()->withInput();
        }

        $activeNo = ($request->MobileActive != null) ? $request->MobileActive : '';

        $data = $request->all();

        $benObj = Beneficiaryform::where('MobileActive', $data['MobileActive'])->where('firstname', $data['firstname'])->where('lastname', $data['lastname'])->first();



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
            $benObj->pastortelephone = $request->pastortelephone;
            $benObj->pastorname = $request->pastorname;
            $benObj->churchname = $request->churchname;
            $benObj->SchoolFees = $request->SchoolFees;
            // $benObj->TelephoneGuardian = $request->TelephoneGuardian;
            // $benObj->EmailGuardian = $request->EmailGuardian;
            $benObj->AnotherSponsorship = $request->AnotherSponsorship;
            $benObj->AnotherSponsorshipRemark = $request->AnotherSponsorshipRemark;
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
            $famDetails->SpouseName = $request->SpouseName;
            $famDetails->SpouseID = $request->SpouseID;
            $famDetails->SpouseMobile = $request->SpouseMobile;
            $famDetails->SpouseOccupation = $request->SpouseOccupation;
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
            ExpectedTermFee::updateOrCreate(
                ['beneficiary_id' => $benObj->id, 'year' => $activeYear->year],
                [
                    'TermOneFee' => $request->TermOneFee,
                    'TermTwoFee' => $request->TermTwoFee,
                    'TermThreeFee' => $request->TermThreeFee,
                    'beneficiary' => $request->lastname . " " . $request->firstname,
                ]
            );

            Fees::updateOrCreate(
                ['beneficiary_id' => $benObj->id, 'year' => $activeYear->year],
                [
                    'expectedterm1' => $request->TermOneFee,
                    'expectedterm2' => $request->TermTwoFee,
                    'expectedterm3' => $request->TermThreeFee,
                    'beneficiary' => $request->lastname . " " . $request->firstname,
                    'yearlyfee' => $benObj->SchoolFees,
                    'school' => $benObj->SecondaryAdmitted,
                ]
            );

            activity()->log('Beneficiary record updated:' . $request->firstname . " " . $request->middlename);
            alert('UPDATED', 'Beneficiary Update was a Success', 'success')->autoClose(10000);
            return back();
        } else {
            toast('Beneficiary Record not Found!!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back();
        }
    }

    public function updatespecialform(Request $request)
    {
        $activeYear = AcademicYear::where('status', 1)->first();
        if (is_null($activeYear)) {
            activity()->log('Active Year is Null');
            toast('Active Year is Required !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        //Check whether father mother or guardian emails are available
        if (is_null($request->FatherMobile) && is_null($request->MotherMobile) && is_null($request->GuardianMobile)) {

            toast('Father Mobile, Mother Mobile or Guardian Mobile is Required !!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        $activeNo = ($request->FatherMobile != null) ? $request->FatherMobile : (($request->MotherMobile != null) ? $request->MotherMobile : ($request->GuardianMobile));

        $data = $request->all();

        $benObj = Beneficiaryform::where('MobileActive', $data['FatherMobile'])->orWhere('MobileActive', $data['MotherMobile'])->orWhere('MobileActive', $data['GuardianMobile'])->where('firstname', $data['firstname'])->where('lastname', $data['lastname'])->first();



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

            $benObj->TypeofDisability = $request->TypeofDisability;
            $benObj->ExtentofDisability = $request->ExtentofDisability;
            // $benObj->TelephoneGuardian = $request->TelephoneGuardian;
            // $benObj->EmailActive = $request->EmailActive;

            $benObj->AnotherSponsorship = $request->AnotherSponsorship;
            $benObj->AnotherSponsorshipRemark = $request->AnotherSponsorshipRemark;
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


            ExpectedTermFee::updateOrCreate(
                ['beneficiary_id' => $benObj->id, 'year' => $activeYear->year],
                [
                    'TermOneFee' => $request->TermOneFee,
                    'TermTwoFee' => $request->TermTwoFee,
                    'TermThreeFee' => $request->TermThreeFee,
                    'beneficiary' => $request->lastname . " " . $request->firstname,
                ]
            );
            Fees::updateOrCreate(
                ['beneficiary_id' => $benObj->id, 'year' => $activeYear->year],
                [
                    'expectedterm1' => $request->TermOneFee,
                    'expectedterm2' => $request->TermTwoFee,
                    'expectedterm3' => $request->TermThreeFee,
                    'beneficiary' => $request->lastname . " " . $request->firstname,
                    'yearlyfee' => $benObj->SchoolFees,
                    'school' => $benObj->SecondaryAdmitted,
                ]
            );
            activity()->log('Beneficiary record updated:' . $request->firstname . " " . $request->middlename);
            alert('UPDATED', 'Beneficiary Update was a Success', 'success')->autoClose(10000);
            return back();
        } else {
            toast('Beneficiary Record not Found!!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back();
        }
    }

    public function updatetertiaryform(Request $request)
    {
        $activeYear = AcademicYear::where('status', 1)->first();
        if (is_null($activeYear)) {
            activity()->log('Active Year is Null:' . $request->firstname . " " . $request->middlename);
            toast('Active Year is Required !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        if (is_null($request->FatherMobile) && is_null($request->MotherMobile) && is_null($request->GuardianMobile)) {
            toast('Father Mobile, Mother Mobile or Guardian Mobile is Required !!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        $activeNo = ($request->FatherMobile != null) ? $request->FatherMobile : (($request->MotherMobile != null) ? $request->MotherMobile : ($request->GuardianMobile));

        $data = $request->all();

        $benObj = Beneficiaryform::where('MobileActive', $data['FatherMobile'])->orWhere('MobileActive', $data['MotherMobile'])->orWhere('MobileActive', $data['GuardianMobile'])->where('firstname', $data['firstname'])->where('lastname', $data['lastname'])->first();



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
            $benObj->EmailActive = $request->EmailActive;
            $benObj->KCPEIndex = $request->KCPEIndex;
            $benObj->SecondaryAdmitted = $request->SecondaryAdmitted;
            $benObj->SchoolFees = $request->SchoolFees;
            $benObj->CurrentForm = $request->CurrentForm;
            $benObj->FormJoining = $request->FormJoining;
            $benObj->CurrentAddress = $request->CurrentAddress;
            $benObj->PoBox = $request->PoBox;
            $benObj->PostalCode = $request->PostalCode;
            $benObj->CityTown = $request->CityTown;
            $benObj->County = $request->County;
            $benObj->churchname = $request->churchname;
            $benObj->pastorname = $request->pastorname;
            $benObj->pastortelephone = $request->pastortelephone;
            // $benObj->EmailGuardian = $request->EmailGuardian; 
            $benObj->AnotherSponsorship = $request->AnotherSponsorship;
            $benObj->AnotherSponsorshipRemark = $request->AnotherSponsorshipRemark;
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

            $communication = Communication::where('beneficiary_id', $benObj->id)->first();
            $communication->email = $activeNo;
            $communication->phone = $request->EmailActive;
            $communication->save();

            // FamilyProperty::where('beneficiary_id', $benObj->id)->delete();
            // foreach ($data['Type1'] as $key => $value) {
            //     FamilyProperty::create(['beneficiary_id' => $benObj->id, 'Type1' => $value, 'Size1' => $data['Size1'][$key], 'Location1' => $data['Location1'][$key]]);
            // }
            ExpectedTermFee::updateOrCreate(
                ['beneficiary_id' => $benObj->id, 'year' => $activeYear->year],
                [
                    'TermOneFee' => $request->TermOneFee,
                    'TermTwoFee' => $request->TermTwoFee,
                    'TermThreeFee' => $request->TermThreeFee,
                    'beneficiary' => $request->lastname . " " . $request->firstname,
                ]
            );
            Fees::updateOrCreate(
                ['beneficiary_id' => $benObj->id, 'year' => $activeYear->year],
                [
                    'expectedterm1' => $request->TermOneFee,
                    'expectedterm2' => $request->TermTwoFee,
                    'expectedterm3' => $request->TermThreeFee,
                    'beneficiary' => $request->lastname . " " . $request->firstname,
                    'yearlyfee' => $benObj->SchoolFees,
                    'school' => $benObj->SecondaryAdmitted,
                ]
            );

            activity()->log('Beneficiary record updated:' . $request->firstname . " " . $request->middlename);
            alert('UPDATED', 'Beneficiary Updated was a Success', 'success')->autoClose(10000);
            return back();
        } else {
            toast('Beneficiary Record not Found!!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back();
        }
    }

    public function updatehighschoolform(Request $request)
    {
        $activeYear = AcademicYear::where('status', 1)->first();
        if (is_null($activeYear)) {
            activity()->log('Active Year is Null:' . $request->firstname . " " . $request->middlename);
            toast('Active Year is Required !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        //Check whether father mother or guardian emails are available
        if (is_null($request->FatherMobile) && is_null($request->MotherMobile) && is_null($request->GuardianMobile)) {
            toast('Father Mobile, Mother Mobile or Guardian Mobile is Required !!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        $activeNo = ($request->FatherMobile != null) ? $request->FatherMobile : (($request->MotherMobile != null) ? $request->MotherMobile : ($request->GuardianMobile));
        $data = $request->all();
        $benObj = Beneficiaryform::where('MobileActive', $data['FatherMobile'])->orWhere('MobileActive', $data['MotherMobile'])->orWhere('MobileActive', $data['GuardianMobile'])->where('firstname', $data['firstname'])->where('lastname', $data['lastname'])->first();



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
            $benObj->EmailActive = $request->EmailActive;
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
            $benObj->AnotherSponsorship = $request->AnotherSponsorship;
            $benObj->AnotherSponsorshipRemark = $request->AnotherSponsorshipRemark;
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

            $communication = Communication::where('beneficiary_id', $benObj->id)->first();
            $communication->email = $activeNo;
            $communication->phone = $request->EmailActive;
            $communication->save();

            // FamilyProperty::where('beneficiary_id', $benObj->id)->delete();
            // foreach ($data['Type1'] as $key => $value) {
            //     FamilyProperty::create(['beneficiary_id' => $benObj->id, 'Type1' => $value, 'Size1' => $data['Size1'][$key], 'Location1' => $data['Location1'][$key]]);
            // }
            ExpectedTermFee::updateOrCreate(
                ['beneficiary_id' => $benObj->id, 'year' => $activeYear->year],
                [
                    'TermOneFee' => $request->TermOneFee,
                    'TermTwoFee' => $request->TermTwoFee,
                    'TermThreeFee' => $request->TermThreeFee,
                    'beneficiary' => $request->lastname . " " . $request->firstname,
                ]
            );
            Fees::updateOrCreate(
                ['beneficiary_id' => $benObj->id, 'year' => $activeYear->year],
                [
                    'expectedterm1' => $request->TermOneFee,
                    'expectedterm2' => $request->TermTwoFee,
                    'expectedterm3' => $request->TermThreeFee,
                    'beneficiary' => $request->lastname . " " . $request->firstname,
                    'yearlyfee' => $benObj->SchoolFees,
                    'school' => $benObj->SecondaryAdmitted,
                ]
            );
            activity()->log('Beneficiary record updated:' . $request->firstname . " " . $request->middlename);
            alert('UPDATED', 'Beneficiary Updated was a Success', 'success')->autoClose(10000);
            return back();
        } else {
            toast('Beneficiary Record not Found!!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBeneficiaryformRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check whether the documents are of expected standard
        $request->validate([
            'applicationformsoftcopy' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
            'schoolfeestructure' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
            'applicantpassport' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
        ]);

        //check existence of an active year
        $activeYear = AcademicYear::where('status', 1)->first();
        if (is_null($activeYear)) {
            activity()->log('Active Year is Null:' . $request->firstname . " " . $request->middlename);
            toast('Active Year is Required !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }
        //Check whether father mother or guardian emails are available
        if (is_null($request->FatherMobile) && is_null($request->MotherMobile) && is_null($request->GuardianMobile)) {
            toast('Father Mobile, Mother Mobile or Guardian Mobile is Required !!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        $activeNo = ($request->FatherMobile != null) ? $request->FatherMobile : (($request->MotherMobile != null) ? $request->MotherMobile : ($request->GuardianMobile));

        $phoneexists = Communication::where('phone', $activeNo)->count();
        if ($phoneexists) {
            activity()->log('Active Year is Null:' . $request->firstname . " " . $request->middlename);
            toast('Phone Number Already Exist !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }
        $data = $request->all();

        $benObj = Beneficiaryform::where('MobileActive', $data['FatherMobile'])->orWhere('MobileActive', $data['MotherMobile'])->orWhere('MobileActive', $data['GuardianMobile'])->where('firstname', $data['firstname'])->where('lastname', $data['lastname'])->first();



        // dd($benObj);
        //$benObj != null
        if (false) {

            $bday = new DateTime($request->DOB);
            $today = new DateTime(date('y-m-d'));
            $dff = $today->diff($bday);

            $benObj->firstname = $request->firstname;
            $benObj->middlename = $request->middlename;
            $benObj->lastname = $request->lastname;
            $benObj->gender = $request->gender;
            $benObj->age = $dff->y;
            $benObj->DOB = $request->DOB;
            $benObj->EmailActive = $request->EmailActive;
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
            // $benObj->EmailActive = $request->EmailActive;
            $benObj->AnotherSponsorship = $request->AnotherSponsorship;
            $benObj->AnotherSponsorshipRemark = $request->AnotherSponsorshipRemark;
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

            $communication = Communication::where('beneficiary_id', $benObj->id)->first();
            $communication->email = is_null($request->EmailActive) ? 'NA' : $request->EmailActive;
            $communication->phone =  $activeNo;
            $communication->save();

            // FamilyProperty::where('beneficiary_id', $benObj->id)->delete();
            // foreach ($data['Type1'] as $key => $value) {
            //     FamilyProperty::create(['beneficiary_id' => $benObj->id, 'Type1' => $value, 'Size1' => $data['Size1'][$key], 'Location1' => $data['Location1'][$key]]);
            // }

            if ($request->file()) {

                if(!is_null($request->applicationformsoftcopy)){
                    $fileName = time() . '_' . $request->applicationformsoftcopy->getClientOriginalName();
                    $filePath = $request->file('applicationformsoftcopy')->storeAs('uploads', $fileName, 'public');
                    SupportingDoc::updateOrCreate(
                        ['beneficiary_id' => $benObj->id, 'type' => 'FORM'],
                        [
                            'name' =>  $request->applicationformsoftcopy->getClientOriginalName(),
                            'name_unique' => time() . '_' . $request->applicationformsoftcopy->getClientOriginalName(),
                            'file_path' => $filePath,
                            
                        ]
                    );
                }
             
                if(!is_null($request->applicantpassport)){
                    $fileName2 = time() . '_' . $request->applicantpassport->getClientOriginalName();
                    $filePath2 = $request->file('applicantpassport')->storeAs('uploads', $fileName2, 'public');
                    SupportingDoc::updateOrCreate(
                        ['beneficiary_id' => $benObj->id, 'type' => 'PASSPORT'],
                        [
                            'name' =>  $request->applicantpassport->getClientOriginalName(),
                            'name_unique' => time() . '_' . $request->applicantpassport->getClientOriginalName(),
                            'file_path' => $filePath2,
                            
                        ]
                    );
                }
              
                if(!is_null($request->schoolfeestructure)){
                    $fileName3 = time() . '_' . $request->schoolfeestructure->getClientOriginalName();
                    $filePath3 = $request->file('schoolfeestructure')->storeAs('uploads', $fileName3, 'public');
                    SupportingDoc::updateOrCreate(
                        ['beneficiary_id' => $benObj->id, 'type' => 'FEES'],
                        [
                            'name' =>  $request->schoolfeestructure->getClientOriginalName(),
                            'name_unique' => time() . '_' . $request->schoolfeestructure->getClientOriginalName(),
                            'file_path' => $filePath3,
                            
                        ]
                    );
                }
                


            }

            activity()->log('Beneficiary record updated:' . $request->firstname . " " . $request->middlename);
            alert('UPDATED', 'Beneficiary Updated was a Success', 'success')->autoClose(10000);
            return back();
        } else {
            $request->validate(
                [
                    'email' => ['required', 'unique:communications'],
                    'AnotherSponsorship' => ['required'],
                    'gender' => ['required'],
                    // 'MobileActive' => ['required', 'unique:beneficiaryforms'],
                    'firstname' => ['required'],
                    'lastname' => ['required'],
                    'phone' => ['unique:communications'],
                    // 'EmailGuardian'=>['required', 'string', 'email', 'max:255','unique:beneficiaryforms']  //
                    'applicationformsoftcopy' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                    'schoolfeestructure' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                    'applicantpassport' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                ]
            );

            $bday = new DateTime($request->DOB);
            $today = new DateTime(date('y-m-d'));
            $dff = $today->diff($bday);


            $resp = Beneficiaryform::create($data + ['MobileActive' => $activeNo, 'age' => $dff->y, 'CreatedBy' => auth()->user()->id, 'EmailActive' => $request->email]);

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
                $academicYear = AcademicYear::where('status', 1)->first();
                $name = $request->firstname . " " . $request->lastname;
                // Fees::updateOrCreate(['beneficiary_id' => $resp->id, 'year' => $academicYear->year], ['beneficiary' => $name, 'yearlyfee' => $request->SchoolFees, 'yearlyfeebal' => $request->SchoolFees, 'school' => $request->SecondaryAdmitted]);

                Communication::create(['beneficiary_id' => $resp->id, 'phone' => $activeNo, 'email' => $request->email]);
                ExpectedTermFee::updateOrCreate(
                    ['beneficiary_id' => $resp->id, 'year' => $activeYear->year],
                    [
                        'TermOneFee' => $request->TermOneFee,
                        'TermTwoFee' => $request->TermTwoFee,
                        'TermThreeFee' => $request->TermThreeFee,
                        'beneficiary' => $request->lastname . " " . $request->firstname,
                    ]
                );
                Fees::updateOrCreate(
                    ['beneficiary_id' => $resp->id, 'year' => $activeYear->year],
                    [
                        'expectedterm1' => $request->TermOneFee,
                        'expectedterm2' => $request->TermTwoFee,
                        'expectedterm3' => $request->TermThreeFee,
                        'beneficiary' => $request->lastname . " " . $request->firstname,
                        'yearlyfee' => $resp->SchoolFees,
                        'school' => $resp->SecondaryAdmitted,
                    ]
                );

                if ($request->file()) {
                    if(!is_null($request->applicationformsoftcopy)){
                        $fileName = time() . '_' . $request->applicationformsoftcopy->getClientOriginalName();
                        $filePath = $request->file('applicationformsoftcopy')->storeAs('uploads', $fileName, 'public');
                        SupportingDoc::updateOrCreate(
                            ['beneficiary_id' => $resp->id, 'type' => 'FORM'],
                            [
                                'name' =>  $request->applicationformsoftcopy->getClientOriginalName(),
                                'name_unique' => time() . '_' . $request->applicationformsoftcopy->getClientOriginalName(),
                                'file_path' => $filePath,
                                
                            ]
                        );
                    }
                  
                    if(!is_null($request->applicantpassport)){
                        $fileName2 = time() . '_' . $request->applicantpassport->getClientOriginalName();
                        $filePath2 = $request->file('applicantpassport')->storeAs('uploads', $fileName2, 'public');
                        SupportingDoc::updateOrCreate(
                            ['beneficiary_id' => $resp->id, 'type' => 'PASSPORT'],
                            [
                                'name' =>  $request->applicantpassport->getClientOriginalName(),
                                'name_unique' => time() . '_' . $request->applicantpassport->getClientOriginalName(),
                                'file_path' => $filePath2,
                                
                            ]
                        );
                    }
                 
                    if(!is_null($request->schoolfeestructure)){
                        $fileName3 = time() . '_' . $request->schoolfeestructure->getClientOriginalName();
                        $filePath3 = $request->file('schoolfeestructure')->storeAs('uploads', $fileName3, 'public');
                        SupportingDoc::updateOrCreate(
                            ['beneficiary_id' => $resp->id, 'type' => 'FEES'],
                            [
                                'name' =>  $request->schoolfeestructure->getClientOriginalName(),
                                'name_unique' => time() . '_' . $request->schoolfeestructure->getClientOriginalName(),
                                'file_path' => $filePath3,
                                
                            ]
                        );
    
                    }
                   

                }


                activity()->log('Beneficiary record uploaded:' . $request->firstname . " " . $request->middlename);
                alert('UPLOAD', 'Beneficiary Uploaded was a Success', 'success')->autoClose(10000);
                return back();
            } else {

                activity()->log('Beneficiary record uploade failed:' . $request->firstname . " " . $request->middlename);
                alert('FAILED', 'Beneficiary Upload was a Failure', 'danger')->autoClose(10000);
                return back()->withInput();
            }
        }
    }

    public function storeSpecial(Request $request)
    {
            // check whether the documents are of expected standard
            $request->validate([
                'applicationformsoftcopy' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                'schoolfeestructure' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                'applicantpassport' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
            ]);
        //check existence of an active year
        $activeYear = AcademicYear::where('status', 1)->first();
        if (is_null($activeYear)) {
            activity()->log('Active Year is Null:' . $request->firstname . " " . $request->middlename);
            toast('Active Year is Required !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        //Check whether father mother or guardian emails are available
        if (is_null($request->FatherMobile) && is_null($request->MotherMobile) && is_null($request->GuardianMobile)) {

            toast('Father Mobile, Mother Mobile or Guardian Mobile is Required !!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        $activeNo = ($request->FatherMobile != null) ? $request->FatherMobile : (($request->MotherMobile != null) ? $request->MotherMobile : ($request->GuardianMobile));
        $phoneexists = Communication::where('phone', $activeNo)->count();
        if ($phoneexists) {
            activity()->log('Active Year is Null:' . $request->firstname . " " . $request->middlename);
            toast('Phone Number Already Exist !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }
        $data = $request->all();

        $benObj = Beneficiaryform::where('MobileActive', $data['FatherMobile'])->orWhere('MobileActive', $data['MotherMobile'])->orWhere('MobileActive', $data['GuardianMobile'])->where('firstname', $data['firstname'])->where('lastname', $data['lastname'])->first();



        // dd($benObj);
        if (false) {

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

            $benObj->TypeofDisability = $request->TypeofDisability;
            $benObj->ExtentofDisability = $request->ExtentofDisability;
            // $benObj->TelephoneGuardian = $request->TelephoneGuardian;
            // $benObj->EmailGuardian = $request->EmailGuardian;

            $benObj->AnotherSponsorship = $request->AnotherSponsorship;
            $benObj->AnotherSponsorshipRemark = $request->AnotherSponsorshipRemark;
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


            activity()->log('Beneficiary record updated:' . $request->firstname . " " . $request->middlename);
            alert('UPDATED', 'Beneficiary Update was a Success', 'success')->autoClose(10000);
            return back();
        } else {
            $request->validate(
                [
                    'DOB' => ['required'],
                    'AnotherSponsorship' => ['required'],
                    'gender' => ['required'],
                    // 'MobileActive' => ['required', 'unique:beneficiaryforms'],
                    'firstname' => ['required'],
                    'lastname' => ['required'],
                    // 'EmailGuardian'=>['required', 'string', 'email', 'max:255','unique:beneficiaryforms']  //
                    'applicationformsoftcopy' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                    'schoolfeestructure' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                    'applicantpassport' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                ]
            );

            $bday = new DateTime($request->DOB);
            $today = new DateTime(date('y-m-d'));
            $dff = $today->diff($bday);


            $resp = Beneficiaryform::create($data + ['MobileActive' => $activeNo, 'age' => $dff->y, 'CreatedBy' => auth()->user()->id]);

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

                //foreach ($data['Type1'] as $key => $value) {
                //     FamilyProperty::create(['beneficiary_id' => $resp->id, 'Type1' => $value, 'Size1' => $data['Size1'][$key], 'Location1' => $data['Location1'][$key]]);
                // }

                //Populate Annual Fee on approval
                /*$academicYear = AcademicYear::where('status',1)->first();
                $name = $request->firstname ." ".$request->lastname;
                 Fees::updateOrCreate(['beneficiary_id' => $resp->id, 'year' => $academicYear->year], ['beneficiary' => $name, 'yearlyfee' => $request->SchoolFees, 'yearlyfeebal' => $request->SchoolFees, 'school' => $request->SecondaryAdmitted]);*/

                ExpectedTermFee::updateOrCreate(
                    ['beneficiary_id' => $resp->id, 'year' => $activeYear->year],
                    [
                        'TermOneFee' => $request->TermOneFee,
                        'TermTwoFee' => $request->TermTwoFee,
                        'TermThreeFee' => $request->TermThreeFee,
                        'beneficiary' => $request->lastname . " " . $request->firstname,
                    ]
                );
                Fees::updateOrCreate(
                    ['beneficiary_id' => $resp->id, 'year' => $activeYear->year],
                    [
                        'expectedterm1' => $request->TermOneFee,
                        'expectedterm2' => $request->TermTwoFee,
                        'expectedterm3' => $request->TermThreeFee,
                        'beneficiary' => $request->lastname . " " . $request->firstname,
                        'yearlyfee' => $resp->SchoolFees,
                        'school' => $resp->SecondaryAdmitted,
                    ]
                );

                if ($request->file()) {
                    if(!is_null($request->applicationformsoftcopy)){
                        $fileName = time() . '_' . $request->applicationformsoftcopy->getClientOriginalName();
                        $filePath = $request->file('applicationformsoftcopy')->storeAs('uploads', $fileName, 'public');
                        SupportingDoc::updateOrCreate(
                            ['beneficiary_id' => $resp->id, 'type' => 'FORM'],
                            [
                                'name' =>  $request->applicationformsoftcopy->getClientOriginalName(),
                                'name_unique' => time() . '_' . $request->applicationformsoftcopy->getClientOriginalName(),
                                'file_path' => $filePath,
                                
                            ]
                        );
                    }
                  
                    if(!is_null($request->applicantpassport)){
                        $fileName2 = time() . '_' . $request->applicantpassport->getClientOriginalName();
                        $filePath2 = $request->file('applicantpassport')->storeAs('uploads', $fileName2, 'public');
                        SupportingDoc::updateOrCreate(
                            ['beneficiary_id' => $resp->id, 'type' => 'PASSPORT'],
                            [
                                'name' =>  $request->applicantpassport->getClientOriginalName(),
                                'name_unique' => time() . '_' . $request->applicantpassport->getClientOriginalName(),
                                'file_path' => $filePath2,
                                
                            ]
                        );
                    }
                 
                    if(!is_null($request->schoolfeestructure)){
                        $fileName3 = time() . '_' . $request->schoolfeestructure->getClientOriginalName();
                        $filePath3 = $request->file('schoolfeestructure')->storeAs('uploads', $fileName3, 'public');
                        SupportingDoc::updateOrCreate(
                            ['beneficiary_id' => $resp->id, 'type' => 'FEES'],
                            [
                                'name' =>  $request->schoolfeestructure->getClientOriginalName(),
                                'name_unique' => time() . '_' . $request->schoolfeestructure->getClientOriginalName(),
                                'file_path' => $filePath3,
                                
                            ]
                        );
    
                    }
                   

                }

                activity()->log('Beneficiary record uploaded:' . $request->firstname . " " . $request->middlename);
                alert('UPLOAD', 'Beneficiary Upload was a Success', 'success')->autoClose(10000);
                return back();
            } else {
                activity()->log('Beneficiary record upload failed:' . $request->firstname . " " . $request->middlename);
                alert('FAILED', 'Beneficiary Upload was a Failure', 'danger')->autoClose(10000);
                return back()->withInput();
            }
        }
    }

    public function storeTheology(Request $request)
    {
            // check whether the documents are of expected standard
            $request->validate([
                'applicationformsoftcopy' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                'schoolfeestructure' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                'applicantpassport' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
            ]);
        //check existence of an active year
        $activeYear = AcademicYear::where('status', 1)->first();
        if (is_null($activeYear)) {
            activity()->log('Active Year is Null:' . $request->firstname . " " . $request->middlename);
            toast('Active Year is Required !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }

        //Check whether father mother or guardian emails are available
        if (is_null($request->MobileActive)) {
            toast('Active Phone Number is Required !!', 'warning')->timerProgressBar()->autoClose(30000)->showCloseButton();
            $request->validate(
                [
                    'MobileActive' => ['required', 'unique:beneficiaryforms'],
                ]
            );
            return back()->withInput();
        }

        $activeNo = ($request->MobileActive != null) ? $request->MobileActive : '';
        $phoneexists = Communication::where('phone', $activeNo)->count();
        if ($phoneexists) {
            activity()->log('Active Year is Null:' . $request->firstname . " " . $request->middlename);
            toast('Phone Number Already Exist !!', 'error')->timerProgressBar()->autoClose(30000)->showCloseButton();
            return back()->withInput();
        }
        $data = $request->all();

        $benObj = Beneficiaryform::where('MobileActive', $data['MobileActive'])->where('firstname', $data['firstname'])->where('lastname', $data['lastname'])->first();



        // dd($benObj);
        if (false) {

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
            $benObj->AnotherSponsorship = $request->AnotherSponsorship;
            $benObj->AnotherSponsorshipRemark = $request->AnotherSponsorshipRemark;
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
            $famDetails->SpouseName = $request->SpouseName;
            $famDetails->SpouseID = $request->SpouseID;
            $famDetails->SpouseMobile = $request->SpouseMobile;
            $famDetails->SpouseOccupation = $request->SpouseOccupation;


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


            activity()->log('Beneficiary record updated:' . $request->firstname . " " . $request->middlename);
            alert('UPDATED', 'Beneficiary Update was a Success', 'success')->autoClose(10000);
            return back();
        } else {
            $request->validate(
                [
                    // 'TelephoneGuardian'=>['required'],
                    'AnotherSponsorship' => ['required'],
                    'gender' => ['required'],
                    'MobileActive' => ['required', 'unique:beneficiaryforms'],
                    'firstname' => ['required'],
                    'lastname' => ['required'],
                    // 'Marks4'=>['required'],
                    // 'Marks5'=>['required'],
                    // 'Marks6'=>['required'],
                    // 'ActivePhoneNumber'=>['required'],
                    // 'Marks6'=>['required'],
                    // 'EmailGuardian'=>['required', 'string', 'email', 'max:255','unique:beneficiaryforms']  //
                    'applicationformsoftcopy' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                    'schoolfeestructure' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                    'applicantpassport' => 'nullable|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:5048',
                ]
            );

            $bday = new DateTime($request->DOB);
            $today = new DateTime(date('y-m-d'));
            $dff = $today->diff($bday);


            $resp = Beneficiaryform::create($data + ['MobileActive' => $activeNo, 'age' => $dff->y, 'CreatedBy' => auth()->user()->id]);

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
                // $academicYear = AcademicYear::where('status', 1)->first();
                // $name = $request->firstname . " " . $request->lastname;
                // Fees::updateOrCreate(['beneficiary_id' => $resp->id, 'year' => $academicYear->year], ['beneficiary' => $name, 'yearlyfee' => $request->SchoolFees, 'yearlyfeebal' => $request->SchoolFees, 'school' => $request->SecondaryAdmitted]);

                ExpectedTermFee::updateOrCreate(
                    ['beneficiary_id' => $resp->id, 'year' => $activeYear->year],
                    [
                        'TermOneFee' => $request->TermOneFee,
                        'TermTwoFee' => $request->TermTwoFee,
                        'TermThreeFee' => $request->TermThreeFee,
                        'beneficiary' => $request->lastname . " " . $request->firstname,
                    ]
                );

                Fees::updateOrCreate(
                    ['beneficiary_id' => $resp->id, 'year' => $activeYear->year],
                    [
                        'expectedterm1' => $request->TermOneFee,
                        'expectedterm2' => $request->TermTwoFee,
                        'expectedterm3' => $request->TermThreeFee,
                        'beneficiary' => $request->lastname . " " . $request->firstname,
                        'yearlyfee' => $resp->SchoolFees,
                        'school' => $resp->SecondaryAdmitted,
                    ]
                );

                if ($request->file()) {
                    if(!is_null($request->applicationformsoftcopy)){
                        $fileName = time() . '_' . $request->applicationformsoftcopy->getClientOriginalName();
                        $filePath = $request->file('applicationformsoftcopy')->storeAs('uploads', $fileName, 'public');
                        SupportingDoc::updateOrCreate(
                            ['beneficiary_id' => $resp->id, 'type' => 'FORM'],
                            [
                                'name' =>  $request->applicationformsoftcopy->getClientOriginalName(),
                                'name_unique' => time() . '_' . $request->applicationformsoftcopy->getClientOriginalName(),
                                'file_path' => $filePath,
                                
                            ]
                        );
                    }
                  
                    if(!is_null($request->applicantpassport)){
                        $fileName2 = time() . '_' . $request->applicantpassport->getClientOriginalName();
                        $filePath2 = $request->file('applicantpassport')->storeAs('uploads', $fileName2, 'public');
                        SupportingDoc::updateOrCreate(
                            ['beneficiary_id' => $resp->id, 'type' => 'PASSPORT'],
                            [
                                'name' =>  $request->applicantpassport->getClientOriginalName(),
                                'name_unique' => time() . '_' . $request->applicantpassport->getClientOriginalName(),
                                'file_path' => $filePath2,
                                
                            ]
                        );
                    }
                 
                    if(!is_null($request->schoolfeestructure)){
                        $fileName3 = time() . '_' . $request->schoolfeestructure->getClientOriginalName();
                        $filePath3 = $request->file('schoolfeestructure')->storeAs('uploads', $fileName3, 'public');
                        SupportingDoc::updateOrCreate(
                            ['beneficiary_id' => $resp->id, 'type' => 'FEES'],
                            [
                                'name' =>  $request->schoolfeestructure->getClientOriginalName(),
                                'name_unique' => time() . '_' . $request->schoolfeestructure->getClientOriginalName(),
                                'file_path' => $filePath3,
                                
                            ]
                        );
    
                    }
                   

                }
                
                activity()->log('Beneficiary record uploaded:' . $request->firstname . " " . $request->middlename);
                alert('UPLOAD', 'Beneficiary Upload was a Success', 'success')->autoClose(10000);
                return back();
            } else {
                activity()->log('Beneficiary record upload failed:' . $request->firstname . " " . $request->middlename);
                alert('FAILED', 'Beneficiary Upload was a Failure', 'danger')->autoClose(10000);
                return back()->withInput();
            }
        }
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

        $continuing = Fees::join('beneficiaryforms', 'fees.beneficiary_id', '=', 'beneficiaryforms.id')->where('fees.year', '!=', $activeYear->year)->where('fees.status', 1)->get();
        return view('clerk.continuingbeneficiaries', compact('continuing'));
    }

    public function ongoingbeneficiaryexcel()
    {
        return Excel::download(new OngoingbeneficiaryClerk, 'beneficiary-' . date('h.i.s.a') . '.xlsx');
    }

    public function ongoingfeeview($id)
    {
        $activeYear = AcademicYear::where('status', 1)->first();
        $beneficiary = Fees::where('beneficiary_id', $id)->first();

        SupportingDoc::all()->filter(function ($value) {
            $today = Carbon::now();
            return $value->created_at->year === $today->year; // assuming, that your timestamp gets converted to a Carbon object.
        })->where('beneficiary_id', $id);
        return view('clerk.continuingfees', compact('activeYear', 'beneficiary', 'id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clerk\Beneficiaryform  $beneficiaryform
     * @return \Illuminate\Http\Response
     */
    public function postongoingfeeview(Request $request)
    {
        $request->validate([
            'ExpectedTermOne' => 'required',
            'schoolfeestructure' => 'mimes:jpeg,png,jpg,csv,txt,xlx,xls,docx,pdf|max:5048',
        ]);
        $activeYear = AcademicYear::where('status', 1)->first();
        $beneficiary = Beneficiaryform::where('id', $request->id)->first();

        Fees::updateOrCreate(
            ['beneficiary_id' => $request->id, 'year' => $activeYear->year],
            [
                'expectedterm1' => $request->ExpectedTermOne,
                'expectedterm2' => $request->ExpectedTermTwo,
                'expectedterm3' => $request->ExpectedTermThree,
                'beneficiary' => $beneficiary->lastname . " " . $beneficiary->firstname,
                'yearlyfee' => $request->ExpectedYearly,
                'school' => $beneficiary->SecondaryAdmitted,
                'status' => 1, //Active Fee record
            ]
        );
        Fees::where('beneficiary_id', $request->id)->where('year', '!=', $activeYear->year)->update(['status' => 0]);

        if ($request->file()) {
            if(!is_null($request->schoolfeestructure)){
                $fileName3 = time() . '_' . $request->schoolfeestructure->getClientOriginalName();
                $filePath3 = $request->file('schoolfeestructure')->storeAs('uploads', $fileName3, 'public');
                SupportingDoc::updateOrCreate(
                    ['beneficiary_id' => $request->id, 'type' => 'FEES'],
                    [
                        'name' =>  $request->schoolfeestructure->getClientOriginalName(),
                        'name_unique' => time() . '_' . $request->schoolfeestructure->getClientOriginalName(),
                        'file_path' => $filePath3,
                        
                    ]
                );

            }
           

        }

        activity()->log('Beneficiary fee record creared:' . $request->firstname . " " . $request->lastname);
        alert('CREATED', 'Beneficiary fee Creation was a Success', 'success')->autoClose(10000);
        return back();
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
