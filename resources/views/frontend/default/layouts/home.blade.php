<!DOCTYPE html>
<html lang="en">
<head>
    @include(config('front.template').'layouts.partials.head')
</head>
<body data-spy="scroll" data-target="#affix-nav">

@include(config('front.template').'layouts.partials.header')

<div class="container">

    <div class="row">
    <div class="col-sm-12 col-md-8 col-lg-8 main">
        @if(Context::get('breadcrumbs'))
            <div class="row">
                <div class="col-md-12">
                    @include(config('front.template').'layouts.partials.breadcrumb')
                </div>
            </div>
        @endif
        @yield('content')
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 side">
        @include(config('front.template').'layouts.partials.relation')
    </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        //review helpful click update
        $('.helpfulButton').tooltip('show');
        $('.helpfulButton').one('click',function(){
            var hf = $(this).find('.helpful_num');
            if(hf){
                $.get('{!! url("/helpful") !!}'+'/'+$(this).attr('id'));
                $(hf).html( parseInt($(hf).html())+1);
            }
        });
        // answer_helpful click update
        $('.answer_helpful .glyphicon').one('click',function(){
            var answer_id = $(this).parent('.answer_helpful').attr('id');
            answer_id = parseInt(answer_id);
            if(answer_id && answer_id > 0){
                var n = $(this).siblings('.answer_helpful_num').html();
                if($(this).hasClass('glyphicon-triangle-top')){
                    $.get('{!! url("/helpful") !!}'+'/'+answer_id+'/1');
                    $(this).next('.answer_helpful_num').html(parseInt(n)+1);
                }else{
                    $.get('{!! url("/helpful") !!}'+'/'+answer_id+'/0');
                    $(this).next('.answer_helpful_num').html(parseInt(n)-1);
                }
                // remove event
                $(this).siblings('.glyphicon').unbind();
            }
        });


        //review report dialog , update review report
        $('.report_review_button').bind(
                "click", function (event) {
                    $.ajax({
                        url:'/report/'+$(this).attr('id'),
                        success:function(html){
                            var dialogInstance2 = new BootstrapDialog({'nl2br':false                            });
                            dialogInstance2.setTitle('{{ trans('review.report_review') }}');
                            dialogInstance2.setMessage(html);
                            dialogInstance2.setType(BootstrapDialog.TYPE_INFO);
                            dialogInstance2.setExistButtonsInitClose();
                            dialogInstance2.open();
                        }
                    });
                    return false;
                }
        );

        //question report dialog , update question report
        $('.report_question_button').bind(
                "click", function (event) {
                    $.ajax({
                        url:'/report/'+$(this).attr('id')+'/question',
                        success:function(html){
                            var dialogInstance2 = new BootstrapDialog({'nl2br':false
                            });
                            dialogInstance2.setTitle('{{ trans('review.report_question') }}');
                            dialogInstance2.setMessage(html);
                            dialogInstance2.setType(BootstrapDialog.TYPE_INFO);
                            dialogInstance2.setExistButtonsInitClose();
                            dialogInstance2.open();
                        }
                    });
                    return false;
                }
        );

        //review report dialog , update review report
        $('.report_answer_button').bind(
                "click", function (event) {
                    $.ajax({
                        url:'/report/'+$(this).attr('id')+'/answer',
                        success:function(html){
                            var dialogInstance2 = new BootstrapDialog({'nl2br':false
                            });
                            dialogInstance2.setTitle('{{ trans('review.report_answer') }}');
                            dialogInstance2.setMessage(html);
                            dialogInstance2.setType(BootstrapDialog.TYPE_INFO);
                            dialogInstance2.setExistButtonsInitClose();
                            dialogInstance2.open();
                        }
                    });
                    return false;
                }
        );

        //review report dialog , update review report
        $('.ask_question').bind(
                "click", function (event) {
                    $.ajax({
                        url:'/ask/'+$(this).attr('id'),
                        success:function(html){
                            var dialogInstance2 = new BootstrapDialog({'nl2br':false
                            });
                            dialogInstance2.setTitle('{{ trans('review.question_button') }}');
                            dialogInstance2.setMessage(html);
                            dialogInstance2.setType(BootstrapDialog.TYPE_INFO);
                            dialogInstance2.setExistButtonsInitClose();
                            dialogInstance2.open();
                        }
                    });
                    return false;
                }
        );

        /* botton question_reply */
        $('.question_reply').on('click',function(){
            $('html,body').animate({scrollTop:($(this).parents('.row').siblings('.write').offset().top)});
        });
        /* botton question_reply end */
        /*
         $('#affix-nav').affix({
         top:$('#fixed').offset().top(),
         bottom:$('footer').outerHeight(true)
         });
         */

        /*  affix-nav   */
        var affix_fixed = $(".affix_fixed");
        if(affix_fixed && affix_fixed.length>0){
            var navH = $(".affix_fixed").offset().top;
            $(".affix_fixed").hide();
            var show_affix_nav_fixed = true;
            $(window).scroll(function(){
                var scroH = $(this).scrollTop();
                if(show_affix_nav_fixed){
                    if(scroH>=navH){
                        $(".affix_fixed").css({"position":"fixed","top":"0","border":"1px #FFF solid","z-index":"99999"});
                        $(".affix_fixed").show();
                    }else if(scroH<navH){
                        $(".affix_fixed").css({"position":"static"});
                        $(".affix_fixed").hide();
                    }
                }
            });
            $(".close_affix_fixed").click(function(){
                show_affix_nav_fixed = false;
                $(".affix_fixed").hide();
            });
        }
        /*  affix-nav  end   */

    });
</script>
@include(config('front.template').'layouts.partials.footer')
</body>
</html>