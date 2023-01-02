<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('finance.dashboard')}}" style="background: #ffd5d5;">
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
        <a class="nav-link" href="{{route('finance.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Operation
    </div>


    <li class="nav-item">
        <a class="nav-link" href="{{route('finance.feepayment')}}">
            <i class="fas fa-list"></i>
            <span> Fee Payment</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

        <!-- Nav Item - Charts -->
        <li class="nav-item">
        <a class="nav-link" href="{{route('finance.pendingfee')}}">
            <i class="fas fa-list"></i>
            <span>Fee Statement</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <li class="nav-item">
        <a class="nav-link" href="{{route('finance.bankstatement')}}">
            <i class="fas fa-list"></i>
            <span> Payment Voucher</span></a>
    </li>


    <!-- <a class="collapse-item" href="{{route('admin.feepayment')}}">Fee Payment</a>
                <a class="collapse-item" href="{{route('admin.bankstatement')}}">Bank Statement</a>
                <a class="collapse-item" href="{{route('admin.academicyears')}}">Academic Years</a> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>





</ul>
<!-- End of Sidebar -->