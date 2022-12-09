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
                <h1 class="h3 mb-0 text-gray-800">{{ucwords($beneficiary->beneficiary)}} <b>{{$activeYear->year}}</b> Fees Structure</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <!-- Content card -->
            <div class="row">
                <div class="col-12">
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
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
                <form action="{{route('admin.postongoingfeeview')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="year" value="{{$activeYear->year}}">
                    <div class="row p-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Expected Term1/Semester1</label>
                                <input type="text" value="{{$beneficiary->expectedterm1 }}" class="form-control" placeholder="Expected Term1/Semester1" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Expected Term2/Semester2</label>
                                <input type="number" value="{{$beneficiary->expectedterm2 }}" class="form-control" placeholder="Expected Term2/Semester2" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Expected Term3/Semester3</label>
                                <input type="number" value="{{$beneficiary->expectedterm3}}" class="form-control" placeholder="Expected Term3/Semester3" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Expected YearlyFee</label>
                                <input type="number" value="{{$beneficiary->yearlyfee}}" class="form-control" placeholder="Expected YearlyFee" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Allocated Yealy Fee</label>
                                <input type="number" name="AllocatedYealyFee" class="form-control" placeholder="Allocated YearlyFee" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-info" type="submit">Submit</button>
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