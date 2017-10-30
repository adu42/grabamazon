<?php use Carbon\Carbon; ?>
@extends(config('front.template').'layouts.home')
@section('content')

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
            <!-- evaluates -->
            @if($evaluates)
                <div class="row evaluates">
                    <div class="col-sm-12 col-md-12">
                        @foreach($evaluates as $i=>$item)
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    {!! evaluate_image($item) !!}
                                </div>
                                <div class="col-md-8 col-sm-6">
                                    <div class="website">
                                        <input value="{!! $item->mark !!}" class="rating" data-size="xxs" data-show-clear="false" data-show-caption="false" readonly="true"/>
                                        <a href="{{ route('review.domain',['domain'=>$item->domain]) }}" target="_blank" rel="bookmark" itemprop="url" title="{{ ($item->title)?$item->title:$item->domain.' Reviews' }}">{{ ($item->title)?$item->title:$item->domain.' Reviews' }}</a>
                                        <a href="{!! route('assess.domain',['domain'=>$item->domain])  !!}" target="_blank" title="Suggestions on {!! $item->domain !!}" rel="bookmark"><span class="glyphicon glyphicon-new-window"></span></a>
                                    </div>
                                    <div class="summary">
                                   {!! $item->summary !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row divde">
                                <div class="col-md-12 col-sm-12">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            <!-- recent_reviews -->
    @if($reviews)
        <div class="row recent_reviews">
            <div class="col-sm-12">
                @foreach($reviews as $review)
                    <div class="row review_line">
                        <div class="col-xs-3 col-sm-3 col-md-2">

                            <img src="{!! asset('assets/avatars/avatar.png') !!}" class="img-thumbnail"/>
                            <div class="author" itemprop="author">{!! ($review->user)?$review->user->name:'unsigned' !!}</div>
                            <div class="helpful">{{ trans('review.helpful_num',['num'=>$review->helpful]) }}</div>
                            <div class="reply">{{ trans('review.reply_num',['num'=>$review->reply]) }}</div>

                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-10">
                            <div class="review_title">
                                "{!! $review->title !!}"
                            </div>
                            <div class="review_rating clearfix">
                                <div class="pull-left">
                                    <input value="{!! $review->rating !!}" class="rating" data-size="xxs" data-show-clear="false" data-show-caption="false" readonly="true"/>
                                </div>
                                <div class="pull-left timeago">
                                    <time title="{!!($review->updated_at) !!} +0100" datetime="{!!($review->updated_at) !!} +0100">{!! Carbon::createFromTimeStamp(strtotime($review->updated_at))->diffForHumans() !!}</time>
                                </div>
                            </div>
                            <div class="review_content">
                                {{ trans('review.review') }}  {!! $review->review !!}
                            </div>
                            <div class="review_other">
                                <div class="helpful">
                                            <span class="isHelpful">
                                                 {{ trans('review.helpful_description') }}
                                            </span>
                                            <span class="helpfulButton" id="{!! $review->id !!}">
                                                yes
                                                <div class="popover fade right in" role="tooltip" style="display: block;margin-left: 40px;text-align: center;">
                                                    <div class="arrow" style="top: 50%;"></div>
                                                    <div class="popover-content helpful_num">{!! $review->helpful !!}</div>
                                                </div>
                                            </span>
                                </div>
                                <div class="report_review pull-right">
                                    <a role="button" class="report_review_button" id="{!! $review->id !!}">
                                        <i class="glyphicon glyphicon-flag"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection