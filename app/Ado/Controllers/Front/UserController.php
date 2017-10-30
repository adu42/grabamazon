<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/4
 * Time: 9:52
 */

namespace App\Ado\Controllers\Front;

use App\Ado\Models\Document;
use App\Ado\Models\Breadcrumbs;
use App\Ado\Models\Tables\Core\Setting;
use App\Ado\Models\Tables\Evaluate\EvaluateGroup;
use Auth;
use DataForm;
use DataEdit;
use Config;
use Redirect;
use Input;
use Route;
use View;
use Vmenu;
use DataSet;
use DataFilter;
use DataGrid;
use App\Ado\Models\Tables\Evaluate\Evaluate;
use App\Ado\Models\Tables\Evaluate\EvaluateUser;
use App\Ado\Models\Tables\Evaluate\Coupon;
use Response;
use File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Currency;
use App\Ado\Models\Tables\Evaluate\Review;
use Cache;
use App\Ado\Repositories\EvaluateRepository;
use Context;
use App\Ado\Models\Tables\Evaluate\EvaluateLink;



class UserController extends BaseController
{
    /**
     * 设置菜单快
     */
    protected function setUserMenuComposer(){
        $menu = Vmenu::get(config('front.vmenu_name'));
        $this->viewComposer('layouts.partials.user_menu',$menu,'user_menus');
    }

    /**
     * 页面公共部分
     */
    protected function pageInit(){
        $this->initDbConfig();
        $this->setUserMenuComposer();
        $this->viewComposerInit();
    }


    /**
     * user.self
     * @return mixed
     */
    public function profile(){
        $this->addCrumb('profile',['label'=>'profile','title'=>'profile','link'=>null]);
        $this->pageInit();
        $user = Auth::user();
        return View::make(config('front.template').'user_profile',compact('user'));
    }

