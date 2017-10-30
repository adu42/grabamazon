<!DOCTYPE html>
<html lang="en">
<head>
    @include(config('front.template').'layouts.partials.head_empty')
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12  content-wrapper">
           @yield('content')
        </div>
    </div>
</div>
@include(config('front.template').'layouts.partials.footer_empty')
</body>
</html>