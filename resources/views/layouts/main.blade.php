<!DOCTYPE html>
<html lang="en">
<head>
    @include(config('adminhtml.template').'layouts.partials.head')
</head>
<body class="backgroud-white flat-blue login-page">

<div class="container-fluid">
    <div class="row vertical-middle">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
