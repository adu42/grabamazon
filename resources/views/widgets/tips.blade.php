@if($tips)
    @if(isset($config['showTitle']) && $config['showTitle'])
        {{ $config['showTitle'] }}
    @endif
    <ul>
    @foreach($tips as $tip)
    <li>{!! '['.$tip->types($tip->type).']'. $tip->tip !!}</li>
    @endforeach
    </ul>
@endif
