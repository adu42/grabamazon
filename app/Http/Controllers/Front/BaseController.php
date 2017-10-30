<?php namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use View;
use menu as Vmenu;
use App\Ado\Models\Document;
use App\Ado\Models\Breadcrumbs;
use Illuminate\Http\Request;
use Config;
use App\Ado\Models\Tables\Core\Setting;
use Cache;
use Context;
use Route;
use App\Ado\Repositories\EvaluateRepository;
use Validator;
use Input;
use Image;

class BaseController extends Controller {
    protected $paginate =20;
	protected $document;
	protected $breadcrumbs;
	protected $evaluateRepository;
	protected $frontPath = 'front.';

	public function __construct(Document $document,Breadcrumbs $breadcrumbs,EvaluateRepository $evaluateRepository)
	{
		$this->initDbConfig();
		$this->document = $document;
		$this->breadcrumbs = $breadcrumbs;
		if(!$this->evaluateRepository)$this->evaluateRepository=$evaluateRepository;
		Context::set('breadcrumbs',true);
		Context::set('searchAction',$this->getSearchAction());
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
		}else if(!$condition && $key){
			if(Input::has($key))$data[$key]=$value;
		}
		if(!empty($data))Request::merge($data);
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
                    if(is_string($val) && stripos($val,config('front.template'))===false)
                        $viewName[$key]=config('front.template').$val;
                }
            }else if(is_string($viewName) && stripos($viewName,config('front.template'))===false){
                $viewName=config('front.template').$viewName;
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
		if($theme)Config::set('front.template',$theme);
		$this->viewComposer(['layouts.partials.head','layouts.partials.foot'],$this->getDocument(),'document');
		$this->viewComposer('layouts.partials.breadcrumb',$this->getBreadcrumbs()->getCrumb(),'crumbs');
		Context::set('searchAction',$this->getSearchAction());
	}

	/**
	 * 设置一些变量到数据库里，跟config.php的一致
	 */
	protected function initDbConfig(){
		$fronts = Cache::rememberForever('front.config', function()
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

	/**
	 * ----------------------// not use
	 * @return string
	 */
	public function getSearchAction(){
		$action = Route::currentRouteAction();
		if(stripos($action,'article')!==false){
			return route('article.post');//route('review.search',['keyword'=>'']);// route('article.post');
		}
	}
	/**
	 * 设置网站标题 关键词 描述 结束
	 */

	/**
	 * 用户犯规次数，超过次数，先关进监狱
	 * @param $user
	 * @param int $num
	 */
	public function setUserPrison($user,$review){
		if($review->capacity){
			$day =0;
			$bad_word_count_prison = config('front.review.bad_word_count_prison')?:2;
			$external_link_count_prison = config('front.review.external_link_count_prison')?:3;
			$bad_word_count_prison_days = config('front.review.bad_word_count_prison_days')?:2;
			$external_link_count_prison_days = config('front.review.external_link_count_prison_days')?:15;
			$day+=($review->bad_word_count>=$bad_word_count_prison)?$bad_word_count_prison_days:0;
			$day+=($review->external_link_count>=$external_link_count_prison)?$external_link_count_prison_days:0;
			$user->bad_expire = $day;
			if($day>0)$user->is_active=0;
			$user->save();
		}
	}



    protected function getSelfUser(Authenticatable $user){
        return $user;
    }

    protected function getSelfUserGroup(Authenticatable $user){
        return $user->groups();
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


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
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public function imagesUpload(){
		$destinationPath = config('app.upload_review_dir');
		$webpath = config('app.upload_review_web_dir');
		$size = config('app.images_size.x9665');
		$size_web_path = config('app.image_web_path.x9665');
		$resize_path = ltrim($size_web_path,'/');
		$files =  Input::file('images');
		$rules = ['photo' => 'mimes:jpeg,png,jpg'];
		$errors = [];
		$medias = [];
		$medias_thumb = [];
		if(is_array($files)){
			foreach($files as $file){
				$validator = Validator::make(['photo'=> $file], $rules);
				if ($validator->fails()) {
					array_push($errors, $validator->messages());
				} else {
					if ($file->isValid())
					{
						$extension = $file->getClientOriginalExtension();
						$fileName = 'review_testimonials_goods_'.date('ymdhis').rand(100,9999).'.'.$extension;
						$file->move($destinationPath, $fileName);
						$fileInServer = $destinationPath.$fileName;
						if(file_exists($fileInServer)){
							try{
							Image::make($fileInServer)->fit($size['width'],$size['height'],function ($constraint) {
								$constraint->upsize();
							})->save($resize_path.$fileName);
								$medias_thumb[]=$size_web_path.$fileName;
							}catch(exception $e){

							}
						}
						array_push($medias, $webpath.$fileName);
					}
				}
			}
		}
		return [$medias,$medias_thumb,$errors];
	}

}
