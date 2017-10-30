@if(isset($relations) && is_array($relations))
    <?php list($label, $items, $showWrite) = $relations; ?>
    @if($showWrite==1)
        <div class="sidebar-module min-hide">
            <ul class="list-unstyled">
                <li>{!! link_to_route('article.write',trans('article.publish'),[],['class'=>'btn btn-primary']) !!}</li>
            </ul>
        </div>
    @endif
    <div class="sidebar-module">
        <dl class="dl-horizontal">
            @foreach($items as $item)
                <dd>
                    {!! link_to_route('article.show',$item->title,['uri'=>$item->url_key?:$item->id],['class'=>'title']) !!}
                </dd>
            @endforeach
        </dl>
    </div>
@endif
<div class="container-no-parent-selector side">
    {{ Widget::block('what-is-site') }}


    {{ Widget::piece('Latest Reviews') }}
    {{ Widget::block('right-one-advertising') }}
    {{ Widget::Articles(5) }}
</div>
<div class="margin-top-30">
    {{ Widget::carousel(2,1,-1) }}
</div>