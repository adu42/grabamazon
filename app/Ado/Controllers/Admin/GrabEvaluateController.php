<?php

namespace App\Ado\Controllers\Admin;

use App\Ado\Models\Tables\Evaluate\EvaluateGroup;
use App\Ado\Models\Tables\Evaluate\EvaluateGroupKeyword;
use App\Ado\Models\Tables\Evaluate\EvaluateTemp;
use App\Ado\Models\Tables\Evaluate\Evaluate;
use App\Ado\Models\Tables\Evaluate\ReviewTemp;
use App\Ado\Models\Screen\GoogleSearch;
use App\Ado\Models\Screen\DomainCheck;
use App\Ado\Repositories\EvaluateRepository;
use File;
//use DB;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use Auth;
use View;
use Input;
use Request;
use Redirect;

class GrabEvaluateController extends BaseController
{


    protected $domainCheck=null;
    protected $evaluateRepository=null;

    public function __construct(EvaluateRepository $evaluateRepository)
    {
        $this->evaluateRepository = $evaluateRepository;
    }

    /**
     * admin.grab.keywords
     * @return mixed
     */
    public function keywords(){
    $filter = DataFilter::source(EvaluateGroupKeyword::with('evaluate_group'));
    $filter->prepareForm();
    $filter->add('title','Search','text')->scope('Search');
    $filter->newLink(route('admin.grab.keyword.edit'));
    $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
    $filter->build();
    $grid = DataGrid::source($filter);
    $grid->add('id','ID', true)->style("width:70px");
    $grid->add('keyword','Keyword');
    $grid->add('evaluate_group.group','Category');
    $grid->add('enable','Enable',true)->cell(function($value){return $value?'yes':'no';});
    $grid->add('used','Used',true)->cell(function($value){return $value?'yes':'no';});
    $grid->edit(route('admin.grab.keyword.edit'), 'Edit','modify|delete')->style("width:70px");
    $grid->paginate(20);
    return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
}

    /**
     * admin.grab.keyword.edit
     * @return string
     */
    public function edit_keyword(){
        $id = (Input::get('modify'))?:Input::get('delete');
        $evaluateGroupKeyword = EvaluateGroupKeyword::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.grab.keywords');
        $edit = DataEdit::source($evaluateGroupKeyword);
        $edit->label('Edit Keyword');
        $edit->link($returnUrl,"Keywords", "TR")->back();
        $edit->action(route('admin.grab.keyword.edit'));
        $edit->add('keyword','Keyword', 'text')->rule('required|min:3');
        $edit->add('group_id','Group', 'select')->options(EvaluateGroup::lists('group','id'));
        $edit->add('enable','Enable','checkbox');
        $edit->add('used','Used','checkbox');
        return $edit->view(config('adminhtml.template').'common_edit', compact('edit'));
    }

