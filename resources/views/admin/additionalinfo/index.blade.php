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
                <h4 class="h3 mb-0 text-gray-800 text-center">Additional Information</h4>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <!-- Content card -->
            <div class="row">
                <!-- <div class="col-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div> -->
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
                        <div class="tab-pane fade show active" id="v-pills-communication" role="tabpanel" aria-labelledby="v-pills-communication-tab">Comm</div>
                        <div class="tab-pane fade" id="v-pills-schoolinfo" role="tabpanel" aria-labelledby="v-pills-schoolinfo-tab">...</div>
                        <div class="tab-pane fade" id="v-pills-transferhistory" role="tabpanel" aria-labelledby="v-pills-transferhistory-tab">...</div>
                        <!-- <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div> -->
                    </div>
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