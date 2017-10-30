<!DOCTYPE html>
<html lang="en">
<head>
    @include(config('front.template').'layouts.partials.head')
</head>
<body>

@include(config('front.template').'layouts.partials.header')

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-9 col-lg-8  content-wrapper">
            @if(Context::get('breadcrumbs'))
                <div class="row">
                    <div class="col-md-12">
                        @include(config('front.template').'layouts.partials.breadcrumb')
                    </div>
                </div>
            @endif
           @yield('content')
        </div>

    <div class="col-sm-12 col-md-3 col-lg-4 article-side">
        @include(config('front.template').'layouts.partials.relation')
    </div>
    </div>
</div>
@include(config('front.template').'layouts.partials.footer')
</body>
</html>