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
            <div class="d-flex m-2">

                <h1 class="h3 mb-2 text-gray-800">Active Scholarships</h1>
                <a href="{{route('admin.feeactivebeneficiaries')}}" class="btn btn-warning ml-auto">Active Beneficiaries Fee Report</a>
                <a href="{{route('admin.filteractivebeneficiaries')}}" class="btn btn-success ml-1">Active Beneficiaries Report</a>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Institute</th>
                                    <th>School</th>
                                    <th>Telephone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Institute</th>
                                    <th>School</th>
                                    <th>Telephone</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if($data)
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->firstname}} {{$item->lastname}}</td>
                                    <td>{{$item->gender}}</td>
                                    <td>{{$item->age}}</td>
                                    <td>{{$item->Type}}</td>
                                    <td>{{$item->SecondaryAdmitted}}</td>
                                    <td>{{$item->MobileActive}}</td>
                                    <td><a class="btn btn-info" href="{{route('admin.selectbeneficiary',$item->id)}}">View <i class="fa fa-eye"></i></a> <a class="btn btn-danger" href="{{route('admin.archivebeneficiary',$item->id)}}" onclick="return confirm('Are you sure want to Archive?')">Archive <i class="fa fa-archive"></i></a></td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>..</td>
                                    <td>.</td>
                                    <td>..</td>
                                    <td>.</td>
                                    <td>..</td>
                                    <!-- <td>$320,800</td> -->
                                </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
</div>

@endsection
@section('script') 
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endsection
@section('style')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection