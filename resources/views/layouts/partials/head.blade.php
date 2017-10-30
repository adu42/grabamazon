@section('layouts.partials.head')
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="NOINDEX,NOFOLLOW" />
    <link rel="icon" href="{{ asset('assets/iamges/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('assets/iamges/favicon.ico') }}" type="image/x-icon" />

    <!--  <link href="{{-- elixir('assets/css/all.css') --}}" rel="stylesheet" />
        <script src="{{-- elixir('assets/js/all.js') --}}"></script> -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- basic styles -->
    <!--//ace作用在sidebar  -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]-->
    <script src="{{ asset('assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <!--[endif]-->





    {!! Rapyd::head() !!}



@show
