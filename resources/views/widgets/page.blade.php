@if($page)
    @if(isset($config['showTitle']) && $config['showTitle'])
        {{ $page->title }}
    @endif
    @if($config['showContent'])
        {!! $page->capacity !!}
        @else
        {!! $page->summary !!}
        <span>{{ link_to('/'.$page->url_key,trans('messages.more'))   }}</span>
        @endif
@endif