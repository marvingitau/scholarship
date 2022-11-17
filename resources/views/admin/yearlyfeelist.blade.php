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
            <div class="d-flex my-3">
                <h1 class="h3 mb-2 text-gray-800">Yearly Fee</h1>
                <a href="{{route('admin.createyearlyfee')}}" class="btn btn-info ml-auto">Create New</a>
                <a href="{{route('admin.importyearlyfee')}}" class="btn btn-success ml-1">Import Bulk <i class="fa fa-file-excel-o"></i></a>
            </div>


            <!-- DataTales Example -->
            <div class="row">
            <div class="col-12">
                    @if (session('delfee'))
                    <div class="alert alert-danger">
                        {{ session('delfee') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3"> 
                    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                </div>
                <div class="card-body">
                    <!-- <div class="table-responsive"> -->
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> No</th>
                                <th>Beneficiary Name</th>
                                <th>Yearly Fee</th>
                                <th>Year</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                    </table>
                    <!-- </div> -->
                </div>
                <div class="card-footer">
                    <!-- <form action="" class="form-role">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" placeholder="Scholar Number">
                            </div>
                            <div class="col-md-8">
                                <button type="submit">Download CSV</button>
                            </div>
                        </div>
                    </form> -->
                    <a  href="{{route('admin.downloadyearlyfee')}}" class="btn btn-danger ">Download CSV &nbsp; <i class="far fa-file-excel"></i></a>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
</div>

@endsection
@section('script')
<!-- Page level plugins -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
<!-- Page level custom scripts -->
<!-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> -->

<script>
    $(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("admin.yearlyfeedata") !!}',
            columns: [
                {
                    data: 'beneficiary_id',
                    name: 'beneficiary_id'
                },
                {
                    data: 'beneficiary',
                    name: 'beneficiary'
                },
                {
                    data: 'yearlyfee',
                    name: 'yearlyfee'
                },
                {
                    data: 'year',
                    name: 'year'
                },
                {data: 'action', name: 'action'},

            ]
        });
    });
</script>

@endsection
@section('style')
<!-- Custom styles for this page -->
<!-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection