@section('layouts.partials.navbar')
    <nav class="navbar navbar-default navbar-fixed-top navbar-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">@lang('messages.welcome')</a>
            </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/">Home</a></li>
                    @if (Auth::guest())
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                    @else
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown" role="menu">
                                <li><a href="">System Menu</a></li>
                                <li><a href="/logout">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
        </div>
    </nav>
@show