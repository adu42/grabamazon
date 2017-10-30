<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-13
 * Time: 上午2:53
 */

namespace App\Ado\Controllers\Front;
use Input;
use View;
use Route;
use App\Ado\Models\Tables\Evaluate\Evaluate;
use App\Ado\Models\Tables\Evaluate\EvaluateGroup;
use App\Ado\Models\Tables\Evaluate\Review;
use App\Ado\Models\Tables\Evaluate\ReviewExplain;
use App\Ado\Models\Tables\Evaluate\ReviewImage;
use App\Ado\Models\Tables\Evaluate\Question;
use App\Ado\Models\Tables\Evaluate\Answer;
use App\Ado\Models\Tables\Evaluate\EvaluateLink;
use App\Ado\Models\Tables\Evaluate\EvaluateTip;
use App\Ado\Models\Document;
use App\Ado\Models\Breadcrumbs;
use App\Ado\Models\Tables\Core\Setting;
use App\Ado\Models\Tables\Evaluate\SearchLog;
use Auth;
use DataForm;
use DataEdit;
use Config;
use Redirect;
use Request;
use Session;
use DB;
use Carbon\Carbon;
use App\Ado\Repositories\EvaluateRepository;
use Context;




class reviewController extends BaseController {
    protected $paginate=20;
    /**
     * 首页显示行业列表
     * + 评论排行-权重倒叙
     * + 说明描述
     *
     *  统一一下变量名称：
     *  url = http://www.baidu.com/xxxx/xxxx
     *  domain  = baidu.com
     *  site = http://www.baidu.com
     *
     * best 二级页面 行业best 10；
     * poor 二级页面 行业last 10；
     * 广告位
     *
     * 评论书写页面 三级页面
     * review
     *
     * 评论详情，展示 某个网站的评价及评论
     * detail
     *
     */



    /**
     * 暂缺视图
     * 评论详情-某个站的评论全展示
     * + 评论回复
     * + 同行业回复
     * + 本企业回复
     * @param null $domain
     * @return Redirect
     */

    public function detail($url=null,$keyword=null,$sort=null,$dir=null){
        $this->initDbConfig();
        $domain = $this->evaluateRepository->cleanDomain($url);
        $evaluate =  Evaluate::where('domain',$domain)->first();
        if($evaluate){
            Context::set('current_evaluate',$evaluate);
            $reviews = Review::with('review_explain')->where('evaluate_id',$evaluate->id)->where('enable',1)->orderBy('updated_at','desc');
            if(!empty($keyword)){
                if(is_numeric($keyword)){
                    if($keyword>5){
                        $reviews = $reviews->where('id',$keyword);
                    }else{
                        $min = ($keyword==1)?0:$keyword-0.5;
                        $max = $keyword+0.5;
                        $reviews =  $reviews->where('rating','>=',$min)->where('rating','<',$max);
                    }
                }else{
                    $reviews =  $reviews->where('title','like','%'.$keyword.'%');
                }
            }
           $reviews = $reviews->paginate($this->paginate);
           $questions = $this->questions($evaluate,$sort,$dir);
        }else{
            return redirect(route('review.add',array('domain'=>$domain)));
        }

        $this->setTitle(trans('review.domain_detail_title',['domain'=>$evaluate->domain]));
        $this->setKeywords(trans('review.domain_detail_keywords',['domain'=>$evaluate->domain,'keywords'=>$evaluate->tags]));
        $this->setDescription(trans('review.domain_detail_description',['domain'=>$evaluate->domain]));
        $this->viewComposerInit();
        return View::make(config('front.template').'review_detail_list',compact('evaluate','reviews','questions'));
    }

