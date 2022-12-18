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
                <h1 class="h3 mb-0 text-gray-800">Disciplinary Case</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <!-- Content card -->
      
            <div class="card">
    
                    <div class="row p-2">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Case Title" value="{{$dis->subject}}" disabled>
                            </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                                <label for="">Date</label>
                                <input type="text" name="date" class="form-control" value="{{$dis->date}} " disabled>
                            </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label for="">Recommendation</label>
                               <textarea name="recommendation" id="" cols="30" class="form-control"  rows="6" placeholder="Recommendation" disabled>{{$dis->recommendation}}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            
                        </div>
                    </div>
               
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    @include('committee.partials.footer')
</div>

@endsection
@section('script')
@endsection
@section('style')
@endsection