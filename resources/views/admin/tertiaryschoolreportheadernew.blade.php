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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">New Institute Academic Result</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <!-- Content card -->
            <div class="row">
                <div class="col-12">
                    @if (session('reportuploaded'))
                    <div class="alert alert-success">
                        {{ session('reportuploaded') }}
                    </div>
                    @endif
                </div>
                <div class="col-12">
                    @if (session('errfee'))
                    <div class="alert alert-danger">
                        {{ session('errfee') }}
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
            <div class="card">
                <form action="{{route('admin.postschoolreport')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
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
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Year</label>
                                <select class="form-control year-selector" name="form">
                                    <option value="">Choose Year</option>
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
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Term</label>
                                <select class="form-control year-selector" name="term" required>
                                    <option value="1st Term/Semester">1st Term/Semester</option>
                                    <option value="2nd Term/Semester">2nd Term/Semester</option>
                                    <option value="3rd Term/Semester">3rd Term/Semester</option>
                                    <option value="Yearly Report">Yearly Report</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Mean Grade/Total Marks</label>
                                <input type="text" class="form-control" name="meangrade" required>
                            </div>
                        </div>

                    </div>

                    <div class="academic_repeater p-2">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="">Subject : </label>
                                    <input type="text" name="Subject1[]" class="form-control" placeholder="Subject/Unit" />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="">Marks/Grade : </label>
                                    <input type="text" name="Marks1[]" class="form-control" placeholder="Marks/Grade" />
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">

                                    <label class="fieldlabels">Action</label>
                                    <button class="add_academic_button btn btn-outline-success" style="font-weight: 500;margin:0px">Add Subject</button>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="row p-2">
                        <div class="col-12">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    @include('admin.partials.footer')
</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // $('.scholar-sector').select2();
        // $('.year-selector').select2();

        //ACADEMIC REPEATER
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".academic_repeater"); //Fields wrapper
        var add_button = $(".add_academic_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row"><div class="col-md-5"><div class="form-group"><label class="fieldlabels">Subject : </label><input type="text" name="Subject1[]" class="form-control" placeholder="Subject/Unit" required /></div></div><div class="col-md-5"><div class="form-group"><label class="fieldlabels">Marks : </label><input type="text" name="Marks1[]" class="form-control" placeholder="Marks" required /></div></div><div class="col-md-2"> <div class="form-group d-flex flex-column"><label class="fieldlabels">Action </label><button class="btn btn-outline-danger remove_field" type="button">Remove</button></div></div></div>'); //add input box
            }
        })

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        })

    });
</script>
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection