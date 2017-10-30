<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-2
 * Time: 上午3:05
 */

namespace App\Http\Controllers\Admin;
use App\Ado\Models\Tables\Cms\Article;
use App\Ado\Models\Tables\Cms\Category;
use File;
//use DB;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use Illuminate\Support\Facades\Auth;
use View;
use Input;
use Request;



class articlesController extends AdminBaseController {
    // 列表页
    public function index(){
        $filter = DataFilter::source(Article::with('author','categories'));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"])->scope('CreateAt');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('title','Title');
        $grid->add('author.name','Author');
        $grid->add('is_active','Enable',true)->cell(function($value){return $value?'yes':'no';});
        $grid->edit(route('admin.article.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'article_index', compact('filter', 'grid'));
    }

    //编辑页
    public function edit($id=0){
        $id = (Request::get('modify'))?:Request::get('delete');
        $article = Article::findOrNew($id);
       if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.article.index');
        $edit = DataEdit::source($article);
        $edit->label('Edit Article');
        $edit->link($returnUrl,"Articles", "TR")->back();
        $edit->action(route('admin.article.edit'));
        $edit->set('author_id',Auth::user()->id);
        $edit->add('title','Title', 'text')->rule('required|min:3');
        $edit->add('url_key','urlKey', 'text');
        $edit->add('content_heading','Content Heading', 'textarea')->attributes(array('rows'=>2));
        $edit->add('content','Content', 'redactor')->enableScript()->fullmode()->setIsMultiple()->setParam('replaceDivs',false)->setImageSize('x690');
        $edit->add('image','Image', 'image')->move(config('app.upload_dir'))->fit(config('app.images_size.x640480'))->preview(config('app.images_size.x240'));
        $edit->add('meta_keywords','MetaKeywords', 'text');
        $edit->add('meta_description','MetaDescription', 'textarea')->attributes(array('rows'=>2));
      //  $edit->add('sort_order','Sort', 'text');
        $edit->add('categories','categories','checkboxgroup')->options(Category::pluck('name','id'));
        $edit->add('writer','Writer','text');
        $edit->add('top','Top(Desc)','text')->rule('numeric');
       // $edit->add('image','image', 'image')->move(config('app.upload_dir'))->fit(config('app.images_size.x240'))->resize(config('app.images_size.x80'))->preview(config('app.images_size.x80'));
        $edit->add('is_active','Enable','checkbox');
        $edit->add('share','Share','checkbox');
        $edit->set('created_at',date('Y-m-d H:i:s'));
      //  $edit->add('path','path','text');
        return $edit->view(config('adminhtml.template').'article_edit', compact('edit'));
    }

}