    /**
     * admin.grab.domains
     * @return mixed
     */
    public function domains(){
        $filter = DataFilter::source(EvaluateTemp::with('evaluate_group'));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('admin.grab.domain.edit'));
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('domain','Domain')->cell(function($value,$item){ return link_to($item->url,$value,['target'=>"_blank"]); });
        $grid->add('title','Title');
        $grid->add('evaluate_group.group','Category');
        $grid->add('shop','hop',true)->cell(function($value){return $value?'yes':'no';});
        $grid->add('ad_url','AdUrl',true)->cell(function($value){return $value?'yes':'no';});
        $grid->add('enable','Enable',true)->cell(function($value){return $value?'yes':'no';});
        $grid->add('used','Used',true)->cell(function($value){return $value?'yes':'no';});
        $grid->edit(route('admin.grab.domain.edit'), 'Edit','show|modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }


    /**
     * admin.grab.domain.edit
     * @return string
     */
    public function edit_domain(){
        if(Input::has('show')){
          $r =   EvaluateTemp::where('id',Input::get('show'))->where('enable',0)->update(['enable'=>1]);
            if(!$r)EvaluateTemp::where('id',Input::get('show'))->where('enable',1)->update(['enable'=>0]);
            if($r)$this->checkDomainAndCopyEnable(Input::get('show'));
            return Redirect::back();
        }

        $id = (Input::get('modify'))?:Input::get('delete');
        $evaluateTemp = EvaluateTemp::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.grab.domains');
        $edit = DataEdit::source($evaluateTemp);
        $edit->label('Edit Domain');
        $edit->link($returnUrl,"Domains", "TR")->back();
        $edit->action(route('admin.grab.domain.edit'));
        $edit->add('domain','Domain', 'text')->rule('required|min:3');
        $edit->add('title','Title', 'text');
        $edit->add('content','ontent', 'text');
        $edit->add('group_id','Group', 'select')->options(EvaluateGroup::lists('group','id'));
        $edit->add('enable','Enable','checkbox');
        $edit->add('used','Used','checkbox');
        $edit->add('shop','Is Shop', 'checkbox');
        $edit->add('ad_url','Is AdUrl', 'checkbox');
        return $edit->view(config('adminhtml.template').'common_edit', compact('edit'));
    }

    /**
     * admin.grab.google
     * @return View
     */
    public function grabGoogle(){
        $keywords = EvaluateGroupKeyword::where('enable',1)->where('used',0)->orderBy('id','desc')->take(20)->get();
        $msg = '';
        foreach($keywords as $keyword){
            $googleSearch = new GoogleSearch();
            $googleSearch->runGrab($keyword->keyword);
            $rows = $googleSearch->getRows();
            //print_r($rows);
            if(!empty($rows)){
                foreach($rows as $row){
                    $this->saveEvaluateTemp($row,$keyword->group_id);
                }
            }else{
                $msg .= $googleSearch->getMessage().'<br>';
            }
            $keyword->update(['used'=>1]);
        }
        return view(config('adminhtml.template').'common_message', compact('msg'));
    }

    /**
     * 域名检查类
     * @return DomainCheck|null
     */
    protected function getDomainCheck(){
        if($this->domainCheck ===null)
            $this->domainCheck = new DomainCheck();
        return $this->domainCheck;
    }


    /**
     * 存储domain
     * @param $row
     * @param $group_id
     */
    protected function saveEvaluateTemp($row,$group_id){
        $domain = $this->getDomainCheck()->getDomain($row->visibleUrl);
        $find = EvaluateTemp::where('domain',$domain)->first();
        if(!$find){
            $evaluateTemp = new EvaluateTemp();
            $evaluateTemp->domain = $domain;
            $evaluateTemp->group_id = $group_id;
            $evaluateTemp->title = $row->titleNoFormatting;
            $evaluateTemp->content = $row->content;
            $evaluateTemp->url = $row->unescapedUrl;
            $evaluateTemp->origin = 'google';
            $evaluateTemp->save();
        }
    }

    /**
     * 在域名检查完毕，可以使用的时候，
     * 1、检查域名的google广告情况
     * 2、检查是否已经启用，存在于正式表中，如果不存在，则添加进去，否则更改广告在线状态
     * 3、检查是否有快照存在，如果不存在，生产快照，完成快照后，启用展示
     * 4、随机几条评论写进去。
     * 待写。。。
     */
    protected function checkDomainAndCopyEnable($id){
        $evaluateTemp = EvaluateTemp::find($id);
        if($evaluateTemp){
            $evaluate = Evaluate::where('domain',$evaluateTemp->domain)->first();
            if(!$evaluate){
                  $this->evaluateRepository->saveDomain($evaluateTemp->url,$evaluateTemp);
            }
        }
    }

    /**
     * admin.grab.reviews
     * 导入评论
     */
    public function reviews(){
        $filter = DataFilter::source(ReviewTemp::with('evaluate_group'));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('admin.grab.review.edit'));
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('title','Title');
        $grid->add('evaluate_group.group','Category');

        $grid->add('rating','Rating');
        $grid->add('service','Service');
        $grid->add('value','Value');
        $grid->add('shipping','Shipping');
        $grid->add('returns','Returns');
        $grid->add('quality','Quality');
        $grid->add('helpful','Helpful');

        $grid->add('enable','Enable',true)->cell(function($value){return $value?'yes':'no';});
        $grid->add('used','Used',true)->cell(function($value){return $value?'yes':'no';});
        $grid->edit(route('admin.grab.review.edit'), 'Edit','show|modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    /**
     * admin.grab.review.edit
     * @return string
     */
    public function edit_review(){
        if(Input::has('show')){
            $r =   ReviewTemp::where('id',Input::get('show'))->where('enable',0)->update(['enable'=>1]);
            if(!$r)ReviewTemp::where('id',Input::get('show'))->where('enable',1)->update(['enable'=>0]);
            return Redirect::back();
        }

        $id = (Input::get('modify'))?:Input::get('delete');
        $reviewTemp = ReviewTemp::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.grab.reviews');
        $edit = DataEdit::source($reviewTemp);
        $edit->label('Edit Review');
        $edit->link($returnUrl,"Reviews", "TR")->back();
        $edit->action(route('admin.grab.review.edit'));
        $edit->add('title','Title', 'text')->rule('required|min:3');
        $edit->add('review','Review', 'redactor');
        $edit->add('group_id','Group', 'select')->options(EvaluateGroup::lists('group','id'));
        $edit->add('enable','Enable','checkbox');
        $edit->add('used','Used','checkbox');

        $data = $this->getRandRating();
        $ratingFields=array(
            'rating'=>'Rating',
            'service'=>'Service',
            'value'=>'Value',
            'shipping'=>'Shipping',
            'returns'=>'Returns',
            'quality'=>'Quality'
        );
        $i=0;
        foreach($ratingFields as $field=>$label){
            $edit->add($field,$label,'rating')->attributes(
                array(
                    'class'=>'rating',
                    'max'=>5,
                    'min'=>0,
                    'step'=>0.2,
                    'data-size'=>'sm',
                )
            )->insertValue($data[$i]);
            $i++;
        }
       // $edit->add('rating','Rating', 'rating')->insertValue($data[0]);
       // $edit->add('service','service', 'rating')->insertValue($data[1]);
      //  $edit->add('value','value', 'rating')->insertValue($data[2]);
      //  $edit->add('shipping','shipping', 'rating')->insertValue($data[3]);
     // //  $edit->add('returns','returns', 'rating')->insertValue($data[4]);
      //  $edit->add('quality','quality', 'rating')->insertValue($data[5]);
        $edit->add('helpful','helpful', 'number')->insertValue(1);
        return $edit->view(config('adminhtml.template').'common_edit', compact('edit'));
    }

    /**
     * @param string $type
     */
    protected function getRandRating($type='good'){
        $data=[];
        if($type=='good'){
            for($i=0;$i<6;$i++){
                $data[]=4 + rand(2,5)*2/10;
            }
        }elseif($type=='middle'||$type=='normal'){
            for($i=0;$i<6;$i++){
                $data[]=3 + rand(2,5)*2/10;
            }
        }elseif($type=='bad'){
            for($i=0;$i<6;$i++){
                $data[]=rand(1,3)+ rand(2,5)*2/10;
            }
        }
        return $data;
    }

}
