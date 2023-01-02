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
                <h4 class="h3 mb-0 text-gray-800 text-center">Beneficiary Information</h4>
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
            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active my-1" id="v-pills-communication-tab" data-toggle="pill" data-target="#v-pills-communication" type="button" role="tab" aria-controls="v-pills-communication" aria-selected="true">Communication</button>
                        <button class="nav-link my-1" id="v-pills-schoolinfo-tab" data-toggle="pill" data-target="#v-pills-schoolinfo" type="button" role="tab" aria-controls="v-pills-schoolinfo" aria-selected="false">School Information</button>
                        <button class="nav-link my-1" id="v-pills-transferhistory-tab" data-toggle="pill" data-target="#v-pills-transferhistory" type="button" role="tab" aria-controls="v-pills-transferhistory" aria-selected="false">Transfer History</button>
                        <!-- <button class="nav-link" id="v-pills-settings-tab" data-toggle="pill" data-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button> -->
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-communication" role="tabpanel" aria-labelledby="v-pills-communication-tab">
                            <form action="{{route('clerk.updateadditionalinfo',$id)}}" method="post">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Active Contact Information</h4>
                                    </div>
                                    <div class="card-body">
                                        @if($commData)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control" name="phone" placeholder="Active Phone Number" value="{{$commData->phone}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Active Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Active Email Address" value="{{$commData->email}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Belongs To</label>
                                                    <input type="text" class="form-control" name="belongsto" placeholder="" value="{{$commData->belongsto}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control" name="phone" placeholder="Active Phone Number"  required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Active Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Active Email Address"  required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Belongs To</label>
                                                    <input type="text" class="form-control" name="belongsto" placeholder=""  required>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Update <i class="fas fa-file-upload ml-2"></i></button>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="v-pills-schoolinfo" role="tabpanel" aria-labelledby="v-pills-schoolinfo-tab">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                                    <div class="d-flex">
                                        <a href="{{ route('clerk.newschoolinfo',$id)}}" class="btn btn-success ml-auto">Add New School Information</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>School</th>
                                                    <th>Bank</th>
                                                    <th>Branch</th>
                                                    <th>A/C No</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>School</th>
                                                    <th>Bank</th>
                                                    <th>Branch</th>
                                                    <th>A/C No</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if($schoolData)
                                                @foreach ($schoolData as $key=>$item)
                                                <tr>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->bankname}}</td>
                                                    <td>{{$item->branch}}</td>
                                                    <td>{{$item->accountno}}</td>

                                                    <td><a class="btn btn-info" href="{{route('clerk.getschoolinfo',$item->id)}}">Edit <i class="fas fa-edite"></i></a>
                                                    <a class="btn btn-danger" href="{{route('clerk.deleteschoolinfo',$item->id)}}">Del <i class="fas fa-edite"></i></a>
                                                </td>
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
                        <div class="tab-pane fade" id="v-pills-transferhistory" role="tabpanel" aria-labelledby="v-pills-transferhistory-tab">


                        <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                                    <div class="d-flex">
                                        <a href="{{ route('clerk.newtransfer',$id)}}" class="btn btn-success ml-auto">New Transfer History</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>School</th>
                                                    <th>Date From</th>
                                                    <th>Date To</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>School</th>
                                                    <th>Date From</th>
                                                    <th>Date To</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if($transferData)
                                                @foreach ($transferData as $key=>$item)
                                                <tr>
                                                    <td>{{$item->schoolname}}</td>
                                                    <td>{{$item->from}}</td>
                                                    <td>{{$item->to}}</td>

                                                    <td><a class="btn btn-info" href="{{route('clerk.gettransfer',$item->id)}}">Edit <i class="fas fa-edite"></i></a>
                                                    <a class="btn btn-danger" href="{{route('clerk.deletetransfer',$item->id)}}">Del <i class="fas fa-edite"></i></a>
                                                </td>
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
                    </div>

                    <!-- <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div> -->
                </div>
            </div>

        </div>



    </div>
    <!-- /.container-fluid -->
    @include('clerk.partials.footer')
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