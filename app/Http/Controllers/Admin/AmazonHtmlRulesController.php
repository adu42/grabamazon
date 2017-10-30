<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Amazons\AmazonProduct;
use Request;
use DataFilter;
use DataGrid;
use App\Models\Amazons\AmazonHtmlRules;
use View;
use Input;
use DataEdit;
use Redirect;
use App\Models\Amazons\AmazonCategory;
use App\Models\Amazons\AmazonBadWords;
use App\Models\Amazons\AmazonOkCategory;
use App\Models\Amazons\AmazonGrab;
use App\Ado\Libraries\Captcha2Text;
use App\Models\Amazons\AmazonProducts;
use App\Models\Amazons\AmazonProductRank;
use App\Models\Amazons\AmazonFocusTag;
use App\Models\Amazons\AmazonOkProduct;
use App\Models\Amazons\AmazonOkProductOption;
use App\Models\Amazons\AmazonOkProductOptionValue;

class AmazonHtmlRulesController extends AdminBaseController
{

    public function Grab(AmazonGrab $amazonGrab){

       // $amazonGrab->grabCatalogProductLinks();
       // $amazonGrab->processProductPage(null);
        //$amazonGrab->grabCatalogProductLinks();  //抓取产品链接
      //  $amazonGrab->grabCategories();  //抓分类页
        // $amazonGrab->grabFirstPage();//抓首页
      //$amazonGrab->grabProducts(); //抓商品页
        $amazonGrab->testProduct([24213,24214,24215]);
      //  $routes = [route('admin.amazon.grab'),route('admin.amazon.grab.new')];
      //  $route = $routes[mt_rand(0, count($routes) - 1)];
      //  return redirect()->to($route);// 'end';
        return 'end';
    }


    public function getCatalogCount(AmazonGrab $amazonGrab){
        $routes = [route('admin.amazon.count'),route('admin.amazon.count.new')];
        return $amazonGrab->count();
       // ob_end_flush();
       // sleep(10);
       // $route = $routes[mt_rand(0, count($routes) - 1)];
       // return redirect()->to($route);
    }

