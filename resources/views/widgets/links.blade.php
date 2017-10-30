@if($links)
    @if(isset($config['showTitle']) && $config['showTitle'])
        {{ $config['showTitle'] }}
    @endif
    <ul>
        @foreach($links as $link)
            <li>{!! '['.$link->refers($link->refer).']'.link_to($link->link,$link->label?:$link->link)  !!}</li>
        @endforeach
    </ul>
@endif