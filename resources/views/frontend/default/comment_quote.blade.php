<?php use Carbon\Carbon; ?>
@if($quote)
        <div class="row">
            <div class="col-sm-12 col-md-12 quote">
                <div class="row author">
                    <div class="col-xs-2 col-md-1">
                        {!! avatar($quote->user,'x40',['class'=>"img-circle avatar"]) !!}
                    </div>
                    <div class="col-xs-10 col-md-7 name">
                        {!! $quote->user->name !!}
                        <time class="timeago" title="{!!($comment->updated_at) !!} +0800"
                              datetime="{!!($comment->updated_at) !!} +0800">
                            {!! Carbon::createFromTimeStamp(strtotime($quote->updated_at))->diffForHumans() !!}
                        </time>
                    </div>
                </div>
                <div class="row comment-content">
                    <div class="col-md-12">
                        {!! $quote->comment !!}
                    </div>
                </div>
            </div>
        </div>
@endif
