        <header class="navbar navbar-blue navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">{!! config('front.site_name') !!}</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="/" class="navbar-brand"><img src="{!!  asset('assets/images/logo.png') !!}" alt="{!! config('front.site_name') !!}"/></a>
                </div>
                <nav class="collapse navbar-collapse" id="navbar">
                    {!! $menus !!}

                    @if(Auth::check())
                        <ul class="nav navbar-nav navbar-right">
                            @include(config('vmenus.bootstrap-items'),['items' =>(Vmenu::get(config('front.vmenu_name')))?Vmenu::get(config('front.vmenu_name'))->roots():[] ])
                        </ul>
                    @else
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{!! url('login') !!}">Log In</a>
                            </li>
                            <li>
                                <a href="{!! url('register') !!}">Sign Up</a>
                            </li>
                        </ul>
                    @endif
                    <form class="navbar-form navbar-right" id="top-search-form" action="{!! Context::get('searchAction')  !!}" method="get">
                        <div class="input-group">
                            <input type="text" id="top-search-keyword" name="keyword" class="form-control" placeholder="Search ..."/>
      <span class="input-group-btn">
        <button class="btn btn-primary default" id="top-search-btn" type="button">{{ trans('Go!')  }}</button>
      </span>
                        </div>
                        <script>
                            $(function(){
                                function _setKeyowrd(){
                                    var _keyword_value =   $('input[name=keyword]').val();
                                    if(_keyword_value!=''){
                                        var _form = $('form#top-search-form');
                                        var _url = $(_form).attr('action');
                                        _url+='/'+_keyword_value;
                                        $(_form).attr('action',_url);
                                        $(_form).submit();
                                    }
                                }

                            $('#top-search-btn').click(function(){
                                _setKeyowrd();
                            });

                            $("form#top-search-form input").keypress(function (e) {
                                if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                                    _setKeyowrd();
                                    return false;
                                }
                            });
                            });
                        </script>
                    </form>
                </nav>
            </div>
        </header>

