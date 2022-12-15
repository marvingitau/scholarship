<?php
$current = url()->current();
$query = explode(env('ADMIN_URL_DELIMETER_VALUE'), $current);
$aux = isset($query[1]) ? $query[1] : "";
$tag = "";
$advanceList = ['yearlyfee', 'feepayment', 'bankstatement', 'academicyears', 'new/user', 'user/list'];
$flag = in_array($aux, $advanceList);
$tag = $flag != 'true' ? '' : 'show';


$scholarshipsList = ['approved/applicants', 'archived/applicants', 'rejected/applicants'];
$flag = in_array($aux, $scholarshipsList);
$tag2 = $flag != 'true' ? '' : 'show';

?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('clerk.dashboard')}}" style="background: #ffd5d5;">
        <div class="sidebar-brand-icon ">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <img class="img-profile rounded-circle" src="{{asset('images/logo.png')}}" style="width: 65%;">

        </div>
        <div class="sidebar-brand-text mx-3">{{env('APP_NAME')}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Operation
    </div>


    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.applicationlist')}}">
            <i class="fas fa-list"></i>
            <span>Pending Applications</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.ongoingbeneficiary')}}">
            <i class="fas fa-user-tie"></i>
            <span>Ongoing Beneficiaries</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Scholarships</span>
        </a>
        <div id="collapseTwo" class="collapse {{$tag2}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Scholarships Status:</h6>
                <a class="collapse-item" href="{{route('admin.approvedbeneficiaries')}}">Approved Scholarships</a>
                <a class="collapse-item" href="{{route('admin.archivedbeneficiaries')}}">Archived Scholarships</a>
                <a class="collapse-item" href="{{route('admin.rejectedapplicants')}}">Rejected Scholarships</a>

            </div>
        </div>
    </li>

    <!-- Divider -->
    <!-- <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSMS" aria-expanded="true" aria-controls="collapseFour">
            <i class="fa fa-comment"></i>
            <span>Messaging</span>
        </a>
        <div id="collapseSMS" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Messaging actions:</h6>
                <a class="collapse-item" href="{{route('admin.academicyears')}}">Text Alert</a>
                <a class="collapse-item" href="{{route('admin.yearlyfee')}}">Yearly Fee</a>
                <a class="collapse-item" href="{{route('admin.newuser')}}">Create User</a>
                <a class="collapse-item" href="{{route('admin.userlist')}}">User List</a>

            </div>
        </div>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudymaterial" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-folder-open"></i>
            <span>Study Material</span>
        </a>
        <div id="collapseStudymaterial" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Beneficiaries materials:</h6>
                <a class="collapse-item" href="{{route('admin.studymaterials')}}">Academic Materials</a>
                <a class="collapse-item" href="{{route('admin.mailedstudymaterials')}}">Mailed Materials</a>


            </div>
        </div>
    </li>




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThres" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-cog "></i>
            <span>Advanced</span>
        </a>
        <div id="collapseThres" class="collapse {{$tag}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Advanced Operations:</h6>
                <a class="collapse-item" href="{{route('admin.yearlyfee')}}">Yearly Fee Statement</a>
                <!-- <a class="collapse-item" href="{{route('admin.feepayment')}}">Fee Payment</a>
                <a class="collapse-item" href="{{route('admin.bankstatement')}}">Bank Statement</a> -->
                <a class="collapse-item" href="{{route('admin.academicyears')}}">Academic Years</a>
                <a class="collapse-item" href="{{route('admin.newuser')}}">Create User</a>
                <a class="collapse-item" href="{{route('admin.userlist')}}">User List</a>

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseThree">
            <i class="fa fa-book"></i>
            <span>Reports</span>
        </a>
        <div id="collapseReport" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Beneficiaries Report:</h6>
                <a class="collapse-item" href="{{route('admin.selectreport')}}">Academic Performance</a>
                <a class="collapse-item" href="{{route('admin.contacts')}}">Messaging List</a>


            </div>
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>





</ul>
<!-- End of Sidebar -->