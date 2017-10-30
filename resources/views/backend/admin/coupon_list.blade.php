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
                        <div class="input-group-btn">
                            <a href="{!! url('admin/coupon/edit') !!}" class="btn btn-sm">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
