@if(isset($articles) && $articles)
    @if(isset($config['showTitle']) && $config['showTitle'])
        <div class="row cap-title">
            <div class="col-md-12">
                <h3>{{ $config['showTitle'] }}</h3>
            </div>
        </div>
    @endif
    @foreach($articles as $item)
        <div class="row">
            <div class="col-md-12">
                <h4>{{ $item->title }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                {!!  article_image($item,'x120',['class'=>'img-thumbnail']) !!}
            </div>
            <div class="col-md-7 motive">
                {{ str_limit($item->content_heading,$config['str_limit']) }}
                <div class="more pull-right">{{ link_to_route('article.show',trans('messages.more'),['uri'=>$item->url_key]) }}</div>
            </div>
        </div>
    @endforeach
@endif