    public function summary($domain=null){
        $domain = $this->evaluateRepository->cleanDomain($domain);
        if(is_numeric($domain)){
            $evaluate =  Evaluate::where('id',$domain)->first();
        }else{
            $evaluate =  Evaluate::where('domain',$domain)->first();
        }
        if($evaluate){
            Context::set('current_evaluate',$evaluate);
            $this->initDbConfig();
            $this->setTitle(trans('review.domain_summary_title',['domain'=>$evaluate->domain]));
            $this->setKeywords(trans('review.domain_summary_keywords',['domain'=>$evaluate->domain,'keywords'=>$evaluate->tags]));
            $this->setDescription(trans('review.domain_summary_description',['domain'=>$evaluate->domain]));
            $this->viewComposerInit();
            return View::make(config('front.template').'review_detail_summary',compact('evaluate'));
        }else{
            return redirect(route('review.domain',array('domain'=>$domain)));
        }
    }


    /*
     * 如果域名存在，则
     *   查找评价信息，如果没有且是提交状态，则检测域名网址，抓图存档
     *
     *   缺审核  比如品牌brand、风险risk、在线online状态没有；
     *
     *  待做。。。
     *   视图排版
     */
    public function write($site=null){
        $this->initDbConfig();
        $user = Auth::user();
        $review = new Review();
        $site = (Input::has('domain'))?Input::get('domain'):$site;
        $external_link_count = (Input::has('review'))? external_link_count(Input::get('review')):0;

        $form = DataForm::source($review);


        $cash_back_in = false;
        $msg='';
        if($site){
            $domain = EvaluateRepository::getDomain($site);
            $site = EvaluateRepository::getSite($site);
            $evaluate= Evaluate::where('domain',$domain)->first();
            if($evaluate){
                $cash_back_in = $evaluate->cash_back_in;
                if($cash_back_in && Input::has('rating')){
                    if(Input::get('rating')<4){
                        $msg = 'Is not a favorable comment, You may not be able to get cash back.';
                    }
                }
            }
          }

       //  min=0 max=5 step=0.5 data-size="sm"
        $ratingFields=array(
            'rating'=>'Rating',
            'service'=>'Service',
            'value'=>'Value',
            'shipping'=>'Shipping',
            'returns'=>'Returns',
            'quality'=>'Quality'
        );
        foreach($ratingFields as $field=>$label){
            $form->add($field,$label,'rating')->attributes(
                array(
                    'class'=>'rating',
                    'max'=>5,
                    'min'=>0,
                    'step'=>0.2,
                    'data-size'=>'sm',
                    )
            );
        }
        $form->add('review','Review', 'textarea')->rule('required|min:15');//redactor
        $form->add('title','Title', 'text')->rule('required|min:5');

     //  $form->add('image_s','Image', 'image')->move(config('app.upload_web_path'))->fit(240, 160)->preview(120,80);
        // if($review->evaluate_id){
       //     $form->add('domain','Website', 'hidden');
       // }else{
            $form->add('domain','Website', 'text')->rule('required|min:5|url')->insertValue($site)->attributes(array('placeholder'=>'http://www.google.com'));
       // }
        if($cash_back_in){
            $form->add('cash_back_order_number','Order Number', 'text')->rule('min:5');
            $form->add('cash_back_in','Apply Cashback for Praise', 'checkbox');
        }else{
            $form->add('cash_back_order_number','Order Number', 'hidden');
            $form->add('cash_back_in','Apply Cashback for Praise', 'hidden');
        }
        $form->set('user_id',$user->id);
        $form->set('enable',0);
        $form->set('ip',Request::ip());
        $form->set('useragent',strtolower($_SERVER['HTTP_USER_AGENT']));
        $form->set('external_link_count',$external_link_count);
       // $form->add('evaluate_id','evaluate_id', 'hidden')->insertValue($review->evaluate_id);
        $form->submit('Save');
        $form->saved(function ($form) use ($site,$msg) {
           $evaluate = $this->evaluateRepository->saveDomain($site);
            list($media,$medias_thumb,$error)=$this->imagesUpload();
            if(!empty($media)){
                foreach($media as $i=>$pic){
                    $thumbnail = isset($medias_thumb[$i])?$medias_thumb[$i]:'';
                    ReviewImage::create([
                        'review_id'=>$form->model->id,
                        'image'=>$pic,
                        'thumbnail'=> $thumbnail,
                    ]);
                }
            }
            $form->model->update(['evaluate_id'=>$evaluate->id]);
            $form->message("You review saved.<br/>".$msg);
            $form->link(route('review.domain',['domain'=>$evaluate->domain]),"back to the site reviews");
        });
        $form->setUseMultipart();
        $form->build();

        $this->setTitle(config('front.site_name'));
        $this->setKeywords(config('front.site_keywords'));
        $this->setDescription(config('front.site_description'));
        $this->viewComposerInit();
        return View::make(config('front.template').'review_write_form', compact('form'));
    }




