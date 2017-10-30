<?php


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'AmazonController@index');


$this->get('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['namespace'=>Config('adminhtml.namespace'),'prefix' => Config('adminhtml.url'),'middleware'=>['admin']],function(){
    Route::get('amazon/rules',[ 'as'=>'admin.amazon.rules','uses'=>'AmazonHtmlRulesController@index']);
    Route::any('amazon/rule/edit',[ 'as'=>'admin.amazon.rule.edit','uses'=>'AmazonHtmlRulesController@edit']);
    Route::get('amazon/categories',[ 'as'=>'admin.amazon.categires','uses'=>'AmazonHtmlRulesController@categories']);
    Route::any('amazon/catalog/edit',[ 'as'=>'admin.amazon.catalog.edit','uses'=>'AmazonHtmlRulesController@editCatelog']);
    Route::get('amazon/blacks',[ 'as'=>'admin.amazon.blacks','uses'=>'AmazonHtmlRulesController@black']);
    Route::any('amazon/black/edit',[ 'as'=>'admin.amazon.black.edit','uses'=>'AmazonHtmlRulesController@editBlack']);
    Route::get('amazon/grab',[ 'as'=>'admin.amazon.grab','uses'=>'AmazonHtmlRulesController@grab']);
    Route::get('amazon/grabnew',[ 'as'=>'admin.amazon.grab.new','uses'=>'AmazonHtmlRulesController@grab']);
    Route::get('amazon/count',[ 'as'=>'admin.amazon.count','uses'=>'AmazonHtmlRulesController@getCatalogCount']);
    Route::get('amazon/count_new',[ 'as'=>'admin.amazon.count.new','uses'=>'AmazonHtmlRulesController@getCatalogCount']);

    Route::get('amazon/products/rank2',[ 'as'=>'admin.amazon.products.rank2','uses'=>'AmazonHtmlRulesController@ranksfilter']);
    Route::get('amazon/products/rank',[ 'as'=>'admin.amazon.products.rank','uses'=>'AmazonHtmlRulesController@ranks']);
    Route::get('amazon/focustags',[ 'as'=>'admin.amazon.focustags','uses'=>'AmazonHtmlRulesController@focusTags']);
    Route::any('amazon/focustag/edit',[ 'as'=>'admin.amazon.focustag.edit','uses'=>'AmazonHtmlRulesController@focusTagEdit']);
    Route::any('amazon/focustag/process',[ 'as'=>'admin.amazon.focustag.process','uses'=>'AmazonHtmlRulesController@focusProcess']);

    Route::get('amazon/products/lists', ['as' => 'admin.amazon.products.lists', 'uses' => 'AmazonHtmlRulesController@OKProductUrls']);
    Route::any('amazon/products/edit', ['as' => 'admin.amazon.products.edit', 'uses' => 'AmazonHtmlRulesController@addOKProductUrl']);

    Route::get('amazon/product/options', ['as' => 'admin.amazon.product.options', 'uses' => 'AmazonHtmlRulesController@options']);
    Route::any('amazon/product/option/edit', ['as' => 'admin.amazon.product.option.edit', 'uses' => 'AmazonHtmlRulesController@optionEdit']);
    Route::any('amazon/product/option/value/edit', ['as' => 'admin.amazon.product.option.value.edit', 'uses' => 'AmazonHtmlRulesController@optionValueEdit']);

    //Route::get('users/roles','usersController@roles');
    Route::get('users/roles',[ 'as'=>'admin.users.roles','uses'=>'usersController@roles']);
    Route::any('users/role',[ 'as'=>'admin.users.role','uses'=>'usersController@role']);
    Route::any('users/userrole',[ 'as'=>'admin.users.userrole','uses'=>'usersController@userrole']);

    Route::get('/rules',['as'=>'rules','uses'=> 'AmazonHtmlRulesController@index']);
    Route::any('/rules/edit', ['as'=>'rules.edit','uses'=> 'AmazonHtmlRulesController@edit']);
    //Route::resource('article','articlesController');
    Route::any('menus/{id}/edit','menusController@edit');
    Route::any('menus/edit',[ 'as'=>'admin.menus.edit','uses'=>'menusController@edit']);
    Route::any('menus/sort',[ 'as'=>'admin.menus.sort','uses'=>'menusController@sort']);
    Route::any('menus',[ 'as'=>'admin.menus','uses'=>'menusController@index']);
    Route::any('menus/index',[ 'as'=>'admin.menus.index','uses'=>'menusController@index']);
    //Route::any('users/{id}/edit','usersController@edit');

    Route::any('catalog/edit',[ 'as'=>'admin.catalog.edit','uses'=>'categoriesController@edit']);
    Route::any('catalog/sort',[ 'as'=>'admin.catalog.sort','uses'=>'categoriesController@sort']);
    Route::any('catalog/index',[ 'as'=>'admin.catalog.index','uses'=>'categoriesController@index']);
    Route::any('catalog',[ 'as'=>'admin.catalog','uses'=>'categoriesController@index']);
    Route::any('article/{id}/edit','articlesController@edit');
    Route::any('article/edit',['as'=>'admin.article.edit','uses'=>'articlesController@edit']);
    Route::any('article/edit?modify={id}','articlesController@edit');
    Route::any('article','articlesController@index');
    Route::any('article/index',['as'=>'admin.article.index','uses'=>'articlesController@index']);
    //   Route::post('article/postimage',['as'=>'admin.article.post.image','uses'=>'articlesController@postimage']);
    //Route::any('permissions/{id}/edit','permissionsController@edit');
    Route::any('permissions',['as'=>'admin.permissions','uses'=>'permissionsController@index']);
    Route::any('permissions/edit',['as'=>'admin.permission.edit','uses'=>'permissionsController@edit']);
    Route::any('permissions/store',['as'=>'admin.permissions.store','uses'=>'permissionsController@store']);

    Route::any('groups',['as'=>'admin.groups','uses'=>'groupsController@index']);
    Route::any('groups',['as'=>'admin.groups.index','uses'=>'groupsController@index']);
    Route::any('groups/edit',['as'=>'admin.groups.edit','uses'=>'groupsController@edit']);


    Route::get('setting',['as'=>'admin.setting','uses'=>'adminController@setting']);
    Route::any('setting/edit',['as'=>'admin.setting.edit','uses'=>'adminController@editSetting']);
    // Route::post('setting/edit',['as'=>'admin.setting.edit','uses'=>'adminController@editSetting']);
    Route::post('setting/save',['as'=>'admin.setting.save','uses'=>'adminController@saveSetting']);

    Route::any('page',['as'=>'admin.page','uses'=>'PageController@page']);
    Route::any('page/edit',['as'=>'admin.page.edit','uses'=>'PageController@editPage']);

    Route::any('block',['as'=>'admin.block','uses'=>'PageController@block']);
    Route::any('block/edit',['as'=>'admin.block.edit','uses'=>'PageController@editBlock']);
    Route::any('user/edit',['as'=>'admin.user.edit','uses'=>'usersController@edit']);

    Route::any('users',['as'=>'admin.users.index','uses'=>'usersController@index']);
    Route::resource('/','adminController');



/*

    //Route::any('groups/{id}/edit','groupsController@edit');

Route::any('domain',['as'=>'admin.domain','uses'=>'reviewController@index']);
    Route::any('domain/add',['as'=>'admin.domain.add','uses'=>'reviewController@add']);
    Route::any('review',['as'=>'admin.review','uses'=>'reviewController@listReviews']);
    Route::any('review/add',['as'=>'admin.review.add','uses'=>'reviewController@add']);
    Route::any('review/type',['as'=>'admin.review.type','uses'=>'reviewController@editEvaluateGroup']);
    Route::any('review/types',['as'=>'admin.review.types','uses'=>'reviewController@listEvaluateGroup']);

    Route::any('review/list',['as'=>'admin.review.list','uses'=>'reviewController@listReviews']);
    Route::get('review/pass',['as'=>'admin.review.pass','uses'=>'reviewController@reviewPass']);
    Route::get('review/delete',['as'=>'admin.review.delete','uses'=>'reviewController@delete']);
    Route::get('review/del/{id}',['as'=>'admin.review.del','uses'=>'reviewController@reviewDelete']);
    Route::get('review/apply/{id}',['as'=>'admin.review.apply','uses'=>'reviewController@reviewApply']);
    Route::get('review/trash/{id}',['as'=>'admin.review.trash','uses'=>'reviewController@reviewTrash']);
    Route::get('review/clear/trash',['as'=>'admin.review.trash.clear','uses'=>'reviewController@reviewTrashClear']);

    Route::any('review/explain',['as'=>'admin.review.explain','uses'=>'reviewController@explains']);
    Route::any('review/question',['as'=>'admin.review.question','uses'=>'reviewController@questions']);
    Route::any('review/answer',['as'=>'admin.review.answer','uses'=>'reviewController@answers']);

    Route::any('coupon',['as'=>'admin.coupon','uses'=>'CouponController@index']);
    Route::any('coupon/edit',['as'=>'admin.coupon.edit','uses'=>'CouponController@edit']);

 Route::any('contact',['as'=>'admin.contact','uses'=>'PageController@contacts']);
    Route::any('contact/edit',['as'=>'admin.contact.edit','uses'=>'PageController@editContact']);


    Route::any('grab/keywords',['as'=>'admin.grab.keywords','uses'=>'GrabEvaluateController@keywords']);
    Route::any('grab/keyword/edit',['as'=>'admin.grab.keyword.edit','uses'=>'GrabEvaluateController@edit_keyword']);

    Route::any('grab/domain/enable',['as'=>'admin.grab.domain.enable','uses'=>'GrabEvaluateController@enable_domain']);

    Route::any('grab/reviews',['as'=>'admin.grab.reviews','uses'=>'GrabEvaluateController@reviews']);
    Route::any('grab/review/edit',['as'=>'admin.grab.review.edit','uses'=>'GrabEvaluateController@edit_review']);
    // Route::any('grab/review/enable',['as'=>'admin.grab.review.enable','uses'=>'GrabEvaluateController@enable_review']);
    Route::any('grab/domains',['as'=>'admin.grab.domains','uses'=>'GrabEvaluateController@domains']);
    Route::any('grab/domain/edit',['as'=>'admin.grab.domain.edit','uses'=>'GrabEvaluateController@edit_domain']);
    Route::any('grab/google',['as'=>'admin.grab.google','uses'=>'GrabEvaluateController@grabGoogle']);

    Route::any('group/tips',['as'=>'admin.evaluate.tips','uses'=>'EvaluateController@tips']);
    Route::any('group/tips/edit',['as'=>'admin.evaluate.tips.edit','uses'=>'EvaluateController@edit_tips']);
    Route::any('domain/tip/edit',['as'=>'admin.evaluate.tip.edit','uses'=>'EvaluateController@evaluate_tips']);
    Route::get('domain/links',['as'=>'admin.domain.links','uses'=>'EvaluateController@domain_links']);
    Route::any('domain/link/edit',['as'=>'admin.domain.link.edit','uses'=>'EvaluateController@edit_links']);
    Route::any('domain/import',['as'=>'admin.domain.import','uses'=>'EvaluateController@import_csv']);
*/
    //  Route::any('users',['as'=>'admin.users.index','uses'=>'usersController@index']);

    //  Route::resource('users','usersController');
    // Route::resource('groups','groupsController');
    //  Route::resource('permissions','permissionsController');
    //  Route::resource('catalog','categoriesController');

});
Route::group(['namespace'=>Config('adminhtml.common_namespace'),'prefix' =>'/'],function(){
    Route::any('upload','uploadController@post');
    Route::get('upload/files','uploadController@files');
});


