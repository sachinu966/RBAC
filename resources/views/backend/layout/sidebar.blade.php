<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
    <div class="container-fluid">
        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('backend.dashboard') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="las la-tachometer-alt"></i> <span data-key="t-dashboards">Dashboards</span>
                </a>
            </li>
            <!-- Role menu item, visible only to admin -->
            @if(Auth::user()->hasRole('Admin'))
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('roles.index') }}" role="button" aria-expanded="false" aria-controls="sidebarApps">
                    <i class="lab la-delicious"></i> <span>Role</span>
                </a>
            </li>
            @endif

            <!-- Role Has Permission menu item, visible only to admin -->
            @if(Auth::user()->hasRole('Admin'))
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('role-has-permissions') }}" role="button" aria-expanded="false" aria-controls="sidebarApps">
                    <i class="lab la-delicious"></i> <span>Role Has Permission</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasPermission('manage_users'))

            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('users.index') }}" role="button" aria-expanded="false" aria-controls="sidebarApps">
                    <i class="lab la-delicious"></i> <span>Users</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasPermission('edit_profile'))

            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('users.profile') }}" role="button" aria-expanded="false" aria-controls="sidebarApps">
                    <i class="lab la-delicious"></i> <span>Profile</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasPermission('view_reports'))
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('manage-report') }}" role="button" aria-expanded="false" aria-controls="sidebarApps">
                    <i class="lab la-delicious"></i> <span>Report</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('logout') }}" role="button" aria-expanded="false" aria-controls="sidebarApps">
                    <i class="lab la-delicious"></i> <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>


            <div class="sidebar-background"></div>
        </div>