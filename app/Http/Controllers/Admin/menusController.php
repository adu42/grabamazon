<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-2
 * Time: 上午3:05
 */

namespace App\Http\Controllers\Admin;
use App\Ado\Models\Tables\User\Menu;
//use DB;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use View;
use Input;
use Request;



class menusController extends AdminBaseController {
    // 列表页
    public function index(Menu $menu){
        $filter = DataFilter::source($menu->orderBy('_lft'));
        $filter->text('name','Search')->scope('Search');
        $filter->build();
        $set = DataSet::source($filter);
        $set->paginate(200);
        $set->build();

     //   $filter->withDepth();
      // $tree=  $set->data->linkNodes();
        // ->withDepth();
        $editUrl = route('admin.menus.edit',['id'=>'%s']);
        $sortUrl = route('admin.menus.sort');
        $tree =   $set->data->renderTree($editUrl,'ul',$sortUrl);
        return View::make(config('adminhtml.template').'menu_index', compact('filter', 'set'));
    }

    //编辑页
    public function edit($id=''){
       $id = (!empty($id))?:Request::get('id');
       $this->setInputValue('parent_id',0,$id);
       $menu = Menu::findOrNew($id);
       if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.menus.index');
        $edit = DataEdit::source($menu);
        $edit->label('Edit Menu');
        $edit->link($returnUrl,"Menus", "TR")->back();
        $edit->action(route('admin.menus.edit'));
        $edit->add('name','Name', 'text')->rule('required|min:3');
        $edit->add('url_key','urlKey', 'text');
        $edit->add('description','Description', 'textarea')->attributes(array('rows'=>2));
        $edit->add('image','image', 'image')->move(config('app.upload_dir'))->fit(config('app.images_size.x240'))->resize(config('app.images_size.x80'))->preview(config('app.images_size.x80'));
        //  $edit->add('sort_order','Sort', 'text');
        $edit->add('parent_id','parent','select')->options(Menu::select('name as title','id as value')->get()->toArray());
        $edit->add('in_top','in_top','checkbox');
        $edit->add('is_active','Enable','checkbox');
      //  $edit->add('path','path','text');
        return $edit->view(config('adminhtml.template').'menu_edit', compact('edit'));
    }

    public function sort($id=null,$sort=''){
        if(!$sort)$sort=Input::get('sort')?:'';
        if(!$id)$id=Input::get('id')?:0;
        if($id){
            $menu = Menu::find($id);
            if($menu){
                if($sort=='up'){
                    $menu->up();
                }else  if($sort=='down')$menu->down();
            }
        }
        Menu::fixTree();
        return back();
    }

}