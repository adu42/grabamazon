@if(Auth::check())
    <i class="glyphicon glyphicon-comment text-muted" aria-label="{{ trans('messages.please_upgrade_role',isset($for)?['for'=>trans($for)]:['for'=>'']) }}"></i>
@else
    <a href="{{url('/login')}}">
    <i class="glyphicon glyphicon-user text-muted" aria-label="{{ trans('messages.please_login',isset($for)?['for'=>trans($for)]:['for'=>'']) }}"></i>
    </a>
@endif