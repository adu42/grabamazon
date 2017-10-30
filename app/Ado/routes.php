<?php
/**
 * 默认controller方法带着missingMethod定义，如果在前面定义了，很有可能先执行到，所有应该放到最后定义。
 */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


Route::get('/qq','Auth\OauthController@qq_login');
Route::any('/qq/callback','Auth\OauthController@qq_callback');
Route::resource('test','Front\testController');
Route::any('auth/logout',['as'=>'user.logout','uses'=>'Auth\AuthController@logout']);
Route::any('auth/login',['as'=>'user.login','uses'=>'Auth\AuthController@login']);


Route::group(['namespace'=>Config('adminhtml.namespace'),'prefix' => Config('adminhtml.url'),'middleware'=>['admin']],function(){
    //Route::get('users/roles','usersController@roles');
    Route::get('users/roles',[ 'as'=>'admin.users.roles','uses'=>'usersController@roles']);
    Route::any('users/role',[ 'as'=>'admin.users.role','uses'=>'usersController@role']);
    Route::any('users/userrole',[ 'as'=>'admin.users.userrole','uses'=>'usersController@userrole']);


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
    //Route::any('groups/{id}/edit','groupsController@edit');
    Route::get('setting',['as'=>'admin.setting','uses'=>'adminController@setting']);
    Route::any('setting/edit',['as'=>'admin.setting.edit','uses'=>'adminController@editSetting']);
   // Route::post('setting/edit',['as'=>'admin.setting.edit','uses'=>'adminController@editSetting']);
    Route::post('setting/save',['as'=>'admin.setting.save','uses'=>'adminController@saveSetting']);
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

    Route::any('page',['as'=>'admin.page','uses'=>'PageController@page']);
    Route::any('page/edit',['as'=>'admin.page.edit','uses'=>'PageController@editPage']);

    Route::any('block',['as'=>'admin.block','uses'=>'PageController@block']);
    Route::any('block/edit',['as'=>'admin.block.edit','uses'=>'PageController@editBlock']);

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

  //  Route::any('users',['as'=>'admin.users.index','uses'=>'usersController@index']);
    Route::any('user/edit',['as'=>'admin.user.edit','uses'=>'usersController@edit']);

    Route::any('users',['as'=>'admin.users.index','uses'=>'usersController@index']);

  //  Route::resource('users','usersController');
   // Route::resource('groups','groupsController');
  //  Route::resource('permissions','permissionsController');
  //  Route::resource('catalog','categoriesController');
    Route::resource('/','adminController');
});
Route::group(['namespace'=>Config('adminhtml.common_namespace'),'prefix' =>'/'],function(){
    Route::any('upload','uploadController@post');
    Route::get('upload/files','uploadController@files');
});

Route::group(['namespace'=>Config('front.namespace'),'prefix' =>'/','middleware'=>['web']],function() {
    Route::any('review', 'reviewController@write');
    Route::any('write/{domain}',['as'=>'review.add','uses'=>'reviewController@write']);
    Route::any('write',['as'=>'review.new','uses'=>'reviewController@write']);
    Route::post('comment',['as'=>'comment.save','uses'=>'articlesController@comment_save']);
    Route::get('post/add',['as'=>'article.write','uses'=>'articlesController@add']);
    Route::post('post/add',['as'=>'article.save','uses'=>'articlesController@add']);
    Route::get('user/profile',['as'=>'user.profile','uses'=>'UserController@profile']);
    Route::any('user/edit',['as'=>'user.profile.edit','uses'=>'UserController@edit_user']);
    Route::get('user/domains',['as'=>'user.domain','uses'=>'UserController@domain']);
    Route::get('user/domain/verify',['as'=>'user.domain.verify','uses'=>'UserController@verify_domain']);
    Route::get('user/domain/verify/file',['as'=>'user.domain.verify.file','uses'=>'UserController@sendVerificationCodeHtml']);
    Route::get('user/domain/check',['as'=>'user.domain.check','uses'=>'UserController@verify_domain_check']);
    Route::any('user/domain/edit',['as'=>'user.domain.edit','uses'=>'UserController@edit_domain']);
    Route::get('user/coupons',['as'=>'user.coupon','uses'=>'UserController@coupon']);
    Route::any('user/coupon/edit',['as'=>'user.coupon.edit','uses'=>'UserController@edit_coupon']);
    Route::get('user/reviews',['as'=>'user.review','uses'=>'UserController@review']);
    Route::any('user/review/edit',['as'=>'user.review.edit','uses'=>'UserController@edit_review']);
    Route::get('user/questions',['as'=>'user.question','uses'=>'UserController@question']);
    Route::any('user/answer',['as'=>'user.answer','uses'=>'UserController@answer']);
    Route::get('user/domain/links',['as'=>'user.domain.links','uses'=>'UserController@domain_links']);
    Route::any('user/domain/link/edit',['as'=>'user.domain.link.edit','uses'=>'UserController@edit_links']);
    Route::any('user/cashback/orders',['as'=>'user.cashback.orders','uses'=>'UserController@cashback_orders']);
    Route::get('user/cashback/order/edit',['as'=>'user.cashback.order.edit','uses'=>'UserController@set_cashback']);
    Route::any('cashback/my/orders',['as'=>'user.cashback.my.orders','uses'=>'UserController@user_cashback_orders']);
    Route::get('cashback/my/order/edit',['as'=>'user.cashback.my.order.edit','uses'=>'UserController@set_my_cashback']);
});