    /**
     * @return rules
     */
    public function index(){
        $filter = DataFilter::source(new AmazonHtmlRules());
        $filter->prepareForm();
        $filter->add('title', 'Search', 'text')->scope('Search')->scope('Type');
        $filter->add('kind', 'Search', 'select')->options(AmazonHtmlRules::getTypes());
        $filter->newLink(route('admin.amazon.rule.edit'));
       // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"])->scope('CreateAt');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('label','Label');
        $grid->add('rule_name','Rule Name');
        $grid->add('rule_string','Flag');
        $grid->add('kind','Type', true)->cell(function($value){return ($value)?AmazonHtmlRules::getTypes($value):'';});
        $grid->edit(route('admin.amazon.rule.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }
    /**
     * return rule edit
     */
    public function edit($id=null){
        $id = (Request::get('modify'))?:Request::get('delete');
        $amazonHtmlRules = AmazonHtmlRules::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('admin.amazon.rules');
        $edit = DataEdit::source($amazonHtmlRules);
        $edit->label('Edit Rule');
        $edit->link($returnUrl,"Filter Rule", "TR")->back();
        $edit->action(route('admin.amazon.rule.edit'));
        $edit->add('label','规则名称', 'text')->rule('required|min:3');
        $edit->add('rule_name','规则', 'select')->options(AmazonHtmlRules::getRuleNames())->setDefaultValue($amazonHtmlRules->kind.'.'.$amazonHtmlRules->rule_name);
        $edit->add('kind','Type', 'hidden');//->options(AmazonHtmlRules::getTypes());
        $edit->add('rule_string','字符标识', 'text');
        $edit->add('rule_regular','提取规则', 'text');
        $edit->add('rule_is_regular','是否正则', 'checkbox');
        $edit->add('query_selector_1','Css查询一', 'text');
        $edit->add('query_selector_2','Css查询二', 'text');
        $edit->add('query_selector_3','Css查询三', 'text');
        $edit->add('query_selector_4','Css查询四', 'text');
        $edit->add('query_selector_5','Css查询五', 'text')->extra('多条规则是分开的或的关系<br>单条规则里的多条query_selector是且的关系');
        return $edit->view(config('adminhtml.template').'common_edit', compact('edit'));
    }

    /**
     * 分类筛选
     */
    public function categories(){

        $filter = DataFilter::source(new AmazonCategory());
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->add('is_active','Enable','checkbox')->scope('Active');
        $filter->newLink(route('admin.amazon.catalog.edit'));
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"])->scope('CreateAt');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('name','Name')->cell(function ($value){ return '<a href="'.route('admin.amazon.catalog.edit',['bad'=>$value]).'" title="Remove To Disable." target="_self">'.$value.'</a>'; });
        $grid->add('url','Url')->cell(function($value){ return '<div style="text-overflow: ellipsis; white-space: nowrap;width: 500px;overflow: hidden;"><a href="'.$value.'" title="'.$value.'"  target="_self">'.$value.'</a></div>'; });
        //$grid->add('kind','Type', true)->cell(function($value){return ($value)?AmazonHtmlRules::getTypes($value):'';});
        $grid->add('is_active','Enable',true)->cell(function ($value){ return $value?'yes':''; });
        $grid->edit(route('admin.amazon.catalog.edit'), 'Edit','show|modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    /**
     * 分类剔除筛选处理
     */
    public function editCatelog($id=null){
        $do = '';
        if(Input::get('bad')){  //删除某些关键词，并加入黑名单
            $word = Input::get('bad');
            if(!empty($word)){
                $word = trim($word);
                $amazonBadWords = new AmazonBadWords();
                $amazonBadWords->firstOrCreate(['word'=>$word]);
            }
            AmazonCategory::where('name',$word)->delete();
            return Redirect::to(route('admin.amazon.categires'));
        }
        if($id =Input::get('show')){ // 设置成is_active|
            $r =   AmazonCategory::find($id);
            if($r->is_active==1){
                $r->is_active=0;
            }else{
                $r->is_active=1;
            }
            $r->save();
            return Redirect::back();
        }
        if($id = Input::get('delete')){
            AmazonCategory::where('id',$id)->delete();
            return Redirect::back();
        }
       // if($id = Input::get('modify')){
            $catalog = AmazonCategory::find($id);
            $returnUrl = route('admin.amazon.catalog.edit');
            $edit = DataEdit::source($catalog);
            $edit->label('Edit Amazon Catalog');
            $edit->link($returnUrl,"Categoris", "TR")->back();
            $edit->action(route('admin.amazon.catalog.edit'));
            $edit->add('name','Name', 'text');
            $edit->add('url','Url', 'textarea')->rule('url|required|min:10|max:2000');
            $edit->add('is_active','Enable', 'checkbox');

            if(isset($msg)){
                $edit->message($msg);
            }
            $edit->saved(function () use ($edit,$returnUrl) {
                $edit->message("Data Saved");
                $edit->link($returnUrl,"back to the lists");
            });
            return View::make(config('adminhtml.template').'common_edit',compact('edit'));
       // }
    }

    /**
     * 词黑名单
     */
    public function black(){
        $filter = DataFilter::source(new AmazonBadWords());
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('admin.amazon.black.edit'));
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"])->scope('CreateAt');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('word','Name');
        $grid->edit(route('admin.amazon.black.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }


    /**
     * 分类剔除词黑名单
     */
    public function editBlack($id=null){
        $do = '';
        if($id = Input::get('delete')){
            AmazonBadWords::where('id',$id)->delete();
            return Redirect::back();
        }
        $id =Input::has('modify')?Input::get('modify'):null;
        $catalog = AmazonBadWords::findOrNew($id);
            $returnUrl = route('admin.amazon.blacks');
            $edit = DataEdit::source($catalog);
            $edit->label('Edit Black Word');
            $edit->link($returnUrl,"Words", "TR")->back();
            $edit->action(route('admin.amazon.black.edit'));
            $edit->add('word','Word', 'text');
            if(isset($msg)){
                $edit->message($msg);
            }
            $edit->saved(function () use ($edit,$returnUrl) {
                $edit->message("Data Saved");
                $edit->link($returnUrl,"back to the lists");
            });
            return View::make(config('adminhtml.template').'common_edit',compact('edit'));
      //  }
    }

    public function ranks(){
        $filter = DataFilter::source(AmazonProductRank::with('product')->with('catalog')->Dlist());
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
       // $filter->newLink(route('admin.amazon.rule.edit'));
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"])->scope('CreateAt');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("max-width:70px");
        $grid->add('asin','ASIN');
        $grid->add('rank','Rank')->style("max-width:50px");
        $grid->add('mbc','跟卖')->style("max-width:50px");
        $grid->add('product.url','Url')->cell(function($value){ return '<div style="text-overflow: ellipsis; white-space: nowrap;max-width: 200px;overflow: hidden;"><a href="'.$value.'" title="'.$value.'"  target="_blank">'.$value.'</a></div>'; });

        for ($i=1;$i<=5;$i++)$grid->add("d{$i}","Diff$i")->cell(function ($value){return $value?$value:'';})->style("max-width:50px");
        $grid->add('catalog.name','Catalog');
        //$grid->edit(route('admin.amazon.rule.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    /**
     * 抓哪些词，焦点词设置
     * @return mixed
     */
    public function focusTags(){
        $filter = DataFilter::source(new AmazonFocusTag());
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->newLink(route('admin.amazon.focustag.edit'));
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"])->scope('CreateAt');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("max-width:70px");
        $grid->add('word','Word')->cell(function ($value,$row){
              return $value.' '.$row->itemsCount;
        });
        $grid->add('is_active','Active')->cell(function($value){ return $value?$value:''; });
        $grid->edit(route('admin.amazon.focustag.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
       // $this->focusProcess();
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    public function focusProcess(){
        echo '<br/>items:'.AmazonProduct::count();
        echo '<br/>active items:'.AmazonProduct::where('is_active','>=',0)->count();
        foreach (AmazonFocusTag::where('is_active',1)->cursor() as $focusTags){
            $focusTags->activeWord($focusTags->word,1);
        }
        echo '<br/>active items:'.AmazonProduct::where('is_active','>=',0)->count();
    }
    /**
     * 抓哪些词，焦点词设置 - 编辑
     * @return mixed
     */
    public function focusTagEdit(){
        $do = '';
        if($id = Input::get('delete')){
            AmazonFocusTag::where('id',$id)->delete();
            return Redirect::back();
        }
        $id =Input::has('modify')?Input::get('modify'):null;
        $catalog = AmazonFocusTag::findOrNew($id);

        $returnUrl = route('admin.amazon.focustags');
        $edit = DataEdit::source($catalog);
        $edit->label('Edit Black Word');
        $edit->link($returnUrl,"Words", "TR")->back();
        $edit->action(route('admin.amazon.focustag.edit'));
        $edit->add('word','Word', 'text');
        $edit->add('is_active','active', 'checkbox');
        if(isset($msg)){
            $edit->message($msg);
        }

        $edit->saved(function () use ($returnUrl) {
        //    $edit->message("Data Saved");
            redirect()->to($returnUrl);
           // $edit->link($returnUrl,"back to the lists");
        });
        return View::make(config('adminhtml.template').'common_edit',compact('edit'));
    }

    /**
     *
     * @return mixed
     */
    public function ranksfilter(){
        $filter = DataFilter::source(AmazonProductRank::with('product')->with('catalog')->mbc()->thousandRank()->dlist(1)->productFocus());
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        // $filter->newLink(route('admin.amazon.rule.edit'));
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"])->scope('CreateAt');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id','ID', true)->style("max-width:70px");
        $grid->add('asin','ASIN');
        $grid->add('rank','Rank')->style("max-width:50px");
        $grid->add('mbc','跟卖')->style("max-width:50px");
        $grid->add('product.url','Url')->cell(function($value){ return '<div style="text-overflow: ellipsis; white-space: nowrap;max-width: 200px;overflow: hidden;"><a href="'.$value.'" title="'.$value.'"  target="_blank">'.$value.'</a></div>'; });

        for ($i=1;$i<=5;$i++)$grid->add("d{$i}","Diff$i")->cell(function ($value){return $value?$value:'';})->style("max-width:50px");
        $grid->add('catalog.name','Catalog');
        //$grid->edit(route('admin.amazon.rule.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template').'common_list', compact('filter', 'grid'));
    }

    /**
     * 添加要抓的商品
     * 抓商品数据做csv
     */
    public function OKProductUrls()
    {
        $filter = DataFilter::source(AmazonOkProduct::SortActiveDesc());
        $filter->prepareForm();
        $filter->add('url', 'Search', 'text')->scope('Search');
        $filter->newLink(route('admin.amazon.products.edit'));
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"])->scope('CreateAt');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id', 'ID', true)->style("max-width:70px");
        $grid->add('url', 'Url')->cell(function ($value) {
            return '<div style="text-overflow: ellipsis; white-space: nowrap;max-width: 200px;overflow: hidden;"><a href="' . $value . '" title="' . $value . '"  target="_blank">' . $value . '</a></div>';
        });
        $grid->add('typecsvname', 'AttributeSet');
        $grid->add('is_active', 'Crawled')->cell(function ($value) {
            return $value ? 'Y' : '';
        });
        $grid->edit(route('admin.amazon.products.edit'), 'Edit', 'modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template') . 'common_list', compact('filter', 'grid'));
    }

    /**
     * 添加要抓的商品
     * 抓商品数据做csv
     */
    public function addOKProductUrl($id = null)
    {
        $do = '';
        if ($id = Input::get('delete')) {
            AmazonOkProduct::where('id', $id)->delete();
            return Redirect::back();
        }
        $id = Input::has('modify') ? Input::get('modify') : null;
        $product = AmazonOkProduct::findOrNew($id);
        $returnUrl = route('admin.amazon.products.lists');
        $edit = DataEdit::source($product);
        $edit->label('Edit Product');
        $edit->link($returnUrl, "Products", "TR")->back();
        $edit->action(route('admin.amazon.products.edit'));
        $edit->add('url', 'Url', 'text');
        $edit->add('typecsvname', 'AttributeSet', 'select')->options($this->getAttributeSet());

        $edit->add('color', 'Color', 'text')->setDefaultValue('');
        $edit->add('color_format', 'Color Field', 'text')->setDefaultValue('');
        $edit->add('size', 'Size', 'text')->setDefaultValue('Size:drop_down:20:1');
        $edit->add('size_format', 'Size Field', 'text')->setDefaultValue('S:fixed:0.00:17||M:fixed:0.00:18||L:fixed:0.00:19||XL:fixed:0.00:20||2XL:fixed:0.00:21');



        if (isset($msg)) {
            $edit->message($msg);
        }
        $returnUrl = route('admin.amazon.products.edit');
        $edit->saved(function () use ($edit, $returnUrl) {
            $edit->message("Data Saved");
            $edit->link($returnUrl, "back to the lists");
        });
        return View::make(config('adminhtml.template') . 'common_edit', compact('edit'));
        //  }
    }


    /**
     * 列表 商品属性
     * @return mixed
     */
    public function options(){
        $filter = DataFilter::source(AmazonOkProductOption::with('values'));
        $filter->prepareForm();
        $filter->add('url', 'Search', 'text')->scope('Search');
        $filter->newLink(route('admin.amazon.product.option.edit'));
        // $filter->add('created_at','','date')->format('Y-m-d', 'en')->attributes(['placeholder'=>date('Y-m-d'),'onclick'=>"SelectDate(this,'yyyy-MM-dd')", 'readonly'=>"true"])->scope('CreateAt');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $grid->add('id', 'ID', true)->style("max-width:70px");
        $grid->add('label', 'Label');
        $grid->add('typecsvname', 'AttributeSet');
        $fields = AmazonOkProductOption::fieldTypes();
        $grid->add('field_type', 'FieldType')->cell(function ($value) use ($fields) {
            return !empty($fields[$value]) ? $fields[$value] : '';
        });
        $grid->add('{{ implode(", ",$values->pluck("label")->all()) }}', 'Values');
        $grid->add('format', 'Field');
        $grid->add('format_value', 'Field Value');
        $grid->edit(route('admin.amazon.product.option.edit'), 'Edit', 'modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make(config('adminhtml.template') . 'common_list', compact('filter', 'grid'));
    }

    public function getAttributeSet(){
        return ['Clothes'=>'Clothes','Tops'=>'Tops','Bottoms'=>'Bottoms','Co-ord Sets'=>'Co-ord Sets','Shoes'=>'Shoes','Accessories'=>'Accessories','Bags'=>'Bags','Sunglasses'=>'Sunglasses','Rings'=>'Rings'];
    }

    protected function getOptionsHeader(){
        return [
            'Color:drop_down:10:1'=>'Show as picture:fixed:0.00:1||Ivory:fixed:0.00:2||Champagne:fixed:0.00:3||Pink:fixed:0.00:4||White:fixed:0.00:5||Brown:fixed:0.00:6||Black:fixed:0.00:7||Blue:fixed:0.00:8||Chocolate:fixed:0.00:9||Burgundy:fixed:0.00:10||Daffodil:fixed:0.00:11||Dark Navy:fixed:0.00:12||Dark Green:fixed:0.00:13||Fuchsia:fixed:0.00:14||Gold:fixed:0.00:15||Grape:fixed:0.00:16||Hunter:fixed:0.00:17||Green:fixed:0.00:18||Lavender:fixed:0.00:19||Watermelon:fixed:0.00:20||Pearl Pink:fixed:0.00:21||Light Sky Blue:fixed:0.00:22||Lilac:fixed:0.00:23||Orange:fixed:0.00:24||Red:fixed:0.00:25||Royal Blue:fixed:0.00:26||Sage:fixed:0.00:27||Silver:fixed:0.00:28||Regency:fixed:0.00:29',
            'Size:drop_down:20:1'=>'US2-AU/UK6-EUR32:fixed:0.00:1||US4-AU/UK8-EUR34:fixed:0.00:2||US6-AU/UK10-EUR36:fixed:0.00:3||US8-AU/UK12-EUR38:fixed:0.00:4||US10-AU/UK14-EUR40:fixed:0.00:5||US12-AU/UK16-EUR42:fixed:0.00:6||US14-AU/UK18-EUR44:fixed:0.00:7||US16-AU/UK20-EUR46:fixed:0.00:8||US14W-AU/UK18-EUR44:fixed:0.00:9||US16W-AU/UK20-EUR46:fixed:0.00:10||US18W-AU/UK22-EUR48:fixed:0.00:11||US20W-AU/UK24-EUR50:fixed:0.00:12||US22W-AU/UK26-EUR52:fixed:0.00:13||US24W-AU/UK28-EUR54:fixed:0.00:14||US26W-AU/UK30-EUR56:fixed:0.00:15||Custom Size:fixed:0.00:16||S:fixed:0.00:17||M:fixed:0.00:18||L:fixed:0.00:19||XL:fixed:0.00:20||2XL:fixed:0.00:21||3XL:fixed:0.00:22',
        ];
    }
    /**
     * 编辑属性-标题
     * @param null $id
     * @return mixed
     */
    public function optionEdit($id = null)
    {
        $do = '';
        if ($id = Input::get('delete')) {
            AmazonOkProductOption::with('values')->where('id', $id)->delete();
            return Redirect::back();
        }
        $id = Input::has('modify') ? Input::get('modify') : null;
        $product = AmazonOkProductOption::with('values')->findOrNew($id);
        $returnUrl = route('admin.amazon.product.options');
        $edit = DataEdit::source($product);
        $edit->label('Edit Option');
        $edit->link($returnUrl, "Options", "TR")->back();
        $edit->action(route('admin.amazon.product.option.edit'));
        $edit->add('label', 'Label', 'text');
        $edit->add('typecsvname', 'AttributeSet', 'select')->options($this->getAttributeSet());
        $fields = AmazonOkProductOption::fieldTypes();
        $edit->add('field_type', 'Field Types', 'select')->options($fields);
        $edit->add('value', 'Default', 'text');
        $edit->add('format', 'Header', 'text')->extra(implode('<br/>',array_keys($this->getOptionsHeader())));
        $edit->add('format_value', 'Options', 'text')->extra(implode('<br/><br/>',$this->getOptionsHeader()));

        if (isset($msg)) {
            $edit->message($msg);
        }
        $returnUrl = route('admin.amazon.product.option.edit');
        $edit->saved(function () use ($edit, $returnUrl) {
            $edit->message("Data Saved");
            $edit->link($returnUrl, "back to the lists");
        });
        return View::make(config('adminhtml.template') . 'common_edit', compact('edit'));
        //  }
    }

    /**
     * 编辑属性-标题
     * @param null $id
     * @return mixed
     */
    public function optionValueEdit($id = null)
    {
        $do = '';
        if ($id = Input::get('delete')) {
            AmazonOkProductOptionValue::where('id', $id)->delete();
            return Redirect::back();
        }
        $id = Input::has('modify') ? Input::get('modify') : null;
        $product = AmazonOkProductOptionValue::findOrNew($id);
        $returnUrl = route('admin.amazon.product.options');
        $edit = DataEdit::source($product);
        $edit->label('Edit Value');
        $edit->link($returnUrl, "Options", "TR")->back();
        $edit->action(route('admin.amazon.product.option.value.edit'));
        $edit->add('label', 'Label', 'text');
        $edit->add('sort_order', 'Sort', 'text');
        $edit->add('is_default', 'Set Is Default', 'checkbox');
        if (isset($msg)) {
            $edit->message($msg);
        }
        $returnUrl = route('admin.amazon.product.option.value.edit');
        $edit->saved(function () use ($edit, $returnUrl) {
            $edit->message("Data Saved");
            $edit->link($returnUrl, "back to the lists");
        });
        return View::make(config('adminhtml.template') . 'common_edit', compact('edit'));
        //  }
    }
}
