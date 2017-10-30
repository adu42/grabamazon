<?php

namespace App\Ado\Controllers\Admin;

use App\Ado\Models\Tables\Evaluate\EvaluateGroup;
use App\Ado\Models\Tables\Evaluate\EvaluateTip;
use App\Ado\Models\Tables\Evaluate\Evaluate;
use App\Ado\Models\Tables\Evaluate\EvaluateGroupTip;
use App\Ado\Models\Tables\Evaluate\ReviewTemp;
use App\Ado\Models\Tables\Evaluate\EvaluateLink;
use App\Ado\Repositories\EvaluateRepository;
use App\Ado\Models\Tables\Evaluate\EvaluateTemp;
use File;
use DB;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use Auth;
use View;
use Input;
use Request;
use Redirect;

class EvaluateController extends BaseController
{

    protected $evaluateRepository=null;

    public function __construct(EvaluateRepository $evaluateRepository)
    {
        $this->evaluateRepository = $evaluateRepository;
    }

    /**
     * admin.evaluate.tips
     * @return mixed
     */
    public function tips(){
        $filter = DataFilter::source(EvaluateGroupTip::with('evaluate_group'));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('admin.evaluate.tips.edit'));
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('tip','tip');
        $grid->add('evaluate_group.group','Category');
        $grid->add('type','Type',true)->cell(function($value){
            return EvaluateGroupTip::types($value);
        });
        $grid->add('general','general')->cell(function($value){ return $value?'Y':'N'; });
        $grid->edit(route('admin.evaluate.tips.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    /**
     * admin.evaluate.tips.edit
     * @return string
     */
    public function edit_tips(){
        $id = (Input::get('modify'))?:Input::get('update');
        $evaluateGroupTip = EvaluateGroupTip::with('evaluate_group')->where('id',$id)->first();
        if(!$evaluateGroupTip)$evaluateGroupTip = new EvaluateGroupTip();
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.evaluate.tips');
        $edit = DataEdit::source($evaluateGroupTip);
        $edit->label('Edit Tips');
        $edit->link($returnUrl,"Tips", "TR")->back();
        $edit->action(route('admin.evaluate.tips.edit'));
        $edit->add('tip','Tip', 'text')->rule('required|min:3');
        $edit->add('sort_order','Sort', 'text');
        $edit->add('group_id','Group', 'select')->options(EvaluateGroup::lists('group','id'));
        $edit->add('general','General','checkbox');
        $edit->add('type','Type','select')->options(EvaluateGroupTip::types('all'));
        return $edit->view(config('adminhtml.template').'common_edit', compact('edit'));
    }

    /**
     * admin.evaluate.tip.edit
     * @return mixed
     */
    public function evaluate_tips(){
        $id = (Input::get('more'))?:0;
        if(!$id)back();
        $evaluate = Evaluate::with('tips')->find($id);
        if(!$evaluate)back();
        $returnUrl = route('admin.domain');
        $edit = DataEdit::source($evaluate);
        $edit->label('Domain Tips: '.$evaluate->domain);
        $edit->link($returnUrl,"Tips", "TR")->back();
        $edit->action(route('admin.evaluate.tip.edit'));

        $edit->add('tips.tip_id','Tip', 'checkboxgroup')->options(EvaluateGroupTip::where('group_id',$evaluate->group_id)->orWhere('general',1)->select(DB::raw('CONCAT(type, " ",tip) as title'),'id as value')->get()->toArray());
        return $edit->view(config('adminhtml.template').'common_edit', compact('edit'));
    }

    /**
     * admin.domain.links
     * @return mixed
     */
    public function domain_links(){
        $filter = DataFilter::source(EvaluateLink::with('evaluate'));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('admin.domain.link.edit'));
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('label','Label');
        $grid->add('link','Link');
        $grid->add('refer','Refer')->cell(function($value){ return EvaluateLink::refers($value); });
        $grid->add('evaluate.domain','Website');
        $grid->add('enable','Enable')->cell(function($value){ return $value?'yes':'no'; });
        $grid->edit(route('admin.domain.link.edit'), 'Edit','show|modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));

    }
    /**
     * admin.domain.link.edit
     * 编辑自有域名的links
     */
    public function edit_links(){
        if(Input::has('show')){
            $r =   EvaluateLink::where('id',Input::get('show'))->where('enable',0)->update(['enable'=>1]);
            if(!$r)EvaluateLink::where('id',Input::get('show'))->where('enable',1)->update(['enable'=>0]);
            return Redirect::back();
        }
        $id = (Input::get('modify'))?:Input::get('delete');
        $id = (Input::has('update'))?Input::get('update'):$id;
        $domain = (Input::has('domain'))?Input::get('domain'):'';
        $evaluate = null;
        if($domain){
            $domain = EvaluateRepository::getDomain($domain);
            $evaluate = Evaluate::where('domain',$domain)->first();
            if(!$evaluate){
                return back()->with('msg','Can not find the Website，Save failure.');
            }
        }
        $evaluateLink =  EvaluateLink::find($id);
        if(!$evaluateLink)$evaluateLink=new EvaluateLink();
        if (Input::get('destroy'))return abort(404);
            $returnUrl = route('admin.domain.links');
            $edit = DataEdit::source($evaluateLink);
            $edit->label('Edit Website Links:');
            $edit->link($returnUrl,"My Website Links", "TR")->back();
            $edit->action(route('user.domain.link.edit'));
            $edit->add('label','Label', 'text');
            $edit->add('link','Link', 'text')->rule('url|required|min:10|max:100');
            $edit->add('refer','Refer', 'select')->options(EvaluateLink::refers('all'));
            if($evaluateLink->evaluate){
                $edit->add('domain','Website', 'text')->updateValue($evaluateLink->evaluate->domain)->rule('required|min:4|max:100');
            }else{
                $edit->add('domain','Website', 'text')->rule('required|min:4|max:100');
            }
            if(isset($msg)){
                $edit->message($msg);
            }
            if($evaluate)$edit->set('evaluate_id',$evaluate->id);
            $edit->saved(function () use ($edit,$returnUrl) {
                $edit->message("You link saved");
                $edit->link($returnUrl,"back to the link lists");
            });
        return View::make(config('adminhtml.template').'common_edit',compact('edit'));
    }

    /**
     * admin.domain.import
     * @return mixed
     */
    public function import_csv(){
        $msg = '';
        $action = route('admin.domain.import');
        $helper = '.csv upload.';
        $what = '';
        if(Input::hasFile('uploadFile')){
            $mimes =['text/plain'];
            $destinationPath = config('adminhtml.csv_path');

            $file = Input::file('uploadFile');

            $mime = $file->getMimeType();
            $path=''; //server path
            if(in_array($mime,$mimes)){
                $clientName = $file->getClientOriginalName();
                $path = $file->move($destinationPath,$clientName)->getRealPath();
                if(file_exists($path)){
                    $msg = "FILE $clientName is uploaded.";
                    if(Input::get('what')=='domain'){
                        $this->sendToDb($path);
                    }elseif(Input::get('what')=='review'){
                         $this->evaluateRepository->saveReviewTemps($path);
                    }

                    $msg .= "<br/>FILE $clientName is saved.";
                }
            }
            $what = Input::get('what');
        }
        return View::make(config('adminhtml.template').'file_upload',compact('action','helper','what','msg'));
    }

    /**
     *  col-1: group_id
     *  col-2: domain/url
     *  col-3: title
     *  col-4: description
     * @param $file
     */
    protected function sendToDb($file){
        $rows = fopen($file,"r");
        while(! feof($rows))
        {
           $row = (fgetcsv($rows));
            if(!empty($row) && count($row)>=4){
                $domain = EvaluateRepository::getDomain($row[1]);
                if(!empty($domain)){
                    $group_id=$row[0];
                    $site = EvaluateRepository::getSite($row[1]);
                    $title =  str_replace(['"'],'',$row[2]);
                    $content = str_replace(['"'],'',$row[3]);
                    $title = e($title);
                    $content= e($content);
                    $find = EvaluateTemp::where('domain',$domain)->first();
                    if(!$find){
                        $evaluateTemp = new EvaluateTemp();
                        $evaluateTemp->domain = $domain;
                        $evaluateTemp->group_id = $group_id;
                        $evaluateTemp->title = $title;
                        $evaluateTemp->content = $content;
                        $evaluateTemp->url = $site;
                        $evaluateTemp->origin = 'upload';
                        $evaluateTemp->save();
                    }
                }
            }
        }
        fclose($rows);
    }

}
