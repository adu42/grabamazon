<?php namespace App\Http\Controllers\Admin;

use App\Ado\Models\Tables\User\Group;
use App\Http\Requests;
use App\Ado\Models\Tables\User\User;
use App\Ado\Models\Tables\User\Role;
use App\Ado\Models\Tables\User\RoleUser;
use App\Ado\Models\Tables\User\GroupUser;
use App\Ado\Models\Tables\User\Permission;
use App\Ado\Models\Tables\User\PermissionRole;
use Collective\Html\FormFacade as Form;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use View;
use Input;


class usersController extends AdminBaseController {

	/**
     * 用户列表
	 * Display a listing of the resource.
	 * admin.users.index
	 * @return Response
	 */
	public function index()
	{

        $idCell =function($value){
            return '<input type="checkbox" name="id[]" value="'.$value.'"/>';
        };

        $filter = DataFilter::source(User::with('roles','groups'));
        $filter->text('name','Search')->scope('Search');
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px")->cell($idCell);
        $grid->add('avatar','Avatar')->cell(function($value,$user){ return avatar($user,'x30');});
        $grid->add('name','Name', true);
        $grid->add('email','Email');
        $grid->add('{{ $roles->first()->name }}','Role')->cell(function($value){ return (stripos($value,'{{')!==false?'':$value);});
        $grid->add('{{ $groups->first()->group_name }}','Group')->cell(function($value){ return stripos($value,'{{')!==false ?'':$value; });
        $grid->add('is_active','Enable',true)->cell(function($value){return $value?'yes':'no';});

        $set = Role::all();
        $data[0]['name']= 'role';
        $data[0]['set']= $set;
        $set = Group::select('group_name as name','id')->get();
        $data[1]['name']= 'group';
        $data[1]['set']= $set;
        $form_attr = array('url' => route('admin.users.index'), 'class' => "form-horizontal", 'role' => "form", 'method' => 'post');
        $formOpen = Form::open($form_attr);
        $formClose = Form::close();
        $updataFiled =View::make('backend.admin.part_select',compact('data'));
        $grid->addUpdataFiled($updataFiled,$formOpen,$formClose);
        $grid->edit(route('admin.user.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
       // $grid->build();
        return View::make(config('adminhtml.template').'user_list', compact('filter', 'grid'));
	}

    /**
     * admin.users.roles
     * role名称列表
     * @param Role $role
     * @return mixed
     */
    public function roles(Role $role){

        $grid = DataGrid::source($role);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('name','Name', true);
        $grid->add('description','Description');
        $grid->edit(route('admin.users.role'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(100);
        return View::make(config('adminhtml.template').'role_list', compact( 'grid'));
    }

    /**
     * admin.users.role
     * 编辑角色role
     * @param $id
     * @return string
     */
    public function role(){
        $id = Input::has('modify')?Input::get('modify'):(Input::has('delete')?Input::get('delete'):0);
        $role = Role::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.users.roles');
        $edit = DataEdit::source($role);
        $edit->label('Edit Role');
        $edit->link($returnUrl,"Roles", "TR")->back();
        $edit->action(route('admin.users.role'));
        $edit->add('name','Name', 'text')->rule('required|min:3');
        $edit->add('description','Description', 'text');
        $edit->add('permission_ids[]','Permission', 'select')->options(Permission::select('name as title','id as value')->get()->toArray())
            ->attributes(array('multiple'=>'multiple'))
            ->setValues(new PermissionRole(),'role_id','permission_id');
        Role::created($this->savePermissionRole($role));
        Role::saved($this->savePermissionRole($edit->model));
        return $edit->view(config('adminhtml.template').'role_edit', compact('edit'));
    }


    protected function savePermissionRole($role){
        return function() use ($role){
            $role_id = $role->id;
            if(!$role_id)return;
           if(Input::has('permission_ids')){
               $permission_ids = Input::get('permission_ids');
               if(!empty($permission_ids)){
                   PermissionRole::where('role_id',$role_id)->delete();
                   $data['role_id']=$role_id;
                   foreach($permission_ids as $permission_id){
                       $data['permission_id']=$permission_id;
                       PermissionRole::create($data);
                   }
               }
           }
        };
    }

    /**
     * admin.user.userrole
 * 用户设置角色
 * 检查用户角色是否存在，不存在就删除关系
 *
 */
    public function userrole(){
        $pivot = Input::only('user_id','role_id');
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



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
     * admin.user.edit
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $ids = Input::get('id');
        $role_id = Input::get('role',0);
        $group_id = Input::get('group',0);
        $saveRole = $saveGroup = 0;
        if($role_id){
            $saveRole=1;
            $dataRole = array('user_id'=>0,'role_id'=>$role_id);
        }
        if($group_id){
            $saveGroup=1;
            $dataGroup = array('user_id'=>0,'group_id'=>$group_id);
        }
        if(is_array($ids)){

            foreach($ids as $userid){
                $dataRole['user_id'] = $userid;
                $dataGroup['user_id'] = $userid;
                if($saveRole){
                      RoleUser::where('user_id',$userid)->delete();
                      RoleUser::firstOrCreate($dataRole);
                }
                if($saveGroup){
                    GroupUser::where('user_id',$userid)->delete();
                    GroupUser::firstOrCreate($dataGroup);
                }
            }
        }

       return redirect(route('admin.users.index'));
	}



	/**
     * admin.user.edit
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id='')
	{
        $user = User::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.users.index');
        $edit = DataEdit::source($user);
        $edit->label('Edit User');
        $edit->link($returnUrl,"Users", "TR")->back();
        $edit->action(route('admin.user.edit'));
        $edit->add('name','Name', 'text')->rule('required|min:2');
        $edit->add('email','Email', 'text')->rule('required|email');
        $edit->add('avatar','Avatar','image')->move(config('app.upload_dir'))->fit(config('app.images_size.x80'))->preview(config('app.images_size.x80'));
        $edit->add('summary','summary','text');
        $edit->add('role_id','Role','select')->options(Role::select('name as title','id as value')->get()->toArray());
        $edit->add('tags','tags','text');
        $edit->add('is_active','Enable','checkbox');
        $edit->add('domain_in','Enable Domain','checkbox');
        $edit->add('cash_back_in','Enable Cash Back','checkbox');
        $edit->add('post_in','Enable Post','checkbox');
        $edit->add('comment_in','Enable Comment','checkbox');
        return $edit->view(config('adminhtml.template').'user_edit', compact('edit'));
	}

}
