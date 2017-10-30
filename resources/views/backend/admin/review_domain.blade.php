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
            <div class="search-form">
                {!! $filter->open !!}
                <div class="col-md-12">
                    {!! $filter->field('domain') !!}

                        <button class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                        <a href="{!! route('admin.review') !!}" class="btn btn-sm">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                        <a href="{!! route('admin.review.add') !!}" class="btn btn-sm">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>

                </div>


                {!! $filter->close !!}
            </div>
        </div>

            <div class="table-responsive">
                {!! $grid !!}
            </div>
        </div>
    </div>

@stop
