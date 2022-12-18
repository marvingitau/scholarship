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

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('committee.approvedbeneficiaries')}}">Scholarship List</a></li>
                    <li class="breadcrumb-item"><a href="{{route('committee.beneficiaryfee',$dis->beneficiary_id)}}">Fee Ledger</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Fee Data</li>
                </ol>
            </nav>

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><b>{{$yearfee->beneficiary}}</b> Fee Payment for Year <b>{{$dis->year}}</b></h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <!-- Content card -->

            <div class="card">

                <div class="row p-2">
                <div class="col-6">
                            <div class="form-group">
                                <label for="">Pending Yearly Required Fee</label>
                                <input type="text" class="form-control"  name="yearlyfee" value="{{number_format($pendingfee, 2, '.', ',') }}" disabled>
                            </div>
                        </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Year</label>
                            <input type="text" class="form-control" value="{{$dis->year}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 text-danger">
                        <h4>Expected By School</h4>
                    </div>
                    <div class="col-4 ">
                        <div class="form-group text-danger">
                            <label for="">Term 1</label>
                            <input type="text" name="term" class="form-control  border-danger" value="{{number_format($yearfee->expectedterm1, 2, '.', ',')}} " disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group text-danger">
                            <label for="">Term 2</label>
                            <input type="text" name="term" class="form-control border-danger" value="{{number_format($yearfee->expectedterm2, 2, '.', ',')}} " disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group text-danger">
                            <label for="">Term 3</label>
                            <input type="text" name="term" class="form-control border-danger" value="{{number_format($yearfee->expectedterm3, 2, '.', ',')}} " disabled>
                        </div>
                    </div>
                    <div class="col-md-12 text-success">
                        <h4>Paid Fee</h4>
                    </div>
                    <div class="col-4">
                        <div class="form-group text-success">
                            <label for="">Term 1</label>
                            <input type="text" name="term" class="form-control border-success" value="{{number_format($dis->term1, 2, '.', ',')}} " disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group text-success">
                            <label for="">Term 2</label>
                            <input type="text" name="term" class="form-control border-success" value="{{number_format($dis->term2, 2, '.', ',')}} " disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group text-success">
                            <label for="">Term 3</label>
                            <input type="text" name="term" class="form-control border-success" value="{{number_format($dis->term3, 2, '.', ',')}} " disabled>
                        </div>
                    </div>
                  
                   
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    @include('committee.partials.footer')
</div>

@endsection
@section('script')
@endsection
@section('style')
@endsection