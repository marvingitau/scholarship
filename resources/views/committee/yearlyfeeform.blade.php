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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">New Academic Fee</h1>
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
                    @if (session('errfee'))
                    <div class="alert alert-danger">
                        {{ session('errfee') }}
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
                <form action="{{route('committee.postyearlyfee')}}" method="POST">
                    @csrf

                    <div class="row p-2">
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="">School Expected Term 1 Fee</label>
                                <input type="number" class="form-control" name="expectedterm1" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">School Expected Term 2 Fee</label>
                                <input type="number" class="form-control" name="expectedterm2" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">School Expected Term 3 Fee</label>
                                <input type="number" class="form-control" name="expectedterm3" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Scholar</label>
                                <select class="form-control scholar-sector" name="beneficiary_id" required>

                                    @foreach ($data as $item)
                                    <option value="{{$item->id}}">{{$item->firstname}} {{$item->lastname}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Yearly Fee</label>
                                <input type="number" class="form-control" name="yearlyfee" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Year</label>
                                <select class="form-control year-selector" name="year" required>
                                    <?php
                                    for ($year = (int)date('Y'); 2019 <= $year; $year--) : ?>
                                        <option value="<?= $year; ?>"><?= $year; ?></option>
                                    <?php endfor; ?>
                                </select>

                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    @include('committee.partials.footer')
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