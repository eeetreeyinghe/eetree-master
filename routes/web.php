<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/explore/doc', 'DocController@index')->name('explore.doc');
Route::get('/explore/project', 'ProjectController@index')->name('explore.project');
Route::get('/category/{category}', 'CategoryController@index')->name('category.list');
Route::get('/doc/detail/{doc}', 'DocController@detail')->name('doc.detail');
Route::get('/doc/mindmap/{doc}', 'DocController@mindmap')->name('doc.mindmap');
Route::get('/doc-publish/preview/{docPublish}', 'DocPublishController@preview')->name('docPublish.preview');
Route::get('/doc/templates', 'DocController@templates')->name('doc.templates');
Route::get('/comments', 'CommentController@index')->name('comment.index');
Route::get('/comments/replys/{comment}', 'CommentController@replyList')->name('comment.replyList');
Route::get('/test', 'DocController@test')->name('doc.test');
Route::get('/user/{user}/{tab?}', 'UserController@home')->where('user', '[0-9]+')->name('user.home');
Route::view('/agreement', 'agreement')->name('page.agreement');
Route::get('/page/digikey-funpack/{phase?}', 'PageController@digikeyFunpack')->name('page.digikeyFunpack');
Route::get('/page/{tpl}', 'PageController@index')->name('page.index');
Route::get('/project-drafts/{projectDraft}/preview', 'ProjectDraftController@preview')->name('projectDraft.preview');
Route::get('/college/{college}', 'CollegeController@detail')->where('college', '[0-9]+')->name('college.detail');

//project
Route::get('/project/detail/{project}', 'ProjectController@detail')->name('project.detail');
Route::get('/trials', 'GoodsTrialController@index')->name('goodsTrial.index');
Route::get('/project-schedules', 'ProjectScheduleController@index')->name('projectSchedule.index');
Route::get('/colleges', 'CollegeController@index')->name('college.index');

//qiniu
Route::post('/qiniu/callback/{action}', 'QiniuController@callback')->name('qiniu.callback');

//login
Route::get('login/weixin', 'Auth\LoginController@redirectToWeixin')->name('auth.loginWx');
Route::get('login/weixin/callback', 'Auth\LoginController@handleWeixinCallback')->name('auth.loginWxCb');
Route::get('login/qq', 'Auth\LoginController@redirectToQQ')->name('auth.loginQQ');
Route::get('login/qq/callback', 'Auth\LoginController@handleQQCallback')->name('auth.loginQQCb');

//pay
Route::post('/pay/notify', 'PayController@notify')->name('pay.notify');
Route::get('/pay/returnto/{order}', 'PayController@returnto')->name('pay.returnto');
Route::get('/pay/success', 'PayController@pSuccess')->name('pay.success');

//导出
Route::get('/export-xform/{xform}', 'ExportController@xform')->name('export.xform');

Route::middleware('guest')->group(function () {
    Route::get('password/reset-mobile', 'Auth\ForgotPasswordController@showMobileForm')->name('password.mobile');
    Route::post('/sms/code', 'SmsController@code')->name('sms.code');
    Route::post('password/reset-mobile', 'Auth\ResetPasswordController@resetByMobile')->name('password.resetByMobile');
});

