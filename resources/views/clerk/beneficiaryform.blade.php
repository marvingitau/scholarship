@extends('layouts.clerk')

@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!--  Topbar -->
        @include('clerk.partials.topnav')
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
                        <h2 id="heading">Beneficiary Applicant Form</h2>
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

                            <form method="POST" action="{{ route('clerk.storepersonaldetail') }}" class="form-input">
                                @csrf
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Personal Information:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 1 - 7</h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @if (session('personal_status'))
                                                <div class="alert alert-success">
                                                    {{ session('personal_status') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>

                                        </div>
                                        <!-- <form method="POST" action="{{ route('clerk.storepersonaldetail') }}" class="form-input">
                                        @csrf -->
                                        <label class="fieldlabels">First Name: *</label>
                                        <input type="text" name="firstname" value="{{ old('firstname') }}" placeholder="First Name" />

                                        <label class="fieldlabels">Middle Name: </label>
                                        <input type="text" name="middlename" value="{{ old('middlename') }}" placeholder="Middle Name" />

                                        <label class="fieldlabels">Last Name: *</label>
                                        <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name" />

                                        <label class="fieldlabels">Gender: </label>
                                        <select name="gender" value="">

                                            <option value="">Choose</option>
                                            <option value="MALE" <?php echo old('gender') == "MALE" ? 'selected' : "" ?>>MALE</option>
                                            <option value="FEMALE" <?php echo old('gender') == "FEMALE" ? 'selected' : "" ?>>FEMALE</option>
                                        </select>

                                        <label class="fieldlabels">Age: </label>
                                        <input type="text" name="age" value="{{ old('age') }}" placeholder="Age" />

                                        <label class="fieldlabels">Date of Birth: </label>
                                        <input type="date" name="DOB" value="{{ old('DOB') }}" placeholder="Age" />
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="fieldlabels">KCPE Index: </label>
                                                <input type="text" name="KCPEIndex" value="{{ old('KCPEIndex') }}" placeholder="KCPE Index" />
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">Secondary Admitted: </label>
                                                <input type="text" name="SecondaryAdmitted" value="{{ old('SecondaryAdmitted') }}" placeholder="Secondary Admitted" />
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">Current Form: </label>
                                                <input type="text" name="CurrentForm" value="{{ old('CurrentForm') }}" placeholder="Current Form" />
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">Form Joining: </label>
                                                <input type="text" name="FormJoining" value="{{ old('FormJoining') }}" placeholder="Form Joining" />
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">Current Address: </label>
                                                <input type="text" name="CurrentAddress" value="{{ old('CurrentAddress') }}" placeholder="Current Address" />
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">P.O. Box: </label>
                                                <input type="text" name="PoBox" value="{{ old('PoBox') }}" placeholder="P.O. Box" />
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">Postal Code: </label>
                                                <input type="text" name="PostalCode" value="{{ old('PostalCode') }}" placeholder="Postal Code" />
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">City/Town: </label>
                                                <input type="text" name="CityTown" value="{{ old('CityTown') }}" placeholder="City/Town" />
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">Guardian Telephone: </label>
                                                <input type="text" name="TelephoneGuardian" value="{{ old('TelephoneGuardian') }}" placeholder="Guardian Telephone" />
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">Guardian Email: </label>
                                                <input type="text" name="EmailGuardian" class="@error('EmailGuardian') is-invalid @enderror" value="{{ old('EmailGuardian') }}" placeholder="Guardian Guardian" />
                                                @error('EmailGuardian')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">Have another Sponsor: </label>
                                                <select name="AnotherSponship">
                                                    <option value="">Choose</option>
                                                    <option value="YES" <?php echo old('AnotherSponship') == "YES" ? 'selected' : "" ?>>YES</option>
                                                    <option value="NO" <?php echo old('AnotherSponship') == "NO" ? 'selected' : "" ?>>NO</option>
                                                </select>
                                            </div>

                                            <div class="col-12">
                                                <label class="fieldlabels">Have another Sponsor Remark: </label>
                                                <textarea name="AnotherSponshipRemark" id="" cols="30" rows="10">{{ old('AnotherSponshipRemark') }}</textarea>
                                            </div>


                                        </div>
                                        <!-- <button type="submit" class="btn btn-success rounded-0">Submit</button>
                                    </form> -->


                                    </div>
                                    <!-- <input type="button" name="next" class="next action-button" value="Next" /> -->
                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
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
                                                <input type="text" name="Subject1" value="{{ old('Subject1') }}" placeholder="Subject 1" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Marks 1: *</label>
                                                <input type="number" name="Marks1" value="{{ old('Marks1') }}" placeholder="Marks" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Subject 2: *</label>
                                                <input type="text" name="Subject2" value="{{ old('Subject2') }}" placeholder="Subject 2" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Marks 2: *</label>
                                                <input type="number" name="Marks2" value="{{ old('Marks2') }}" placeholder="Marks" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Subject 3: *</label>
                                                <input type="text" name="Subject3" value="{{ old('Subject3') }}" placeholder="Subject 3" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Marks 3: *</label>
                                                <input type="number" name="Marks3" value="{{ old('Marks3') }}" placeholder="Marks" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Subject 4: *</label>
                                                <input type="text" name="Subject4" value="{{ old('Subject4') }}" placeholder="Subject 4" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Marks 4: *</label>
                                                <input type="number" name="Marks4" value="{{ old('Marks4') }}" placeholder="Marks" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Subject 5: *</label>
                                                <input type="text" name="Subject5" value="{{ old('Subject5') }}" placeholder="Subject 5" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Marks 5: *</label>
                                                <input type="number" name="Marks5" value="{{ old('Marks5') }}" placeholder="Marks" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Subject 6: *</label>
                                                <input type="text" name="Subject6" value="{{ old('Subject6') }}" placeholder="Subject 6" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Marks 6: *</label>
                                                <input type="number" name="Marks6" value="{{ old('Marks6') }}" placeholder="Marks" />
                                            </div>

                                            <!-- <div class="col-6">
                                                <label class="fieldlabels">Subject 7: *</label>
                                                <input type="text" name="Subject7" value="{{ old('Subject7') }}" placeholder="Subject 7" />
                                            </div> -->
                                            <div class="col-12">
                                                <label class="fieldlabels">Total Marks</label>
                                                <input type="text" name="TotalMarks" value="{{ old('TotalMarks') }}" placeholder="Total Marks" />
                                            </div>




                                        </div>
                                        

                                    </div>
                                    <!-- <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Family Information:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 3 - 7</h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="fieldlabels">Father: *</label>
                                                <input type="text" name="Father" value="{{ old('Father') }}" placeholder="Father" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Mother: *</label>
                                                <input type="text" name="Mother" value="{{ old('Mother') }}" placeholder="Mother" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Father Alive: *</label>
                                                <input type="text" name="FatherAlive" value="{{ old('FatherAlive') }}" placeholder="Father Alive" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Mother Alive: *</label>
                                                <input type="text" name="MotherAlive" value="{{ old('MotherAlive') }}" placeholder="Mother Alive" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Father Age: *</label>
                                                <input type="text" name="FatherAge" value="{{ old('FatherAge') }}" placeholder="Father Age" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Mother Age: *</label>
                                                <input type="text" name="MotherAge" value="{{ old('MotherAge') }}" placeholder="Mother Age" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Fathe ID: *</label>
                                                <input type="text" name="FatherID" value="{{ old('FatherID') }}" placeholder="Father ID" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Mother ID: *</label>
                                                <input type="text" name="MotherID" value="{{ old('MotherID') }}" placeholder="Mother ID" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Father Occupation: *</label>
                                                <input type="text" name="FatherOccupation" value="{{ old('FatherOccupation') }}" placeholder="Father Occupation" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Mother Occupation: *</label>
                                                <input type="text" name="MotherOccupation" value="{{ old('MotherOccupation') }}" placeholder="Mother Occupation" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Father Other Source of Income: *</label>
                                                <input type="text" name="FatherOtherSourceIncome" value="{{ old('FatherOtherSourceIncome') }}" placeholder="Father Other Source of Income" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Mother Other Source of Income: *</label>
                                                <input type="text" name="MotherOtherSourceIncome" value="{{ old('MotherOtherSourceIncome') }}" placeholder="Mother Other Source of Income" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Father Mobile: *</label>
                                                <input type="text" name="FatherMobile" value="{{ old('FatherMobile') }}" placeholder="Father Mobile" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Mother Mobile: *</label>
                                                <input type="text" name="MotherMobile" value="{{ old('MotherMobile') }}" placeholder="Mother Mobile" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">FatherTelephone: *</label>
                                                <input type="text" name="FatherTelephone" value="{{ old('FatherTelephone') }}" placeholder="Father Telephone" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Mother Telephone: *</label>
                                                <input type="text" name="MotherTelephone" value="{{ old('MotherTelephone') }}" placeholder="Mother Telephone" />
                                            </div>

                                            <div class="col-6">
                                                <label class="fieldlabels">Father Email: *</label>
                                                <input type="text" name="FatherEmail" value="{{ old('FatherEmail') }}" placeholder="Father Email" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Mother Email: *</label>
                                                <input type="text" name="MotherEmail" value="{{ old('MotherEmail') }}" placeholder="Mother Email" />
                                            </div>

                                            <div class="col-12">
                                                <label class="fieldlabels">Active Phone Number: *</label>
                                                <input type="text" name="ActivePhoneNumber" value="{{ old('ActivePhoneNumber') }}" placeholder="Active Phone Number" />
                                            </div>
                                            <div class="col-12">
                                                <label class="fieldlabels">Lives With Name: *</label>
                                                <input type="text" name="LiveWithName" value="{{ old('LiveWithName') }}" placeholder="Lives With" />
                                            </div>

                                            <div class="col-12">
                                                <label class="fieldlabels">Lives With Relationship: *</label>
                                                <input type="text" name="LiveWitRelation" value="{{ old('LiveWitRelation') }}" placeholder="Lives With Relationship" />
                                            </div>

                                        </div>

                                    </div>
                                    <!-- <input type="button" name="next" class="next action-button" value="Submit" /> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
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
                                                <textarea name="StatementofNeed" cols="30" rows="10">{{ old('StatementofNeed') }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <input type="button" name="next" class="next action-button" value="Submit" /> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Siblings Information:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 5 - 7</h2>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                        <div class="col-12">
                                            @if (session('academic_status'))
                                            <div class="alert alert-success">
                                                {{ session('academic_status') }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </div>

                                    </div> -->
                                       
                                        <div class="row">

                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Name 1: *</label>
                                                <input type="text" name="SiblingName1" value="{{ old('SiblingName1') }}" placeholder="Sibling Name 1" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Relation 1: *</label>
                                                <input type="text" name="SiblingRelation1" value="{{ old('SiblingRelation1') }}" placeholder="Sibling Relation 1" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Age 1: *</label>
                                                <input type="text" name="SiblingAge1" value="{{ old('SiblingAge1') }}" placeholder="Sibling Age 1" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Occupation 1: *</label>
                                                <input type="text" name="SiblingOccupation1" value="{{ old('SiblingOccupation1') }}" placeholder="Sibling Occupation 1" />
                                            </div>
                                            <div class="col-12">
                                                <label class="fieldlabels">Sibling Mobile 1: *</label>
                                                <input type="text" name="SiblingMobile1" value="{{ old('SiblingMobile1') }}" placeholder="Sibling Mobile 1" />
                                            </div>


                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Name 2: *</label>
                                                <input type="text" name="SiblingName2" value="{{ old('SiblingName2') }}" placeholder="Sibling Name 2" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Relation 2: *</label>
                                                <input type="text" name="SiblingRelation2" value="{{ old('SiblingRelation2') }}" placeholder="Sibling Relation 2" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Age 2: *</label>
                                                <input type="text" name="SiblingAge2" value="{{ old('SiblingAge2') }}" placeholder="Sibling Age 2" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Occupation 2: *</label>
                                                <input type="text" name="SiblingOccupation2" value="{{ old('SiblingOccupation2') }}" placeholder="Sibling Occupation 2" />
                                            </div>
                                            <div class="col-12">
                                                <label class="fieldlabels">Sibling Mobile 2: *</label>
                                                <input type="text" name="SiblingMobile2" value="{{ old('SiblingMobile2') }}" placeholder="Sibling Mobile 2" />
                                            </div>



                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Name 3: *</label>
                                                <input type="text" name="SiblingName3" value="{{ old('SiblingName3') }}" placeholder="Sibling Name 3" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Relation 3: *</label>
                                                <input type="text" name="SiblingRelation3" value="{{ old('SiblingRelation3') }}" placeholder="Sibling Relation 3" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Age 3: *</label>
                                                <input type="text" name="SiblingAge3" value="{{ old('SiblingAge3') }}" placeholder="Sibling Age 3" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Occupation 3: *</label>
                                                <input type="text" name="SiblingOccupation3" value="{{ old('SiblingOccupation3') }}" placeholder="Sibling Occupation 3" />
                                            </div>
                                            <div class="col-12">
                                                <label class="fieldlabels">Sibling Mobile 3: *</label>
                                                <input type="text" name="SiblingMobile3" value="{{ old('SiblingMobile3') }}" placeholder="Sibling Mobile 3" />
                                            </div>




                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Name 4: *</label>
                                                <input type="text" name="SiblingName4" value="{{ old('SiblingName4') }}" placeholder="Sibling Name 4" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Relation 4: *</label>
                                                <input type="text" name="SiblingRelation4" value="{{ old('SiblingRelation4') }}" placeholder="Sibling Relation 4" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Age 4: *</label>
                                                <input type="text" name="SiblingAge4" value="{{ old('SiblingAge4') }}" placeholder="Sibling Age 4" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Occupation 4: *</label>
                                                <input type="text" name="SiblingOccupation4" value="{{ old('SiblingOccupation4') }}" placeholder="Sibling Occupation 4" />
                                            </div>
                                            <div class="col-12">
                                                <label class="fieldlabels">Sibling Mobile 4: *</label>
                                                <input type="text" name="SiblingMobile4" value="{{ old('SiblingMobile4') }}" placeholder="Sibling Mobile 4" />
                                            </div>




                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Name 5: *</label>
                                                <input type="text" name="SiblingName5" value="{{ old('SiblingName5') }}" placeholder="Sibling Name 5" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Relation 5: *</label>
                                                <input type="text" name="SiblingRelation5" value="{{ old('SiblingRelation5') }}" placeholder="Sibling Relation 5" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Age 5: *</label>
                                                <input type="text" name="SiblingAge5" value="{{ old('SiblingAge5') }}" placeholder="Sibling Age 5" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Occupation 5: *</label>
                                                <input type="text" name="SiblingOccupation5" value="{{ old('SiblingOccupation5') }}" placeholder="Sibling Occupation 5" />
                                            </div>
                                            <div class="col-12">
                                                <label class="fieldlabels">Sibling Mobile 5: *</label>
                                                <input type="text" name="SiblingMobile5" value="{{ old('SiblingMobile5') }}" placeholder="Sibling Mobile 5" />
                                            </div>



                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Name 6: *</label>
                                                <input type="text" name="SiblingName6" value="{{ old('SiblingName6') }}" placeholder="Sibling Name 6" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Relation 6: *</label>
                                                <input type="text" name="SiblingRelation6" value="{{ old('SiblingRelation6') }}" placeholder="Sibling Relation 6" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Age 6: *</label>
                                                <input type="text" name="SiblingAge6" value="{{ old('SiblingAge6') }}" placeholder="Sibling Age 6" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Occupation 6: *</label>
                                                <input type="text" name="SiblingOccupation6" value="{{ old('SiblingOccupation6') }}" placeholder="Sibling Occupation 6" />
                                            </div>
                                            <div class="col-12">
                                                <label class="fieldlabels">Sibling Mobile 6: *</label>
                                                <input type="text" name="SiblingMobile6" value="{{ old('SiblingMobile6') }}" placeholder="Sibling Mobile 6" />
                                            </div>



                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Name 7: *</label>
                                                <input type="text" name="SiblingName7" value="{{ old('SiblingName7') }}" placeholder="Sibling Name 7" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Relation 7: *</label>
                                                <input type="text" name="SiblingRelation7" value="{{ old('SiblingRelation7') }}" placeholder="Sibling Relation 7" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Age 7: *</label>
                                                <input type="text" name="SiblingAge7" value="{{ old('SiblingAge7') }}" placeholder="Sibling Age 7" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Occupation 7: *</label>
                                                <input type="text" name="SiblingOccupation7" value="{{ old('SiblingOccupation7') }}" placeholder="Sibling Occupation 7" />
                                            </div>
                                            <div class="col-12">
                                                <label class="fieldlabels">Sibling Mobile 7: *</label>
                                                <input type="text" name="SiblingMobile7" value="{{ old('SiblingMobile7') }}" placeholder="Sibling Mobile 7" />
                                            </div>



                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Name 8: *</label>
                                                <input type="text" name="SiblingName8" value="{{ old('SiblingName8') }}" placeholder="Sibling Name 8" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Relation 8: *</label>
                                                <input type="text" name="SiblingRelation8" value="{{ old('SiblingRelation8') }}" placeholder="Sibling Relation 8" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Age 8: *</label>
                                                <input type="text" name="SiblingAge8" value="{{ old('SiblingAge8') }}" placeholder="Sibling Age 8" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Sibling Occupation 8: *</label>
                                                <input type="text" name="SiblingOccupation8" value="{{ old('SiblingOccupation8') }}" placeholder="Sibling Occupation 8" />
                                            </div>
                                            <div class="col-12">
                                                <label class="fieldlabels">Sibling Mobile 8: *</label>
                                                <input type="text" name="SiblingMobile8" value="{{ old('SiblingMobile8') }}" placeholder="Sibling Mobile 8" />
                                            </div>


                                        </div>
                                       

                                    </div>
                                    <!-- <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                                </fieldset>

                                <fieldset>
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
                                                <input type="text" name="EmergencyName" value="{{ old('EmergencyName') }}" placeholder="Emergency Name" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Emergency Relationship: *</label>
                                                <input type="text" name="EmergencyRelationship" value="{{ old('EmergencyRelationship') }}" placeholder="Emergency Relationship" />
                                            </div>
                                            <div class="col-6">
                                                <label class="fieldlabels">Emergency Physical Address: *</label>
                                                <input type="text" name="EmergencyPhysicalAddress" value="{{ old('EmergencyPhysicalAddress') }}" placeholder="Emergency Physical Address" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Emergency P.O.Box : *</label>
                                                <input type="text" name="EmergencyPoBox" value="{{ old('EmergencyPoBox') }}" placeholder="Emergency P.O.Box" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Emergency Telephone: *</label>
                                                <input type="text" name="EmergencyTelephone" value="{{ old('EmergencyTelephone') }}" placeholder="Emergency Telephone" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Emergency Mobile: *</label>
                                                <input type="text" name="EmergencyMobile" value="{{ old('EmergencyMobile') }}" placeholder="Emergency Mobile" />
                                            </div>
                                            <div class="col-3">
                                                <label class="fieldlabels">Emergency Email: *</label>
                                                <input type="text" name="EmergencyEmail" value="{{ old('EmergencyEmail') }}" placeholder="Emergency Email" />
                                            </div>



                                        </div>
                                        <!-- 
                                        <button type="submit" class="btn btn-success rounded-0">Submit</button>

                                    </form> -->

                                    </div>
                                    <!-- <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                                </fieldset>

                                <fieldset>
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
                                                <input type="text" name="Type1" value="{{ old('Type1') }}" placeholder="Type 1" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Size/Quantity 1: *</label>
                                                <input type="text" name="Size1" value="{{ old('Size1') }}" placeholder="Size 1" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Location 1: *</label>
                                                <input type="text" name="Location1" value="{{ old('Location1') }}" placeholder="Location 1" />
                                            </div>


                                            <div class="col-4">
                                                <label class="fieldlabels">Type of Property/Animals 2: *</label>
                                                <input type="text" name="Type2" value="{{ old('Type2') }}" placeholder="Type 2" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Size/Quantity 2: *</label>
                                                <input type="text" name="Size2" value="{{ old('Size2') }}" placeholder="Size 2" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Location 2: *</label>
                                                <input type="text" name="Location2" value="{{ old('Location2') }}" placeholder="Location 2" />
                                            </div>


                                            <div class="col-4">
                                                <label class="fieldlabels">Type of Property/Animals 3: *</label>
                                                <input type="text" name="Type3" value="{{ old('Type3') }}" placeholder="Type 3" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Size/Quantity 3: *</label>
                                                <input type="text" name="Size3" value="{{ old('Size3') }}" placeholder="Size 3" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Location 3: *</label>
                                                <input type="text" name="Location3" value="{{ old('Location3') }}" placeholder="Location 3" />
                                            </div>


                                            <div class="col-4">
                                                <label class="fieldlabels">Type of Property/Animals 4: *</label>
                                                <input type="text" name="Type4" value="{{ old('Type4') }}" placeholder="Type 4" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Size/Quantity 4: *</label>
                                                <input type="text" name="Size4" value="{{ old('Size4') }}" placeholder="Size 4" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Location 4: *</label>
                                                <input type="text" name="Location4" value="{{ old('Location4') }}" placeholder="Location 4" />
                                            </div>


                                            <div class="col-4">
                                                <label class="fieldlabels">Type of Property/Animals 5: *</label>
                                                <input type="text" name="Type5" value="{{ old('Type5') }}" placeholder="Type 5" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Size/Quantity 5: *</label>
                                                <input type="text" name="Size5" value="{{ old('Size5') }}" placeholder="Size 5" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Location 5: *</label>
                                                <input type="text" name="Location5" value="{{ old('Location5') }}" placeholder="Location 5" />
                                            </div>


                                            <div class="col-4">
                                                <label class="fieldlabels">Type of Property/Animals 6: *</label>
                                                <input type="text" name="Type6" value="{{ old('Type6') }}" placeholder="Type 6" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Size/Quantity 6: *</label>
                                                <input type="text" name="Size6" value="{{ old('Size6') }}" placeholder="Size 6" />
                                            </div>
                                            <div class="col-4">
                                                <label class="fieldlabels">Location 6: *</label>
                                                <input type="text" name="Location6" value="{{ old('Location6') }}" placeholder="Location 6" />
                                            </div>




                                        </div>
                                        

                                    </div>
                                    <!-- <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                                </fieldset>

                                <button class="btn btn-success w-100" type="submit">Submit</button>
                            </form>

                            <!-- <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Finish:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step </h2>
                                        </div>
                                    </div> <br><br>
                                    <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset> -->
                        </section>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @include('clerk.partials.footer')
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