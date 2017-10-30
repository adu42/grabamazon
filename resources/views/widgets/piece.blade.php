@if($evaluates)
    <ul class="list-group sidelist">
        <li class="list-group-item">
            @if(isset($config['showTitle']) && $config['showTitle'])
                <h4>{{ $config['showTitle'] }}</h4>
            @endif
        </li>
        @foreach($evaluates as $evaluate)
            <li class="list-group-item">
                <h5 class="list-group-item-heading"><a href="{!! route('review.domain',['domain'=>$evaluate->domain])  !!}" target="_blank" rel="bookmark" title="{!! $evaluate->domain !!} Reviews">{!! $evaluate->domain !!} Reviews</a></h5>
                <p class="list-group-item-text">
                    <input value="{!! $evaluate->mark !!}" class="rating" data-size="xxs" disabled="disabled" data-showCaption="false" data-showClear="false"/>
                </p>
            </li>
        @endforeach
    </ul>
@endif