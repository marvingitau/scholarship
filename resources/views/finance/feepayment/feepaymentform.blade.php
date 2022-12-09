@extends('layouts.finance')
@section('content')


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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ __('Beneficiaries Fee Payment') }}</h1>
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

            <div class="card">
                <div class="form-body p-2">
                    <form action="{{route('finance.importfeepayment')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Select the excel file</label>
                                    <input type="file" name="feedata" class="form-control" required>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-primary p-1">
                                    Upload the File
                                </button>
                            </div>
                        </div>


                    </form>
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    @include('finance.partials.footer')
</div>

@endsection
@section('script')
@endsection
@section('style')
@endsection