<?php namespace App\Ado\Composers\Backend;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-3-25
 * Time: 上午7:46
 */

use App\Ado\Models\Tables\User\Menu;
use Illuminate\Support\Facades\Auth;

class SidebarComposer{
    protected $adminMenu;
    public function __construct(Menu $adminmenu){
        $this->adminMenu = $adminmenu;
    }
    public function compose($view)
    {
        $menus=Auth::user()->menus();
        if($menus){
            $view->with('menus', $menus->renderNavlist());
        }else{
            $view->with('menus', '');
        }

    }
}