<?php namespace App\Ado\Composers\Backend;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-3-26
 * Time: 上午9:41
 */

class HeadComposer{
    public function compose($view)
    {
        //  $view->with('menus', 'A123456789');
        //  $this->adminMenu->getMenus(Auth::user());
        $head['title'] = 'test title';//Auth::user()->isAdmin;
        $head['keywords'] = 'test keywords';
        $head['description'] = 'test description';
        $head['meta'] = '';
        $head['js'] = '';
        $head['css'] = '';

        $view->with('document', (object)$head);
    }

}