<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-8-24
 * Time: 上午2:56
 */

namespace App\Ado\Controllers\Admin;
use App\Ado\Models\Screen\CutyCapt;
use App\Ado\Models\Tables\Evaluate\Evaluate;
use App\Ado\Models\Tables\Evaluate\EvaluateGroup;
use App\Ado\Models\Tables\Evaluate\EvaluateGroupTip;
use File;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use Auth;
use View;
use Input;
use Request;

use App\Ado\Models\Screen\HtmlTo as HtmlTo;
use App\Ado\Models\Tables\Evaluate\Review;
use App\Ado\Models\Tables\Evaluate\ReviewExplain;
use App\Ado\Models\Tables\Evaluate\ReviewImage;
use App\Ado\Models\Tables\Evaluate\Question;
use App\Ado\Models\Tables\Evaluate\Answer;
use App\Ado\Repositories\EvaluateRepository;

class reviewController extends BaseController {
    protected $evaluateRepository;
    public function __construct(EvaluateRepository $evaluateRepository)
    {
        $this->evaluateRepository = $evaluateRepository;
    }

    /**
     * 域名列表
     * @return mixed
     */
    public function index(){
        $filter = DataFilter::source(Evaluate::with('evaluate_group'));
        $filter->prepareForm();
        $filter->add('domain','Domain','text')->scope('Search');
       // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"]);
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('title','Title');
        $grid->add('domain','Domain')->cell(function($value){ return '<a href="'.route('review.domain',['domain'=>$value]).'" target="_blank">'.$value.'</a>'; });
      //  $resize_path = config('app.image_web_path.x360240');
        $grid->add('screen','Screen')->cell(function($value){ return '<img src="'.$value.'" width="120" height="80" />'; });
        $grid->add('evaluate_group.group','Type');
        $grid->add('online','Enable',true)->cell(function($value){return $value?'yes':'no';});
        $grid->edit(route('admin.review.add'), 'Edit','show|modify|delete|more')->style("width:90px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'review_domain', compact('filter', 'grid'));
    }

    /**
     * 添加域名
     * @return View
     */
    public function add(){
        if(Input::has('more'))return Redirect()->to(route('admin.evaluate.tip.edit',['more'=>Input::get('more')]));
        if(Input::has('show'))return $this->reCheckDomain(Input::get('show'));
        $id = Input::has('modify')?Input::get('modify'):(Input::has('do_delete')?Input::get('do_delete'):(Input::has('delete')?Input::get('delete'):0));
        if($id){
            $evaluate = Evaluate::findOrNew($id);
        }elseif(Input::has('domain')) {
            $evaluate = $this->getDomainInput();
        }
        if(!$evaluate)$evaluate =new Evaluate();
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.domain');
        $typeUrl = route('admin.review.type');
        $edit = DataEdit::source($evaluate);
        $edit->label('Add Domain');
        $edit->link($typeUrl,"Category", "TR")->back('insert|update|do_delete',$returnUrl);
        $edit->action(route('admin.review.add'));
        $edit->add('title','Title', 'text')->rule('required|min:3');
        $edit->add('domain','Domain', 'text')->rule('required|min:3');
        $edit->add('site','site', 'text')->rule('required|url');
        $edit->add('screen','screen', 'image')->move(config('app.upload_dir'))->fit(config('app.images_size.x400300'))->preview(config('app.images_size.x120'));
        $edit->add('summary','Description', 'textarea');
        $edit->add('group_id','Type', 'select')->options(EvaluateGroup::select('group as title','id as value')->get()->toArray())
           // ->attributes(array('multiple'=>'multiple'))
            ->setValues(new EvaluateGroup(),'id','group_id');
        $edit->add('content','About', 'redactor')->fullmode()->setImageSize('x690');
        $edit->add('tags','Keywords', 'text');

        return $edit->view(config('adminhtml.template').'review_domain_edit', compact('edit'));
    }

    /**
     * 重新检查
     * @param $evaluate_id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function reCheckDomain($evaluate_id){
        $evaluate = Evaluate::find($evaluate_id);
        if($evaluate){
            $this->evaluateRepository->checkAndScreenShot($evaluate);
        }
        return back();
    }

    /**
     * 处理传递过来的domain
     *
     */
    protected function getDomainInput(){
        $data = array();
        if(Input::has('domain')){
            $site = Input::get('domain');
            $evaluate =  $this->evaluateRepository->saveDomain($site);
            return $evaluate;
        }
        return false;
    }

    /**
     * 类别列表
     * @param EvaluateGroup $evaluateGroup
     * @return mixed
     */
    public function listEvaluateGroup(EvaluateGroup $evaluateGroup){
        $webPath = $this->getSmallImagePath('x9665');
        $grid = DataGrid::source($evaluateGroup);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('group','Category');
        $grid->add('logo','Logo')->cell(function($value) use ($webPath){
            return '<img src="'.$webPath.$value.'" />';
        });
        $grid->add('icon','Icon')->cell(function($value){
            return '<div class="icon '.$value.'"></div>';
        });
        $grid->add('description','Description');
        $grid->edit(route('admin.review.type'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'review_domain_types', compact('grid'));
    }

    /**
     * 类别-编辑添加
     * @return string
     */
    public function editEvaluateGroup(){
        $id = Input::has('modify')?Input::get('modify'):(Input::has('delete')?Input::get('delete'):0);
        $evaluate = EvaluateGroup::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.review.types');
        $edit = DataEdit::source($evaluate);
        $edit->label('Add Category');
        $edit->link($returnUrl,"Domain", "TR")->back();
        $edit->action(route('admin.review.type'));
        $edit->add('group','Type', 'text')->rule('required|min:3');
        $edit->add('logo','Logo', 'image')->move(config('app.upload_dir'))->fit(config('app.images_size.x9665'))->preview(config('app.images_size.x9665'));
        $edit->add('icon','Icon', 'select')->options(config('front.icons'));
        $edit->add('color','Color', 'select')->options(config('front.colors'));
        $edit->add('description','Description', 'text');
        $edit->add('is_top','Is Top', 'checkbox');
        $edit->add('related','Related', 'multiselect')->options(EvaluateGroup::where('id','!=',$id)->lists('group','id'));
        return $edit->view(config('adminhtml.template').'review_domain_type', compact('edit'));
    }

    /**
     * admin.review.list
     * 列表review
     * @return mixed
     * admin.review.list
     */
    public function listReviews(){
        $this->delete('review');
        $this->showHome('review');
        $filter = DataFilter::source(Review::with('user'));
        $filter->prepareForm();
        $filter->add('title','Title','text')->scope('Search');
        $filter->add('enable','enable','hidden')->scope('enable');
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"]);
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $domain = $id = '';
        $filter_bar = '<div class="toolbar-overflow"><a href="'.route('admin.review.list',['enable'=>0,'search'=>1]).'">Pending</a> | <a href="'.route('admin.review.list',['enable'=>-1,'search'=>1]).'">Trash</a> | <a href="'.route('admin.review.list',['enable'=>1,'search'=>1]).'">Applied</a>';
        if(Input::get('enable')==-1){
            $filter_bar.= ' | <a href="'.route('admin.review.trash.clear').'">Clear Trash</a>';
        }
        $filter_bar .= '</div>';
        $status = [1=>'Applied',-1=>'Trash',0=>'Pending'];
        $grid->row(function($row){
            $domain = $row->data->evaluate?$row->data->evaluate->domain:'';
            $id = $row->data->id;
            foreach($row->cells as &$cell){
                if($cell->name=='title'){
                    $cell->value = '<a href="'.route('review.domain.id',['domain'=>$domain,'id'=>$id]).'" target="_blank">'.$domain.' <span class="glyphicon glyphicon-new-window small"></span></a><br/>'.$cell->value;
                }
                if($cell->name == 'review'){
                    $cell->value =$row->data->useragent.'<br>'. $cell->value;
                    //快速编辑 保存
                    //状态打成pending
                    //状态打成apply
                    //删除
                    $app_div = '<div class="toolbar-overflow">';
                    if($row->data->enable==1){
                        $app_div .= '<a href="'.route('admin.review.trash',['id'=>$id]).'">Trash</a> | <a href="'.route('admin.review.del',['id'=>$id]).'">Delete</a>';
                    }elseif($row->data->enable==-1){
                        $app_div .= '<a href="'.route('admin.review.apply',['id'=>$id]).'">Apply</a> | <a href="'.route('admin.review.del',['id'=>$id]).'">Delete</a>';
                    }else{
                        $app_div .= '<a href="'.route('admin.review.apply',['id'=>$id]).'">Apply</a> | <a href="'.route('admin.review.trash',['id'=>$id]).'">Trash</a> | <a href="'.route('admin.review.del',['id'=>$id]).'">Delete</a>';
                    }
                    $cell->value .=$app_div;
                }
            }
        });
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('title','Title');
        //  $resize_path = config('app.image_web_path.x360240');
        $grid->add('review','Review')->cell(function($value){ return htmlentities($value); });
        $grid->add('user.email','Email');
        $grid->add('enable','Enable',true)->cell(function($value) use ($status){
            return $status[$value];//?'yes':'no';
        });
        $grid->edit(route('admin.review.list'), 'Edit','show')->style("width:80px")->cell(function($value,$row){
           //  $label = $row->enable?'禁用':'启用';
             return $value."|".link_to_route('admin.review.explain','Explain',['show'=>$row->id]);
        });
       // $grid->edit(route('admin.review.pass'), 'Edit','modify');
       // $grid->edit(route('admin.review.explain'), 'Explain','show');

        $grid->paginate(20);

        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid','filter_bar'));
    }

    /**
     * admin.review.pass
     * review
     * enable  disable
     * @param Review $review
     * @return mixed
     */
    public function reviewPass(){
         $id = Input::has('modify')?(int)Input::get('modify'):0;
         if($id){
            $ok = Review::where('id',$id)->where('enable',0)->update(['enable'=>1]);
            if(!$ok)Review::where('id',$id)->where('enable',1)->update(['enable'=>0]);
         }
         return back();
    }

    /**
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reviewApply($id){
        $id = ($id)?$id:(Input::has('id')?(int)Input::get('id'):0);
        if($id){
            Review::where('id',$id)->where('enable','!=',1)->update(['enable'=>1]);
        }
        return back();
    }

    public function reviewTrash($id){
        $id = ($id)?$id:(Input::has('id')?(int)Input::get('id'):0);
        if($id){
            Review::where('id',$id)->where('enable','!=',-1)->update(['enable'=>-1]);
        }
        return back();
    }

    /**
     * 删除单个评论
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reviewDelete($id){
        $id = ($id)?$id:(Input::has('id')?(int)Input::get('id'):0);
        if($id){
            Review::destroy($id);
        }
        return back();
    }

    /**
     * 清理垃圾桶
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reviewTrashClear(){
        $rs =  Review::where('enable','=',-1)->get();
        if($rs){
            foreach($rs as $item){
                $_imgs = [];
                $images = $item->images;
                if($images){
                    foreach($images as $image){
                        $_imgs[] = public_path().$image->image;
                        if($image->thumbnail)
                        $_imgs[] = public_path().$image->thumbnail;
                        $image->destroy($image->id);
                    }
                    File::delete($_imgs);
                }
                $item->destroy($item->id);
            }
        }
        return back();
    }

    /**
     * admin.review.explain
     * 解释列表，删除
     * @return mixed
     */
    public function explains(){
        $this->delete('explain');
        $id = Input::has('show')?(int)Input::get('show'):0;
        if($id){
            $filter = DataFilter::source(ReviewExplain::with('review')->where('review_id',$id));
        }else{
            $filter = DataFilter::source(ReviewExplain::with('review'));
        }


        $filter->prepareForm();
        $filter->add('title','Title','text')->scope('Search');
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"]);
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('review.title','Review');
        //  $resize_path = config('app.image_web_path.x360240');
        $grid->add('explain','Explain')->cell(function($value){ return htmlentities($value); });
        $grid->edit(route('admin.review.explain'), 'Edit','delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    /**
     * admin.review.question
     * questions 列表
     *
     */
    public function questions(){
        $this->delete('question');
        $filter = DataFilter::source(Question::with('user'));
        $filter->prepareForm();
        $filter->add('title','Title','text')->scope('Search');
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"]);
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        //  $resize_path = config('app.image_web_path.x360240');
        $grid->add('question','Question')->cell(function($value){ return htmlentities($value); });
        $grid->edit(route('admin.review.question'), 'Edit','delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }


    /**
     * admin.review.answer
     * questions 列表
     *
     */
    public function answers(Answer $answer){
        $this->delete('answer');
        $filter = DataFilter::source($answer);
        $filter->prepareForm();
        $filter->add('title','Title','text')->scope('Search');
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"]);
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        //  $resize_path = config('app.image_web_path.x360240');
        $grid->add('answer','nswer')->cell(function($value){ return htmlentities($value); });
        $grid->edit(route('admin.review.answer'), 'Edit','delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    protected function delete($type){
        $id = Input::has('delete')? Input::get('delete'):0;
        if($id){
            if($type=='review'){
                Review::destroy($id);
            }elseif($type=='explain'){
                ReviewExplain::destroy($id);
            }elseif($type=='question'){
                Question::destroy($id);
            }elseif($type=='answer'){
                Answer::destroy($id);
            }
        }
        return back();
    }

    /**
     * 评论设置为home页展示
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function showHome($type){
        $id = Input::has('show')? Input::get('show'):0;
        if($id){
            if($type=='review'){
                Review::where('id',$id)->update(['home'=>1]);
            }
        }
        return back();
    }

}