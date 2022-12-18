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

            <!-- Page Heading -->
            <div class="d-flex my-1">

                <h1 class="h3 mb-2 text-gray-800">School Report History</h1>
                <a href="{{route('committee.newschoolreport',$id)}}" class="btn btn-success ml-auto"><i class="fa fa-book mr-1"></i> Add New Report</a>
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
                                    <th>Id</th>
                                    <th>Year</th>
                                    <th>Form/Class</th>
                                    <th>Term</th>
                                    <th>Mean Grade</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Year</th>
                                    <th>Form/Class</th>
                                    <th>Term</th>
                                    <th>Mean Grade</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if($schoolreport)
                                @foreach ($schoolreport as $key=>$item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->year}}</td>
                                    <td>{{$item->form}}</td>
                                    <td>{{$item->term}}</td>
                                    <td>{{$item->meangrade}}</td>
                                
                                    <td><a class="btn btn-info" href="{{route('committee.viewschoolreport',$item->id)}}">View <i class="fa fa-eye"></i></a></td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>..</td>
                                    <td>.</td>
                                    <td>..</td>
                                    <td>..</td>
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