<!DOCTYPE html>
<html class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-assets-path="/Admin/assets/"
    data-template="vertical-menu-template" data-theme="theme-default" dir="rtl" lang="fa">

@include('Admin.Layouts.Head-tags')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('Admin.Layouts.Sidebar')


            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->

                @include('Admin.Layouts.Header')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <!-- / Content -->
                </div>

                <!-- Footer -->

                @include('Admin.Layouts.Footer')
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>

            </div>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>
        <!-- / Layout page -->

    </div>
    <!-- / Layout wrapper -->
    @include('Admin.Layouts.Script')

</body>

</html>
