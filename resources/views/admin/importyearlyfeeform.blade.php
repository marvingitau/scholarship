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
                <h1 class="h3 mb-0 text-gray-800">Import Annual Fees</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <!-- Content card -->
            <div class="row">
                <div class="col-12">
                    @if (session('messagefee'))
                    <div class="alert alert-success">
                        {{ session('messagefee') }}
                    </div>
                    @endif
                </div>
                <div class="col-12">
                    @if (session('csvstatus'))
                    <div class="alert alert-success">
                        {{ session('csvstatus') }}
                    </div>
                    @endif
                </div>
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
                <form action="{{route('admin.saveyearlyfee')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="year" value="{{$academicYear->year}}">
                    <div class="row m-3 ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">File</label>
                                <input type="file" name="yearlydata" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-2">
                        <label for="oo">Action</label>
                        <button class="btn btn-primary" id="oo">Import data</button>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.scholar-sector').select2();
        $('.year-selector').select2();
    });
</script>
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection