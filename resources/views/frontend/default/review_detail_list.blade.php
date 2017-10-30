<?php use Carbon\Carbon; ?>
@extends(config('front.template').'layouts.review')
@section('content')
    <div class="evaluate">
        @if($evaluate)
            <div class="row">
                <div class="col-sm-12">
                <div class="domain">
                    <div class="domain_name">
                        <h2>
                            @if($evaluate->title)
                                {{ $evaluate->title }}
                            @else
                                {!! $evaluate->domain !!} Reviews
                            @endif
                        </h2>
                        @if($evaluate->risk)
                            <div data-toggle="tooltip" class="risk glyphicon glyphicon-warning-sign" title="{{ trans('review.risky') }}"></div>
                        @endif
                    </div>
                    <div class="review_num">{!! $evaluate->reviews !!} {{ trans('review.reviews') }}</div>
                    <div class="honors pull-right">
                        @if($evaluate->cash_back_in)
                            <i class="fa fa-money fa-lg" data-toggle="tooltip" title="{{ trans('review.cash_back_description') }}"></i>
                        @endif
                        @if($evaluate->hasCoupon())
                            <i class="fa fa-gift fa-lg" data-toggle="tooltip" title="{{ trans('review.cash_back_description') }}"></i>
                        @endif
                    </div>
                </div>
                <div class="site_mark">
                    <input id="mark" value="{!! $evaluate->mark !!}" class="rating" data-size="xs" disabled="disabled" data-show-clear="false"/>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="btn-block margin-bottom-20">
                        <a class="btn btn-primary btn-sm width100" data-toggle="tooltip"  href="{{ route('review.add',['domain'=>$evaluate->domain]) }}" title="{{ trans('review.write_title') }}">{{ trans('review.write') }}</a>
                     <!--   <a class="btn btn-primary btn-sm width-100" data-toggle="tooltip"   href="{!! route('assess.domain',['domain'=>$evaluate->domain])  !!}" title="{{ trans('review.summary_title') }}">{{ trans('review.summary') }}</a>-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    {!! image_to($evaluate->screen,'',$evaluate->domain,['class'=>"img-thumbnail"]) !!}
                    @if($evaluate->online)
                        <div class="online">{{ trans('review.online') }}</div>
                        @else
                        <div class="offline">{{ trans('review.offline') }}</div>
                    @endif
                </div>
                <div class="col-sm-8 website_info">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                    <div class="website"><a href="{!! route('front.goto',['link'=>'a'.$evaluate->id])  !!}" target="_blank"  itemprop="url">Link to {!! $evaluate->domain !!}<span class="glyphicon glyphicon-new-window"></span></a></div>
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
<!-- assess -->
            <div class="row margin-top-20">
                <div class="col-xs-12 col-md-12 col-lg-12">
                    {!! $evaluate->content !!}
                </div>
            </div>
            <!-- tips -->
            @if($evaluate->tips_warning && $evaluate->tips_warning->count())
                <div class="row margin-top-20 alert alert-danger">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="h4">
                            <i class="fa fa-warning fa-lg"></i>  {{ trans('review.tip_warning_title') }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <ul class="tips">
                            @foreach($evaluate->tips_warning as $tip)
                                <li>{{ $tip->tip  }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if($evaluate->tips_notice && $evaluate->tips_notice->count())
                <div class="row margin-top-20 alert alert-warning">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="h4">
                            <i class="fa fa-lightbulb-o fa-lg"></i> {{ trans('review.tip_notice_title') }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <ul class="tips">
                            @foreach($evaluate->tips_notice as $tip)
                                <li>{{ $tip->tip  }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            @endif
            @if($evaluate->tips_success && $evaluate->tips_success->count())
                <div class="row margin-top-20 alert alert-success">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="h4">
                            <i class="fa fa-check-square-o fa-lg"></i>   {{ trans('review.tip_success_title') }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <ul class="tips">
                            @foreach($evaluate->tips_success as $tip)
                                <li>{{ $tip->tip  }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if($evaluate->links && $evaluate->links->count())
                <div class="row margin-top-20">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="h4">
                            <i class="fa fa-link fa-lg"></i>{{ trans('review.links_title') }}
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
        <!--assess end-->
                    <!-- space -->
                    <div class="row">
                        <div class="col-xs-12">

                        </div>
                    </div><!-- end space -->
                    <!-- tabs -->
                    <div class="row margin-top-20 hidden-xs hidden-sm">
                        <div class="col-xs-12">
                            <ul class="nav nav-tabs">
                                <li><a href="{{  Request::url() }}#overview"><i class="glyphicon glyphicon-stats"></i> {{ trans('review.overview')  }}</a></li>
                                <li><a href="{{  Request::url() }}#reviews"><i class="glyphicon glyphicon-comment"></i> {{ trans('review.reviews')  }}({!! $evaluate->reviews !!})</a></li>
                                <li><a href="{{  Request::url() }}#qas"><i class="glyphicon glyphicon-comment"></i> {{ trans('review.qa')  }}({!! $evaluate->qas !!})</a></li>
                             <!--   <li><a href="#photos"><i class="glyphicon glyphicon-picture"></i> {{ trans('review.photo')  }}({!! $evaluate->photos !!})</a></li>  -->
                            </ul>
                        </div>
                    </div>
            <!--class="fixed_top"-->
                <div class="affix_fixed hidden-xs hidden-sm" id="affix-nav">
                    <div class="container">
                    <div class="row width-95p">
                    <div class="col-xs-10 col-md-10">
                        <ul class="nav nav-pills">
                            <li class="tab_overview"><a href="#overview"><span class="tab_title">{{ trans('review.overview')  }}</span></a></li>
                            <li class="tab_reviews"><a href="#reviews"><span class="tab_title">{{ trans('review.reviews')  }}</span> <span class="tab_count">({!! $evaluate->reviews !!})</span></a></li>
                            <li class="tab_qa"><a href="#qas"><span class="tab_title">{{ trans('review.qa')  }}</span> <span class="tab_count">({!! $evaluate->qas !!})</span></a></li>
                          <!--  <li class="tab_photos last current"><a href="#website_photos"><span class="tab_title">{{ trans('review.photo')  }}</span> <span class="tab_count">({!! $evaluate->photos !!})</span></a></li> -->
                        </ul>
                    </div>
                    <div class="col-xs-2 col-md-2">
                        <a href="{{ route('review.add',['domain'=>$evaluate->domain]) }}" class="btn btn-sm btn-primary pull-right" rel="nofollow">{{ trans('review.write_review') }}</a>
                    </div>
                    </div>
                    </div>
                </div>

            <!--class="fixed_top end"-->
                    <div class="row margin-top-20 bottom_line">
                        <div class="col-xs-6">
                            <div class="h4">
                                {{ trans_choice('review.review_in_community',$evaluate->reviews,['num'=>$evaluate->reviews])  }}
                            </div>
                            </div>
                        <div class="col-xs-6">
                            <div class="search">
                                <form class="form-inline pull-right" action="{!! route('review.domain',['domain'=>$evaluate->domain]) !!}" method="get">
                                    <div class="input-group">
                                        <input type="text" name="keyword" class="form-control input-sm" placeholder="{{ trans('review.search_review_placeholder')  }}"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-sm" type="submit">Go!</button>
                                          </span>
                                    </div><!-- /input-group -->
                                </form>
                            </div>
                        </div>
                    </div>

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
                        <div class="col-xs-12 col-md-12">
                         <h5> {{ trans('review.domain_detail_description',['domain'=>$evaluate->domain]) }} </h5>
                        </div>
                    </div>
                    <!-- reviews -->
                    @if($reviews)
                        <div class="row margin-top-20" id="reviews">
                            <div class="col-xs-6 col-md-6 col-lg-6">
                                <div class="h4">
                                    {{ trans('review.all_review') }}
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6 col-lg-6">
                                <div class="dropdown pull-right">
                                    <div class="dropdown-toggle" id="sort_by_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        {{ trans('review.review_sort_by')  }}{{ trans('review.review_sort_by_recent')  }}
                                        <span class="caret"></span>
                                    </div>
                                    <ul class="dropdown-menu" aria-labelledby="sort_by_dropdown">
                                        <li><a href="{{ route('review.domain.sort.dir',['domain'=>$evaluate->domain,'sort'=>'recent','dir'=>'desc']) }}">{{ trans('review.review_sort_by_recent')  }}</a></li>
                                        <li><a href="{{ route('review.domain.sort.dir',['domain'=>$evaluate->domain,'sort'=>'helpful','dir'=>'desc']) }}">{{ trans('review.review_sort_by_helpful')  }}</a></li>
                                    </ul>
                                </div>
                            </div>
                       </div>

                        @foreach($reviews as $k=>$review)
                            <div class="row review_line">
                                <div class="col-xs-3 col-sm-3 col-md-2">
                                    @if($review->user)
                                        {{ avatar($review->user,'x120',['class'=>'img-thumbnail']) }}
                                        @endif
                                    <div class="author" itemprop="author">{!! ($review->user)?$review->user->name:'unsigned' !!}</div>
                                    <div class="helpful">{{ trans('review.helpful_num',['num'=>$review->helpful]) }}</div>
                                   <!-- <div class="reply">{{ trans('review.reply_num',['num'=>$review->reply]) }}</div> -->
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
                                      {!! $review->capacity !!}
                                    </div>
                                    @if($review->images)<div class="review_images">
                                       @foreach($review->images as $image)
                                           <img src="{{ $image->thumbnail }}" data-toggle="modal"  data-target="#big-image-{{$image->id}}"/>
                                            <div class="modal fade" id="big-image-{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <img src="{{ $image->image }}" class="img-responsive"/>
                                                </div>
                                            </div>
                                       @endforeach
                                    </div>
                                    @endif
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

                                    <div class="review_explains">
                                    @if($review->review_explain)
                                        @foreach($review->review_explain as $explain)
                                            <div class="review_explain">
                                            {{ trans('review.explain') }}       {!! $explain->explain !!}
                                            </div>
                                            <div class="review_explain_other">
                                                <div class="review_explain_affiliated">
                                            {{ trans('review.affiliated') }}      {!! $explain->affiliated !!}
                                                </div>
                                                <div class="review_explain_company">
                                            {{ trans('review.company') }}     {!! $explain->company !!}
                                                </div>
                                                <div class="time">&nbsp;•&nbsp;<time class="timeago" title="{!!($explain->updated_at) !!} +0100" datetime="{!!($explain->updated_at) !!} +0100">{{ time_ago($explain->updated_at) }}</time></div>
                                             </div>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                            </div>
                          @if($k<1)
                            <div class="row review_line ad">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    {{ Widget::block('review-first-advertising')  }}
                                </div>
                            </div>
                         @endif
                        @endforeach
                    @endif
    <!-- qustions  -->
                  @if($questions)
                      {!! $questions !!}
                  @endif
    <!-- questions end -->

 <script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "WebPage",
  "name": "Review {!! $evaluate->domain !!}",
  "description": "{!! $evaluate->domain !!} operators {{ $evaluate->summary }}",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "{!! $evaluate->mark !!}",
    "bestRating": "5",
    "ratingCount": "{!! ($reviews && $reviews->count())?$reviews->count():121 !!}"
  }
}
</script>
        @else
            <div class="h2">{{ trans('review.not_found') }}</div>
        @endif
    </div>
@endsection
