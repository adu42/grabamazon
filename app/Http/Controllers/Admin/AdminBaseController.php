<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-6-26
 * Time: 上午7:54
 */

namespace App\Http\Controllers\Admin;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use Request;
use Route;
use App\Ado\Models\Document;
use App\Ado\Models\Breadcrumbs;
use Context;
use Cache;
use App\Ado\Models\Tables\Core\Setting;
use View;
use Config;

class AdminBaseController extends Controller
{
    protected $paginate =20;
    protected $document;
    protected $breadcrumbs;
    protected $frontPath = 'adminhtml.';

    public function __construct(Document $document,Breadcrumbs $breadcrumbs)
    {
        $this->middleware('auth');
        $this->initDbConfig();
        $this->document = $document;
        $this->breadcrumbs = $breadcrumbs;
        Context::set('breadcrumbs',true);
    }

    /**
     * 块组件
     * @param $viewName
     * @param $data
     * @param string $varName
     */
    public function viewComposer($viewName,$data,$varName=''){
        if(is_array($viewName)){
            foreach($viewName as $key=>$val){
                if(is_string($val) && stripos($val,config('adminhtml.template'))===false)
                    $viewName[$key]=config('adminhtml.template').$val;
            }
        }else if(is_string($viewName) && stripos($viewName,config('adminhtml.template'))===false){
            $viewName=config('adminhtml.template').$viewName;
        }
        if(!$varName)$varName='data';
        View::composer($viewName, function($view) use ($data,$varName)
        {
            $view->with($varName,$data);
        });
    }

    /**
     * 结束控制器方法的时候，执行这个
     * @param string $theme
     */
    public function viewComposerInit($theme=''){
        if($theme)Config::set('adminhtml.template',$theme);
        $this->viewComposer(['layouts.partials.head','layouts.partials.foot'],$this->getDocument(),'document');
        $this->viewComposer('layouts.partials.breadcrumb',$this->getBreadcrumbs()->getCrumb(),'crumbs');
    }

    /**
     * 设置一些变量到数据库里，跟config.php的一致
     */
    protected function initDbConfig(){
        $fronts = Cache::rememberForever('adminhtml.config', function()
        {
            return Setting::getPathsValue($this->frontPath);
        });
        if($fronts){
            foreach($fronts as $item){
                Config::set($item->path,$item->value);
            }
        }
    }

    protected function getDocument(){
        if(!$this->document){
            $this->document = new Document();
        }
        return $this->document;
    }

    protected function getBreadcrumbs(){
        if(!$this->breadcrumbs){
            $this->breadcrumbs = new Document();
        }
        return $this->breadcrumbs;
    }

    public function addCrumb($crumbName, $crumbInfo, $before= false){
        return $this->breadcrumbs->addCrumb($crumbName,$crumbInfo,$before)->enable();
    }

    /**
     * 设置网站标题 关键词 描述
     * @param $title
     * @param string $template
     * @return $this
     */
    protected function setTitle($title,$template='%s'){
        if($template)$title = vsprintf($template,[$title]);
        $this->getDocument()->setTitle($title);
        return $this;
    }
    protected function setKeywords($keywords=''){
        if($keywords)
            $this->getDocument()->setKeywords($keywords);
        return $this;
    }
    protected function setDescription($description=''){
        if(!empty($description))
            $this->getDocument()->setDescription($description);
        return $this;
    }
    protected function getTitle(){
        return $this->getDocument()->getTitle();
    }
    protected function getKeywords(){
        return $this->getDocument()->getKeywords();
    }
    protected function getDescription(){
        return $this->getDocument()->getDescription();
    }


    protected function getSelfUser(Authenticatable $user)
    {
        return $user;
    }

    protected function getSelfUserGroup(Authenticatable $user)
    {
        return $user->groups();
    }

    /**
     * 根据条件找input过来的键，如果存在，就设置成某个值.
     * 如果给的是数组，不覆盖写进Input
     * @param $key
     * @param string $value
     * @param string $condition
     */
    protected function setInputValue($key,$value='',$condition=''){
        $data = array();
        if(is_array($key)){
            foreach($key as $name=>$val){
                if(!Input::has($name)){
                    unset($key[$name]);
                }
            }
            $data = $key;
        }else if($condition && $key){
            if(Input::has($key) && $condition == Input::get($key)){
                $data[$key]=$value;
            }
        }
        if(!empty($data))Request::merge($data);
    }

    /**
     * 把多选框的传值用，串起来，便于存档
     * @param $key
     */
    protected function setSelectMultipleValue($key){
        $data = array();
        if(Input::has($key)){
            if(is_array(Input::get($key))){
                $data[$key]=implode(',',Input::get($key));
            }
        }
        if(!empty($data))Request::merge($data);
    }
    /**
     * 把Input不需要转义的.还原一下
     */
    protected function getDsInput($only=array(),$exclude=array('_token')){
        $data = array();
        if(!empty($exclude)){
            $data = Input::except(implode(',',$exclude));
        }else if(!empty($only)){
            $data = Input::only(implode(',',$only));
        }else{
            $data = Input::all();
        }
        foreach($data as $key=>$val){
            if(stripos($key,'_',1)!==false){
                $_key = preg_replace('/_/', '.', $key, 1);
                $data[$_key]=$val;
                unset($data[$key]);
            }
        }
        return $data;
    }

    public function getSmallImagePath($size='x80'){
        $path = config('app.image_web_path.'.$size);
        if(($path))
        return $path;
        return config('app.upload_web_path');
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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id='')
    {
        //
        return 'Not found,BaseController@show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id='')
    {
        //
        return 'Not found,BaseController@edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id='')
    {
        //
        return 'Not found,BaseController@update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id='')
    {
        //
        return 'Not found,BaseController@destroy';
    }

}