    /**
     * 报告错误或疑虑
     * report_review
     * ajax获得这个model dialog页面
     * 主要考虑token
     */
    public function report($review_id=null){
        $reviewExplain = new ReviewExplain();
        $user = Auth::user();
        $form = DataForm::source($reviewExplain);
       // $form->add('title',trans('review.explain_title'), 'text');
        $form->add('explain',trans('review.explain_content'), 'textarea')->rule('required|min:15');//redactor
        $form->add('affiliated',trans('review.explain_title'), 'radiogroup')->options(['1'=>trans('review.explain_is_affiliated'),'0'=>trans('review.explain_is_not_affiliated')]);
        $form->add('review_id','review', 'hidden')->insertValue($review_id);
        $form->submit('Save');
        $form->cancel('Cancel');
        if($user && $user->id)
        $form->set('user_id',$user->id);
        $form->build();

        return View::make(config('front.template').'review_report_form', compact('form'));
    }

    /**
     * answer report
     * @param null $answer_id
     * @return mixed
     */
    public function report_answer($answer_id=null,$act=null){
        $user = Auth::user();
        if($act == 'answer'){
            $answer = new Answer();
            if($user)$answer->report_user_id = $user->id;
            $form = DataForm::source($answer);
            // $form->add('title',trans('review.explain_title'), 'text');
            $form->add('report',trans('review.report'), 'textarea')->rule('required|min:15');//redactor
            $form->add('answer_id','answer', 'hidden');
            $form->add('report_user_id','user', 'hidden');
            $form->submit('Save');
            $form->cancel('Cancel');
            $form->build();
            return View::make(config('front.template').'review_report_answer_form', compact('form'));
        }elseif($act=='question'){
            $question = new Question();
            if($user)$question->report_user_id = $user->id;
            $form = DataForm::source($question);
            // $form->add('title',trans('review.explain_title'), 'text');
            $form->add('report',trans('review.report'), 'textarea');//redactor
            $form->add('question_id','question', 'hidden');
            $form->add('report_user_id','user', 'hidden');
            $form->submit('Save');
            $form->cancel('Cancel');
            $form->build();
            return View::make(config('front.template').'review_report_question_form', compact('form'));
        }
    }

    /**
     * helpful +1
     * @param null $review_id
     * @return int
     */
    public function helpful($review_id=null){
        $_review_id = Session::get('review_id');
        $review_id = (int)$review_id;
        if($_review_id && $review_id==$_review_id){
            return 0;
        }else{
            Review::where('id',$review_id)->increment('helpful');
            Session::set('review_id',1);
            return 1;
        }
    }

    /**
     * answer helpful
     * @param null $review_id
     * @return int
     */
    public function helpful_answer($answer_id=null,$up=true){
        $_answer_id = Session::get('answer_id'.$answer_id);
        $answer_id = (int)$answer_id;
        if($_answer_id && $answer_id==$_answer_id){
            return 0;
        }else{
            if($up){
                Answer::where('id',$answer_id)->increment('helpful');
            }else{
                Answer::where('id',$answer_id)->decrement('helpful');
            }
            Session::set('review_id'.$answer_id,1);
            return 1;
        }
    }

