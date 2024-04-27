<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout-mode="{{Session::get('mode') == 'dark' ? 'dark' : '' }}" dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}" >

<head>
    @include('layouts.title-meta')
    @include('layouts.head')
</head>

@section('body')
    <div class="loader"></div>

    <body>
    @show

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @include('includes.Alert')
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.right-sidebar')
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
</body>

</html>
