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
            <h1 class="h3 mb-2 text-gray-800">Ongoing Beneficiaries</h1>

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
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>School</th>
                                    <th>Telephone</th>
                                    <th>Type</th>
                                    <th>From Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>School</th>
                                    <th>Telephone</th>
                                    <th>Type</th>
                                    <th>From Year</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if($continuing)
                                @foreach ($continuing as $item)
                                <tr>
                                    <td>{{$item->firstname}} {{$item->lastname}}</td>
                                    <td>{{$item->gender}}</td>
                                    <td>{{$item->age}}</td>
                                    <td>{{$item->SecondaryAdmitted}}</td>
                                    <td>{{$item->MobileActive}}</td>
                                    <td>{{$item->Type}}</td>
                                    <td>{{$item->year}}</td>
                                    <td> <a href="{{route('clerk.ongoingfeeview',$item->id)}}" class="btn btn-dark"> Edit <i class="fas fa-edit ml-2 "></i></a></td>
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