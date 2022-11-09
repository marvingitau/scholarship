@extends('layouts.admin')
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!--  Topbar -->
        @include('admin.partials.topnav')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4"> -->
                <!-- <h1 class="h3 mb-0 text-gray-800">Beneficiary Form</h1> -->
                <ul class="nav justify-content-center">
                    <li class="nav-item px-2">
                        <a class="nav-link border bg-primary text-white" href="{{route('admin.beneficiarydisciplinary',$personalSection['id'])}}">Displinary Section</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link border bg-primary text-white" href="{{route('admin.beneficiarymentorship',$personalSection['id'])}}">Mentorship Section</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link border bg-primary text-white" href="{{route('admin.beneficiaryfee',$personalSection['id'])}}">Payment of Fee</a>
                    </li>
                   
                </ul>
            <!-- </div> -->

            <div class="row justify-content-center">
                <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10 text-center p-0 mt-3 mb-2">
                    <div class="card px-2 pt-4 pb-0 mt-3 mb-3">
                        <h2 id="heading">Beneficiary Profile</h2>
                        <!-- <p>Fill all form field to go to next step</p> -->
                        <section id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Personal Information</strong></li>
                                <li id="personal"><strong>Academic Information</strong></li>
                                <li id="payment"><strong>Family Details</strong></li>
                                <li id="confirm"><strong>Statement Of Need</strong></li>
                                <li id="confirm"><strong>Sibling</strong></li>
                                <li id="confirm"><strong>Emergency Contact</strong></li>
                                <li id="confirm"><strong>Family Property</strong></li>
                                <li id="confirm"><strong>Approval Reason</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
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

                                    <label class="fieldlabels">First Name: *</label>
                                    <input type="text" name="firstname" value="{{ $personalSection['firstname']}}" placeholder="First Name" disabled />

                                    <label class="fieldlabels">Middle Name: </label>
                                    <input type="text" name="middlename" value="{{ $personalSection['middlename']}}" placeholder="Middle Name" disabled />

                                    <label class="fieldlabels">Last Name: *</label>
                                    <input type="text" name="lastname" value="{{ $personalSection['lastname']}}" placeholder="Last Name" disabled />

                                    <label class="fieldlabels">Gender: </label>
                                    <select name="gender" disabled>
                                        <option>{{$personalSection['gender']}}</option>
                                        <option value="MALE" <?php echo $personalSection['gender'] == "MALE" ? 'selected' : "" ?>>MALE</option>
                                        <option value="FEMALE" <?php echo $personalSection['gender'] == "FEMALE" ? 'selected' : "" ?>>FEMALE</option>
                                    </select>

                                    <label class="fieldlabels">Age: </label>
                                    <input type="text" name="age" value="{{ $personalSection['age']}}" placeholder="Age" disabled />

                                    <label class="fieldlabels">Date of Birth: </label>
                                    <input type="date" name="DOB" value="{{ $personalSection['DOB']}}" placeholder="DOB" disabled />
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="fieldlabels">KCPE Index: </label>
                                            <input type="text" name="KCPEIndex" value="{{ $personalSection['KCPEIndex']}}" placeholder="KCPE Index" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Secondary Admitted: </label>
                                            <input type="text" name="SecondaryAdmitted" value="{{ $personalSection['SecondaryAdmitted']}}" placeholder="Secondary Admitted" disabled />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Current Form: </label>
                                            <input type="text" name="CurrentForm" value="{{ $personalSection['CurrentForm']}}" placeholder="Current Form" disabled />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Form Joining: </label>
                                            <input type="text" name="FormJoining" value="{{ $personalSection['FormJoining']}}" placeholder="Form Joining" disabled />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Current Address: </label>
                                            <input type="text" name="CurrentAddress" value="{{ $personalSection['CurrentAddress']}}" placeholder="Current Address" disabled />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">P.O. Box: </label>
                                            <input type="text" name="PoBox" value="{{ $personalSection['PoBox']}}" placeholder="P.O. Box" disabled />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Postal Code: </label>
                                            <input type="text" name="PostalCode" value="{{ $personalSection['PostalCode']}}" placeholder="Postal Code" disabled />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">City/Town: </label>
                                            <input type="text" name="CityTown" value="{{ $personalSection['CityTown']}}" placeholder="City/Town" disabled />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Guardian Telephone: </label>
                                            <input type="text" name="TelephoneGuardian" value="{{ $personalSection['TelephoneGuardian']}}" placeholder="Guardian Telephone" disabled />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Guardian Email: </label>
                                            <input type="text" name="EmailGuardian" class="@error('EmailGuardian') is-invalid @enderror" value="{{ $personalSection['EmailGuardian']}}" placeholder="Guardian Guardian" disabled />
                                            @error('EmailGuardian')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Have another Sponsor: </label>
                                            <select name="AnotherSponship" disabled>
                                                <option value="">{{ $personalSection['AnotherSponship']}}</option>
                                                <option value="YES" <?php echo old('AnotherSponship') == "YES" ? 'selected' : "" ?>>YES</option>
                                                <option value="NO" <?php echo old('AnotherSponship') == "NO" ? 'selected' : "" ?>>NO</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="fieldlabels">Have another Sponsor Remark: </label>
                                            <textarea name="AnotherSponshipRemark" id="" cols="30" rows="10" disabled>{{ $personalSection['AnotherSponshipRemark']}}</textarea>
                                        </div>


                                    </div>



                                </div>
                                @else
                                <p class="text-danger">Personal Detail Section Missing !!</p>
                                @endif
                                <input type="button" name="next" class="next action-button" value="Next" />
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
                                        <div class="col-6">
                                            <label class="fieldlabels">Subject 1: *</label>
                                            <input type="text" name="Subject1" value="{{ $academicSection['Subject1']}}" placeholder="Subject 1" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Marks 1: *</label>
                                            <input type="number" name="Marks1" value="{{ $academicSection['Marks1']}}" placeholder="Marks" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Subject 2: *</label>
                                            <input type="text" name="Subject2" value="{{ $academicSection['Subject2']}}" placeholder="Subject 2" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Marks 2: *</label>
                                            <input type="number" name="Marks2" value="{{ $academicSection['Marks2']}}" placeholder="Marks" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Subject 3: *</label>
                                            <input type="text" name="Subject3" value="{{ $academicSection['Subject3']}}" placeholder="Subject 3" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Marks 3: *</label>
                                            <input type="number" name="Marks3" value="{{ $academicSection['Marks3']}}" placeholder="Marks" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Subject 4: *</label>
                                            <input type="text" name="Subject4" value="{{ $academicSection['Subject4']}}" placeholder="Subject 4" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Marks 4: *</label>
                                            <input type="number" name="Marks4" value="{{ $academicSection['Marks4']}}" placeholder="Marks" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Subject 5: *</label>
                                            <input type="text" name="Subject5" value="{{ $academicSection['Subject5']}}" placeholder="Subject 5" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Marks 5: *</label>
                                            <input type="number" name="Marks5" value="{{ $academicSection['Marks5']}}" placeholder="Marks" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Subject 6: *</label>
                                            <input type="text" name="Subject6" value="{{ $academicSection['Subject6']}}" placeholder="Subject 6" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Marks 6: *</label>
                                            <input type="number" name="Marks6" value="{{ $academicSection['Marks6']}}" placeholder="Marks" disabled />
                                        </div>

                                        <!-- <div class="col-6">
                                                <label class="fieldlabels">Subject 7: *</label>
                                                <input type="text" name="Subject7" value="{{ old('Subject7') }}" placeholder="Subject 7" />
                                            </div> -->
                                        <div class="col-12">
                                            <label class="fieldlabels">Total Marks</label>
                                            <input type="text" name="TotalMarks" value="{{ $academicSection['TotalMarks']}}" placeholder="Total Marks" disabled />
                                        </div>




                                    </div>


                                </div>
                                @else
                                <p class="text-danger">Academic Detail Section Missing !!</p>
                                @endif
                                <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
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
                                            <h2 class="steps">Step 3 - 8</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="fieldlabels">Father: *</label>
                                            <input type="text" name="Father" value="{{ $familySection['Father']}}" placeholder="Father" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Mother: *</label>
                                            <input type="text" name="Mother" value="{{ $familySection['Mother']}}" placeholder="Mother" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Father Alive: *</label>
                                            <input type="text" name="FatherAlive" value="{{ $familySection['FatherAlive']}}" placeholder="Father Alive" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Mother Alive: *</label>
                                            <input type="text" name="MotherAlive" value="{{ $familySection['MotherAlive']}}" placeholder="Mother Alive" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Father Age: *</label>
                                            <input type="text" name="FatherAge" value="{{ $familySection['FatherAge']}}" placeholder="Father Age" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Mother Age: *</label>
                                            <input type="text" name="MotherAge" value="{{ $familySection['MotherAge']}}" placeholder="Mother Age" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Fathe ID: *</label>
                                            <input type="text" name="FatherID" value="{{ $familySection['FatherID']}}" placeholder="Father ID" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Mother ID: *</label>
                                            <input type="text" name="MotherID" value="{{ $familySection['MotherID']}}" placeholder="Mother ID" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Father Occupation: *</label>
                                            <input type="text" name="FatherOccupation" value="{{ $familySection['FatherOccupation']}}" placeholder="Father Occupation" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Mother Occupation: *</label>
                                            <input type="text" name="MotherOccupation" value="{{ $familySection['MotherOccupation']}}" placeholder="Mother Occupation" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Father Other Source of Income: *</label>
                                            <input type="text" name="FatherOtherSourceIncome" value="{{ $familySection['FatherOtherSourceIncome']}}" placeholder="Father Other Source of Income" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Mother Other Source of Income: *</label>
                                            <input type="text" name="MotherOtherSourceIncome" value="{{ $familySection['MotherOtherSourceIncome']}}" placeholder="Mother Other Source of Income" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Father Mobile: *</label>
                                            <input type="text" name="FatherMobile" value="{{ $familySection['FatherMobile']}}" placeholder="Father Mobile" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Mother Mobile: *</label>
                                            <input type="text" name="MotherMobile" value="{{ $familySection['MotherMobile']}}" placeholder="Mother Mobile" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">FatherTelephone: *</label>
                                            <input type="text" name="FatherTelephone" value="{{ $familySection['FatherTelephone']}}" placeholder="Father Telephone" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Mother Telephone: *</label>
                                            <input type="text" name="MotherTelephone" value="{{ $familySection['MotherTelephone']}}" placeholder="Mother Telephone" disabled />
                                        </div>

                                        <div class="col-6">
                                            <label class="fieldlabels">Father Email: *</label>
                                            <input type="text" name="FatherEmail" value="{{ $familySection['FatherEmail']}}" placeholder="Father Email" disabled />
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Mother Email: *</label>
                                            <input type="text" name="MotherEmail" value="{{ $familySection['MotherEmail']}}" placeholder="Mother Email" disabled />
                                        </div>

                                        <div class="col-12">
                                            <label class="fieldlabels">Active Phone Number: *</label>
                                            <input type="text" name="ActivePhoneNumber" value="{{ $familySection['ActivePhoneNumber']}}" placeholder="Active Phone Number" disabled />
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Lives With Name: *</label>
                                            <input type="text" name="LiveWithName" value="{{ $familySection['LiveWithName']}}" placeholder="Lives With" disabled />
                                        </div>

                                        <div class="col-12">
                                            <label class="fieldlabels">Lives With Relationship: *</label>
                                            <input type="text" name="LiveWitRelation" value="{{ $familySection['LiveWitRelation']}}" placeholder="Lives With Relationship" disabled />
                                        </div>

                                    </div>

                                </div>
                                @else
                                <p class="text-danger">Family Detail Section Missing !!</p>
                                @endif
                                <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
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
                                <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
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

                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Name 1: *</label>
                                            <input type="text" name="SiblingName1" value="{{ $siblingSection['SiblingName1']}}" placeholder="Sibling Name 1" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Relation 1: *</label>
                                            <input type="text" name="SiblingRelation1" value="{{ $siblingSection['SiblingRelation1']}}" placeholder="Sibling Relation 1" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Age 1: *</label>
                                            <input type="text" name="SiblingAge1" value="{{ $siblingSection['SiblingAge1']}}" placeholder="Sibling Age 1" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Occupation 1: *</label>
                                            <input type="text" name="SiblingOccupation1" value="{{ $siblingSection['SiblingOccupation1']}}" placeholder="Sibling Occupation 1" disabled />
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Sibling Mobile 1: *</label>
                                            <input type="text" name="SiblingMobile1" value="{{ $siblingSection['SiblingMobile1']}}" placeholder="Sibling Mobile 1" disabled />
                                        </div>


                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Name 2: *</label>
                                            <input type="text" name="SiblingName2" value="{{ $siblingSection['SiblingName2']}}" placeholder="Sibling Name 2" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Relation 2: *</label>
                                            <input type="text" name="SiblingRelation2" value="{{ $siblingSection['SiblingRelation2']}}" placeholder="Sibling Relation 2" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Age 2: *</label>
                                            <input type="text" name="SiblingAge2" value="{{ $siblingSection['SiblingAge2']}}" placeholder="Sibling Age 2" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Occupation 2: *</label>
                                            <input type="text" name="SiblingOccupation2" value="{{ $siblingSection['SiblingOccupation2']}}" placeholder="Sibling Occupation 2" disabled />
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Sibling Mobile 2: *</label>
                                            <input type="text" name="SiblingMobile2" value="{{ $siblingSection['SiblingMobile2']}}" placeholder="Sibling Mobile 2" disabled />
                                        </div>



                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Name 3: *</label>
                                            <input type="text" name="SiblingName3" value="{{ $siblingSection['SiblingName3']}}" placeholder="Sibling Name 3" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Relation 3: *</label>
                                            <input type="text" name="SiblingRelation3" value="{{ $siblingSection['SiblingRelation3']}}" placeholder="Sibling Relation 3" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Age 3: *</label>
                                            <input type="text" name="SiblingAge3" value="{{ $siblingSection['SiblingAge3']}}" placeholder="Sibling Age 3" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Occupation 3: *</label>
                                            <input type="text" name="SiblingOccupation3" value="{{ $siblingSection['SiblingOccupation3']}}" placeholder="Sibling Occupation 3" disabled />
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Sibling Mobile 3: *</label>
                                            <input type="text" name="SiblingMobile3" value="{{ $siblingSection['SiblingMobile3']}}" placeholder="Sibling Mobile 3" disabled />
                                        </div>




                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Name 4: *</label>
                                            <input type="text" name="SiblingName4" value="{{ $siblingSection['SiblingName4']}}" placeholder="Sibling Name 4" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Relation 4: *</label>
                                            <input type="text" name="SiblingRelation4" value="{{ $siblingSection['SiblingRelation4']}}" placeholder="Sibling Relation 4" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Age 4: *</label>
                                            <input type="text" name="SiblingAge4" value="{{ $siblingSection['SiblingAge4']}}" placeholder="Sibling Age 4" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Occupation 4: *</label>
                                            <input type="text" name="SiblingOccupation4" value="{{ $siblingSection['SiblingOccupation4']}}" placeholder="Sibling Occupation 4" disabled />
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Sibling Mobile 4: *</label>
                                            <input type="text" name="SiblingMobile4" value="{{ $siblingSection['SiblingMobile4']}}" placeholder="Sibling Mobile 4" disabled />
                                        </div>




                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Name 5: *</label>
                                            <input type="text" name="SiblingName5" value="{{ $siblingSection['SiblingName5']}}" placeholder="Sibling Name 5" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Relation 5: *</label>
                                            <input type="text" name="SiblingRelation5" value="{{ $siblingSection['SiblingRelation5']}}" placeholder="Sibling Relation 5" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Age 5: *</label>
                                            <input type="text" name="SiblingAge5" value="{{ $siblingSection['SiblingAge5']}}" placeholder="Sibling Age 5" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Occupation 5: *</label>
                                            <input type="text" name="SiblingOccupation5" value="{{ $siblingSection['SiblingOccupation5']}}" placeholder="Sibling Occupation 5" disabled />
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Sibling Mobile 5: *</label>
                                            <input type="text" name="SiblingMobile5" value="{{ $siblingSection['SiblingMobile5']}}" placeholder="Sibling Mobile 5" disabled />
                                        </div>



                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Name 6: *</label>
                                            <input type="text" name="SiblingName6" value="{{ $siblingSection['SiblingName6']}}" placeholder="Sibling Name 6" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Relation 6: *</label>
                                            <input type="text" name="SiblingRelation6" value="{{ $siblingSection['SiblingRelation6']}}" placeholder="Sibling Relation 6" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Age 6: *</label>
                                            <input type="text" name="SiblingAge6" value="{{ $siblingSection['SiblingAge6']}}" placeholder="Sibling Age 6" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Occupation 6: *</label>
                                            <input type="text" name="SiblingOccupation6" value="{{ $siblingSection['SiblingOccupation6']}}" placeholder="Sibling Occupation 6" disabled />
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Sibling Mobile 6: *</label>
                                            <input type="text" name="SiblingMobile6" value="{{ $siblingSection['SiblingMobile6']}}" placeholder="Sibling Mobile 6" disabled />
                                        </div>



                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Name 7: *</label>
                                            <input type="text" name="SiblingName7" value="{{ $siblingSection['SiblingName7']}}" placeholder="Sibling Name 7" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Relation 7: *</label>
                                            <input type="text" name="SiblingRelation7" value="{{ $siblingSection['SiblingRelation7']}}" placeholder="Sibling Relation 7" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Age 7: *</label>
                                            <input type="text" name="SiblingAge7" value="{{ $siblingSection['SiblingAge7']}}" placeholder="Sibling Age 7" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Occupation 7: *</label>
                                            <input type="text" name="SiblingOccupation7" value="{{ $siblingSection['SiblingOccupation7']}}" placeholder="Sibling Occupation 7" disabled />
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Sibling Mobile 7: *</label>
                                            <input type="text" name="SiblingMobile7" value="{{ $siblingSection['SiblingMobile7']}}" placeholder="Sibling Mobile 7" disabled />
                                        </div>



                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Name 8: *</label>
                                            <input type="text" name="SiblingName8" value="{{ $siblingSection['SiblingName8']}}" placeholder="Sibling Name 8" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Relation 8: *</label>
                                            <input type="text" name="SiblingRelation8" value="{{ $siblingSection['SiblingRelation8']}}" placeholder="Sibling Relation 8" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Age 8: *</label>
                                            <input type="text" name="SiblingAge8" value="{{ $siblingSection['SiblingAge8']}}" placeholder="Sibling Age 8" disabled />
                                        </div>
                                        <div class="col-3">
                                            <label class="fieldlabels">Sibling Occupation 8: *</label>
                                            <input type="text" name="SiblingOccupation8" value="{{ $siblingSection['SiblingOccupation8']}}" placeholder="Sibling Occupation 8" disabled />
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Sibling Mobile 8: *</label>
                                            <input type="text" name="SiblingMobile8" value="{{ $siblingSection['SiblingMobile8']}}" placeholder="Sibling Mobile 8" disabled />
                                        </div>


                                    </div>


                                </div>
                                @else
                                <p class="text-danger">Sibling Section Missing !!</p>
                                @endif
                                <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
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

                                </div>
                                @else
                                <p class="text-danger">Emergency Section Missing !!</p>
                                @endif
                                <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>

                            <fieldset>
                                @if($familyPropertySection)
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Family Property Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 7 - 7</h2>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-4">
                                            <label class="fieldlabels">Type of Property/Animals 1: *</label>
                                            <input type="text" name="Type1" value="{{ $familyPropertySection['Type1']}}" placeholder="Type 1" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Size/Quantity 1: *</label>
                                            <input type="text" name="Size1" value="{{ $familyPropertySection['Size1']}}" placeholder="Size 1" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Location 1: *</label>
                                            <input type="text" name="Location1" value="{{ $familyPropertySection['Location1']}}" placeholder="Location 1" disabled />
                                        </div>


                                        <div class="col-4">
                                            <label class="fieldlabels">Type of Property/Animals 2: *</label>
                                            <input type="text" name="Type2" value="{{ $familyPropertySection['Type2']}}" placeholder="Type 2" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Size/Quantity 2: *</label>
                                            <input type="text" name="Size2" value="{{ $familyPropertySection['Size2']}}" placeholder="Size 2" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Location 2: *</label>
                                            <input type="text" name="Location2" value="{{ $familyPropertySection['Location2']}}" placeholder="Location 2" disabled />
                                        </div>


                                        <div class="col-4">
                                            <label class="fieldlabels">Type of Property/Animals 3: *</label>
                                            <input type="text" name="Type3" value="{{ $familyPropertySection['Type3']}}" placeholder="Type 3" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Size/Quantity 3: *</label>
                                            <input type="text" name="Size3" value="{{ $familyPropertySection['Size3']}}" placeholder="Size 3" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Location 3: *</label>
                                            <input type="text" name="Location3" value="{{ $familyPropertySection['Location3']}}" placeholder="Location 3" disabled />
                                        </div>


                                        <div class="col-4">
                                            <label class="fieldlabels">Type of Property/Animals 4: *</label>
                                            <input type="text" name="Type4" value="{{ $familyPropertySection['Type4']}}" placeholder="Type 4" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Size/Quantity 4: *</label>
                                            <input type="text" name="Size4" value="{{ $familyPropertySection['Size4']}}" placeholder="Size 4" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Location 4: *</label>
                                            <input type="text" name="Location4" value="{{ $familyPropertySection['Location4']}}" placeholder="Location 4" disabled />
                                        </div>


                                        <div class="col-4">
                                            <label class="fieldlabels">Type of Property/Animals 5: *</label>
                                            <input type="text" name="Type5" value="{{ $familyPropertySection['Type5']}}" placeholder="Type 5" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Size/Quantity 5: *</label>
                                            <input type="text" name="Size5" value="{{ $familyPropertySection['Size5']}}" placeholder="Size 5" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Location 5: *</label>
                                            <input type="text" name="Location5" value="{{ $familyPropertySection['Location5']}}" placeholder="Location 5" disabled />
                                        </div>


                                        <div class="col-4">
                                            <label class="fieldlabels">Type of Property/Animals 6: *</label>
                                            <input type="text" name="Type6" value="{{ $familyPropertySection['Type6']}}" placeholder="Type 6" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Size/Quantity 6: *</label>
                                            <input type="text" name="Size6" value="{{ $familyPropertySection['Size6']}}" placeholder="Size 6" disabled />
                                        </div>
                                        <div class="col-4">
                                            <label class="fieldlabels">Location 6: *</label>
                                            <input type="text" name="Location6" value="{{ $familyPropertySection['Location6']}}" placeholder="Location 6" disabled />
                                        </div>




                                    </div>


                                </div>
                                @else
                                <p class="text-danger">Emergency Section Missing !!</p>
                                @endif
                                <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>

                            <fieldset>
                                @if($reasonSection)
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Approval Reason:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 8 - 8</h2>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">

                                            <label class="fieldlabels">Reason: *</label>
                                            <textarea id="" cols="30" rows="10" disabled>{{ $reasonSection['reason']}}</textarea>

                                        </div>

                                    </div>
                                </div>
                                @else
                                <p class="text-danger">Reason Section Missing !!</p>
                                @endif
                            </fieldset>





                        </section>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @include('admin.partials.footer')
</div>
@endsection
@section('style')
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous"> -->
<style>
    #heading {
        text-transform: uppercase;
        color: #673AB7;
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
        display: none;
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