    /**
     * list
     * 展示Questions Answers
     */
    public function questions($site=null,$sort=null,$dir=null){
        if(is_string($site)){
            $domain = $this->evaluateRepository->cleanDomain($site);
            $evaluate =  Evaluate::where('domain',$domain)->first();
        }elseif(is_a($site,'App\Ado\Models\Tables\Evaluate\Evaluate')){
            $evaluate = $site;
            unset($site);
        }
        $questions = null;
        if($evaluate){
            if($sort){
                if($sort=='recent'){
                    $sort = 'updated_at';
                }elseif($sort=='helpful'){
                    $sort = 'same_ask';
                }else{
                    $sort = 'id';
                }
            }else{
                $sort = 'id';
            }
            $dir=($dir=='desc')?'desc':'asc';
            $questions = Question::where('enable',1)->where('evaluate_id',$evaluate->id)->orderBy($sort,$dir)->paginate($this->paginate);
        }
        return View::make(config('front.template').'review_questions', compact('evaluate','questions'));
    }

    /**
     * 提问
     * @return mixed
     */
    public function questionWrite($evaluate_id=null){
        $question = new Question();
        $form = DataForm::source($question);
        if($evaluate_id && is_numeric($evaluate_id))$question->evaluate_id=$evaluate_id;

        $user = Auth::user();
        $question->enable = 1;
        // $form->add('title',trans('review.explain_title'), 'text');
        $form->add('question',trans('review.question'), 'textarea')->rule('required|min:15')->attributes(['row'=>4]);//redactor
        $form->add('evaluate_id','evaluate', 'hidden')->insertValue($evaluate_id);
        if($user && $user->id)
        $form->set('user_id',$user->id);
        $form->submit('Save');
        $form->cancel('Cancel');
        $form->build();
        $form->saved(function(){
            if(Request::ajax()){
                return trans('review.question_saved');
            }else{
                return Redirect::back();
            }
        });
        return View::make(config('front.template').'review_question_form', compact('form'));
    }

    /*
     * post
     * 提交提问之前需要做：
     * 1、设置user_id
     * 2、检查域名评价表的关联 evaluate_id
     */
    public function saveQuestion(){
        $question = Input::has('question')?Input::get('question'):'';
        $evaluate_id = Input::has('evaluate_id')?Input::get('evaluate_id'):0;
        if($evaluate_id && !empty($question)){
            $user_id = Input::has('user_id')?Input::get('user_id'):(Auth::user() ? Auth::user()->id : 0);
            Question::create([
                'question'=>$question,
                'evaluate_id'=>$evaluate_id,
                'user_id'=>$user_id,
            ]);
        }
        if(Request::ajax()){
            return trans('review.question_saved');
        }else{
            return Redirect::back();
        }
    }

    public function answerWrite($question_id=null){
        $answer = new Answer();
        $form = DataForm::source($answer);
        if($question_id && is_numeric($question_id))$answer->question_id=$question_id;
        $user = Auth::user();
         // $form->add('title',trans('review.explain_title'), 'text');
        $form->add('answer',trans('review.answer'), 'textarea')->rule('required|min:15');//redactor
        $form->add('question_id','question', 'hidden');
        if($user && $user->id)
        $form->set('user_id',$user->id);
        $form->submit('Save');
        $form->cancel('Cancel');
        $form->build();
        return View::make(config('front.template').'review_answer_form', compact('form'));
    }

    /**
     * post
     * 保存提交过来的数据
     * 1、检查 question_id
     * 2、检查 user_id
     */
    public function saveAnswer(){
        $answer = Input::has('answer')?Input::get('answer'):'';
        $question_id = Input::has('question_id')?Input::get('question_id'):0;
       // $answer = htmlspecialchars($answer);

        if($question_id && !empty($answer)){
            $user_id = Input::has('user_id')?Input::get('user_id'):(Auth::user() ? Auth::user()->id : 0);
            Answer::create([
                'answer'=>$answer,
                'question_id'=>$question_id,
                'user_id'=>$user_id,
            ]);
        }
        if(Request::ajax()){
            return trans('review.answer_saved');
        }else{
            return Redirect::back();
        }
    }

