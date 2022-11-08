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
                <h1 class="h3 mb-0 text-gray-800">Beneficiary Form</h1>
            </div>

            <div class="row justify-content-center">
                <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10 text-center p-0 mt-3 mb-2">
                    <div class="card px-2 pt-4 pb-0 mt-3 mb-3">
                        <h2 id="heading">Beneficiary Applicant Form</h2>
                        <!-- <p>Fill all form field to go to next step</p> -->
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
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
                            </div> <br> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Account Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 1 - 7</h2>
                                        </div>
                                    </div>
                                    <label class="fieldlabels">First Name: *</label>
                                    <input type="text" name="firstname" placeholder="First Name" />

                                    <label class="fieldlabels">Middle Name: </label>
                                    <input type="text" name="middlename" placeholder="Middle Name" />

                                    <label class="fieldlabels">Last Name: *</label>
                                    <input type="text" name="lastname" placeholder="Last Name" />

                                    <label class="fieldlabels">Gender: </label>
                                    <select name="gender">
                                        <option value="">Choose</option>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMAL</option>
                                    </select>

                                    <label class="fieldlabels">Age: </label>
                                    <input type="text" name="age" placeholder="Age" />

                                    <label class="fieldlabels">Date of Birth: </label>
                                    <input type="date" name="DOB" placeholder="Age" />
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="fieldlabels">KCPE Index: </label>
                                            <input type="text" name="KCPEIndex" placeholder="KCPE Index" />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Secondary Admitted: </label>
                                            <input type="text" name="SecondaryAdmitted" placeholder="Secondary Admitted" />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Current Form: </label>
                                            <input type="text" name="CurrentForm" placeholder="Current Form" />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Form Joining: </label>
                                            <input type="text" name="FormJoining" placeholder="Form Joining" />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Current Address: </label>
                                            <input type="text" name="CurrentAddress" placeholder="Current Address" />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">P.O. Box: </label>
                                            <input type="text" name="PoBox" placeholder="P.O. Box" />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Postal Code: </label>
                                            <input type="text" name="PostalCode" placeholder="Postal Code" />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">City/Town: </label>
                                            <input type="text" name="CityTown" placeholder="City/Town" />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Guardian Telephone: </label>
                                            <input type="text" name="TelephoneGuardian" placeholder="Guardian Telephone" />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Guardian Guardian: </label>
                                            <input type="text" name="EmailGuardian" placeholder="Guardian Guardian" />
                                        </div>

                                        <div class="col-3">
                                            <label class="fieldlabels">Have another Sponsor: </label>
                                            <select name="AnotherSponship">
                                                <option value="">Choose</option>
                                                <option value="MALE">YES</option>
                                                <option value="FEMALE">NO</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                        <label class="fieldlabels">Have another Sponsor Remark: </label>
                                        <textarea name="AnotherSponshipRemark" id="" cols="30" rows="10"></textarea>
                                        </div>


                                    </div>

                                </div>
                                <input type="button" name="next" class="next action-button" value="Next" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Personal Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 2 - 4</h2>
                                        </div>
                                    </div> <label class="fieldlabels">First Name: *</label> <input type="text" name="fname" placeholder="First Name" /> <label class="fieldlabels">Last Name: *</label> <input type="text" name="lname" placeholder="Last Name" /> <label class="fieldlabels">Contact No.: *</label> <input type="text" name="phno" placeholder="Contact No." /> <label class="fieldlabels">Alternate Contact No.: *</label> <input type="text" name="phno_2" placeholder="Alternate Contact No." />
                                </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Image Upload:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 3 - 4</h2>
                                        </div>
                                    </div> <label class="fieldlabels">Upload Your Photo:</label> <input type="file" name="pic" accept="image/*"> <label class="fieldlabels">Upload Signature Photo:</label> <input type="file" name="pic" accept="image/*">
                                </div> <input type="button" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Finish:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 4 - 4</h2>
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
                            </fieldset>
                        </form>
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
        display: none
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