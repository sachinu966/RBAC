<!doctype html>
<html lang="en" data-layout="vertical" data-layout-style="detached" data-layout-position="fixed" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-layout-width="fluid">

<head>
  @include('backend.layout.head')
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
     @include('backend.layout.header')
        <!-- ========== App Menu ========== -->
        @include('backend.layout.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('content-area')
            <!-- End Page-content -->

            <footer class="footer">
              @include('backend.layout.footer')
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
   @include('backend.layout.foot')
</body>

</html>