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
                <h1 class="h3 mb-0 text-gray-800">Filter the Report</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <!-- Content card -->
            <div class="row">
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
            <div class="card">
                <form action="{{route('committee.postviewreport')}}" method="GET">
                

                    <div class="row p-2">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Year</label>
                                <select class="form-control year-selector" name="year" required>
                                    <?php
                                    for ($year = (int)date('Y'); 2019 <= $year; $year--) : ?>
                                        <option value="<?= $year; ?>"><?= $year; ?></option>
                                    <?php endfor; ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">School Type</label>
                                <!-- <input type="text" class="form-control" name="yearlyfee" value="" > -->
                                <select name="Type" id="" class="form-control" onchange="filtedDisplay(this)" id="schooltype">
                                    <option value="SECONDARY APPLICANTS">SECONDARY APPLICANTS</option>
                                    <option value="TERTIARY APPLICANTS">TERTIARY APPLICANTS</option>
                                    <option value="SPECIAL APPLICANT">SPECIAL APPLICANT</option>
                                    <option value="THEOLOGY APPLICANTS">THEOLOGY APPLICANTS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" id="highSchoolInp">
                            <div class="form-group">
                                <label for="">Class (High School Applicable)</label>
                                <!-- <input type="text" class="form-control" value="" placeholder="Term 1 Fee" > -->
                                <select name="form" id="" class="form-control">
                                    <option value="Form 1">Form One</option>
                                    <option value="Form 2">Form Two</option>
                                    <option value="Form 3">Form Three</option>
                                    <option value="Form 4">Form Four</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4" id="tertiaryInp">
                            <div class="form-group">
                                <label for="">Year (Tertiary,Special,Theology Applicable)</label>
                                <!-- <input type="text" class="form-control" value="" placeholder="Term 1 Fee" > -->
                                <select name="academicyear" id="" class="form-control">
                                    <option value="Year 1">Year One</option>
                                    <option value="Year 2">Year Two</option>
                                    <option value="Year 3">Year Three</option>
                                    <option value="Year 4">Year Four</option>
                                    <option value="Year 5">Year Five</option>
                                    <option value="Year 6">Year Six</option>
                                    <option value="Year 7">Year Seven</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Term</label>
                                <select name="term" id="" class="form-control">
                                    <!-- <option value="">Select Term</option> -->
                                    <option value="1st Term/Semester">1st Term/Semester</option>
                                    <option value="2nd Term/Semester">2nd Term/Semester</option>
                                    <option value="3rd Term/Semester">3rd Term/Semester</option>
                                    <!-- <option value="Yearly Report">Yearly Report</option> -->
                                </select>
                                <!-- <input type="text" name="term"  placeholder="Term" required> -->
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    @include('committee.partials.footer')
</div>

@endsection
@section('script')
<script>
    // document.getElementById("tertiaryInp").style.display = "none";
    $(document).ready(function() {
       $('#tertiaryInp').hide();
       $('#schooltype').attr('value','SECONDARY APPLICANTS')

    });
    function filtedDisplay(arg) {
        // console.log(arg.value);
        if (arg.value !== "SECONDARY APPLICANTS") {
            document.getElementById("tertiaryInp").style.display = "block";
            document.getElementById("highSchoolInp").style.display = "none";
        } else {
            document.getElementById("tertiaryInp").style.display = "none";
            document.getElementById("highSchoolInp").style.display = "block";
        }
    }
</script>
@endsection
@section('style')
@endsection