    /**
     * user.domain
     * @return mixed
     */
    public function domain(){
        $this->pageInit();
        $user = Auth::user();
        $filter = DataFilter::source(Evaluate::with('evaluate_users')->user($user->id));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('user.domain.edit'));
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('domain','domain');
        $grid->add('pass','checking')->cell(function($value,$item)use($user){
            if($item->evaluate_users && $item->evaluate_users->count()){
                $value = $item->evaluate_users[0]->pass;
            }
            return $value?'pass':link_to_route('user.domain.verify','Verify',['id'=>$item->id]);
        });
        $grid->edit(route('user.domain.edit'), 'Edit','modify|delete')->style("width:70px")->cell(function($value,$evaluate) use($user){
            $isOwn = $this->evaluateRepository->checkUserOwnDomain($user,$evaluate);
            if(!$isOwn)unset($value->actions[0]);
            return $value;
        });
        $grid->paginate(20);
        return View::make(config('front.template').'user_domain',compact('filter', 'grid'));
    }



    /**
     * 编辑用户自己的域名介绍
     * user.domain
     * @return mixed
     */
    public function edit_domain(){
        $user = Auth::user();
        if (Input::get('delete')){
            EvaluateUser::where('evaluate_id',Input::get('delete'))->where('user_id',$user->id)->delete();
            return Redirect::to(route('user.domain'));
        }
        if (Input::get('destroy'))return Redirect::to(route('user.domain'));
        $id = (Input::get('modify'))?:0;
        $id = (Input::has('update'))?:$id;
        $site = Input::has('site')?Input::get('site'):'';
        $this->pageInit();
        $domain='';
        $isOwn = $isNew = false;
        $evaluate =null;
        if(!empty($site)){
            $domain = $this->evaluateRepository->cleanDomain($site);
            $evaluate = Evaluate::where('domain',$domain)->first();
            if($evaluate){
                $id = $evaluate->id;
                $isOwn = $this->evaluateRepository->checkUserOwnDomain($user,$evaluate);
            }
        }
        if(!$evaluate){
            $isNew = true;
            $evaluate = new Evaluate();
        }
        $returnUrl = route('user.domain');
        $edit = DataEdit::source($evaluate);

        $edit->link($returnUrl,"My Domains", "TR")->back();
        $edit->action(route('user.domain'));
        if($isNew){
            $edit->label('Edit Site');
            $edit->add('site','Site', 'text')->rule('required|min:10|max:100');
            $edit->set('domain',$domain);
            $edit->set('verification_code','');
        }else{
            $edit->label('Edit Site: '.$evaluate->site);
        }
        if($isOwn||$isNew){
            $edit->add('brand','Brand', 'text')->rule('max:100');
            $edit->add('summary','About Site', 'textarea')->attributes(array('rows'=>4));
            $edit->add('content','Summary', 'textarea')->attributes(array('rows'=>4));
        }

        //可评论返现
        if($user->cash_back_in){
            $edit->add('cash_back_in','Cash Back Enable', 'checkbox');
            $edit->add('cash_back_amount','Cash Back Amount', 'text')->rule('numeric|max:8');
            $edit->add('cash_back_currency','Cash Back Currency', 'select')->options(Currency::getCurrencies('options'));
            $edit->add('cash_back_begin','Cash Back Begin', 'date')->format('Y-m-d');
            $edit->add('cash_back_end','Cash Back End', 'date')->format('Y-m-d');
        }

        $edit->saved(function() use($user,$edit,$isOwn){
            if(!$isOwn){
                $edit->model->users()->detach($user->id);
                $edit->model->users()->attach($user->id);
            }
            $edit->message("You website saved");
            $edit->link(route('user.domain'),"back to the website list");
        });
        return View::make(config('front.template').'user_domain_edit',compact('edit'));
    }

    /**
     * 验证域名
     *
     * @return mixed
     */
    public function verify_domain(){
        $this->pageInit();
        $user = Auth::user();
        $id = (Input::has('id'))?Input::get('id'):0;
        $evaluate =  Evaluate::user($user->id)->where('id',$id)->first();
        if(!$evaluate)return Redirect::route('user.domain');
        $verify_file_url = link_to_route('user.domain.verify.file',$evaluate->verification_code.'.html',['id'=>$evaluate->id]); // route('user.domain.verify.file');
        $check_url = route('user.domain.check',['id'=>$evaluate->id]);
        return View::make(config('front.template').'user_domain_verify',compact('user','evaluate','verify_file_url','check_url'));
    }

    /**
     * user.domain.verify.file
     * @param $evaluate
     * @return mixed
     */
    public function sendVerificationCodeHtml(){
        $user = Auth::user();
        $id = (Input::has('id'))?Input::get('id'):0;
        $evaluate =  Evaluate::user($user->id)->where('id',$id)->first();
        if(!$evaluate)return abort(404);
        $filepath = storage_path('framework/cache').'/'.$evaluate->verification_code.'.html';
        File::put($filepath,$evaluate->verification_code);
        return Response::download($filepath);
    }
    /**
     * 查看域名根目录下是否存在验证文件
     * @param null $id
     * @return mixed
     */
    public function verify_domain_check(){
        $this->pageInit();
        $user = Auth::user();
        $id = (Input::has('id'))?Input::get('id'):0;
        $evaluate =  Evaluate::user($user->id)->where('id',$id)->first();
        if(!$evaluate)return 'err';
        $path = $evaluate->site.'/'.$evaluate->verification_code.'.html';
        try{
            $content =   File::get($path);
        }catch(FileNotFoundException $e){
            $content='';
        }
        if($evaluate->verification_code == $content){
            EvaluateUser::where('evaluate_id',$evaluate->id)->where('user_id',$user->id)->update(['pass'=>1]);
            return 'ok';
        }else{
            return 'err';
        }
    }

    /**
     * user.coupon
     * @return mixed
     */
    public function coupon(){
        $this->pageInit();
        $user = Auth::user();
        $filter = DataFilter::source(Coupon::users($user->id));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('user.coupon.edit'));
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('coupon','Coupon');
     //   $grid->add('currency','Currency');
        $grid->add('discount','Discount')->cell(function($value,$item){ return Currency::format($value,$item->currency); });
        $grid->add('begin','Begin Show');
        $grid->add('expire','Expire');
        $grid->add('enable','Enable')->cell(function($value){ return $value?'yes':'no'; });
        $grid->edit(route('user.coupon.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('front.template').'user_coupon',compact('filter','grid'));
    }

    /**
     * user.coupon.edit
     * @return mixed
     */
    public function edit_coupon(){
        $this->pageInit();
        $user = Auth::user();
        if (Input::get('destroy'))return abort(404);
        $id= Input::get('modify');
        $coupon = Coupon::users($user->id)->where('id',$id)->first();
        if(!$coupon)$coupon=new Coupon();
        $returnUrl = route('user.coupon');
        $edit = DataEdit::source($coupon);
        $edit->set('user_id',$user->id);
        $edit->label('Edit Coupon');
        $edit->link($returnUrl,"My Coupons", "TR")->back();
        $edit->action(route('user.coupon'));
        $edit->add('coupon','Coupon', 'text')->rule('required|max:50');
        $edit->add('discount','Discount', 'text')->rule('required|max:50');
        $edit->add('currency','Currency', 'select')->options(Currency::getCurrencies('options'));
        $edit->add('begin','Begin Show', 'datetime')->format('Y-m-d H:i:s');
        $edit->add('expire','Expire', 'datetime')->format('Y-m-d H:i:s');
        $edit->add('site','Use in website', 'text')->rule('required|max:50');
        $edit->add('background','Background', 'image')->move(config('app.upload_dir'))->fit(config('app.images_size.x240120'))->preview(config('app.images_size.x240120'));
        $edit->add('enable','Enable', 'checkbox');
        return View::make(config('front.template').'user_coupon_edit',compact('edit'));
    }
    /**
     * user.reviews
     * @return mixed
     */
    public function review(){
        $this->pageInit();
        $user = Auth::user();
        if($user->has_domain){
            $filter = DataFilter::source(Review::users($user->id));
        }else{
            $filter = DataFilter::source(Review::myReview($user->id));
        }
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('review.new'));
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('title','Title')->cell(function($value,$item){
            $domain = ($item->evaluate)?$item->evaluate->domain:'';
            $url = route('review.domain.id',['domain'=>$domain,'id'=>$item->id]);
           return link_to($url,$value);
        });
        //   $grid->add('currency','Currency');
        $grid->add('created_at|strtotime|date[Y-m-d]','Created_at',true);
        $grid->add('enable','Enable')->cell(function($value){ return $value?'yes':'no'; });
       // $grid->edit(route('user.coupon.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);

        return View::make(config('front.template').'user_review',compact('filter','grid'));
    }

    /**
     * user.addreview
     * @return mixed
     */
    public function edit_review($site=null){
        $this->pageInit();
        $user = Auth::user();
        $this->initDbConfig();
        $review = new Review();
        $site = (Input::has('domain'))?Input::get('domain'):$site;
        $external_link_count = (Input::has('review'))? external_link_count(Input::get('review')):0;
        $domain = $this->evaluateRepository->cleanDomain($site);
        $cash_back_in = false;
        $msg='';
        if(!empty($site)){
            if(Input::has('process')){
                $evaluate = $this->evaluateRepository->saveDomain($site);
                $review->evaluate_id = $evaluate->id;
                $cash_back_in = $evaluate->cash_back_in;
                if($cash_back_in && Input::has('rating')){
                    if(Input::get('rating')<4){
                        $msg = 'Is not a favorable comment, You may not be able to get cash back.';
                    }
                }
            }
        }
        $review->ip =  Input::ip();
        $form = DataForm::source($review);
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
        $form->add('review','Review', 'redactor')->rule('required|min:15');
        $form->add('title','Title', 'text')->rule('required|min:5');
        $form->add('ip','ip', 'hidden');
        if($review->evaluate_id){
            $form->add('domain','domain', 'hidden');
        }else{
            $form->add('domain','domain', 'text')->rule('url|required|min:10')->insertValue($site)->attributes(array('placeholder'=>'http://www.google.com'));
        }
        if($cash_back_in){
            $form->add('cash_back_order_number','Order Number', 'text')->rule('min:5');
            $form->add('cash_back_in','Apply Cashback for Praise', 'checkbox');
        }
        $form->set('user_id',$user->id);
        $form->set('external_link_count',$external_link_count);
        // $form->add('evaluate_id','evaluate_id', 'hidden')->insertValue($review->evaluate_id);
        $form->submit('Save');
        $form->saved(function () use ($form,$domain,$msg) {
            $form->message("You review saved.<br/>".$msg);
            $form->link('detail/'. $domain,"back to the site reviews");
        });
        $form->build();



        return View::make(config('front.template').'user_review_edit',compact('user','form'));
    }

    public function question(){
        $this->pageInit();
        $user = Auth::user();
        return View::make(config('front.template').'user_domain',compact('user'));
    }

    /**
     * ------------------------------not use
     * post
     * 快速回复
     */
    public function answer(){
        $this->pageInit();
        $user = Auth::user();
        return View::make(config('front.template').'user_domain',compact('user'));
    }

    /**
     * 编辑用户自己的资料
     * user.profile.edit
     * @return mixed
     */
    public function edit_user(){
        $this->pageInit();
        $user = Auth::user();
        $id = (Input::get('modify'))?:Input::get('delete');
        $id = (Input::has('update'))?Input::get('update'):$id;
        if($id && $id!=$user->id)return back();
        if (Input::get('destroy'))return abort(404);

        $files =

        $avatar_path = '/assets/avatars/';
        $returnUrl = route('user.profile');
        $edit = DataEdit::source($user);
        $edit->label('Edit Profile:');
        $edit->link($returnUrl,"My Profile", "TR")->back();
        $edit->action(route('user.profile.edit'));
        $edit->add('avatar','Avatar', 'avatar')->options($this->avatars())->setAvatar($avatar_path,['width'=>120,'height'=>120]);
        $edit->add('summary','Summary', 'textarea')->attributes(array('rows'=>2))->rule('max:100');

     //   $edit->add('tag','Tags', 'Tags')->options(EvaluateGroup::list('group','group'));
        return View::make(config('front.template').'user_profile_edit',compact('edit','avatar_path'));
    }

    /**
     * 获得头像列表数组
     * @return mixed
     */
    protected function avatars(){
        $path = public_path('assets/avatars');
        $options = Cache::rememberForever('avatars.files',function() use($path){
            $_options = [];
            $files =  File::allFiles($path);
            foreach($files as $k=>$file){
                $_options[$file->getFileName()] ='avatar-'.$k;
            }
            return $_options;
        });
        return $options;
    }

    /**
     * user.domain.links
     * @return mixed
     */
    public function domain_links(){
        $this->pageInit();
        $user = Auth::user();
        $filter = DataFilter::source(EvaluateLink::with('evaluate')->user($user->id));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('user.domain.link.edit'));
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('label','Label');
        $grid->add('link','Link');
        $grid->add('refer','Refer')->cell(function($value){ return EvaluateLink::refers($value); });
        $grid->add('evaluate.domain','Website');
        $grid->add('enable','Enable')->cell(function($value){ return $value?'yes':'no'; });
        $grid->edit(route('user.domain.link.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('front.template').'user_domain_links',compact('filter','grid'));

    }
    /**
     * user.domain.link.edit
     * 编辑自有域名的links
     */
    public function edit_links(){
        $this->pageInit();
        $user = Auth::user();
        $id = (Input::get('modify'))?:Input::get('delete');
        $id = (Input::has('update'))?Input::get('update'):$id;
        $evaluateLink =  EvaluateLink::find($id);
        if(!$evaluateLink)$evaluateLink=new EvaluateLink();
        if (Input::get('destroy'))return abort(404);
        if($user->has_domain){
            $returnUrl = route('user.domain.links');
            $edit = DataEdit::source($evaluateLink);
            $edit->label('Edit Website Links:');
            $edit->link($returnUrl,"My Website Links", "TR")->back();
            $edit->action(route('user.domain.link.edit'));
            $edit->add('label','Label', 'text');
            $edit->add('link','Link', 'text')->rule('url|required|min:10|max:100');
            $edit->add('refer','Refer', 'select')->options(EvaluateLink::refers('all'));
            $edit->add('evaluate_id','Website', 'select')->options(EvaluateUser::with('evaluate')->userPassEvaluate($user->id)->lists('domain as title','evaluate_id as value'));
            $edit->set('user_id',$user->id);
            $edit->saved(function () use ($edit,$returnUrl) {
                $edit->message("You link saved");
                $edit->link($returnUrl,"back to the link lists");
            });
            //   $edit->add('tag','Tags', 'Tags')->options(EvaluateGroup::list('group','group'));
            return View::make(config('front.template').'user_domain_link_edit',compact('edit'));
        }
    }


    /**
     * user.cashback.orders
     * 列表可返现的订单号和评论标题
     * 设置成已返现。。
     *
     */
    public function cashback_orders(){
        $this->pageInit();
        $user = Auth::user();
        $filter = DataFilter::source(Review::with('evaluate')->usersCashBackOrders($user->id));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('UsersCashBackOrdersSearch');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('cash_back_order_number','Order Number');
      //  $grid->add('title','Title');
        $grid->add('rating','Rating');
        $grid->add('evaluate.domain','Website');
        $grid->add('cash_back_in','Enable')->cell(function($value){ return ($value>0)?'yes':'no'; });
        $grid->add('cash_back_result','Result',true)->cell(function($value){ return $value?'Processed':'...'; });
        $grid->edit(route('user.cashback.order.edit'), 'Processing','modify')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('front.template').'user_cashback_orders',compact('filter','grid'));
    }

    /**
     * user.cashback.my.orders
     * @return mixed
     */
    public function user_cashback_orders(){
        $this->pageInit();
        $user = Auth::user();
        $filter = DataFilter::source(Review::with('evaluate')->usersCashBackMyOrders($user->id));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('UsersCashBackOrdersSearch');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('cash_back_order_number','Order Number');
     //   $grid->add('title','Title');
        $grid->add('rating','Rating');
        $grid->add('evaluate.domain','Website');
        $grid->add('cash_back_in','Enable')->cell(function($value){ return $value?'yes':'no'; });
        $grid->add('cash_back_result','Result',true)->cell(function($value){ return ($value==2)?'Processed':'Processing'; });
        $grid->edit(route('user.cashback.my.order.edit'), 'Confirm','modify')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('front.template').'user_cashback_orders',compact('filter','grid'));
    }

    /**
     * user.cashback.order.edit
     * 设置成已返现的状态
     */
    public function set_cashback(){
        $id = (Input::get('modify'))?:0;
        Review::where('id',$id)->where('cash_back_result',0)->update(['cash_back_result'=>1]);
        return back();
    }

    public function set_my_cashback(){
        $id = (Input::get('modify'))?:0;
        Review::where('id',$id)->whereIn('cash_back_result',[0,1])->update(['cash_back_result'=>2]);
        return back();
    }
}