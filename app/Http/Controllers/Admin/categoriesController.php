<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-2
 * Time: 上午3:05
 */

namespace App\Http\Controllers\Admin;
use App\Ado\Models\Tables\Cms\Category;
//use DB;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use View;
use Input;
use Request;



class categoriesController extends AdminBaseController {
    // 列表页
    public function index(Category $category){
        $filter = DataFilter::source($category->orderBy('_lft'));
        $filter->text('name','Search')->scope('Search');
        $filter->build();
        $set = DataSet::source($filter);
        $set->paginate(500);
        $set->build();
        $editUrl = route('admin.catalog.edit',['id'=>'%s']);
        $sortUrl = route('admin.catalog.sort');
        $tree =   $set->data->renderTree($editUrl,'ul',$sortUrl);
        return View::make(config('adminhtml.template').'categories_index', compact('filter', 'set','tree'));
    }

    //编辑页
    public function edit($id=''){
       if(!$id)$id=Input::get('id');
       $this->setInputValue('parent_id',0,$id);
       $category = Category::findOrNew($id);
       if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.catalog.index');
        $returnUrl = urldecode($returnUrl);
        $edit = DataEdit::source($category);
        $edit->label('Edit Category');
        $edit->link($returnUrl,"Categories", "TR")->back();
        $edit->action(route('admin.catalog.edit'));
        $edit->add('name','Name', 'text')->rule('required|min:3');
        $edit->add('url_key','urlKey', 'text');
        $edit->add('title','Title', 'text');
        $edit->add('keywords','Keywords', 'text');
        $edit->add('description','Description', 'textarea')->attributes(array('rows'=>2));
        $edit->add('parent_id','parent','select')->options(Category::select('name as title','id as value')->get()->toArray());
        $edit->add('in_top','in_top','checkbox');
        $edit->add('image','image', 'image')->move(config('app.upload_dir'))->fit(config('app.images_size.x240'))->resize(config('app.images_size.x80'))->preview(config('app.images_size.x80'));
        $edit->add('is_active','Enable','checkbox');
        return $edit->view(config('adminhtml.template').'categories_edit', compact('edit'));
    }

    public function sort($id=null,$sort=''){
        if(!$sort)$sort=Input::get('sort')?:'';
        if(!$id)$id=Input::get('id')?:0;
        if($id){
            $category = Category::find($id);
            if($category){
                if($sort=='up'){
                    $category->up();
                }else  if($sort=='down')$category->down();
            }
        }
        Category::fixTree();
        return back();
    }



}