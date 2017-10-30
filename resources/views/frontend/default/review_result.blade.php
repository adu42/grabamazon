<?php use Carbon\Carbon; ?>
@extends(config('front.template').'layouts.review')
@section('content')
   <!-- evaluate Top Group -->
    @if($evaluateTopGroup)
            <div class="row trades">
                <div class="col-sm-12 categories">
             <ul>
            @foreach($evaluateTopGroup as $i=>$item)
                @if($i%6==0 && $i>0)
                         <div class="clear"></div>
                @endif
                <li class="category">
                <a href="{{ $item->url }}" target="_blank">{{ $item->logo }}
                    <div class="overlay {{ $item->color }}">
                        <span class="icon {{ $item->icon }}"></span>
                    </div>
                </a>
                </li>
            @endforeach
             </ul>
                </div>
            </div>
    @endif
<!-- recent_searches -->
    @if($searchLog)
    <div class="row recent-keyword">
        <div class="col-sm-12">
        <span>{{ trans('review.recent_searches')  }}</span>
        @foreach($searchLog as $item)
            {{ $item->keyword }}
        @endforeach
    </div> </div>
    @endif

            @if($evaluates)
                <div class="row trades">
                    <div class="col-sm-12 categories">
                            @foreach($evaluates as $i=>$evaluate)
                                <div class="row">
                                    <div class="col-sm-4">
                                    <a href="{{ route('review.domain',['domain'=>$evaluate->domain]) }}" target="_blank">
                                        {!! image_to($evaluate->screen,'',$evaluate->domain,['class'=>"img-thumbnail"]) !!}
                                        @if($evaluate->online)
                                            <div class="online">{{ trans('review.online') }}</div>
                                        @else
                                            <div class="offline">{{ trans('review.offline') }}</div>
                                        @endif
                                    </a>
                                    </div>
                                    <div class="col-sm-8 website_info">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="website">
                                                    <input value="{!! $evaluate->mark !!}" class="rating" data-size="xxs" data-show-clear="false" data-show-caption="false" readonly="true"/>
                                                    <a href="{{ route('review.domain',['domain'=>$evaluate->domain]) }}" target="_blank" rel="bookmark" itemprop="url" title="{!! $evaluate->domain !!} reviews">{!! $evaluate->domain !!} reviews</a>
                                                    <a href="{!! route('assess.domain',['domain'=>$evaluate->domain])  !!}" target="_blank" title="Suggestions on {!! $evaluate->domain !!}"  rel="bookmark"><span class="glyphicon glyphicon-new-window"></span></a>
                                                </div>
                                                <div class="summary">
                                                    {!! $evaluate->summary !!}
                                                </div>
                                            </div></div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="category">
                                                    @if($evaluate->group)
                                                        {!! $evaluate->group->group !!}
                                                    @else
                                                        {{ trans('review.brand',['brand'=>$evaluate->brand]) }}
                                                    @endif
                                                </div>
                                                <div class="region">
                                                    {!! $evaluate->region !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                            @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! $evaluates->render() !!}
                    </div>
                </div>
            @endif
@endsection