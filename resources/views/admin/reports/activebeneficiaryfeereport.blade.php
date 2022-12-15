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
                <h1 class="h3 mb-0 text-gray-800">Filter Fee Beneficiaries</h1>
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
                                <label for="">{{__('Year')}}</label>
                                <select class="form-control year-selector" name="year">
                                    <option value="">Choose</option>
                                    @if($academicYears)
                                    @foreach($academicYears as $item)
                                    <option value="{{$item->year}}">{{$item->year}}</option>
                                    @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{__('Term')}}</label>
                                <select name="institution" id="" class="form-control" id="schooltype">
                                    <option value="">Choose</option>
                                    <option value="SECONDARY">Term1/Semester1</option>
                                    <option value="TERTIARY">Term2/Semester2</option>
                                    <option value="SPECIAL">Term3/Semester3</option>
                                </select>
                            </div>
                        </div>





                        <div class="col-12">
                            <button class="btn btn-info" type="submit">Fetch</button>
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