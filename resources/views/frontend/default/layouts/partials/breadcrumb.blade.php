<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-14
 * Time: 上午1:19
 */
?>
@if($crumbs && is_array($crumbs))
<div class="breadcrumbs">
    <ul class="breadcrumb">
        @foreach($crumbs as $_crumbName=>$_crumbInfo)
        <li class="{!! $_crumbName !!}">
            @if($_crumbInfo['link'])
            <a href="{!! $_crumbInfo['link'] !!}" title="{{ $_crumbInfo['title'] }}">{{ $_crumbInfo['label'] }}</a>
            @elseif($_crumbInfo['last'])
            <strong>{{ $_crumbInfo['label'] }}</strong>
            @else
                {{ $_crumbInfo['label'] }}
            @endif
            @if(!$_crumbInfo['last'])
            <span></span>
            @endif
        </li>
        @endforeach
    </ul>
</div>
@endif