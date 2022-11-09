<?php

namespace App\Http\Controllers\Clerk;

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

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applicationlist()
    {
        $data = DB::table('beneficiaryforms')->where('ClerkStatus','OPEN')->where('AdminStatus','PENDING')->get()->toArray();
        // dd($data);
        return view('clerk.applications',compact('data'));
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
   
        
        $data = $request->all();
        $benObj = Beneficiaryform::where('EmailGuardian',$data['EmailGuardian'])->first();
        // dd($benObj);
        if($benObj != null){

            $benObj->firstname=$request->firstname;
            $benObj->middlename=$request->middlename;
            $benObj->lastname=$request->lastname;
            $benObj->gender=$request->gender;
            $benObj->age=$request->age;
            $benObj->DOB=$request->DOB;
            $benObj->KCPEIndex=$request->KCPEIndex;
            $benObj->SecondaryAdmitted=$request->SecondaryAdmitted;
            $benObj->CurrentForm=$request->CurrentForm;
            $benObj->FormJoining=$request->FormJoining;
            $benObj->CurrentAddress=$request->CurrentAddress;
            $benObj->PoBox=$request->PoBox;
            $benObj->PostalCode=$request->PostalCode;
            $benObj->CityTown=$request->CityTown;
            $benObj->County=$request->County;
            $benObj->TelephoneGuardian=$request->TelephoneGuardian;
            $benObj->EmailGuardian=$request->EmailGuardian;
            $benObj->AnotherSponship=$request->AnotherSponship;
            $benObj->AnotherSponshipRemark=$request->AnotherSponshipRemark;
            $benObj->save();

            $rec = AcademicInfo::where('beneficiary_id', $benObj->id)->first();
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

            $famDetails = FamilyDetail::where('beneficiary_id', $benObj->id)->first();
            $famDetails->Father=$request->Father;
            $famDetails->Mother=$request->Mother;
            $famDetails->FatherAlive=$request->FatherAlive;
            $famDetails->MotherAlive=$request->MotherAlive;
            $famDetails->FatherAge=$request->FatherAge;
            $famDetails->MotherAge=$request->MotherAge;
            $famDetails->FatherID=$request->FatherID;
            $famDetails->MotherID=$request->MotherID;
            $famDetails->FatherOccupation=$request->FatherOccupation;
            $famDetails->MotherOccupation=$request->MotherOccupation;
            $famDetails->FatherOtherSourceIncome=$request->FatherOtherSourceIncome;
            $famDetails->MotherOtherSourceIncome=$request->MotherOtherSourceIncome;
            $famDetails->FatherMobile=$request->FatherMobile;
            $famDetails->MotherMobile=$request->MotherMobile;
            $famDetails->FatherTelephone=$request->FatherTelephone;
            $famDetails->MotherTelephone=$request->MotherTelephone;
            $famDetails->FatherEmail=$request->FatherEmail;
            $famDetails->MotherEmail=$request->MotherEmail;
            $famDetails->ActivePhoneNumber=$request->ActivePhoneNumber;
            $famDetails->LiveWithName=$request->LiveWithName;
            $famDetails->LiveWitRelation=$request->LiveWitRelation;
            $famDetails->save();

            $stateOfNeed = StatementNeed::where('beneficiary_id', $benObj->id)->first();
            $stateOfNeed->StatementofNeed =$request->StatementofNeed;
            $stateOfNeed->save();

            $siblingData = Sibling::where('beneficiary_id', $benObj->id)->first();
            $siblingData->SiblingName1=$request->SiblingName1;
            $siblingData->SiblingRelation1=$request->SiblingRelation1;
            $siblingData->SiblingAge1=$request->SiblingAge1;
            $siblingData->SiblingOccupation1=$request->SiblingOccupation1;
            $siblingData->SiblingMobile1=$request->SiblingMobile1;

            $siblingData->SiblingName2=$request->SiblingName2;
            $siblingData->SiblingRelation2=$request->SiblingRelation2;
            $siblingData->SiblingAge2=$request->SiblingAge2;
            $siblingData->SiblingOccupation2=$request->SiblingOccupation2;
            $siblingData->SiblingMobile2=$request->SiblingMobile2;

            $siblingData->SiblingName3=$request->SiblingName3;
            $siblingData->SiblingRelation3=$request->SiblingRelation3;
            $siblingData->SiblingAge3=$request->SiblingAge3;
            $siblingData->SiblingOccupation3=$request->SiblingOccupation3;
            $siblingData->SiblingMobile3=$request->SiblingMobile3;

            $siblingData->SiblingName4=$request->SiblingName4;
            $siblingData->SiblingRelation4=$request->SiblingRelation4;
            $siblingData->SiblingAge4=$request->SiblingAge4;
            $siblingData->SiblingOccupation4=$request->SiblingOccupation4;
            $siblingData->SiblingMobile4=$request->SiblingMobile4;

            $siblingData->SiblingName5=$request->SiblingName5;
            $siblingData->SiblingRelation5=$request->SiblingRelation5;
            $siblingData->SiblingAge5=$request->SiblingAge5;
            $siblingData->SiblingOccupation5=$request->SiblingOccupation5;
            $siblingData->SiblingMobile5=$request->SiblingMobile5;

            $siblingData->SiblingName6=$request->SiblingName6;
            $siblingData->SiblingRelation6=$request->SiblingRelation6;
            $siblingData->SiblingAge6=$request->SiblingAge6;
            $siblingData->SiblingOccupation6=$request->SiblingOccupation6;
            $siblingData->SiblingMobile6=$request->SiblingMobile6;

            $siblingData->SiblingName7=$request->SiblingName7;
            $siblingData->SiblingRelation7=$request->SiblingRelation7;
            $siblingData->SiblingAge7=$request->SiblingAge7;
            $siblingData->SiblingOccupation7=$request->SiblingOccupation7;
            $siblingData->SiblingMobile7=$request->SiblingMobile7;

            $siblingData->SiblingName8=$request->SiblingName8;
            $siblingData->SiblingRelation8=$request->SiblingRelation8;
            $siblingData->SiblingAge8=$request->SiblingAge8;
            $siblingData->SiblingOccupation8=$request->SiblingOccupation8;
            $siblingData->SiblingMobile8=$request->SiblingMobile8;
            $siblingData->save();

            $emergence = EmergencyContact::where('beneficiary_id', $benObj->id)->first();
            $emergence->EmergencyName=$request->EmergencyName;
            $emergence->EmergencyRelationship=$request->EmergencyRelationship;
            $emergence->EmergencyPhysicalAddress=$request->EmergencyPhysicalAddress;
            $emergence->EmergencyPoBox=$request->EmergencyPoBox;
            $emergence->EmergencyTelephone=$request->EmergencyTelephone;
            $emergence->EmergencyMobile=$request->EmergencyMobile;
            $emergence->EmergencyEmail=$request->EmergencyEmail;
            $emergence->save();

            $familyProp = FamilyProperty::where('beneficiary_id', $benObj->id)->first();
             $familyProp->Type1=$request->Type1;
             $familyProp->Size1=$request->Size1;
             $familyProp->Location1=$request->Location1;

             $familyProp->Type2=$request->Type2;
             $familyProp->Size2=$request->Size2;
             $familyProp->Location2=$request->Location2;

             $familyProp->Type3=$request->Type3;
             $familyProp->Size3=$request->Size3;
             $familyProp->Location3=$request->Location3;

             $familyProp->Type4=$request->Type4;
             $familyProp->Size4=$request->Size4;
             $familyProp->Location4=$request->Location4;

             $familyProp->Type5=$request->Type5;
             $familyProp->Size5=$request->Size5;
             $familyProp->Location5=$request->Location5;

             $familyProp->Type6=$request->Type6;
             $familyProp->Size6=$request->Size6;
             $familyProp->Location6=$request->Location6;
             $familyProp->save();

            Session::put('personal_status', 'Information updated!');
            return back()->withInput();
        }else{
            $request->validate(
                [
                    'TelephoneGuardian'=>['required'],
                    'EmailGuardian'=>['required', 'string', 'email', 'max:255','unique:beneficiaryforms']  //
                ]
            );
            $resp = Beneficiaryform::create($data);
      
            if($resp->id){
                Session::forget('personal_status');

                AcademicInfo::create($data+['beneficiary_id'=>$resp->id]);
                FamilyDetail::create($data+['beneficiary_id'=>$resp->id]);
                StatementNeed::create($data+['beneficiary_id'=>$resp->id]);
                Sibling::create($data+['beneficiary_id'=>$resp->id]);
                EmergencyContact::create($data+['beneficiary_id'=>$resp->id]);
                FamilyProperty::create($data+['beneficiary_id'=>$resp->id]);

                Session::put('personal_status', 'Information uploaded!');
                return back()->withInput();
            }else{
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
