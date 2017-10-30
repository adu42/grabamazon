<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">
            @include('includes.header')
            @include('includes.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @include('includes.breadcrumb')
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            @include('includes.footer')
            @include('includes.control_sidebar')
        </div><!-- ./wrapper -->
        @include('includes.foot')
    </body>
</html>