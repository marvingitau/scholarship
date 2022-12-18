@extends('layouts.committee')
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!--  Topbar -->
        @include('committee.partials.topnav')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <!-- <h1 class="h3 mb-0 text-gray-800">Beneficiary Form</h1> -->
            </div>

            <div class="row justify-content-center">
                <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10 text-center p-0 mt-3 mb-2">
                    <div class="card px-2 pt-4 pb-0 mt-3 mb-3">
                        <h2 id="heading">{{$personalSection['Type']}} Applicant Form</h2>
                        <!-- <p>Fill all form field to go to next step</p> -->
                        <section id="msform">
                            <!-- progressbar -->
                            <!-- <ul id="progressbar">
                                <li class="active" id="account"><strong>Personal Information</strong></li>
                                <li id="personal"><strong>Academic Information</strong></li>
                                <li id="payment"><strong>Family Details</strong></li>
                                <li id="confirm"><strong>Statement Of Need</strong></li>
                                <li id="confirm"><strong>Sibling</strong></li>
                                <li id="confirm"><strong>Emergency Contact</strong></li>
                                <li id="confirm"><strong>Family Property</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>  -->
                            <br> <!-- fieldsets -->

                            <div class="row">
                                <div class="col-12">
                                    @if (session('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <fieldset>
                                @if($personalSection)

                                <div class="form-card ">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Personal Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 1 - 7</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="fieldlabels">First Name: *</label>
                                            <input type="text" name="firstname" value="{{ $personalSection['firstname']}}" placeholder="First Name" disabled />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Middle Name: </label>
                                            <input type="text" name="middlename" value="{{ $personalSection['middlename']}}" placeholder="Middle Name" disabled />

                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Last Name: *</label>
                                            <input type="text" name="lastname" value="{{ $personalSection['lastname']}}" placeholder="Last Name" disabled />

                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Gender: </label>
                                            <select name="gender" disabled>
                                                <option>{{$personalSection['gender']}}</option>
                                                <option value="MALE" <?php echo $personalSection['gender'] == "MALE" ? 'selected' : "" ?>>MALE</option>
                                                <option value="FEMALE" <?php echo $personalSection['gender'] == "FEMALE" ? 'selected' : "" ?>>FEMALE</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Age: </label>
                                            <input type="text" name="age" value="{{ $personalSection['age']}}" placeholder="Age" disabled />

                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Date of Birth: </label>
                                            <input type="date" name="DOB" value="{{ $personalSection['DOB']}}" placeholder="DOB" disabled />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Active Email: </label>
                                            <input type="email" name="EmailActive" value="{{ $personalSection['EmailActive']}}" placeholder="Active Email" disabled />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="fieldlabels">KCPE Index: </label>
                                            <input type="text" name="KCPEIndex" value="{{ $personalSection['KCPEIndex']}}" placeholder="KCPE Index" disabled />
                                        </div>

                                        <div class="col-md-6">
                                            <label class="fieldlabels">Secondary Admitted: </label>
                                            <input type="text" name="SecondaryAdmitted" value="{{ $personalSection['SecondaryAdmitted']}}" placeholder="Secondary Admitted" disabled />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">School Fees: </label>
                                            <input type="text" name="SchoolFees	" value="{{ $personalSection['SchoolFees']}}" placeholder="School Fees" disabled />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">Current Form: </label>
                                            <input type="text" name="CurrentForm" value="{{ $personalSection['CurrentForm']}}" placeholder="Current Form" disabled />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">Form Joining: </label>
                                            <input type="text" name="FormJoining" value="{{ $personalSection['FormJoining']}}" placeholder="Form Joining" disabled />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">Current Address: </label>
                                            <input type="text" name="CurrentAddress" value="{{ $personalSection['CurrentAddress']}}" placeholder="Current Address" disabled />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">P.O. Box: </label>
                                            <input type="text" name="PoBox" value="{{ $personalSection['PoBox']}}" placeholder="P.O. Box" disabled />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">Postal Code: </label>
                                            <input type="text" name="PostalCode" value="{{ $personalSection['PostalCode']}}" placeholder="Postal Code" disabled />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">City/Town: </label>
                                            <input type="text" name="CityTown" value="{{ $personalSection['CityTown']}}" placeholder="City/Town" disabled />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Church Name: </label>
                                            <input type="text" name="churchname" value="{{ $personalSection['churchname']}}" placeholder="Church Name" disabled />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">Pastor Name: </label>
                                            <input type="text" name="pastorname" value="{{ $personalSection['pastorname']}}" placeholder="Pastor Name" disabled />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">Pastor/Church Mobile: </label>
                                            <input type="text" name="pastortelephone" value="{{ $personalSection['pastortelephone']}}" placeholder="Pastor/Church Mobile" disabled />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">Have another Sponsor: </label>
                                            <select name="AnotherSponsorship" disabled>
                                                <option value="">{{ $personalSection['AnotherSponsorship']}}</option>
                                                <option value="YES" <?php echo old('AnotherSponsorship') == "YES" ? 'selected' : "" ?>>YES</option>
                                                <option value="NO" <?php echo old('AnotherSponsorship') == "NO" ? 'selected' : "" ?>>NO</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="fieldlabels">Have another Sponsor Remark: </label>
                                            <textarea name="AnotherSponsorshipRemark" id="" cols="30" rows="10" disabled>{{ $personalSection['AnotherSponsorshipRemark']}}</textarea>
                                        </div>


                                    </div>



                                </div>
                                @else
                                <p class="text-danger">Personal Detail Section Missing !!</p>
                                @endif
                                <!-- <input type="button" name="next" class="next action-button" value="Next" /> -->
                            </fieldset>

                            <fieldset>
                                @if($academicSection)
                                <div class="form-card ">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Academic Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 2 - 7</h2>
                                        </div>
                                    </div>


                                    <div class="row">
                                        @if($academicSection)
                                        @foreach($academicSection as $itm)

                                        <div class="col-md-6">
                                            <label class="fieldlabels">Subject:</label>
                                            <input type="text" name="Subject1" value="{{ $itm->Subject1 }}" placeholder="" disabled />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="fieldlabels">Marks/Grade:</label>
                                            <input type="number" name="Marks1" value="{{ $itm->Marks1 }}" placeholder="" disabled />
                                        </div>

                                        @endforeach
                                        <div class="col-md-12">
                                            <label class="fieldlabels">Total Marks/Mean Grade</label>
                                            <input type="text" name="TotalMarks" value="<?php echo $academicSection[0]->TotalMarks ?>" placeholder="" disabled />
                                        </div>
                                        @endif


                                    </div>


                                </div>
                                @else
                                <p class="text-danger">Academic Detail Section Missing !!</p>
                                @endif
                                <!-- <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                            </fieldset>

                            <fieldset>
                                @if($familySection)
                                <?php //var_dump($familyPropertySection)
                                ?>
                                <div class="form-card ">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Family Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 3 - 7</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Father: *</label>
                                            <input type="text" name="Father" value="{{$familySection['Father']}}" placeholder="Father" />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">Fathe ID: *</label>
                                            <input type="text" name="FatherID" value="{{$familySection['FatherID']}}" placeholder="Father ID" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Father Mobile: *</label>
                                            <input type="text" name="FatherMobile" value="{{$familySection['FatherMobile']}}" placeholder="Father Mobile" />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">Father Occupation: *</label>
                                            <input type="text" name="FatherOccupation" value="{{$familySection['FatherOccupation']}}" placeholder="Father Occupation" />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="fieldlabels">Mother: *</label>
                                            <input type="text" name="Mother" value="{{ $familySection['Mother']}}" placeholder="Mother" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Mother ID: *</label>
                                            <input type="text" name="MotherID" value="{{ $familySection['MotherID']}}" placeholder="Mother ID" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Mother Mobile: *</label>
                                            <input type="text" name="MotherMobile" value="{{ $familySection['MotherMobile']}}" placeholder="Mother Mobile" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Mother Occupation: *</label>
                                            <input type="text" name="MotherOccupation" value="{{ $familySection['MotherOccupation']}}" placeholder="Mother Occupation" />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fieldlabels">If Applicable</label>

                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Guardian Name: *</label>
                                            <input type="text" name="Guardian" value="{{ $familySection['Guardian']}}" placeholder="Guardian" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Guardian ID: *</label>
                                            <input type="text" name="GuardianID" value="{{ $familySection['GuardianID']}}" placeholder="Guardian ID" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Guardian Mobile: *</label>
                                            <input type="text" name="GuardianMobile" value="{{ $familySection['GuardianMobile']}}" placeholder="Guardian Mobile" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fieldlabels">Guardian Occupation:*</label>
                                            <input type="text" name="GuardianOccupation" value="{{ $familySection['GuardianOccupation']}}" placeholder="Guardian Occupation" />
                                        </div>

                                    </div>

                                </div>
                                @else
                                <p class="text-danger">Family Detail Section Missing !!</p>
                                @endif
                                <!-- <input type="button" name="next" class="next action-button" value="Submit" /> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                            </fieldset>

                            <fieldset>
                                @if($statementSection)
                                <div class="form-card ">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Statement of Need Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 4 - 7</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="fieldlabels">Statement of Need: *</label>
                                            <textarea name="StatementofNeed" cols="30" rows="10" disabled>{{ $statementSection['StatementofNeed']}}</textarea>
                                        </div>
                                    </div>

                                </div>
                                @else
                                <p class="text-danger">Statement Section Missing !!</p>
                                @endif
                                <!-- <input type="button" name="next" class="next action-button" value="Submit" /> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                            </fieldset>

                            <fieldset>
                                @if($siblingSection)
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Siblings Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 5 - 7</h2>
                                        </div>
                                    </div>


                                    <div class="row">
                                        @if($siblingSection)
                                        @foreach($siblingSection as $itm)
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Name : *</label>
                                            <input type="text" name="SiblingName1" value="{{ $itm->SiblingName1 }}" placeholder="Sibling Name 1" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Relation : *</label>
                                            <input type="text" name="SiblingRelation1" value="{{ $itm->SiblingRelation1 }}" placeholder="Sibling Relation 1" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Age : *</label>
                                            <input type="text" name="SiblingAge1" value="{{ $itm->SiblingAge1 }}" placeholder="Sibling Age 1" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Occupation : *</label>
                                            <input type="text" name="SiblingOccupation1" value="{{ $itm->SiblingOccupation1 }}" placeholder="Sibling Occupation 1" disabled />
                                        </div>

                                        @endforeach
                                        @endif



                                    </div>


                                </div>
                                @else
                                <p class="text-danger">Sibling Section Missing !!</p>
                                @endif
                                <!-- <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                            </fieldset>

                            <fieldset>
                                @if($emergencySection)
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Emergency Contact Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 6 - 7</h2>
                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="col-3">
                                            <label class="fieldlabels">Emergency Name: *</label>
                                            <input type="text" name="EmergencyName" value="{{ $emergencySection['EmergencyName']}}" placeholder="Emergency Name" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Emergency Relationship: *</label>
                                            <input type="text" name="EmergencyRelationship" value="{{ $emergencySection['EmergencyRelationship']}}" placeholder="Emergency Relationship" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Emergency Physical Address: *</label>
                                            <input type="text" name="EmergencyPhysicalAddress" value="{{ $emergencySection['EmergencyPhysicalAddress']}}" placeholder="Emergency Physical Address" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Emergency P.O.Box : *</label>
                                            <input type="text" name="EmergencyPoBox" value="{{ $emergencySection['EmergencyPoBox']}}" placeholder="Emergency P.O.Box" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Emergency Telephone: *</label>
                                            <input type="text" name="EmergencyTelephone" value="{{ $emergencySection['EmergencyTelephone']}}" placeholder="Emergency Telephone" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Emergency Mobile: *</label>
                                            <input type="text" name="EmergencyMobile" value="{{ $emergencySection['EmergencyMobile']}}" placeholder="Emergency Mobile" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Emergency Email: *</label>
                                            <input type="text" name="EmergencyEmail" value="{{ $emergencySection['EmergencyEmail']}}" placeholder="Emergency Email" disabled />
                                        </div>



                                    </div>
                                    <!-- 
                                        <button type="submit" class="btn btn-success rounded-0">Submit</button>

                                    </form> -->

                                </div>
                                @else
                                <p class="text-danger">Emergency Section Missing !!</p>
                                @endif
                                <!-- <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                            </fieldset>


                            <fieldset>
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Approval:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 7 - 7</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label class="fieldlabels">Expected Term1/Semester1: </label>
                                        <input type="text" value="{{ $expectedFee['TermOneFee'] }}" placeholder="Expected Term1/Semester1" disabled />
                                    </div>
                                    <div class="col-3">
                                        <label class="fieldlabels">Expected Term2/Semester2: </label>
                                        <input type="text" value="{{ $expectedFee['TermTwoFee'] }}" placeholder="Expected Term2/Semester2" disabled />
                                    </div>

                                    <div class="col-3">
                                        <label class="fieldlabels">Expected Term3/Semester3: </label>
                                        <input type="text" value="{{ $expectedFee['TermThreeFee'] }}" placeholder="Expected Term3/Semester3" disabled />
                                    </div>
                                    <div class="col-3">
                                        <label class="fieldlabels">Expected Annual Fee:</label>
                                        <input type="text" value="{{$personalSection['SchoolFees']}}" placeholder="Expected Annual Fee" disabled />
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-6">
                                        <form method="POST" action="{{ route('committee.approveapplicant') }}" class="form-input">
                                            @csrf
                                            <input type="hidden" name="applicant" value="{{ $personalSection['id']}}">
                                            <div class="form-group">
                                                <!-- <label style="margin:0rem !important;">Allocated Amount : *</label> -->
                                                <input type="number" class="form-control" name="AllocatedYealyFee" value="{{ old('AllocatedYealyFee') }}" placeholder="Allocated Amount" required />
                                            </div>
                                            <textarea name="applicantactionreason" id="" cols="30" rows="10" placeholder="Approve Reason" value="{{ old('applicantactionreason') }}" required></textarea>
                                            <button class="btn btn-success w-100 rounded-0" type="submit">Approve</button>

                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form method="POST" action="{{ route('committee.rejectapplicant') }}" class="form-input">
                                            @csrf
                                            <input type="hidden" name="applicant" value="{{ $personalSection['id']}}">
                                            <textarea name="applicantactionreason" id="" cols="30" rows="10" placeholder="Reject Reason" value="{{old('applicantactionreason')}}" required></textarea>
                                            <button class="btn btn-danger w-100 rounded-0" type="submit">Reject</button>

                                        </form>
                                    </div>
                                </div>

                            </fieldset>





                        </section>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @include('committee.partials.footer')
</div>
@endsection
@section('style')
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous"> -->
<style>
    #heading {
        text-transform: uppercase;
        color: #575360;
        font-weight: normal
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    .form-card {
        text-align: left
    }

    #msform fieldset:not(:first-of-type) {
        display: block;
    }

    #msform input,
    #msform textarea,
    #msform select {
        padding: 8px 15px 8px 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        background-color: #ECEFF1;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #673AB7;
        outline-width: 0
    }

    #msform .action-button {
        width: 100px;
        background: #673AB7;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 0px 10px 5px;
        float: right
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        background-color: #311B92
    }

    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        background-color: #000000
    }

    .card {
        z-index: 0;
        border: none;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #673AB7;
        margin-bottom: 15px;
        font-weight: normal;
        text-align: left
    }

    .purple-text {
        color: #673AB7;
        font-weight: normal
    }

    .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: gray;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #673AB7
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: ""
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: ""
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: ""
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: ""
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #673AB7
    }

    .progress {
        height: 20px
    }

    .progress-bar {
        background-color: #673AB7
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }

    @media only screen and (max-width: 500px) {

        #progressbar {
            display: flex;
            flex-direction: column;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 100%;
            float: left;
            position: relative;
            font-weight: 400;
        }

    }
</style>
@endsection
@section('script')
<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
        }

        $(".submit").click(function() {
            return false;
        })

    });
</script>
@endsection