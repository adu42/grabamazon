@if($block)
    @if(isset($config['showTitle']) && $config['showTitle'])
{{ $config['showTitle'] }}
@endif
{!! $block->capacity !!}
@endif
