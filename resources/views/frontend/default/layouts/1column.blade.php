<!DOCTYPE html>
<html lang="en">
<head>
    @include(config('front.template').'layouts.partials.head')
</head>
<body>
@include(config('front.template').'layouts.partials.header')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Widget::block('top-jumbotron') }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-10  content-wrapper">
           <div class="row">
                <div class="col-md-12">
                    @include(config('front.template').'layouts.partials.breadcrumb')
                </div>
            </div>
           @yield('content')
        </div></div>
</div>
@include(config('front.template').'layouts.partials.footer')
</body>
</html>