Route::middleware('auth')->group(function () {
    // profile
    Route::post('password/resetpwd', 'Auth\ResetPasswordController@resetpwd')->name('password.resetpwd');
    // doc draft
    Route::get('/draftDocs', 'DocDraftController@index')->name('docDraft.index');
    Route::post('/draftDocs', 'DocDraftController@store')->name('docDraft.store');
    Route::post('/draftDocs/{docDraft}/duplicate', 'DocDraftController@duplicate')->name('docDraft.duplicate');
    Route::post('/draftDocs/{doc}/copy', 'DocDraftController@copy')->name('docDraft.copy');
    Route::put('/draftDocs/{docDraft}', 'DocDraftController@save')->name('docDraft.save');
    Route::delete('/draftDocs/{docDraft}', 'DocDraftController@delete')->name('docDraft.delete');
    Route::get('/doc/edit/{docDraft}', 'DocDraftController@edit')->name('docDraft.edit');
    Route::get('/user/cv', 'DocDraftController@cv')->name('docDraft.cv');
    Route::post('/doc/share/{docDraft}', 'DocDraftController@setShare')->name('docDraft.setShare');
    Route::post('/doc/publish/{docDraft}', 'DocDraftController@publish')->name('docDraft.publish');
    Route::get('/doc/share/{docDraft}', 'DocDraftController@share')->name('docDraft.share');
    Route::put('/draftDocs/{docDraft}/move', 'DocDraftController@move')->name('docDraft.move');
    Route::get('/doc-draft/preview/{docDraft}', 'DocDraftController@preview')->name('docDraft.preview');
    // doc publish
    Route::get('/publishDocs', 'DocPublishController@index')->name('docPublish.index');
    // doc
    Route::put('/doc/lock/{doc}', 'DocController@lock')->name('doc.lock');
    // favorite
    Route::get('/favorites', 'FavoriteController@index')->name('favorite.index');
    Route::post('/favorites', 'FavoriteController@store')->name('favorite.store');
    Route::delete('/favorites/{favorite}', 'FavoriteController@delete')->name('favorite.delete');
    // like
    Route::post('/likes', 'LikeController@store')->name('like.store');
    Route::delete('/likes/{like}', 'LikeController@delete')->name('like.delete');
    // user category
    Route::post('/folder/{category?}', 'UserCategoryController@folder')->name('userCategory.folder');
    Route::get('/userCategories', 'UserCategoryController@index')->name('userCategory.index');
    Route::post('/categories', 'UserCategoryController@store')->name('userCategory.store');
    Route::put('/categories/{category}', 'UserCategoryController@update')->name('userCategory.update');
    Route::delete('/categories/{category}', 'UserCategoryController@delete')->name('userCategory.delete');
    Route::put('/categories/{category}/move', 'UserCategoryController@move')->name('userCategory.move');

    // upload
    Route::post('/upload/docImage/{docDraft}', 'UploadController@docImage')->name('upload.docImage');
    Route::post('/upload/avatar', 'UploadController@avatar')->name('upload.avatar');
    Route::post('/upload/html', 'UploadController@html')->name('upload.html');

    //user center
    Route::get('/user/info', 'UserController@info')->name('user.info');
    Route::put('/user', 'UserController@update')->name('user.update');
    Route::get('/user/center', 'UserController@center')->name('user.center');
    Route::get('/user/comments', 'CommentController@userComments')->name('comment.userComments');
    Route::get('/user/revenues', 'UserController@revenues')->name('user.revenues');
    Route::get('/user/orders', 'OrderController@index')->name('order.index');
    Route::delete('/orders/{order}', 'OrderController@delete')->name('order.delete');
    Route::get('/user/find', 'UserController@find')->name('user.find');

    //address
    Route::get('/addresses', 'AddressController@index')->name('address.index');
    Route::post('/addresses', 'AddressController@store')->name('address.store');
    Route::put('/addresses/{address}', 'AddressController@update')->name('address.update');
    Route::delete('/addresses/{address}', 'AddressController@delete')->name('address.delete');

    //comment
    Route::post('/comments', 'CommentController@store')->name('comment.store');
    Route::post('/comments/reply/{target}', 'CommentController@reply')->name('comment.reply');
    Route::delete('/comments/{comment}', 'CommentController@delete')->name('comment.delete');

    //notice
    Route::get('/notices', 'NoticeController@index')->name('notice.index');

    //project
    Route::get('/projects', 'ProjectController@all')->name('project.all');
    Route::get('/project-drafts', 'ProjectDraftController@index')->name('projectDraft.index');
    Route::get('/project-drafts/{projectDraft}', 'ProjectDraftController@edit')->name('projectDraft.edit');
    Route::post('/project-drafts', 'ProjectDraftController@store')->name('projectDraft.store');
    Route::put('/project-drafts/{projectDraft}/products', 'ProjectDraftController@updateProducts')->name('projectDraft.updateProducts');
    Route::put('/project-drafts/{projectDraft}/clouds', 'ProjectDraftController@updateClouds')->name('projectDraft.updateClouds');
    Route::put('/project-drafts/{projectDraft}/relates', 'ProjectDraftController@updateRelates')->name('projectDraft.updateRelates');
    Route::put('/project-drafts/{projectDraft}/publish', 'ProjectDraftController@publish')->name('projectDraft.publish');
    Route::put('/project-drafts/{projectDraft}/cancel', 'ProjectDraftController@cancel')->name('projectDraft.cancel');
    Route::put('/project-drafts/{projectDraft}', 'ProjectDraftController@update')->name('projectDraft.update');
    Route::delete('/project-drafts/{projectDraft}', 'ProjectDraftController@delete')->name('projectDraft.delete');
    Route::get('/project-drafts/{projectDraft}', 'ProjectDraftController@edit')->name('projectDraft.edit');
    Route::get('/xforms/{xform}', 'XformController@show')->name('xform.show');
    Route::post('/xforms-save/{xform}', 'XformController@save')->name('xform.save');

    Route::get('/project-relate-drafts', 'ProjectRelateDraftController@index')->name('projectRelateDraft.index');

    //tag
    Route::get('/tag/find', 'TagController@find')->name('tag.find');
    // product
    Route::get('/product/find', 'ProductController@find')->name('product.find');

    //schedule
    Route::get('/project-schedule-drafts', 'ProjectScheduleDraftController@index')->name('projectScheduleDraft.index');
    Route::post('/project-schedule-drafts', 'ProjectScheduleDraftController@store')->name('projectScheduleDraft.store');
    Route::put('/project-schedule-drafts/{scheduleDraft}', 'ProjectScheduleDraftController@update')->name('projectScheduleDraft.update');
    Route::delete('/project-schedule-drafts/{scheduleDraft}', 'ProjectScheduleDraftController@delete')->name('projectScheduleDraft.delete');

    //course
    Route::get('/project-course-drafts', 'ProjectCourseDraftController@index')->name('projectCourseDraft.index');
    Route::post('/project-course-drafts', 'ProjectCourseDraftController@store')->name('projectCourseDraft.store');
    Route::put('/project-course-drafts/{courseDraft}', 'ProjectCourseDraftController@update')->name('projectCourseDraft.update');
    Route::delete('/project-course-drafts/{courseDraft}', 'ProjectCourseDraftController@delete')->name('projectCourseDraft.delete');

    //case
    Route::put('/project-case-drafts/{caseDraft}/move', 'ProjectCaseDraftController@move')->name('projectCaseDraft.move');
    Route::get('/project-case-drafts', 'ProjectCaseDraftController@index')->name('projectCaseDraft.index');
    Route::post('/project-case-drafts', 'ProjectCaseDraftController@store')->name('projectCaseDraft.store');
    Route::put('/project-case-drafts/{caseDraft}', 'ProjectCaseDraftController@update')->name('projectCaseDraft.update');
    Route::delete('/project-case-drafts/{caseDraft}', 'ProjectCaseDraftController@delete')->name('projectCaseDraft.delete');

    //goods
    Route::get('/project-goods-drafts', 'ProjectGoodsDraftController@index')->name('projectGoodsDraft.index');
    Route::post('/project-goods-drafts', 'ProjectGoodsDraftController@store')->name('projectGoodsDraft.store');
    Route::put('/project-goods-drafts/{goodsDraft}', 'ProjectGoodsDraftController@update')->name('projectGoodsDraft.update');
    Route::delete('/project-goods-drafts/{goodsDraft}', 'ProjectGoodsDraftController@delete')->name('projectGoodsDraft.delete');

    //team
    Route::post('/project-team-drafts', 'ProjectTeamDraftController@store')->name('projectTeamDraft.store');
    Route::put('/project-team-drafts/{teamDraft}', 'ProjectTeamDraftController@update')->name('projectTeamDraft.update');
    Route::delete('/project-team-drafts/{teamDraft}', 'ProjectTeamDraftController@delete')->name('projectTeamDraft.delete');

    //cloud
    Route::get('/project-cloud-drafts', 'ProjectCloudDraftController@index')->name('projectCloudDraft.index');

    Route::post('/trial-drafts', 'GoodsTrialDraftController@store')->name('trialDraft.store');
    Route::put('/trial-drafts/{trialDraft}', 'GoodsTrialDraftController@update')->name('trialDraft.update');

    //product
    Route::get('/project-product-drafts', 'ProjectProductDraftController@index')->name('projectProductDraft.index');

    //pay
    Route::get('/pay', 'PayController@index')->name('pay.index');
    Route::get('/pay/confirm', 'PayController@confirm')->name('pay.confirm');
    Route::get('/pay/native/{order}', 'PayController@native')->name('pay.native');
    Route::get('/pay/mweb/{order}', 'PayController@mweb')->name('pay.mweb');
    Route::get('/pay/jsapi/{order}', 'PayController@jsapi')->name('pay.jsapi');
    Route::get('/pay/qrcode', 'PayController@qrcode')->name('pay.qrcode');
    Route::get('/pay/check-paid/{order}', 'PayController@checkPaid')->name('pay.checkPaid');

    //wechat
    Route::get('/wechat/oauthCallback', 'WechatController@oauthCallback')->name('wechat.oauthCallback');

    //common
    Route::get('/common/enums', 'CommonController@enums')->name('common.enums');
    Route::get('/common/qnUploadToken', 'CommonController@qnUploadToken')->name('common.qnUploadToken');
});

Route::get('/tag/{tag:name}/{type?}', 'TagController@items')->name('tag.items');