    /**
     * 行业汇总
     * @param string $year
     * @param string $industry
     */
   public function best($industry='wedding'){
       $this->initDbConfig();
       $industry = str_replace(['-'],[' '],$industry);
       $industry = ucwords($industry);
       $keywords = explode(' ',$industry);
       //当前行业
       if(isset($keywords[1]) && !empty($keywords[1])){
           $evaluateGroup =  EvaluateGroup::where('group','like',"%".$keywords[0]."%")->where('group','like',"%".$keywords[1]."%")->orderBy('sort_order','desc')->first();
       }else{
           $evaluateGroup =  EvaluateGroup::where('group','like',"%$industry%")->orderBy('sort_order','desc')->first();
       }
       $evaluates=null;
       if($evaluateGroup){
           //行业top 10
           $evaluates =  Evaluate::where('group_id',$evaluateGroup->id)->enable()->orderBy('mark','desc')->take(10)->get();
             //相关行业
           $relatedGroups = EvaluateGroup::where('related',$evaluateGroup->related)->orderBy('sort_order','desc')->take(9)->get();
       }
       $searchLog = SearchLog::where('keyword','!=','')->orderBy('times','desc')->take(3)->get();
       $searchLog->each(function($item){
           $item->keyword = link_to_route('review.search',$item->keyword,['keyword'=>$item->keyword]);
       });
       //顶层行业
       $evaluateTopGroup = EvaluateGroup::where('is_top',1)->orderBy('sort_order','desc')->take(21)->get();
       $evaluateTopGroup->each(function($witem){
           $witem->logo = image_to($witem->logo,'x120',$witem->icon,['class'=>'category_image']);
           $witem->url = url('/best/'.$witem->url_path);
       });
       $reviews = null;

       $this->setTitle(trans('review.domain_best_title',['keyword'=>$industry]));
       $this->setKeywords(trans('review.domain_best_keywords',['keyword'=>$industry]));
       $this->setDescription(trans('review.domain_best_description',['keyword'=>$industry]));

       $this->viewComposerInit();
       return View::make(config('front.template').'review_best', compact('evaluateGroup','searchLog','reviews','evaluates','relatedGroups','evaluateTopGroup'));
   }


