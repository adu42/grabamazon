<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-2
 * Time: 上午3:05
 */

namespace App\Ado\Controllers\Admin;
use App\Ado\Models\Tables\User\User;
use App\Ado\Models\Tables\User\Group;
use App\Ado\Models\Tables\User\GroupUser;
//use DB;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use View;
use Input;
use Request;



class groupsController extends BaseController {
    // 列表页
    public function index(Group $group){
        $grid = DataGrid::source($group);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('group_name','Name', true);
        $grid->add('description','Description');
        $grid->edit(route('admin.groups.edit'), 'Edit','insert|modify|delete')->style("width:70px");
        $grid->paginate(200);
        return View::make(config('adminhtml.template').'group_list', compact('grid'));
    }

    //编辑页
    public function edit($id=null){
       $group = Group::findOrNew($id);
       if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.groups.index');
        $edit = DataEdit::source($group);
        $edit->label('Edit User Group');
        $edit->link($returnUrl,"Groups", "TR")->back();
        $edit->action(route('admin.groups.edit'));
        $edit->add('group_name','Name', 'text')->rule('required|min:3');
        $edit->add('description','Description', 'textarea')->attributes(array('rows'=>2));
        return $edit->view(config('adminhtml.template').'group_edit', compact('edit'));
    }



}