Route::group(['namespace'=>Config('front.namespace'),'prefix' =>'/','middleware'=>['web']],function() {
    Route::any('home', ['as'=>'home','uses'=>'articlesController@index']);
    Route::post('/','articlesController@index');
    Route::get('/{uri}','articlesController@index');
    Route::post('/{uri}','articlesController@index');
});



Route::group(['namespace'=>Config('front.namespace'),'prefix' =>'/','middleware'=>['customer']],function() {

    //   Route::get('post','articlesController@index');
    Route::get('post',['as'=>'article.post','uses'=>'articlesController@index']);
    Route::any('post/{uri}',['as'=>'article.show','uses'=>'articlesController@index']);
    Route::get('author/{id}',['as'=>'article.author','uses'=>'articlesController@author']);
  //  Route::get('goto/{link}',['as'=>'front.goto','uses'=>'reviewController@jump_to']);

    Route::get('user/profile',['as'=>'user.profile','uses'=>'UserController@profile']);
    Route::any('user/edit',['as'=>'user.profile.edit','uses'=>'UserController@edit_user']);
    Route::post('comment',['as'=>'comment.save','uses'=>'articlesController@comment_save']);
    Route::get('post/add',['as'=>'article.write','uses'=>'articlesController@add']);
    Route::post('post/add',['as'=>'article.save','uses'=>'articlesController@add']);



});

