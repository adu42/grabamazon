<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/21
 * Time: 10:41
 */

namespace App\Ado\Controllers\Admin;


use App\Ado\Controllers\Admin\BaseController;
use App\Ado\Models\Tables\Evaluate\Evaluate;
use App\Ado\Models\Tables\Evaluate\Coupon;

use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use Auth;
use View;
use Input;
use Request;
use File;
use Currency;

class CouponController extends BaseController
{
    /**
     * 优惠券 列表
     * @return mixed
     */
    public function index(){
        $filter = DataFilter::source(Coupon::with('evaluate'));
        $filter->prepareForm();
        $filter->add('keyword','Keyword','text')->scope('Search');
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"]);
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('coupon','Coupon');
        $grid->add('evaluate.domain','Domain');
        $grid->add('expire','Expire',true)->cell(function($value){return date('Y-m-d',strtotime($value));});
        $grid->add('enable','Enable',true)->cell(function($value){return $value?'yes':'no';});
        $grid->edit(route('admin.coupon.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'coupon_list', compact('filter', 'grid'));
    }


    /**
     * //编辑页
     * @param null $id
     * @return string
     */
    public function edit($id=null){
        $group = Coupon::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.coupon');
        $group->user_id = Auth::user()->id;
        $edit = DataEdit::source($group);
        $edit->label('Edit Coupon');
        $edit->link($returnUrl,"Coupons", "TR")->back();
        $edit->action(route('admin.coupon.edit'));
        $edit->add('coupon','Coupon', 'text')->rule('required|min:3');
        $edit->add('begin','Begin', 'date')->format('Y-m-d', 'en');
        $edit->add('expire','Expire', 'date')->format('Y-m-d', 'en');
        $edit->add('discount','Discount', 'text')->rule('Numeric');
        $edit->add('currency','Currency', 'select')->options(Currency::getCurrencies('options'));
        $edit->add('site','Site Url', 'text')->rule('required|min:3|url');
        $edit->add('link_discount','Is Link Discount', 'checkbox');
        $edit->add('enable','Enable', 'checkbox');
        return $edit->view(config('adminhtml.template').'coupon_edit', compact('edit'));
    }







}