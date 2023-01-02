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
                <h1 class="h3 mb-0 text-gray-800">New School Information</h1>
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
                <form action="{{route('clerk.postnewschoolinfo')}}" method="POST">
                    @csrf
                    <input type="hidden" name="beneficiary_id" value="{{$id}}">
                    <div class="row p-2">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">School Name</label>
                                <input type="text" class="form-control" name="name" placeholder="School Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Bank Name</label>
                                <input type="text" class="form-control" name="bankname" placeholder="Bank Name" >

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Bank Code</label>
                                <input type="text" class="form-control" name="bankcode" placeholder="Bank Code" >

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Branch Code</label>
                                <input type="text" class="form-control" name="branch" placeholder="Branch Code" >

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Account No</label>
                                <input type="text" class="form-control" name="accountno" placeholder="Account No" >

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Student Admission No</label>
                                <input type="text" class="form-control" name="admissionno"  placeholder="Admission No" >

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check1" name="current" value="1">
                                <label class="form-check-label"> Current School</label>

                            </div>
                        </div>
                      
                       
                      
                        <div class="col-12 mt-5 d-flex">
                            <button class="btn btn-info" type="submit"><i class="fas fa-file-upload"></i> Submit</button>
                            <a class="btn btn-danger ml-auto" href="javascript:history.back()"> <i class="fas fa-step-backward"></i> Go Back</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    @include('clerk.partials.footer')
</div>

@endsection
@section('script')
@endsection
@section('style')
@endsection