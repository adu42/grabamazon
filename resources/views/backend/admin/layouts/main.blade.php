<!DOCTYPE html>
<html lang="en">
<head>
    @include(config('adminhtml.template').'layouts.partials.head')
</head>
<body class="flat-blue">
<div class="app-container">
    <div class="row content-container">
        @include(config('adminhtml.template').'layouts.partials.navbar')
        @include(config('adminhtml.template').'layouts.partials.sidebar')
        <div class="container-fluid">
            <div class="side-body padding-top">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Scripts -->
        @include(config('adminhtml.template').'layouts.partials.footer')
    </div>
</div>
</body>
</html>
