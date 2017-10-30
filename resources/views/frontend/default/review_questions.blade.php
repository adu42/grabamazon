<?php use Carbon\Carbon; ?>
@if($questions)
    <div class="row" id="qas">
        <div class="col-xs-12 ">
        <h3>{{ trans('review.question_title',['num'=>$questions->count()])  }}</h3>
        </div>

    </div>
    <div class="row">
        <div class="col-xs-9 col-md-10 col-lg-10">
            {{ trans('review.question_description',['domain'=>$evaluate->domain])  }}
            - {!! link_to_route('review.add','click here to write a review',['domain'=>$evaluate->domain]) !!}
        </div>
        <div class="col-xs-3 col-md-2 col-lg-2">
            @if(Auth::check())
            <a class="btn btn-primary btn-sm ask_question" id="{!! $evaluate->id !!}">
                <span>{!! trans('review.question_button') !!}</span>
            </a>
            @else
                @include(config('front.template').'layouts.partials.please_login',['for'=>'ask_question'])
            @endif
        </div>
    </div>
    @foreach($questions as $question)
    <div class="row question_line">
        <div class="col-xs-4 col-md-2">
        <div class="author">

            @if($question->user)
                <span>
                    {{ avatar($question->user,'x120',['class'=>'img-circle avatar']) }}
                </span>
                <span class="name">{!! $question->user->name !!}.</span>
            @else
                <span class="name">{!! trans('review.question_unsigned') !!}.</span>
            @endif
       </div>
        </div>
        <div class="col-xs-8 col-md-10">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="question-content">
                     {{ trans('review.question_begin') }} {!! $question->question !!}
                     </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="question-footer">
                        <span class="time"><time class="timeago" title="{!!($question->updated_at) !!} +0100" datetime="{!!($question->updated_at) !!} +0100">{!! Carbon::createFromTimeStamp(strtotime($question->updated_at))->diffForHumans() !!}</time></span>
                        <div class="report_question">
                            <a role="button" class="report_question_button" id="{!! $question->id !!}">
                                <i class="glyphicon glyphicon-flag"></i>
                            </a>
                        </div>
                        @if(Auth::check())
                        <div class="btn btn-primary btn-sm question_reply" id="{!! $question->id !!}">{!! trans('review.question_reply') !!}</div>
                        @else
                            @include(config('front.template').'layouts.partials.please_login',['for'=>'ask_question'])
                        @endif
                    </div>
                </div>
            </div>
            @if($question->answers)
                @foreach($question->answers as $answer)
                <div class="row">
                    <div class="col-xs-11 col-md-11">
                         <div class="author">
                             @if($answer->user)
                                 {{ avatar($answer->user,'x120',['class'=>'img-circle avatar']) }}
                                 <span class="name">{!! $answer->user->name !!}.</span>
                             @else
                                 <span class="name">{!! trans('review.answer_unsigned') !!}.</span>
                             @endif
                         </div>
                        <div class="answer_body">
                            {{ trans('review.answer_begin') }}  {{ $answer->answer }}
                        </div>
                        <div class="answer_footer">
                            <span class="time"><time class="timeago" title="{!!($answer->updated_at) !!} +0100" datetime="{!!($answer->updated_at) !!} +0100">{!! Carbon::createFromTimeStamp(strtotime($answer->updated_at))->diffForHumans() !!}</time></span>
                            <div class="report_answer">
                                @if(Auth::check())
                                <a role="button" class="report_answer_button" id="{!! $answer->id !!}">
                                    <i class="glyphicon glyphicon-flag"></i>
                                </a>
                                @else
                                    @include(config('front.template').'layouts.partials.please_login',['for'=>'ask_question'])
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1 col-md-1 answer_helpful" id="{!! $answer->id !!}">
                        <div class="glyphicon glyphicon-triangle-top"></div>
                        <div class="answer_helpful_num">{!! $answer->helpful !!}</div>
                        <div class="glyphicon glyphicon-triangle-bottom"></div>
                    </div>
                </div>
                @endforeach
            @endif
            @if(Auth::check())
            <div class="row write">
                <div class="col-xs-12 col-md-12 answer_new">
                    {!! Form::open(['url'=>'save-answer','class'=>'answer_form']) !!}
                 <div class="input-group">
                    {!! Form::text('answer','',['class'=>'form-control']) !!}
                    <span class="input-group-btn">{!! Form::button('answer',['class'=>'btn btn-primary answer-btn']) !!}</span>
                </div>
                    {!! Form::hidden('question_id',$question->id) !!}
                    {!! Form::hidden('user_id',$question->user_id) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            @else
                @include(config('front.template').'layouts.partials.please_login',['for'=>'ask_question'])
            @endif
        </div>
    </div>
    @endforeach

    @if(Auth::check())
    <script>
        $('.reply_btn').click(function(){
            $('input[name="quote_user_id"]').val($(this).attr('id'));
            if($('#div_reply').length>0){
                console.log($('#div_reply'));
                $('#div_reply').html('{!! trans('article.reply') !!} '+ $(this).attr('data-name'));
            }else{
                $('#div_comment').before('<span id="div_reply">{!! trans('article.reply') !!} '+ $(this).attr('data-name')+'</span>');
            }
            $(window).scrollTop($('#div_comment').offset().top);
            //$(document).animate({scrollTop:$('#div_comment').offset().top},1000);
        });
        $('.answer-btn').click(function(){
            var answer_form =  $(this).parents('form.answer_form:first');
            var answer_new  = $(this).parents('div.answer_new:first');
            var answer = $(this).prevAll('input[name="answer"]');
            if(answer && answer.length>0){
                answer=$(answer).val();
            }
            if(answer_form && answer_form.length>0){
                $.post($(answer_form).attr('action'),$(answer_form).serialize(),function(message){
                    console.log(message+answer);
                    if(answer_new && answer_new.length>0){
                        $(answer_new).html(message);
                    }
                })
            }

        });
    </script>
    @endif
@endif
