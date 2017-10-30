<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-6-26
 * Time: 上午7:51
 */

namespace App\Http\Controllers\Admin;
use Auth;
use App\Ado\Models\Tables\Core\Setting;
use App\Ado\Models\Tables\Core\SettingGroup;
use File;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use View;
use Input;
use Request;
use Cache;
use Collective\Html\FormFacade as Form;




class adminController extends AdminBaseController{


    public  function index(){
        $this->setTitle('Dashboard');
        $this->viewComposerInit();
        return view(config('adminhtml.template').'layouts.main');
    }

    public function setting(){
        $filter = DataFilter::source(Setting::with('SettingGroup')->orderBy('sort_order'));
        $filter->prepareForm();
        $filter->add('path','Search','text')->scope('Search');
        //$filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"]);
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();


        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        //传值给当前path列
        $grid->add('path','Path')->cell(function($value) use ($grid){ $grid->getColumn('path')->value=$value; return $value; });
        $grid->add('description','Description');
        //从path列获得值，拼装成input name
        $grid->add('value','Value')->cell(function($value) use ($grid){
            return '<input name="'.$grid->getColumn('path')->value.'[value]" id="'.$grid->getColumn('path')->value.'.value" class="span4" value="'.$value.'" />';
        });
        $grid->add('SettingGroup.group','Group');
        $grid->add('sort_order','Sort',true)->cell(function($value) use ($grid){return '<input name="'.$grid->getColumn('path')->value.'[sort_order]" id="'.$grid->getColumn('path')->value.'.sort_order" class="span" value="'.$value.'" />';});

        $grid->edit(route('admin.setting.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(2000);
       // $grid->submit(trans("submit"), "BL");
        $grid->form(route('admin.setting.save'),trans("messages.submit"),'BL');
        return View::make(config('adminhtml.template').'setting_list', compact('filter', 'grid'));
    }

    public function editSetting($id=null){
        $model = Setting::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.setting');
        $addedSettingGroup =$this->addSettingGroup();
        if($addedSettingGroup){
            $model->group_id = $addedSettingGroup;
        }
        $edit = DataEdit::source($model);
        $edit->label('Edit Setting');
        $edit->link($returnUrl,"Setting", "TR")->back();
        $edit->action(route('admin.setting.edit'));
        //先存储组，再展示出来


        $edit->set('group',null);
        $edit->add('path','Path','text')->rule('required|min:3');
        $edit->add('description','Description', 'text');
        $edit->add('value','Value', 'text');
        $edit->add('sort_order','SortOrder', 'text');
        $edit->add('group_id','Select Group', 'radiogroup')->options(SettingGroup::pluck('group','id'));
        $edit->add('group','addGroup', 'text');
        return $edit->view(config('adminhtml.template').'setting_edit', compact('edit'));
    }

    protected function addSettingGroup(){
        if(Input::has('group')){
            $group = Input::get('group');
            $group =  SettingGroup::firstOrCreate(['group'=>$group]);
            return $group->id;
         }
        return false;
    }


    /**
     * 保存配置修改
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveSetting(){
        $data=$this->getDsInput();
        if(!empty($data)){
            foreach($data as $path=>$item){
                if(empty($item))continue;
                $setting = Setting::where('path',$path)->first();
                if($setting){
                    foreach($item as $key=>$val){
                        $setting->$key = $val;
                    }
                    $setting->save();
                }
            }
        }
        return redirect(route('admin.setting'));
    }
}