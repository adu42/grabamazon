<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/30
 * Time: 11:46
 */
 ?>
@if(isset($reviews))
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