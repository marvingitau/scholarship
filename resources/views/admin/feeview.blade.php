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
                <h1 class="h3 mb-0 text-gray-800">Fee</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <!-- Content card -->

            <div class="card">

                <div class="row p-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="text" class="form-control" value="{{$dis->date}}" disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Term</label>
                            <input type="text" name="term" class="form-control" value="{{$dis->term}} " disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" name="amount" class="form-control" value="{{$dis->amount}} " disabled>
                        </div>
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
@endsection
@section('style')
@endsection