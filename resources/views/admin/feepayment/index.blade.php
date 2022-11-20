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
                <h1 class="h3 mb-0 text-gray-800">Select Year</h1>
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
                <div class="form-body p-2">
                    <form action="{{route('admin.getfeepayment')}}" method="get">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="">Select Year</label>
                                    <select name="year" id="" class="form-control">
                                        @if($years)
                                        @foreach($years as $year)
                                        <option value="{{$year->year}}">{{$year->year}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-primary p-1">
                                    Set Year
                                </button>
                            </div>
                        </div>


                    </form>
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