<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Vmenu;
use Session;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            if (Auth::check()){
                $this->check_user();
                $this->check_admin();
            }else{
                return redirect()->to('/login');
            }
        return $next($request);
    }

    protected function getUserMenu($name=''){
        if(empty($name))$name=config('front.vmenu_name');
        $userMenu = Vmenu::get($name);
        if(!$userMenu){
            $userMenu = Vmenu::make($name, function($menu){
                $menu->add('Home',['url' => '', 'class' => 'navbar navbar-home', 'id' => 'home'])->prepend('<i class="glyphicon glyphicon-home"></i> ');;
              //  $menu->home->add('New',['url'  =>url('post/add'),  'class' => 'max-hide', 'id' => 'write'])->append('<i class="glyphicon glyphicon-edit"></i>');
            });
        }
        return  $userMenu;
    }
    public function check_user(){
        $user = Auth::user();
        if(!$user)return;
        $role = $user->isRole(config('front.role'));
        $menus = $this->getUserMenu();
        if($user){
            $menu=[
                'My Profile'=>route('user.profile'),

                //  'New Review/Testimonials'=>route('review.write'),
              //  'Review/Testimonials'=>route('user.review'),
            ];
            $icons=[
                'My Profile'=>'glyphicon-user',
             //   'Review/Testimonials'=>'glyphicon-star',
              //  'Share Coupon'=>'glyphicon-share',
                'New Post'=>'glyphicon-edit',
             //   'My Domains'=>'glyphicon-globe',
            //    'My Domain links'=>'glyphicon-th-list',
            //    'New Review/Testimonials'=>'glyphicon-queen',
            //    'My Cash Back Orders'=>'glyphicon-piggy-bank',
                'logout'=>'glyphicon-log-out',
            ];
/*
            if(!config('front.test')){
                $menu['Share Coupon']=route('user.coupon');

                if($user->post_in)
                    $menu['New Post']=route('article.write');
                  //  $menu->home->add('New',['url'  =>route('article.write'),  'class' => 'max-hide', 'id' => 'write'])->append('<i class="glyphicon glyphicon-edit"></i>');


                if($user->domain_in){
                $menu['My Domains']=route('user.domain');
                if($user->has_domain){
                    $menu['My Domain links']=route('user.domain.links');
                }
            }else{
                $menu['New Review/Testimonials']=route('user.review.edit');
            }
            if($user->cash_back_in){
                $menu['My Cash Back Orders']=route('user.cashback.orders');
            }else{
                $menu['My Cash Back Orders']=route('user.cashback.my.orders');
            }
            }
*/
        }

        $menu['logout']=route('logout');
        foreach($menu as $label=>$url){
            $icon = isset($icons[$label])?$icons[$label]:'glyphicon-cog';
            $menus->home->add($label,$url)->prepend('<i class="glyphicon '.$icon.'"></i> ');
        }
    }

    public function check_admin(){
        $user = Auth::user();
        if(!$user)return;
        $role = Auth::user()->isRole(config('adminhtml.role'));
        if($role){
            $menus = $this->getUserMenu();
            $menus->home->add('system',url(config('adminhtml.url')));
            $menus->home->add('logout',url('logout'));
            Session::set('system_user',1);
        }else{
            Session::set('system_user',0);
        }
        return $role;
    }
}
