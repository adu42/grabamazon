@extends(config('adminhtml.template').'layouts.main')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @if($msg)
                <div class="row">
                    <div class="col-xs-12 col-md-12 alert alert-success">{!! $msg !!}</div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    {!! Form::open(['url'=>$action,'class'=>'form','files' => true]) !!}
                    <div class="form-group">
                        <div class="radio-inline">
                        <label>
                        {!! Form::radio('what','domain',($what=='domain'),['class'=>'radio']) !!}Domains
                        </label>
                            </div>
                        <div class="radio-inline"> <label>
                        {!! Form::radio('what','review',($what=='review'),['class'=>'radio']) !!}Reviews
                        </label></div>
                    </div>
                    <div class="form-group">
                        <label for="uploadFile">File input</label>
                        {!! Form::file('uploadFile','',['class'=>'form-control']) !!}
                        <p class="help-block">{{ $helper }}.</p>
                        <span class="input-group-btn">{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}</span>
                    </div>
                    {!! Form::token() !!}
                    {!! Form::close() !!}
                </div>
            </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        Domains:  <br/>
                        *  col-1: group_id<br/>
                        *  col-2: domain/url<br/>
                        *  col-3: title<br/>
                        *  col-4: description<br/>
                        Reviews: <br/>
                        * col-1:domain<br/>
                        * col-2:rating (good|normal|bad|Numeric|)<br/>
                        * col-3:title<br/>
                        * col-4:content<br/>
                        * col-5:user nice name(Null)<br/>
                    </div>
                </div>
        </div>
    </div>
@stop


