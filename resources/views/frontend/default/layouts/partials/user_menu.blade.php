@if(isset($user_menus) && !empty($user_menus))
<nav class="nav navbar-nav">
    <ul class="panel-group">
        @include(config('front.template').'layouts.partials.user_menu_items', array('items'=>$user_menus->roots()))
    </ul>
</nav>
@endif