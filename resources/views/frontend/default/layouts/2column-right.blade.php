<!DOCTYPE html>
<html lang="en">
<head>
    @include(config('front.template').'layouts.partials.head')
</head>
<body>

@include(config('front.template').'layouts.partials.header')

<div class="container">
     {!! Widget::block('top-user-advertising') !!}

    <div class="col-sm-12 col-md-12 col-lg-3 article-left-side">
        @include(config('front.template').'layouts.partials.sidebar')
    </div>
        <div class="col-sm-12 col-md-12 col-lg-9  content-wrapper">
            @if(Context::get('breadcrumbs'))
            <div class="row">
                <div class="col-md-12">
                    @include(config('front.template').'layouts.partials.breadcrumb')
                </div>
            </div>
            @endif
           @yield('content')
        </div>
</div>
@include(config('front.template').'layouts.partials.footer')
</body>
</html>