<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-2
 * Time: 上午3:08
 */

?>
@extends(config('adminhtml.template').'layouts.main')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                {!! $filter->open !!}
                <div class="col-md-12">
                    {!! $filter->field('name') !!}
                    <button class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    <a href="{!! route('admin.catalog.edit') !!}" class="btn btn-sm">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>
                {!! $filter->close !!}
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {!! $tree !!}
                </div>
            </div>
        </div>
    </div>
@stop