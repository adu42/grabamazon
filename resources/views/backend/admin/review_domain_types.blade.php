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
                    <div class="col-sm-6 col-md-1 col-md-offset-11 col-sm-offset-6">
                    <div class="input-group-btn">
                        <a href="{!! route('admin.review') !!}" class="btn btn-primary">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                        <a href="{!! route('admin.review.add') !!}" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </div>
                </div>
                </div>
            <div class="row">
                <div class="col-md-12">
            <div class="table-responsive">
                {!! $grid !!}
            </div>
        </div></div></div>
    </div>

@stop
