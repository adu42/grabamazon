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
   <div class="row user">
      <div class="col-xs-12 col-sm-12 col-md-12">
{{ avatar($user)  }}
         <div class="user">{!! ($user)?$user->name:'unsigned' !!}</div>
         <div class="email">{!! ($user)?$user->email:'unsigned' !!}</div>
         <div class="summary">{!! ($user)?$user->summary:'' !!}</div>
      </div>
   </div>
   <div class="row user">
      <div class="col-xs-12 col-sm-12 col-md-12">
         {{ link_to_route('user.profile.edit',trans('messages.user_profile_edit_link_label')) }}
      </div>
   </div>
@endsection