/*
//dataform routing
Burp::post(null, 'process=1', array('as'=>'save', function() {
    BurpEvent::queue('dataform.save');
}));

//datagrid routing
Burp::get(null, 'page/(\d+)', array('as'=>'page', function($page) {
    BurpEvent::queue('dataset.page', array($page));
}));
Burp::get(null, 'ord=(-?)(\w+)', array('as'=>'orderby', function($direction, $field) {
    $direction = ($direction == '-') ? "DESC" : "ASC";
    BurpEvent::queue('dataset.sort', array($direction, $field));
}))->remove('page');

//todo: dataedit


if (version_compare(app()->version(), '5.2')>0)
{
    Route::group(['middleware' => 'web'], function () {
        Route::get('rapyd-ajax/{hash}', array('as' => 'rapyd.remote', 'uses' => '\Zofe\Rapyd\Controllers\AjaxController@getRemote'));
        //Route::controller('rapyd-demo', '\Zofe\Rapyd\Demo\DemoController');

    });
} else {
    Route::get('rapyd-ajax/{hash}', array('as' => 'rapyd.remote', 'uses' => '\Zofe\Rapyd\Controllers\AjaxController@getRemote'));
    //Route::controller('rapyd-demo', '\Zofe\Rapyd\Demo\DemoController');
}
*/