    /**
     * review.search
     * 搜索结果页
     */
    public function result($keyword=null,$sort=null,$dir=null){
        $url =Input::has('_url')?Input::get('_url'):Input::get('_url');
        if(!empty($url)){
        $keyword = substr($url,stripos($url,'/',1)+1);

        if(stripos($keyword,'?'))$keyword=substr($keyword,0,stripos('?'));
            $keyword = urldecode($keyword);
            }
        $keyword =($keyword)?$keyword:(Input::has('keyword')?Input::get('keyword'):'');

        $this->initDbConfig();
        $keyword = str_replace(array('%','_','-'),array('\%','\_',' '),$keyword);


        if($sort=='recent'){
            $sort='updated_at';
        }elseif($sort=='hot'){
            $sort='hits';
        }elseif($sort=='good'){
            $sort='mark';
            $dir='desc';
        }elseif($sort=='bad'){
            $sort='mark';
            $dir='asc';
        }else{
            $sort = 'mark';
        }
        $dir=($dir=='asc')?'asc':'desc';
        $evaluates=null;
        $evaluates =  Evaluate::keyword($keyword)->orderBy($sort,$dir)->paginate($this->paginate);


        //当前行业
        $evaluateGroup =  EvaluateGroup::where('group','like',"%$keyword%")->orderBy('sort_order','desc')->first();

        if($evaluateGroup){
            //相关行业
            $relatedGroups = EvaluateGroup::where('related',$evaluateGroup->related)->orderBy('sort_order','desc')->take(21)->get();
        }

        if(config('front.save_search_log')){
            $search_Log = SearchLog::where('keyword',$keyword)->first();
            if($search_Log){
                $search_Log->times+=1;
            }else{
                $search_Log = new SearchLog();
                $search_Log->keyword = $keyword;
                $search_Log->times=1;
                $search_Log->created_at = date('Y-m-d H:i:s');
            }
            $search_Log->save();
            //清除2万条之外的搜索日志。
            SearchLog::where('created_at','<',date('Y-m-d H:i:s',strtotime('-2 months')))->where('times','<=',1)->orderBy('times','desc')->take(1000)->delete();
        }

        $searchLog = SearchLog::where('keyword','!=','')->orderBy('times','desc')->take(3)->get();
        $searchLog->each(function($item){
            $item->keyword = link_to_route('review.search',$item->keyword,['keyword'=>$item->keyword]);
        });
        //顶层行业
        $evaluateTopGroup = EvaluateGroup::where('is_top',1)->orderBy('sort_order','desc')->take(21)->get();
        $evaluateTopGroup->each(function($witem){
            $witem->logo = image_to($witem->logo,'x120',$witem->icon,['class'=>'category_image']);
            $witem->url = url('/best/'.$witem->url_path);
        });
        $this->setTitle(trans('review.domain_result_title',['keyword'=>$keyword]));
        $this->setKeywords(trans('review.domain_result_keywords',['keyword'=>$keyword]));
        $this->setDescription(trans('review.domain_result_description',['keyword'=>$keyword]));
        $this->viewComposerInit();
        return View::make(config('front.template').'review_result', compact('evaluateGroup','searchLog','evaluates','relatedGroups','evaluateTopGroup'));

    }

    /**
     * 首页
     * 1、引导说明
     * 2、recent review
     * 3、recent plan / save money /
     *
     * 4、行业引导
     *
     *
     * 5、如果有搜索，屏蔽行业引导
     */
   public function home($search=null){
       $this->initDbConfig();
       $this->setTitle(config('front.site_name'));
       $this->setKeywords(config('front.site_keywords'));
       $this->setDescription(config('front.site_description'));

       $descriptions['why']=Setting::getPathValue('review.why');
       $search = Input::has('keyword')?Input::get('keyword'):'';
       if(!empty($search)){
          $evaluates =  Evaluate::where('domain','like',"%$search%")->orWhereHas('evaluate_group',function($query) use ($search){
              $query->where('group','like',"%$search%");
          })->orderBy('updated_at','desc')->paginate($this->paginate);
           $reviews = Review::with('user')->where('title','like',"%$search%")->where('enable',1)->orderBy('updated_at')->take(30)->get();
       }else{
          $evaluates =  Evaluate::orderBy('updated_at','desc')->paginate($this->paginate);
           $reviews = Review::with('user')->where('home',1)->where('enable',1)->orderBy('updated_at')->take(30)->get();
       }

       //顶层行业
       $evaluateTopGroup = EvaluateGroup::where('is_top',1)->orderBy('sort_order','desc')->take(21)->get();
        $evaluateTopGroup->each(function($witem){
            $witem->logo = image_to($witem->logo,'x120',$witem->icon,['class'=>'category_image']);
            $witem->url = url('/best/'.$witem->url_path);
       });
       $searchLog = SearchLog::where('keyword','!=','')->orderBy('times','desc')->take(3)->get();
       $searchLog->each(function($item){
           $item->keyword = link_to_route('review.search',$item->keyword,['keyword'=>$item->keyword]);
       });

     //  $reviews = Review::with('user')->where('home',1)->where('enable',1)->orderBy('updated_at')->take(30)->get();
       $this->viewComposerInit();
       return View::make(config('front.template').'review_home', compact('search','evaluates','descriptions','evaluateTopGroup','searchLog','reviews'));
   }

