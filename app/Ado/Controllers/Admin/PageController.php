<?php

namespace App\Ado\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
//use DB;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use Illuminate\Support\Facades\Auth;
use View;
use Input;
use App\Ado\Models\Tables\Cms\Page;
use App\Ado\Models\Tables\Cms\Block;
use Countries;
use App\Ado\Models\Tables\Cms\Contact;



class PageController extends BaseController
{
    /**
     * admin.page
     * @param Page $page
     * @return mixed
     */
    public function page(Page $page){
        $filter = DataFilter::source($page);
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('admin.page.edit'));
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('title','Title');
        $grid->add('url_key','Url');
        $grid->add('lang','Language');
        $grid->add('enable','Enable',true)->cell(function($value){return $value?'yes':'no';});
        $grid->edit(route('admin.page.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    /**
     * admin.page.edit
     * @return string
     */
    public function editPage(){
        $id = (Input::get('modify'))?:Input::get('delete');
        $article = Page::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.page');
        $edit = DataEdit::source($article);
        $edit->label('Edit Pages');
        $edit->link($returnUrl,"Pages", "TR")->back();
        $edit->action(route('admin.page.edit'));
        $edit->add('title','Title', 'text')->rule('required|min:3');
        $edit->add('url_key','Url', 'text');
        $edit->add('content','Content', 'redactor')->enableScript()->fullmode()->setIsMultiple()->enableDiv();
        $edit->add('summary','Summary', 'textarea')->attributes(array('rows'=>4));
        $edit->add('keywords','Meta Keywords', 'text');
        $edit->add('meta_description','MetaDescription', 'textarea')->attributes(array('rows'=>2));
        $edit->add('enable','Enable','checkbox');
        return $edit->view(config('adminhtml.template').'common_edit', compact('edit'));
    }

    /**
     * admin.block
     * @param Block $block
     * @return mixed
     */
    public function block(Block $block){
        $filter = DataFilter::source($block);
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('admin.block.edit'));
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('title','Title');
        $grid->add('identifier','Identifier');
        $grid->add('lang','Language');
        $grid->add('enable','Enable',true)->cell(function($value){return $value?'yes':'no';});

        $grid->edit(route('admin.block.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    /**
     * admin.block.edit
     * admin.page.edit
     * @return string
     */
    public function editBlock(){
        $id = (Input::get('modify'))?:Input::get('delete');
        $article = Block::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.block');
        $edit = DataEdit::source($article);
        $edit->label('Edit Block');
        $edit->link($returnUrl,"Blocks", "TR")->back();
        $edit->action(route('admin.block.edit'));
        $edit->add('title','Title', 'text')->rule('required|min:3');
        $edit->add('identifier','Identifier', 'text')->rule('required|min:3');
        $edit->add('content','Content', 'redactor')->enableScript()->fullmode()->setIsMultiple()->enableDiv();
        $edit->add('lang','language', 'select')->options(Countries::getOptions())->setDefaultValue('USA');
        $edit->add('enable','Enable','checkbox');

        return $edit->view(config('adminhtml.template').'common_edit', compact('edit'));
    }

    /**
     * admin.contact
     * @param Contact $contact
     * @return mixed
     */
    public function contacts(Contact $contact){
        $filter = DataFilter::source($contact);
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('email','Email');
        $grid->add('title','Title');
        $grid->add('content','Content');
        $grid->add('created_at','Time',true)->cell(function($value){return substr($value,0,10);});
        $grid->edit(route('admin.contact.edit'), 'Edit','delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    /**
     * admin.contact.edit
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editContact(){
        $id = (Input::get('delete'))?:0;
        Contact::where('id',$id)->delete();
        return back();
    }
}
