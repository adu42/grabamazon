@foreach($items as $item)
    <li @if($item->hasChildren()) class="panel panel-default dropdown" @endif>
        <a href="{!! $item->url() !!}" class="">{!! $item->title !!} </a>
        @if($item->hasChildren())
            <div class="panel-collapse collapse in">
            <div class="panel-body">
            <ul class="list-group">
                @include(config('front.template').'layouts.partials.user_menu_items', array('items' => $item->children()))
            </ul>
            </div> </div>
        @endif
    </li>
@endforeach