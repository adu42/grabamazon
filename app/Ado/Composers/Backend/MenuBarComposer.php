<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-3-25
 * Time: 上午5:14
 */
namespace App\Ado\Composers\Frontend;

use App\Ado\Models\Tables\Cms\Category;


class NavBarComposer{
    public function compose($view)
    {
        $view->with('menus',Category::where('is_active',1)->orderBy('_lft')->all()->renderHorizontal());
    }
}