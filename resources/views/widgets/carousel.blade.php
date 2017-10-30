@if($articles && $articles->count())
    <div id="carousel-generic-{{ $config['name'] }}" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-generic-{{ $config['name'] }}" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-generic-{{ $config['name'] }}" data-slide-to="1"></li>
            <li data-target="#carousel-generic-{{ $config['name'] }}" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="row">
                    @if($config['column']>0)
                        <div class="col-md-{{$config['column-width']}}">
                            {!! article_image($articles->get(0)) !!}
                        </div>
                    @endif
                    @if($config['column']>1)
                        <div class="col-md-{{$config['column-width']}}">
                            <div class="row">
                                <div class="col-md-12 desc-image-a">
                                    {!!  article_image($articles->get(3),'x520260') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 desc-summary-b">
                                            <h5> {!! ($articles->get(3))?link_to_route('article.show',$articles->get(3)->title,['uri'=>$articles->get(3)->url_key]):'' !!}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($config['column']>2)
                        <div class="col-md-{{$config['column-width']}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 desc-summary-a">
                                            <h5> {!! ($articles->get(4))?link_to_route('article.show',$articles->get(4)->title,['uri'=>$articles->get(4)->url_key]):'' !!}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 desc-image-b">
                                    {!! article_image($articles->get(4),'x520260') !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="item">
                <div class="row">
                    @if($config['column']>0)
                        <div class="col-md-{{$config['column-width']}}">
                            {!! article_image($articles->get(1)) !!}
                        </div>
                    @endif
                    @if($config['column']>1)
                        <div class="col-md-{{$config['column-width']}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 desc-summary-a">
                                            <h5> {!! ($articles->get(5))?link_to_route('article.show',$articles->get(5)->title,['uri'=>$articles->get(5)->url_key]):'' !!}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 desc-image-b">
                                    {!! article_image($articles->get(5),'x520260') !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($config['column']>2)
                        <div class="col-md-{{$config['column-width']}}">
                            <div class="row">
                                <div class="col-md-12 desc-image-a">
                                    {!! article_image($articles->get(6),'x520260') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 desc-summary-b">
                                            <h5> {!! ($articles->get(6))?link_to_route('article.show',$articles->get(6)->title,['uri'=>$articles->get(6)->url_key]):'' !!}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="item">
                <div class="row">
                    @if($config['column']>0)
                        <div class="col-md-{{$config['column-width']}}">
                            {!! article_image($articles->get(2)) !!}
                        </div>
                    @endif
                    @if($config['column']>1)
                        <div class="col-md-{{$config['column-width']}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 desc-summary-a">
                                            <h5> {!! ($articles->get(7))?link_to_route('article.show',$articles->get(7)->title,['uri'=>$articles->get(7)->url_key]):'' !!}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 desc-image-b">
                                    {!! article_image($articles->get(7),'x520260') !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($config['column']>2)
                        <div class="col-md-{{$config['column-width']}}">
                            <div class="row">
                                <div class="col-md-12 desc-image-a">
                                    {!! article_image($articles->get(8),'x520260') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 desc-summary-b">
                                            <h5> {!! ($articles->get(8))?link_to_route('article.show',$articles->get(8)->title,['uri'=>$articles->get(8)->url_key]):'' !!}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif