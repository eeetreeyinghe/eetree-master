<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::namespace ('Api')->group(function () {
    // Route::middleware('admin.guard')->prefix('admin')->group(function () {
    Route::middleware('admin.guard')->prefix('admin')->group(function () {
        //管理员登录
        Route::post('/login', 'AdminController@login')->name('admin.login');
        Route::middleware(['admin.refresh', 'admin.permission'])->group(function () {
            //管理员列表
            Route::get('/admins', 'AdminController@index')->name('admin.list');
            //创建管理员
            Route::post('/admins', 'AdminController@store')->name('admin.store');
            Route::put('/admins/{admin}', 'AdminController@update')->name('admin.update');
            //管理员信息
            Route::get('/admins/{admin}', 'AdminController@show')->name('admin.show');
            //删除管理员
            Route::delete('/admins/{admin}', 'AdminController@delete')->name('admin.delete');
            //当前管理员信息
            Route::get('/info', 'AdminController@info')->name('admin.info');
            //管理员退出
            Route::get('/logout', 'AdminController@logout')->name('admin.logout');

            Route::get('/admin_menus', 'AdminMenuController@index')->name('adminmenu.index');
            Route::post('/admin_menus', 'AdminMenuController@store')->name('adminmenu.store');
            Route::put('/admin_menus/{menu}', 'AdminMenuController@update')->name('adminmenu.update');
            Route::delete('/admin_menus/{menu}', 'AdminMenuController@delete')->name('adminmenu.delete');

            Route::get('/admin_permissions', 'AdminPermissionController@index')->name('adminpermission.index');
            Route::get('/admin_permissions/{permission}', 'AdminPermissionController@show')->name('adminpermission.show');
            Route::post('/admin_permissions', 'AdminPermissionController@store')->name('adminpermission.store');
            Route::put('/admin_permissions/{permission}', 'AdminPermissionController@update')->name('adminpermission.update');
            Route::delete('/admin_permissions/{permission}', 'AdminPermissionController@delete')->name('adminpermission.delete');

            Route::get('/admin_roles', 'AdminRoleController@index')->name('adminrole.index');
            Route::get('/admin_roles/{role}', 'AdminRoleController@show')->name('adminrole.show');
            Route::post('/admin_roles', 'AdminRoleController@store')->name('adminrole.store');
            Route::put('/admin_roles/{role}', 'AdminRoleController@update')->name('adminrole.update');
            Route::delete('/admin_roles/{role}', 'AdminRoleController@delete')->name('adminrole.delete');

            Route::get('/categories', 'CategoryController@index')->name('admin.category.index');
            Route::post('/categories', 'CategoryController@store')->name('admin.category.store');
            Route::put('/categories/{category}', 'CategoryController@update')->name('admin.category.update');
            Route::delete('/categories/{category}', 'CategoryController@delete')->name('admin.category.delete');
            Route::put('/categories/{category}/move', 'CategoryController@move')->name('admin.category.move');

            Route::get('/comments', 'CommentController@index')->name('admin.comment.index');
            Route::put('/comments/{comment}/toggle', 'CommentController@toggle')->name('admin.comment.toggle');

            Route::get('/docs', 'DocController@index')->name('admin.doc.index');
            Route::put('/docs/{doc}', 'DocController@update')->name('admin.doc.update');
            Route::post('/docs/move', 'DocController@move')->name('admin.doc.move');
            Route::put('/docs/{doc}/top', 'DocController@top')->name('admin.doc.top');
            Route::put('/docs/{doc}/untop', 'DocController@untop')->name('admin.doc.untop');
            Route::get('/docPublishs', 'DocPublishController@index')->name('admin.docPublish.index');
            Route::put('/docPublishs/{docPublish}/review', 'DocPublishController@review')->name('admin.docPublish.review');
            Route::get('/docPublishs/{docPublish}/previewKey', 'DocPublishController@previewKey')->name('admin.docPublish.previewKey');

            Route::get('/projects', 'ProjectController@index')->name('admin.project.index');
            Route::put('/projects/{project}', 'ProjectController@update')->name('admin.project.update');
            Route::put('/projects/{project}/top', 'ProjectController@top')->name('admin.project.top');
            Route::put('/projects/{project}/untop', 'ProjectController@untop')->name('admin.project.untop');
            Route::get('/project-drafts', 'ProjectDraftController@index')->name('admin.projectDraft.index');
            Route::put('/project-drafts/{projectDraft}/review', 'ProjectDraftController@review')->name('admin.projectDraft.review');
            Route::get('/project-drafts/{projectDraft}/previewKey', 'ProjectDraftController@previewKey')->name('admin.projectDraft.previewKey');

            Route::get('/platforms', 'PlatformController@index')->name('admin.platform.index');
            Route::post('/platforms', 'PlatformController@store')->name('admin.platform.store');
            Route::put('/platforms/{platform}', 'PlatformController@update')->name('admin.platform.update');
            Route::delete('/platforms/{platform}', 'PlatformController@delete')->name('admin.platform.delete');

            Route::get('/colleges', 'CollegeController@index')->name('admin.college.index');
            Route::post('/colleges', 'CollegeController@store')->name('admin.college.store');
            Route::put('/colleges/{college}', 'CollegeController@update')->name('admin.college.update');
            Route::delete('/colleges/{college}', 'CollegeController@delete')->name('admin.college.delete');

            Route::get('/products', 'ProductController@index')->name('admin.product.index');
            Route::post('/products', 'ProductController@store')->name('admin.product.store');
            Route::put('/products/{product}', 'ProductController@update')->name('admin.product.update');
            Route::delete('/products/{product}', 'ProductController@delete')->name('admin.product.delete');

            Route::get('/project-goods', 'ProjectGoodsController@index')->name('admin.projectGoods.index');
            Route::put('/project-goods/{projectGoods}/promote', 'ProjectGoodsController@promote')->name('admin.projectGoods.promote');
            Route::put('/project-goods/{projectGoods}/unpromote', 'ProjectGoodsController@unpromote')->name('admin.projectGoods.unpromote');
            Route::put('/project-goods/{projectGoods}', 'ProjectGoodsController@update')->name('admin.projectGoods.update');

            Route::get('/goods-trials', 'GoodsTrialController@index')->name('admin.goodsTrial.index');
            Route::put('/goods-trials/{goodsTrial}', 'GoodsTrialController@update')->name('admin.goodsTrial.update');
            Route::put('/goods-trials/{draftTrial}/review', 'GoodsTrialController@review')->name('admin.goodsTrial.review');

            Route::get('/suppliers', 'SupplierController@index')->name('admin.supplier.index');
            Route::post('/suppliers', 'SupplierController@store')->name('admin.supplier.store');
            Route::put('/suppliers/{supplier}', 'SupplierController@update')->name('admin.supplier.update');
            Route::delete('/suppliers/{supplier}', 'SupplierController@delete')->name('admin.supplier.delete');

            Route::get('/recommends', 'RecommendController@index')->name('admin.recommend.index');
            Route::post('/recommends', 'RecommendController@store')->name('admin.recommend.store');
            Route::put('/recommends/{recommend}', 'RecommendController@update')->name('admin.recommend.update');
            Route::delete('/recommends/{recommend}', 'RecommendController@delete')->name('admin.recommend.delete');

            Route::get('/orders', 'OrderController@index')->name('admin.order.index');

            Route::get('/tags', 'TagController@index')->name('admin.tag.index');
            Route::post('/tags', 'TagController@store')->name('admin.tag.store');
            Route::put('/tags/{tag}', 'TagController@update')->name('admin.tag.update');
            Route::delete('/tags/{tag}', 'TagController@delete')->name('admin.tag.delete');

            Route::get('/common/enums', 'CommonController@enums')->name('admin.common.enums');
            Route::get('/common/secret', 'CommonController@secret')->name('admin.common.secret');
            Route::get('/common/qnUploadToken', 'CommonController@qnUploadToken')->name('admin.common.qnUploadToken');

            //注册用户列表
            Route::get('/users', 'UserController@index')->name('admin.user.list');
            Route::post('/users', 'UserController@store')->name('admin.user.store');
            Route::put('/users/{user}', 'UserController@update')->name('admin.user.update');
            Route::delete('/users/{user}', 'UserController@delete')->name('admin.user.delete');

            Route::get('/xforms', 'XformController@index')->name('admin.xform.index');
            Route::post('/xforms', 'XformController@store')->name('admin.xform.store');
            Route::put('/xforms/{xform}', 'XformController@update')->name('admin.xform.update');
            Route::delete('/xforms/{xform}', 'XformController@delete')->name('admin.xform.delete');
        });
    });
});
