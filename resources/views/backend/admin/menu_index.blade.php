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

                              <button class="btn btn-primary" type="submit">
                                  <span class="glyphicon glyphicon-search"></span>
                              </button>
                              <a href="{!! route('admin.menus.index') !!}" class="btn btn-sm">
                                  <span class="glyphicon glyphicon-remove"></span>
                              </a>
                              <a href="{!! route('admin.menus.edit') !!}" class="btn btn-sm">
                                  <span class="glyphicon glyphicon-plus"></span>
                              </a>

            </div>
            {!! $filter->close !!}

            </div>
            <div class="table-responsive">
            <table class="table table-condensed">
                <tr>
                    <th>ID</th>
                    <th>标题</th>
                    <th>url</th>
                    <th>描述</th>
                    <th align="center">操作</th>
                </tr>
                @foreach ($set->data as $item)
                <tr>
                    <td>{!! $item->id !!}</td>
                    <td>{!! $item->name !!}</td>
                    <td>{!! $item->url_key !!}</td>
                    <td>{!! $item->description !!}</td>
                    <td align="center">
                        @if ($item->getPrevNode())
                            &nbsp; &nbsp;  {!!  link_to_route('admin.menus.sort','up',['id'=>$item->id,'sort'=>'up']) !!} &nbsp; &nbsp;
                        @endif

                        @if ($item->getNextNode())
                            &nbsp; &nbsp;   {!!  link_to_route('admin.menus.sort','down',['id'=>$item->id,'sort'=>'down']) !!} &nbsp; &nbsp;
                            @endif
                            {!! link_to_route('admin.menus.edit','编辑',['id'=>$item->id],['class'=>'glyphicon glyphicon-edit']) !!}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
           </div>
            <div class="pager">
                {!! $set->links() !!}
            </div>



        </div>
    </div>
@stop