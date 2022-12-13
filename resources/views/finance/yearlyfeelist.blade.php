@extends('layouts.finance')
@section('content')
<?php
?>

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
            <h1 class="h3 mb-2 text-gray-800">Fee Statement</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Beneficiary</th>
                                    <th>Expected Term1</th>
                                    <th>Expected Term2</th>
                                    <th>Expected Term3</th>
                                    <th>Allocated Fee</th>
                                    <th>Year</th>
                                    <th></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Beneficiary</th>
                                    <th>Expected Term1</th>
                                    <th>Expected Term2</th>
                                    <th>Expected Term3</th>
                                    <th>Allocated Fee</th>
                                    <th>Year</th>
                                    <th></th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if($fee)
                                @foreach ($fee as $item)
                                <tr>
                                    <td>{{$item->beneficiary_id}}</td>
                                    <td>{{$item->beneficiary}}</td>
                                    <td>{{$item->expectedterm1}}</td>
                                    <td>{{$item->expectedterm2}}</td>
                                    <td>{{$item->expectedterm3}}</td>
                                    <td>{{$item->AllocatedYealyFee}}</td>
                                    <td>{{$item->year}}</td>
                                    <td>
                                        <span class="<?php echo in_array($item->id, $feesection) ? "payment_indicator green" : "payment_indicator" ?>"></span>
                                    </td>
                                    <td><a href="{{route('finance.viewpendingfee',$item->id)}}" class="btn btn-dark"> 
                                        View 
                                        <!-- <i class="fas fa-eye ml-2 "></i> -->
                                    </a></td>

                                </tr>
                                @endforeach
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
<style>
    span.payment_indicator {
        width: 1rem;
        height: 1rem;
        display: block;
        background: red;
        border-radius: 50%;
    }

    span.payment_indicator.green {
        background: green !important;
    }
</style>
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection