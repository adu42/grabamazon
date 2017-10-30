<?php
/**
 * 前端显示优惠券的页面
 * 可搜索
 * 附属信息：
 * 1、对应的网址评分
 * 2、对应的同行业网址推荐
 * 3、优质评价
 * 4、优惠券权限收费机制
 */
namespace App\Ado\Controllers\Front;

use Redirect;
use Request;
use Session;
use View;
use App\Ado\Models\Screen\DomainCheck;
use App\Ado\Models\Tables\Evaluate\Coupon;
use App\Ado\Models\Tables\Evaluate\Review;
use Context;
use Input;


class CouponController extends BaseController
{
    /**
     * Coupon首页
     * @param null $keyword
     * @return mixed
     */
    public function index($keyword=null){
        $this->initDbConfig();
        if(empty($keyword) && Input::has('keyword'))$keyword=Input::get('keyword');
        $today = date('Y-m-d');
        $coupons = Coupon::with('evaluate','user')->where('enable',1)->where('begin','<=',$today)->where('expire','>=',$today);
        if($keyword){
            $coupons = $coupons->where('coupon','like','%'.$keyword.'%');
        }

        $coupons = $coupons->paginate($this->paginate);
        Context::set('coupons',$coupons);

        $this->setTitle(trans('coupon.list_title'));
        $this->setKeywords(trans('coupon.list_keywords'));
        $this->setDescription(trans('coupon.list_description'));

        $this->viewComposerSideReviews($coupons);
        $this->viewComposerInit();
        return View::make(config('front.template').'coupon_list',compact('coupons'));
    }

    /**
     * 侧边二级栏目 reviews
     */
    protected function viewComposerSideReviews($coupons){
        $evaluateIds = array();
        $coupons = Context::get('coupons');
        if($coupons) {
            $coupons->each(function ($coupon) use (&$evaluateIds) {
                if ($coupon->evaluate_id && !in_array($coupon->evaluate_id, $evaluateIds)) {
                    $evaluateIds[] = $coupon->evaluate_id;
                }
            });
        }
        if(!empty($evaluateIds)){
            $reviews = Review::whereIn('evaluate_id',$evaluateIds)->where('enable',1);
        }else{
            $reviews = Review::where('enable',1);
        }
        $reviews = $reviews->orderBy('updated_at','desc')->take(10)->get();
        $this->viewComposer('layouts.composers.coupon_side_reviews',$reviews,'reviews');
    }

    public function add(Coupon $coupon){
        $this->initDbConfig();
        $returnUrl = route('coupon.search',['coupon'=>$coupon->coupon]);
        $edit = DataEdit::source($coupon);
        $edit->label('Edit Coupon:');
        $edit->link($returnUrl,"Coupons", "TR")->back();
        $edit->action(route('coupon.add'));
        $edit->add('coupon','Coupon', 'text')->rule('required|min:5|max:100');
        $edit->add('discount','Discount', 'text')->rule('required|max:50');
        $edit->add('currency','Currency', 'select')->options(Currency::getCurrencies('options'));
        $edit->add('begin','Begin Show', 'datetime')->format('Y-m-d H:i:s');
        $edit->add('expire','Expire', 'datetime')->format('Y-m-d H:i:s');
        $edit->add('site','Use in website', 'text')->rule('required|max:50');
        $this->viewComposerInit();
        return View::make(config('front.template').'coupon_edit',compact('edit'));
    }
}