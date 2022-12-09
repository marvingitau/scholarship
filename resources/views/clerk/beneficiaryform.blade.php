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
                        <h2 id="heading">High school Application Form</h2>
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
                                                <!-- @if (session('personal_status'))
                                                <div class="alert alert-success">
                                                    {{ session('personal_status') }}
                                                </div>
                                                @endif -->
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
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="fieldlabels">First Name: *</label>
                                                <input type="text" name="firstname" value="{{ old('firstname') }}" placeholder="First Name" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="fieldlabels">Middle Name: </label>
                                                <input type="text" name="middlename" value="{{ old('middlename') }}" placeholder="Middle Name" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="fieldlabels">Last Name: *</label>
                                                <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="fieldlabels">Gender: </label>
                                                <select name="gender" value="">

                                                    <option value="">Choose</option>
                                                    <option value="MALE" <?php echo old('gender') == "MALE" ? 'selected' : "" ?>>MALE</option>
                                                    <option value="FEMALE" <?php echo old('gender') == "FEMALE" ? 'selected' : "" ?>>FEMALE</option>
                                                </select>
                                                @error('gender')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="fieldlabels">Date of Birth: </label>
                                                <input type="date" name="DOB" value="{{ old('DOB') }}" placeholder="Age" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="fieldlabels">Active Email:* </label>
                                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Active Email" required/>
                                                @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- <div class="col-md-4"></div> -->
                                        </div>

                                        <!-- <label class="fieldlabels">Age: </label>
                                        <input type="text" name="age" value="{{ old('age') }}" placeholder="Age" /> -->


                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="fieldlabels">KCPE Index: </label>
                                                <input type="text" name="KCPEIndex" value="{{ old('KCPEIndex') }}" placeholder="KCPE Index" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Secondary Admitted: </label>
                                                <input type="text" name="SecondaryAdmitted" value="{{ old('SecondaryAdmitted') }}" placeholder="Secondary Admitted" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Current Form: </label>
                                                <input type="text" name="CurrentForm" value="{{ old('CurrentForm') }}" placeholder="Current Form" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Form Joining: </label>
                                                <input type="text" name="FormJoining" value="{{ old('FormJoining') }}" placeholder="Form Joining" />
                                            </div>
                                           
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Expected Term1 Fees: </label>
                                                <input type="number" name="TermOneFee" value="{{ old('TermOneFee') }}" placeholder="Term1 Fees" required/>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Expected Term2 Fees: </label>
                                                <input type="number" name="TermTwoFee" value="{{ old('TermTwoFee') }}" placeholder="Term2 Fees" required/>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Expected Term3 Fees: </label>
                                                <input type="number" name="TermThreeFee" value="{{ old('TermThreeFee') }}" placeholder="Term3 Fees" required/>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Expected Annual Fees: </label>
                                                <input type="number" name="SchoolFees" value="{{ old('SchoolFees') }}" placeholder="School Fees" />
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Current Address: </label>
                                                <input type="text" name="CurrentAddress" value="{{ old('CurrentAddress') }}" placeholder="Current Address" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">P.O. Box: </label>
                                                <input type="text" name="PoBox" value="{{ old('PoBox') }}" placeholder="P.O. Box" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Postal Code: </label>
                                                <input type="text" name="PostalCode" value="{{ old('PostalCode') }}" placeholder="Postal Code" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">City/Town: </label>
                                                <input type="text" name="CityTown" value="{{ old('CityTown') }}" placeholder="City/Town" />
                                            </div>

                                            <!-- <div class="col-3">
                                                <label class="fieldlabels">Guardian Telephone: </label>
                                                <input type="text" name="TelephoneGuardian" value="{{ old('TelephoneGuardian') }}" class="@error('TelephoneGuardian') is-invalid @enderror" value="{{ old('TelephoneGuardian') }}" placeholder="Guardian Telephone" />
                                                @error('TelephoneGuardian')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-3">
                                                <label class="fieldlabels">Guardian Email: </label>
                                                <input type="text" name="EmailGuardian" class="@error('EmailGuardian') is-invalid @enderror" value="{{ old('EmailGuardian') }}" placeholder="Guardian Guardian" />
                                                @error('EmailGuardian')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div> -->

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Church Name: </label>
                                                <input type="text" name="churchname" value="{{ old('churchname') }}" placeholder="Church Name" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Pastor Name: </label>
                                                <input type="text" name="pastorname" value="{{ old('pastorname') }}" placeholder="Pastor Name" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Pastor/Church Mobile: </label>
                                                <input type="text" name="pastortelephone" value="{{ old('pastortelephone') }}" placeholder="Pastor/Church Mobile" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Have another Sponsor: </label>
                                                <select name="AnotherSponsorship">
                                                    <option value="">Choose</option>
                                                    <option value="YES" <?php echo old('AnotherSponsorship') == "YES" ? 'selected' : "" ?>>YES</option>
                                                    <option value="NO" <?php echo old('AnotherSponsorship') == "NO" ? 'selected' : "" ?>>NO</option>
                                                </select>
                                                @error('AnotherSponsorship')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label class="fieldlabels">Have another Sponsor Remark: </label>
                                                <textarea name="AnotherSponsorshipRemark" id="" cols="30" rows="3">{{ old('AnotherSponsorshipRemark') }}</textarea>
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
                                            <div class="col-md-7">
                                                <h2 class="fs-title">Academic Information:</h2>
                                            </div>
                                            <div class="col-md-5">
                                                <h2 class="steps">Step 2 - 7</h2>
                                            </div>
                                        </div>


                                        <div class="academic_repeater">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="fieldlabels">Subject : </label>
                                                    <input type="text" name="Subject1[]" placeholder="Subject"  />
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="fieldlabels">Marks/Grade : </label>
                                                    <input type="number" name="Marks1[]" placeholder="Marks"  />

                                                </div>
                                                <div class="col-md-2">
                                                    <label class="fieldlabels">Action</label>
                                                    <button class="add_academic_button btn btn-outline-success" style="font-weight: 500;margin:0px">Add Subject</button>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="fieldlabels">Total Marks/Grade</label>
                                                <input type="text" name="TotalMarks" value="{{ old('TotalMarks') }}" placeholder="Total Marks" />
                                            </div>
                                            <!-- @error('Marks1')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror -->
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
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Father: *</label>
                                                <input type="text" name="Father" value="{{ old('Father') }}" placeholder="Father" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Fathe ID: *</label>
                                                <input type="text" name="FatherID" value="{{ old('FatherID') }}" placeholder="Father ID" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Father Mobile: *</label>
                                                <input type="text" name="FatherMobile" value="{{ old('FatherMobile') }}" placeholder="Father Mobile" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Father Occupation: *</label>
                                                <input type="text" name="FatherOccupation" value="{{ old('FatherOccupation') }}" placeholder="Father Occupation" />
                                            </div>

                                            <div class="col-md-3">
                                                <label class="fieldlabels">Mother: *</label>
                                                <input type="text" name="Mother" value="{{ old('Mother') }}" placeholder="Mother" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Mother ID: *</label>
                                                <input type="text" name="MotherID" value="{{ old('MotherID') }}" placeholder="Mother ID" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Mother Mobile: *</label>
                                                <input type="text" name="MotherMobile" value="{{ old('MotherMobile') }}" placeholder="Mother Mobile" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Mother Occupation: *</label>
                                                <input type="text" name="MotherOccupation" value="{{ old('MotherOccupation') }}" placeholder="Mother Occupation" />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="fieldlabels">If Applicable</label>

                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Guardian Name: *</label>
                                                <input type="text" name="Guardian" value="{{ old('Guardian') }}" placeholder="Guardian" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Guardian ID: *</label>
                                                <input type="text" name="GuardianID" value="{{ old('GuardianID') }}" placeholder="Guardian ID" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Guardian Mobile: *</label>
                                                <input type="text" name="GuardianMobile" value="{{ old('GuardianMobile') }}" placeholder="Guardian Mobile" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fieldlabels">Guardian Occupation:*</label>
                                                <input type="text" name="GuardianOccupation" value="{{ old('GuardianOccupation') }}" placeholder="Guardian Occupation" />
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
                                                <textarea name="StatementofNeed" cols="30" rows="5">{{ old('StatementofNeed') }}</textarea>
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

                                        <div class="sibling_repeater">
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <label class="fieldlabels">Sibling Name</label>
                                                    <input type="text" name="SiblingName1[]" placeholder="Sibling Name" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="fieldlabels">Sibling Relation</label>
                                                    <input type="text" name="SiblingRelation1[]" placeholder="Sibling Relation" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="fieldlabels">Sibling Age</label>
                                                    <input type="text" name="SiblingAge1[]" placeholder="Sibling Age" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="fieldlabels">Sibling Occupation</label>
                                                    <input type="text" name="SiblingOccupation1[]" placeholder="Sibling Occupation" />
                                                </div>
                                                <!-- <div class="col-md-10">
                                                    <label class="fieldlabels">Sibling Mobile</label>
                                                    <input type="text" name="SiblingMobile1[]" placeholder="Sibling Mobile" />
                                                </div> -->
                                                <div class="col-md-2">
                                                    <label class="fieldlabels">Action</label>
                                                    <button class="add_sibling_button btn btn-outline-success" style="font-weight: 500;margin:0px">Add Sibling </button>
                                                </div>


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

                                <!-- <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Family Property Information:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 7 - 7</h2>
                                            </div>
                                        </div>

                                        <div class="property_repeater">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="fieldlabels">Type of Property/Animals</label>
                                                    <input type="text" name="Type1[]" placeholder="Type " />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="fieldlabels">Size/Quantity</label>
                                                    <input type="text" name="Size1[]" placeholder="Size " />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="fieldlabels">Location:</label>
                                                    <input type="text" name="Location1[]" placeholder="Location " />
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="fieldlabels">Action</label>
                                                    <button class="add_property_button btn btn-outline-success" style="font-weight: 500;margin:0px">Add Property </button>
                                                </div>

                                            </div>
                                        </div>



                                    </div>
                                   
                                </fieldset> -->

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
    /* #heading {
        text-transform: uppercase;
        color: #673AB7;
        font-weight: normal
    } */
    #heading {
        text-transform: uppercase;
        color: #575360;
        font-weight: normal;
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
        /* background-color: #ffffff; */
        background-color: #ECEFF1;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        /* border: 1px solid #F00; */
        border: 1px solid #673AB7;
        outline-width: 0
    }

    #msform input:focus-visible,
    #msform textarea:focus-visible {
        border: none;
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
        color: #000;
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
        text-align: left;
        font-weight: bold;
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


        //ACADEMIC REPEATER
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".academic_repeater"); //Fields wrapper
        var add_button = $(".add_academic_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row"><div class="col-md-5"><label class="fieldlabels">Subject : </label><input type="text" name="Subject1[]"  placeholder="Subject" required /></div><div class="col-md-5"><label class="fieldlabels">Marks : </label><input type="number" name="Marks1[]"  placeholder="Marks" required /></div><div class="col-md-2"> <label class="fieldlabels">Action </label><button class="btn btn-outline-danger remove_field" type="button">Remove</button></div></div>'); //add input box
            }
        })

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        })

        //SIBLING REPEATER
        // var max_fields = 10; //maximum input boxes allowed
        var wrapper2 = $(".sibling_repeater"); //Fields wrapper
        var add_button2 = $(".add_sibling_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button2).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper2).append('<div class="row"><div class="col-md-3"><label class="fieldlabels">Sibling Name</label><input type="text" name="SiblingName1[]"placeholder="Sibling Name" /></div><div class="col-md-3"><label class="fieldlabels">Sibling Relation</label><input type="text" name="SiblingRelation1[]"  placeholder="Sibling Relation" /></div><div class="col-md-3"><label class="fieldlabels">Sibling Age</label><input type="text" name="SiblingAge1[]"  placeholder="Sibling Age" /></div><div class="col-md-3"><label class="fieldlabels">Sibling Occupation</label><input type="text" name="SiblingOccupation1[]"  placeholder="Sibling Occupation" /></div><div class="col-md-2"> <label class="fieldlabels">Action </label><button class="btn btn-outline-danger remove_sibling_field" type="button">Remove</button></div></div>'); //add input box
            }
        })

        $(wrapper2).on("click", ".remove_sibling_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        })


        //PROPERTY REPEATER
        // var max_fields = 10; //maximum input boxes allowed
        var wrapper3 = $(".property_repeater"); //Fields wrapper
        var add_button3 = $(".add_property_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button3).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper3).append('<div class="row"><div class="col-md-4"><label class="fieldlabels">Type of Property/Animals</label><input type="text" name="Type1[]"  placeholder="Type " /></div><div class="col-md-3"><label class="fieldlabels">Size/Quantity</label><input type="text" name="Size1[]"  placeholder="Size " /></div><div class="col-md-3"><label class="fieldlabels">Location:</label><input type="text" name="Location1[]"  placeholder="Location " /></div><div class="col-md-2"> <label class="fieldlabels">Action </label><button class="btn btn-outline-danger remove_property_field" type="button">Remove</button></div></div>'); //add input box
            }
        })

        $(wrapper3).on("click", ".remove_property_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        })

    });
</script>
@endsection