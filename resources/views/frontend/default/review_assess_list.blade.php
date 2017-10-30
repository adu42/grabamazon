<?php use Carbon\Carbon; ?>
@extends(config('front.template').'layouts.review')
@section('content')
    <div class="evaluate">
        @if($evaluate)
            <div class="row">
                <div class="col-sm-12">
                <div class="domain">
                    <div class="domain_name"><h2><a href="{!! route('review.domain',['domain'=>$evaluate->domain])  !!}" target="_blank" rel="bookmark" title="{{$evaluate->domain}} reviews">{!! $evaluate->domain !!}<span class="glyphicon glyphicon-new-window"></span></a></h2>
                        @if($evaluate->risk)
                            <div data-toggle="tooltip" class="risk glyphicon glyphicon-warning-sign" title="{{ trans('review.risky') }}"></div>
                        @endif
                    </div>
                    <div class="review_num">{!! $evaluate->reviews !!} {{ trans('review.reviews') }}</div>
                </div>
                <div class="site_mark">
                    <input id="mark" value="{!! $evaluate->mark !!}" class="rating" data-size="xs" disabled="disabled"/>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-8 website_info">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="website"><a href="{!! route('front.goto',['link'=>'a'.$evaluate->id])  !!}" target="_blank" rel="nofollow" itemprop="url">{!! $evaluate->domain !!}<span class="glyphicon glyphicon-new-window"></span></a></div>
                            <div class="summary">{!! $evaluate->summary !!}</div>
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
                    <!-- space -->
                    <div class="row">
                        <div class="col-xs-12">

                        </div>
                    </div><!-- end space -->



                    <!-- Rating Distribution && Detailed Rating Summary -->
                    <div class="row margin-top-20  bottom_line" id="overview">
                     <!--   Rating Distribution  -->
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="h4">{{ trans('review.rating_distribution')  }}</div>
                                </div>
                            </div>
                            @for($i=5;$i>=1;$i--)
                                <div class="row">
                                <div class="label">
                                    <a href="{{ route('review.domain.id',['domain'=>$evaluate->domain,'star'=>$i])  }}">{{ trans_choice('review.star',$i,['star'=>$i]) }}</a>
                                </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{!! ($star="star_$i")?$evaluate->$star:$evaluate->$star !!}" aria-valuemin="0" aria-valuemax="100" style="width: {!! ($star="star_$i")?$evaluate->{$star}:$evaluate->{$star} !!}%;">
                                            <span class="sr-only">{!! ($star="star_$i")?$evaluate->{$star}:$evaluate->{$star} !!}%</span>
                                        </div>
                                    </div>
                                </div>
                               @endfor
                        </div>
                        <div class="col-xs-12 col-md-1 col-lg-1 hidden-xs">
                            <div class="vline"></div>
                        </div>
                     <!-- Detailed Rating Summary -->
                        <div class="col-xs-12 col-md-5 col-lg-5">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="h4">{{ trans('review.star_summary')  }}</div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="label black">{{ trans('review.star_quality')  }}</div>
                                    <div class="star_value"><input id="star_quality" class="rating" value="{{ $evaluate->quality }}" data-size="xxs" data-show-clear="false" data-show-caption="false" readonly="true"/></div>

                                </div>
                            <div class="row">
                                <div class="label black">{{ trans('review.star_value')  }}</div>
                                <div class="star_value"><input id="star_value" class="rating" value="{{ $evaluate->value }}" data-size="xxs" data-show-clear="false" data-show-caption="false" readonly="true"/></div>

                            </div>
                            <div class="row">
                                <div class="label black">{{ trans('review.star_shipping')  }}</div>
                                <div class="star_value"><input id="star_shipping" class="rating" value="{{ $evaluate->shipping }}" data-size="xxs" data-show-clear="false" data-show-caption="false" readonly="true"/></div>

                            </div>
                            <div class="row">
                                <div class="label black">{{ trans('review.star_returns')  }}</div>
                                <div class="star_value"><input id="star_returns" class="rating" value="{{ $evaluate->returns }}" data-size="xxs" data-show-clear="false" data-show-caption="false" readonly="true"/></div>

                            </div>
                            <div class="row">
                                <div class="label black">{{ trans('review.star_service')  }}</div>
                                <div class="star_value"><input id="star_service" class="rating" value="{{ $evaluate->service }}" data-size="xxs" data-show-clear="false" data-show-caption="false" readonly="true"/></div>

                            </div>
                        </div>
                    </div>
            <div class="row margin-top-20">
                <div class="col-xs-12 col-md-12 col-lg-12">
    {!! $evaluate->content !!}
                </div>