    /**
     * ---------------------------------------- not use
     * 优惠券页
     * 搜索标识为优惠券
     *
     */
    public function coupon($search=null){
        $this->initDbConfig();
        $this->setTitle(config('front.site_name'));
        $this->setKeywords(config('front.site_keywords'));
        $this->setDescription(config('front.site_description'));

        if(!empty($search)){
            $evaluates =  Evaluate::where('domain','like',"%$search%")->orWhereHas ('evaluate_group',function($query) use ($search){
                $query->where('group','like',"%$search%");
            })->orderBy('updated_at','desc')->paginate($this->paginate);
        }else{
            $evaluates =  Evaluate::orderBy('updated_at','desc')->paginate($this->paginate);
        }
        //顶层行业
        $evaluateTopGroup = EvaluateGroup::where('is_top',1)->orderBy('sort_order','desc')->take(21)->get();
        $evaluateTopGroup->each(function($witem){
            $witem->logo = image_to($witem->logo,'x120',$witem->icon,['class'=>'category_image']);
            $witem->url = url('/best/'.$witem->url_path);
        });
        $this->viewComposerInit();
        return View::make(config('front.template').'review_home', compact('search','evaluates','descriptions','evaluateTopGroup'));
    }

    /**
     * 评价参考独立页
     *
     * @param null $url
     */
    public function assess($url=null){
        $this->initDbConfig();
        $domain = $this->evaluateRepository->cleanDomain($url);
        $evaluate =  Evaluate::where('domain',$domain)->first();
        if($evaluate){
            Context::set('current_evaluate',$evaluate);
        }else{
            return abort(404);
        }

        $this->setTitle(trans('review.domain_assess_title',['domain'=>$evaluate->domain]));
        $this->setKeywords(trans('review.domain_assess_keywords',['domain'=>$evaluate->domain,'keywords'=>$evaluate->tags]));
        $this->setDescription(trans('review.domain_assess_description',['domain'=>$evaluate->domain]));
        $this->viewComposerInit();
        return View::make(config('front.template').'review_assess_list',compact('evaluate'));
    }

    /**
     * 跳转并记录
     * @param null $link
     */
    public function jump_to($link=null){

        $_to = null;
        if($link){
            $type = substr($link,0,1);
            $id = substr($link,1);
			if(is_numeric($id)){
            if($type=='a'){
              $evaluate =   Evaluate::find($id);
              if($evaluate){
                  $_to = $evaluate->site;
                  $evaluate->increment('hits');
              }
            }elseif($type=='l'){
                $evaluateLink = EvaluateLink::find($id);
                if($evaluateLink){
                    $_to = $evaluateLink->link;
                    $evaluateLink->increment('hits');
                }
            }
			}
        }
        if($_to)return  Redirect::to($_to);
        if($link){
        $link = route_urldecode($link);
        $link=trim($link);
        EvaluateLink::where('link',$link)->increment('hits');
        $domain =  EvaluateRepository::getDomain($link);
        Evaluate::where('domain',$domain)->increment('hits');
        return  Redirect::to($link);
        }
        return abort(404);
    }

    /**
     * siteMap
     * @return mixed
     */
    public function siteMap(){
        $string='';
        $evaluates =   Evaluate::enable()->get();
        if($evaluates && $evaluates->count()){
            $xml = [];
            $xml[] = '<?xml version="1.0" encoding="UTF-8"?' . '>';
            $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            $lastmod = date('Y-m-d');
            foreach($evaluates as $evaluate){
                $url = route('review.domain',['domain'=>$evaluate->domain]);
                $xml[] = '  <url>';
                $xml[] = "    <loc>$url</loc>";
                $xml[] = "    <lastmod>$lastmod</lastmod>";
                $xml[] = '    <changefreq>weekly</changefreq>';
                $xml[] = '    <priority>1</priority>';
                $xml[] = '  </url>';
            }
            $xml[] = '</urlset>';
            $string = join("\n", $xml);
        }
        return response($string)->header('Content-type', 'text/xml');
    }

}