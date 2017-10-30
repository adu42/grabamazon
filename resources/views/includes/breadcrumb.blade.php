<?php
/**
 * Created by PhpStorm.
 * User: forldo
 * Date: 15-4-18
 * Time: 上午2:58
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    @if ($breadcrumbs)

        <ol class="breadcrumb pull-right">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$breadcrumb->last)
                    @if($breadcrumb->first)
                    <li><a href="{{{ $breadcrumb->url }}}"><i class="fa fa-dashboard">{{{ $breadcrumb->title }}}</i></a></li>
                    @else
                    <li><a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a></li>
                    @endif
                @else
                    <li class="active">{{{ $breadcrumb->title }}}</li>
                @endif
            @endforeach
        </ol>
    @endif
</section>