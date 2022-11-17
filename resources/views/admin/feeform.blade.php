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
                <h1 class="h3 mb-0 text-gray-800">New Fee</h1>
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
                <div class="col-12">
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <form action="{{route('admin.postnewfee')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="yearlyfee" value="<?php echo is_null($annualFee) != true ? $annualFee->yearlyfeebal: "" ?>">
                    <input type="hidden" name="year" value="{{$activeYear->year}}">
                    <div class="row p-2">
                        <!-- <div class="col-12">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" name="date" class="form-control" placeholder="Date" >
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Yearly Allocated Fund</label>
                                <input type="text" class="form-control" name="yearlyfee" value="<?php echo is_null($annualFee) != true ? number_format($annualFee->yearlyfeebal, 2, '.', ',') : "N/A" ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Schools Expected Term 1 Fee</label>
                                <input type="text" class="form-control" value="<?php echo is_null($annualFee) != true ? number_format($annualFee->expectedterm1, 2, '.', ',') : "N/A" ?>" placeholder="Term 1 Fee" disabled>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Schools Expected Term 2 Fee</label>
                                <input type="text" class="form-control" value="<?php echo is_null($annualFee) != true ? number_format($annualFee->expectedterm2, 2, '.', ',') : "N/A" ?>" placeholder="Term 2 Fee" disabled>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Schools Expected Term 3 Fee</label>
                                <input type="text" class="form-control" value="<?php echo is_null($annualFee) != true ? number_format($annualFee->expectedterm3, 2, '.', ',') : "N/A" ?>" placeholder="Term 3 Fee" disabled>

                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Year</label>
                                <input type="text" class="form-control" value="{{$activeYear->year}}" placeholder="Year" disabled>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Term</label>
                                <select name="term" id="" class="form-control">
                                    <option value="term1">1st Term</option>
                                    <option value="term2">2nd Term</option>
                                    <option value="term3">3rd Term</option>
                                </select>
                                <!-- <input type="text" name="term"  placeholder="Term" required> -->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="number" name="amount" class="form-control" placeholder="Amount" required>
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
    @include('admin.partials.footer')
</div>

@endsection
@section('script')
@endsection
@section('style')
@endsection