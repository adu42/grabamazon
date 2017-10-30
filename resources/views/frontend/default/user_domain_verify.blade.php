<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-17
 * Time: 上午7:01
 */
?>
@extends(config('front.template').'layouts.2column-right')
@section('content')
   <div class="row domain">
      <div class="col-xs-12 col-sm-12 col-md-12">
        {!! trans('messages.domain_verify_description')  !!}
         {{ $verify_file_url }}
         <br><br>
         {{ Form::button('Check', array('class' => 'btn btn-default btn-sm','id'=>'domain_check_botton')) }}
         <script>
            $('#domain_check_botton').click(function(){
               $.get('{!! $check_url !!}',function($data){
                  if($data=='ok'){
                     $('#domain_check_botton').html('Verified');
                  }else{
                     $('#domain_check_botton').html('Verify fail.');
                  }
               });
            });
         </script>
      </div>
   </div>
@endsection