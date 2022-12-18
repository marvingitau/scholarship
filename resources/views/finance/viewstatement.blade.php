@extends('layouts.finance')
@section('content')


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!--  Topbar -->
        @include('finance.partials.topnav')
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">



            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ucwords($feestruture->beneficiary) }} Fee Info</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <!-- Content card -->

            <div class="card">

                <div class="row p-2">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Allocated</label>
                            <input type="text" class="form-control" value="{{number_format($feestruture->AllocatedYealyFee, 2, '.', ',') }}" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Year</label>
                            <input type="text" class="form-control" value="{{$feestruture->year}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <h4>Expected By School <b>[ {{$feestruture->school}}]</b></h4>
                    </div>
                    <div class="col-4 ">
                        <div class="form-group ">
                            <label for="">Term 1</label>
                            <input type="text" name="term" class="form-control" value="{{number_format($feestruture->expectedterm1, 2, '.', ',')}} " disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group ">
                            <label for="">Term 2</label>
                            <input type="text" name="term" class="form-control" value="{{number_format($feestruture->expectedterm2, 2, '.', ',')}} " disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group ">
                            <label for="">Term 3</label>
                            <input type="text" name="term" class="form-control " value="{{number_format($feestruture->expectedterm3, 2, '.', ',')}} " disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h4>Paid Fee</h4>
                    </div>
                </div>
            
                <form action="{{route('finance.updatefeeledger')}}" method="POST" role="form" >
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="row p-2">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Term 1</label>
                                <input type="text" name="term1" class="form-control border-success" value="{{number_format(is_null($feepayment)?0:$feepayment->term1, 2, '.', ',')}} " disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Term 2</label>
                                <input type="text" name="term2" class="form-control border-success" value="{{number_format(is_null($feepayment)?0:$feepayment->term2, 2, '.', ',')}} " disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Term 3</label>
                                <input type="text" name="term3" class="form-control border-success" value="{{number_format(is_null($feepayment)?0:$feepayment->term3, 2, '.', ',')}} " disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- <button class="btn btn-info" type="submit">Upload</button> -->
                        </div>


                    </div>
                </form>
           

            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    @include('finance.partials.footer')
</div>

@endsection
@section('script')
@endsection
@section('style')
@endsection