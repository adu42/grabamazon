<header class="main-header">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="toggle navbar-toggle" data-toggle="collapse" data-target=".navbar-top-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/"><img id="navbar-logo" src="{{ asset('assets/images/logo.jpg')  }}"></a>
        </div>
    <!-- Header Navbar: style can be found in header.less -->
        <div class="collapse navbar-collapse navbar-top-collapse">
        {!! $menus !!}
        </div>
    </div>
</header>