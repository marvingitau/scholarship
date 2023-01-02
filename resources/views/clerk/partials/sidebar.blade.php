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
        <a class="nav-link" href="{{route('clerk.dashboard')}}">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Form Entries</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Physical Form Operations:</h6>
                <a class="collapse-item" href="{{route('clerk.newapplication')}}">Secondary School</a>
                <a class="collapse-item" href="{{route('clerk.tertiaryapplication')}}">Tertiary </a>
                <a class="collapse-item" href="{{route('clerk.theologyapplication')}}">Theology </a>
                <a class="collapse-item" href="{{route('clerk.specialapplication')}}">Special School</a>
                <!-- <a class="collapse-item" href="cards.html">Pending Form Entries</a>
                <a class="collapse-item" href="cards.html">Approved Form Entries</a> -->
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="{{route('clerk.applicationlist')}}">
            <i class="fas fa-list"></i>
            <span>Pending Applications</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('clerk.ongoingbeneficiary')}}">
            <i class="fa fa-child"></i>
            <span>Ongoing beneficiaries</span></a>
    </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('clerk.beneficiaries')}}">
            <i class="fas fa-bezier-curve"></i>
            <span>Beneficiaries</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>





</ul>
<!-- End of Sidebar -->