Route::group(['namespace'=>Config('front.namespace'),'prefix' =>'/','middleware'=>['normal']],function() {
    Route::any('appraise/{site}', ['as'=>'review.edit','uses'=>'reviewController@write']);
    Route::any('reviews/{domain}',['as'=>'review.domain','uses'=>'reviewController@detail']);
    Route::any('reviews/{domain}/{id}',['as'=>'review.domain.id','uses'=>'reviewController@detail']);
    Route::any('reviews/{domain}/{sort}/{dir}',['as'=>'review.domain.sort.dir','uses'=>'reviewController@detail']);
    Route::any('summary/{domain}',['as'=>'review.summary','uses'=>'reviewController@summary']);
    Route::any('coupon', 'CouponController@index');
    Route::any('coupon', ['as'=>'coupon','uses'=>'CouponController@index']);
    Route::any('coupon/{coupon}', ['as'=>'coupon.search','uses'=>'CouponController@index']);
    Route::any('coupon/add',['as'=>'coupon.add','uses'=>'CouponController@add']);
    Route::any('best', 'reviewController@best');
    Route::any('best/{uri}', 'reviewController@best');
    Route::any('result/{keyword}',['as'=>'review.search','uses'=>'reviewController@result']);
    //== 这部分有ajax的url拼装定义，不能改uri参数 起始==//
    Route::any('report',['as'=>'report','uses'=> 'reviewController@report']);
    Route::any('home', ['as'=>'home','uses'=>'reviewController@home']);
    Route::any('report/{review_id}', ['as'=>'report.review','uses'=>'reviewController@report']);
    Route::any('report/{answer_id}/{act}', ['as'=>'report.review.act','uses'=>'reviewController@report_answer']);
    Route::any('helpful/{review_id}', ['as'=>'helpful.review','uses'=>'reviewController@helpful']);
    Route::any('helpful/{answer_id}/{up}', ['as'=>'helpful.answer.up','uses'=>'reviewController@helpful_answer']);
    Route::any('questions/{site}', ['as'=>'questions','uses'=>'reviewController@questions']);
    Route::any('save-answer', ['as'=>'answer.save','uses'=>'reviewController@saveAnswer']);
    Route::any('ask/{evaluate_id}',['as'=>'question.ask','uses'=> 'reviewController@questionWrite']);
    //=== 这部分有ajax的url拼装定义，不能改uri参数 结束== //
    //   Route::get('post','articlesController@index');
    Route::get('post',['as'=>'article.post','uses'=>'articlesController@index']);
    Route::any('post/{uri}',['as'=>'article.show','uses'=>'articlesController@index']);
    Route::get('author/{id}',['as'=>'article.author','uses'=>'articlesController@author']);
    Route::get('assess/{domain}',['as'=>'assess.domain','uses'=>'reviewController@assess']);
    Route::get('goto/{link}',['as'=>'front.goto','uses'=>'reviewController@jump_to']);
    Route::any('contact-us',['as'=>'cms.contact','uses'=>'PageController@Contact']);
    Route::get('/sitemap.xml','reviewController@siteMap');


    Route::any('talk',['as'=>'talk','uses'=>'TalkController@index']);
    Route::any('share/{share}',['as'=>'share','uses'=>'TalkController@edit']);
    Route::post('share/save',['as'=>'share.save','uses'=>'TalkController@save']);


    //外部使用的，固定命名，不可改
    Route::any('/share','TalkController@share');
    Route::any('/talks',['as'=>'talk.list','uses'=>'TalkController@talk_list']);
    Route::any('/talkshow/{id}',['as'=>'talk.show','uses'=>'TalkController@show']);


    Route::get('/','reviewController@home');
    Route::post('/','articlesController@index');
    Route::get('/{uri}','articlesController@index');
    Route::post('/{uri}','articlesController@index');



});
/**
 * 不能使用别名，否则找不到控制器。
 */
    Route::any('oauth/{provider}','Auth\OauthController@redirect');
    Route::any('oauth/{provider}/callback', 'Auth\OauthController@callback');
    Route::any('gg','Auth\OauthController@gg');

/*
Route::get('/', '\App\Http\Controllers\WelcomeController@index');
Route::get('/home', '\App\Http\Controllers\HomeController@index');
Route::get('home', '\App\Http\Controllers\HomeController@index');
Route::get('/manage', 'Core\AdminMenuController@index');
//todo: dataedit



*/
//Route::get('/test', 'testController@index');
//Route::any('/test/edit', 'testController@edit');

//Route::resource('test','testController');
/*
Burp::get(null, 'modify=(\w+)', array('as'=>'key', function($key) {
    //check api key in query string..

}));

//Route::controller('test','\App\Ado\Controllers\testController');
Route::resource('test','\App\Ado\Controllers\testController');
Route::any('/test/put', '\App\Ado\Controllers\testController@put');

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

Route::get('rapyd-ajax/{hash}', array('as' => 'rapyd.remote', 'uses' => '\Zofe\Rapyd\Controllers\AjaxController@getRemote'));
//Route::controller('test','\App\Ado\Controllers\testController');

*/

