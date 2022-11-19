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
                <h1 class="h3 mb-0 text-gray-800">New Academic Result</h1>
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
                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Year</label>
                                <select class="form-control year-selector" name="year" disabled>

                                    <option>{{$reporthead->year}}</option>

                                </select>

                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Form</label>
                                <select class="form-control year-selector" name="form" disabled>
                                    <option value="">{{$reporthead->form}}</option>

                                </select>

                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Term</label>
                                <select class="form-control year-selector" name="term" disabled>
                                    <option value="">{{$reporthead->term}}</option>

                                </select>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Mean Grade/Total Marks</label>
                                <input type="text" class="form-control" name="meangrade" value="{{$reporthead->meangrade}}" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="academic_repeater p-2">
                        <div class="row">
                            @if($reportlist)
                            @foreach($reportlist as $item)
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="">Subject : </label>
                                    <input type="text" name="Subject1[]" value="{{$item['Subject1']}}" class="form-control" placeholder="Subject/Unit" />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="">Marks/Grade : </label>
                                    <input type="text" name="Marks1[]" value="{{$item['Grade']}}" class="form-control" placeholder="Marks/Grade" />
                                </div>

                            </div>
                            @endforeach
                            @endif
                        </div>



                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="row">
                        <a href="{{route('admin.viewschoolslip',$reporthead->id)}}" class="btn btn-danger"> View Slip</a>
                    </div>
                </div>



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
        // var max_fields = 10; //maximum input boxes allowed
        // var wrapper = $(".academic_repeater"); //Fields wrapper
        // var add_button = $(".add_academic_button"); //Add button ID

        // var x = 1; //initlal text box count
        // $(add_button).click(function(e) { //on add input button click
        //     e.preventDefault();
        //     if (x < max_fields) { //max input box allowed
        //         x++; //text box increment
        //         $(wrapper).append('<div class="row"><div class="col-md-5"><div class="form-group"><label class="fieldlabels">Subject : </label><input type="text" name="Subject1[]" class="form-control" placeholder="Subject/Unit" required /></div></div><div class="col-md-5"><div class="form-group"><label class="fieldlabels">Marks : </label><input type="text" name="Marks1[]" class="form-control" placeholder="Marks" required /></div></div><div class="col-md-2"> <div class="form-group d-flex flex-column"><label class="fieldlabels">Action </label><button class="btn btn-outline-danger remove_field" type="button">Remove</button></div></div></div>'); //add input box
        //     }
        // })

        // $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        //     e.preventDefault();
        //     $(this).parent('div').parent('div').remove();
        //     x--;
        // })

    });
</script>
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection