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
                <h1 class="h3 mb-0 text-gray-800">Filter the Beneficiaries</h1>
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
                <form action="{{route('admin.getactivebeneficiaries')}}" method="GET">
                

                    <div class="row p-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">{{__('Gender')}}</label>
                                <select class="form-control year-selector" name="gender">
                                        <option value="">Choose</option>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{__('Institution')}}</label>
                                <select name="institution" id="" class="form-control"  id="schooltype">
                                    <option value="">Choose</option>
                                    <option value="SECONDARY">SECONDARY APPLICANTS</option>
                                    <option value="TERTIARY">TERTIARY APPLICANTS</option>
                                    <option value="SPECIAL">SPECIAL APPLICANT</option>
                                    <option value="THEOLOGY">THEOLOGY APPLICANTS</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-md-4" id="highSchoolInp">
                            <div class="form-group">
                                <label for="">SCHOOL</label>
                                <select name="form" id="" class="form-control">
                                    <option value="Form 1">Form One</option>
                                    <option value="Form 2">Form Two</option>
                                    <option value="Form 3">Form Three</option>
                                    <option value="Form 4">Form Four</option>
                                </select>

                            </div>
                        </div> -->
                       

                       

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