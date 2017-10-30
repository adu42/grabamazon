<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-11
 * Time: 上午1:23
 */

namespace App\Http\Controllers\Admin;

use App\Ado\Models\Tables\User\Permission;
use App\Ado\Models\Tables\User\Menu;
use App\Ado\Models\Tables\User\Role;
use App\Ado\Models\Tables\User\PermissionRole;
use App\Ado\Models\Tables\User\MenuPermission;

use Form;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use View;
use Input;
use Request;


class permissionsController extends AdminBaseController{
    /**
     * admin.permissions
     * @param Permission $permission
     * @return mixed
     */
      public function index(Permission $permission){
          $idCell =function($value){
              return '<input type="checkbox" name="id[]" value="'.$value.'"/>';
          };
          $grid = DataGrid::source($permission);
          $grid->add('id','ID', true)->style("width:70px")->cell($idCell);
          $grid->add('name','Name', true);
          $grid->add('description','Description');

          $set = Role::all();
          $data[0]['name']= 'role';
          $data[0]['set']= $set;

          $form_attr = array('url' => route('admin.users.index'), 'class' => "form-horizontal", 'role' => "form", 'method' => 'post');
          $formOpen = Form::open($form_attr);
          $formClose = Form::close();
          $updataFiled =View::make('backend.admin.part_select',compact('data'));
          $grid->addUpdataFiled($updataFiled,$formOpen,$formClose);
          $grid->edit(route('admin.permission.edit'), 'Edit','modify|delete')->style("width:70px");
          $grid->paginate(20);
          // $grid->build();
          return View::make(config('adminhtml.template').'permission_list', compact('filter', 'grid'));
      }

    /**
     * admin.permission.edit
     * @param $id
     * @return string
     */
    public function edit($id=''){
       // $this->setSelectMultipleValue('menu_ids');
        $id = Request::get('modify')?:Request::get('delete');
        $permission = new Permission();
        $label = 'Permissions';
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.permissions');
        $edit = DataEdit::source($permission);
        $edit->label('Edit Permission');
        $edit->link($returnUrl,"Permissions", "TR")->back();
        $edit->action(route('admin.permissions.store'));
        $edit->add('name','Name', 'text')->rule('required|min:3');
        $edit->add('description','Description', 'text');
        $edit->add('menu_ids[]','Menus','select')->options(Menu::select('name as title','id as value')->get()->toArray())
            ->attributes(['multiple'=>'multiple'])
            ->setValues(new MenuPermission(),'permission_id','menu_id');

        Permission::created($this->saveMenuPermission($permission));
        Permission::saved($this->saveMenuPermission($edit->model));

        return $edit->view(config('adminhtml.template').'permission_edit', compact('edit','label'));
    }

    protected function saveMenuPermission($permission){
        return function() use ($permission){
            $permission_id = $permission->id;
            if(!$permission_id)return ;
            if(Input::has('menu_ids')){
                $menuIds =  Input::get('menu_ids');
                if(!empty($menuIds)){
                    MenuPermission::where('permission_id',$permission_id)->delete();
                    $data['permission_id']=$permission_id;
                    foreach($menuIds as $menuId){
                        $data['menu_id']=$menuId;
                        MenuPermission::create($data);
                    }
                }
            }
        };
    }

    /**
     * admin.permissions.store
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(){
        $pivot = Input::only('permission_id','role_id');
        RoleUser::firstOrCreate($pivot);
        RoleUser::all()->each(function($item){
            if(User::find($item->user_id)->isEmpty()){
                RoleUser::where('user_id',$item->user_id)->forceDelete();
            }
            if(Role::find($item->role_id)->isEmpty()){
                RoleUser::where('role_id',$item->role_id)->forceDelete();
            }
        });
        return  redirect(route('admin.users.index'));
    }
}