</div>
    <!-- tips -->
    @if($evaluate->tips_success && $evaluate->tips_success->count())
<div class="row margin-top-20">
    <div class="col-xs-12 col-md-12 col-lg-12">
        <div class="h4">
         <i class="fa fa-check-square-o fa-lg"></i>   {{ trans('review.tip_success_title') }}
        </div>
    </div></div>

<div class="row margin-top-20">
    <div class="col-xs-12 col-md-12 col-lg-12">


            <ul class="tips">
                @foreach($evaluate->tips_success as $tip)
                <li>{{ $tip->tip  }}</li>
                @endforeach
            </ul>

    </div>
</div>
    @endif
@if($evaluate->tips_notice && $evaluate->tips_notice->count())
<div class="row margin-top-20">
    <div class="col-xs-12 col-md-12 col-lg-12">
        <div class="h4">
            <i class="fa fa-lightbulb-o  fa-lg"></i> {{ trans('review.tip_notice_title') }}
        </div>
    </div></div>

<div class="row margin-top-20">
    <div class="col-xs-12 col-md-12 col-lg-12">


        <ul class="tips">
            @foreach($evaluate->tips_notice as $tip)
                <li>{{ $tip->tip  }}</li>
            @endforeach
        </ul>

    </div>
</div>
@endif

@if($evaluate->tips_warning && $evaluate->tips_warning->count())
<div class="row margin-top-20">
    <div class="col-xs-12 col-md-12 col-lg-12">
        <div class="h4">
            <i class="fa fa-warning  fa-lg"></i>  {{ trans('review.tip_warning_title') }}
        </div>
    </div></div>

<div class="row margin-top-20">
    <div class="col-xs-12 col-md-12 col-lg-12">


        <ul class="tips">
            @foreach($evaluate->tips_warning as $tip)
                <li>{{ $tip->tip  }}</li>
            @endforeach
        </ul>

    </div>
</div>
@endif


@if($evaluate->links)
<div class="row margin-top-20">
    <div class="col-xs-12 col-md-12 col-lg-12">
        <div class="h4">
         <i class="fa fa-link fa-lg"></i>   {{ trans('review.links_title') }}
        </div>
    </div></div>

<div class="row margin-top-20">
    <div class="col-xs-12 col-md-12 col-lg-12">


        <ul class="tips">
            @foreach($evaluate->links as $link)
                <li>{{ link_to_route('front.goto',$link->label?:$link->link,['link'=>'l'.$link->id])   }}</li>
            @endforeach
        </ul>

    </div>
</div>
@endif

<div class="row margin-top-20">
<div class="col-xs-12 col-md-12 col-lg-12">
    <ul>
        <li> We will try our best to push most of negative reviews with unsatisfied experience to site owners, to help the reviewers get as much refunded as possible. So it is appreciated to post a review with order id and images via <a href="{{ route('review.add',['domain'=>$evaluate->domain]) }}" title="Post a new reviews about {{$evaluate->domain}}" target="_blank">this link</a>  (<a href="{{ route('review.add',['domain'=>$evaluate->domain]) }}" title="Add reviews" target="_blank">add reviews</a>).</li>
        <li> If there is an improper or fake review, comment, reply and other information, please <a href="{{ route('review.domain',['domain'=>$evaluate->domain]) }}" title="report about {{$evaluate->domain}}" target="_blank">report abuse here.</a></li>
    </ul>
</div>
</div>


@else
<div class="h2">{{ trans('review.not_found') }}</div>
@endif
</div>
@endsection