<?php use Carbon\Carbon; ?>
@if($comments)
    <div class="row reviews_label">
        <h3>{{ trans('review.reviews') }}</h3>
    </div>
    @foreach($comments as $comment)
        <div class="row comment">
            <div class="col-md-12">
                <div class="row author">
                    <div class="col-xs-2 col-sm-2 col-md-1">
                        {!! avatar($comment->user,'x40',['class'=>"img-circle avatar"]) !!}
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-4 name">
                        {!! $comment->user->name !!} <time class="timeago" title="{!!($comment->updated_at) !!} +0800"
                                                           datetime="{!!($comment->updated_at) !!} +0800">
                            {!! Carbon::createFromTimeStamp(strtotime($comment->updated_at))->diffForHumans() !!}
                        </time>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-1 pull-right">
                        @if(Auth::check() && Auth::user()->comment_in)
                        <div class="reply_btn btn" id="{!! $comment->id !!}"
                             data-name="{!! $comment->user->name !!}">
                           <i class="glyphicon glyphicon-edit"></i> {!! trans('article.reply') !!}</div>
                        @else
                            @include(config('front.template').'layouts.partials.please_login',['for'=>'comment'])
                        @endif

                    </div>
                </div>
                @if($quotes=$comment->getQuotes())
                    <div class="row comment-quotes">
                        <div class="col-xs-2 col-md-2 col-sm-2 quote_label"> Quote:</div>
                        <div class="col-xs-10 col-md-10 col-sm-10">
                            @foreach($quotes as $quote)
                            @include(config('front.template').'comment_quote',compact('quote'))
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="row comment-content">
                    <div class="col-md-11 col-md-offset-1 col-sm-11 col-sm-offset-1">
                        {!! $comment->comment !!}
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->comment_in)
                <div class="row comment-form" id="comment-form-{{ $comment->id }}" style="display: none">
                    <div class="col-md-11 col-md-offset-1">
                        @include(config('front.template').'comment_quote_form',compact('comment'))
                    </div>
                </div>
                @endif
            </div>
        </div>
    @endforeach
    @if(Auth::check() && Auth::user()->comment_in)
    <script>
        $('.reply_btn').click(function () {
            var _fom = $('#comment-form-'+$(this).attr('id'));
            if(_fom && _fom.length>0){
                $(_fom).toggle();
                $(_fom).find('input[type=reset]').click(function(){
                    $(_fom).hide();
                });
            }
        });
    </script>
    @endif
@endif
