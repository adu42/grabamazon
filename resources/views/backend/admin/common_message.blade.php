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
        <div class="panel-heading"></div>
        <div class="panel-body">

            <div class="table-responsive">
                {!! $msg !!}
            </div>
        </div>
    </div>
@stop
