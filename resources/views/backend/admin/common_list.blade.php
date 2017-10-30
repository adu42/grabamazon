<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-1
 * Time: 上午7:06
 */
?>
@extends(config('adminhtml.template').'layouts.main')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group search-form">
                        {!! $filter !!}
                    </div>
                </div>
            </div>

            @if(isset($filter_bar))
                <div class="row">
                    <div class="col-md-12">
                <div class="table-responsive">{!! $filter_bar !!}</div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $grid !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
