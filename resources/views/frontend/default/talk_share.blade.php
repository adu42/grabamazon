<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-17
 * Time: 上午7:01
 */
?>
@extends(config('front.template').'layouts.empty')
@section('content')

    <article class="single-post">
        @if(isset($msg) && !empty($msg))
            <div class="row">
                <div class="col-md-12 col-lg-12">
                {{  $msg }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    @if($id)
                   <a href="{{ route('talk.show',['id'=>$id]) }}"> {{ trans('talk.return')  }} </a>
                        @else
                        <a href="{{ route('talk.list') }}"> {{ trans('talk.return')  }} </a>
                    @endif
                </div>
            </div>
         @else

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                <img src="{{ $media  }}" class="img-responsive"/>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6  col-lg-8">
        {!! Form::open(['url'=>'share','class'=>'answer_form','method'=>'get']) !!}

        <div class="input-group">
            {!! Form::textarea('description',$description,['class'=>'form-control','rows'=>3]) !!}
        </div>
        <div class="input-group">
            <span class="input-group-btn">{!! Form::submit(' Submit ',['class'=>'btn btn-primary answer-btn']) !!}</span>
        </div>
        {!! Form::hidden('url',(isset($url)?$url:'')) !!}
        {!! Form::hidden('media',(isset($media)?$media:'')) !!}
        {!! Form::hidden('save',1) !!}
        {!! Form::close() !!}
            </div>
        </div>
            @endif
    </article>
@endsection


