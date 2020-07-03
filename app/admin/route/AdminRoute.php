<?php
use think\facade\Route;
use \app\admin\middleware\Auth;
use \app\admin\middleware\IsLogin;



/**
 * 无Token
 */
Route::group(function () {
    Route::rule('Login', '/admin/AdminBaseAccess/adminUserLogin', 'GET');
    Route::rule('adminLogin', '/admin/AdminBaseAccess/adminLogin', 'POST');
});
/**
 * 有Token
 */
Route::group(function () {
    /**
     * 公共基础
     */
    Route::rule('Index', '/admin/AdminBaseAccess/indexView', 'GET');
    Route::rule('indexWelcome', '/admin/AdminBaseAccess/indexWelcome', 'GET');
    Route::rule('adminQuit', '/admin/AdminBaseAccess/adminQuit', 'GET');
    Route::rule('adminInfo', '/admin/AdminBaseAccess/adminInfo', 'POST');
    Route::rule('seeAllTable', '/admin/AdminBaseAccess/seeAllTable', 'POST');
    Route::rule('seeAllCatalogue', '/admin/AdminBaseAccess/seeAllCatalogue', 'POST');
}) -> middleware(IsLogin::class);

Route::group(function () {
    Route::rule('upload', '/admin/AdminBaseAccess/upload', 'POST');
    /**
     * 视图控制器
     */
    Route::rule('AdminView/userView', '/admin/AdminView/userView', 'GET');
    Route::rule('AdminView/userAddEdit', '/admin/AdminView/userAddEdit', 'GET');
    Route::rule('AdminView/commandView', '/admin/AdminView/commandView', 'GET');
    Route::rule('AdminView/add_table_crud', '/admin/AdminView/add_table_crud', 'GET');
    Route::rule('AdminView/catalogueView', '/admin/AdminView/catalogueView', 'GET');
    Route::rule('AdminView/catalogueAddEdit', '/admin/AdminView/catalogueAddEdit', 'GET');
    /**
     * 管理员
     */
    Route::rule('AdminUser/seeAll', '/admin/AdminUser/seeAll', 'POST');
    Route::rule('AdminUser/addAdminUser', '/admin/AdminUser/addAdminUser', 'POST');
    Route::rule('AdminUser/batchDeleteData', '/admin/AdminUser/batchDeleteData', 'POST');
    Route::rule('AdminUser/deleteData', '/admin/AdminUser/deleteData', 'POST');
    Route::rule('AdminUser/updateData', '/admin/AdminUser/updateData', 'POST');
    Route::rule('AdminUser/retrieveData', '/admin/AdminUser/retrieveData', 'POST');
    Route::rule('AdminUser/export_file', '/admin/AdminUser/export_file', 'GET');
    /**
     * 管理员权限分配
     */
    Route::rule('AdminAuthAccess/seeAll', '/admin/AdminAuthAccess/seeAll', 'POST');
    Route::rule('AdminAuthAccess/seeAuthGroup', '/admin/AdminAuthAccess/seeAuthGroup', 'POST');
    Route::rule('AdminAuthAccess/createData', '/admin/AdminAuthAccess/createData', 'POST');
    Route::rule('AdminAuthAccess/batchDeleteData', '/admin/AdminAuthAccess/batchDeleteData', 'POST');
    Route::rule('AdminAuthAccess/deleteData', '/admin/AdminAuthAccess/deleteData', 'POST');
    Route::rule('AdminAuthAccess/updateData', '/admin/AdminAuthAccess/updateData', 'POST');
    Route::rule('AdminAuthAccess/retrieveData', '/admin/AdminAuthAccess/retrieveData', 'POST');
    Route::rule('AdminAuthAccess/view', '/admin/AdminAuthAccess/view', 'GET');
    Route::rule('AdminAuthAccess/viewAddEdit', '/admin/AdminAuthAccess/viewAddEdit', 'GET');
    /**
     * 管理员权限组
     */
    Route::rule('AdminAuthGroup/seeAll', '/admin/AdminAuthGroup/seeAll', 'POST');
    Route::rule('AdminAuthGroup/seeGenerator', '/admin/AdminAuthGroup/seeGenerator', 'POST');
    Route::rule('AdminAuthGroup/createData', '/admin/AdminAuthGroup/createData', 'POST');
    Route::rule('AdminAuthGroup/batchDeleteData', '/admin/AdminAuthGroup/batchDeleteData', 'POST');
    Route::rule('AdminAuthGroup/deleteData', '/admin/AdminAuthGroup/deleteData', 'POST');
    Route::rule('AdminAuthGroup/updateData', '/admin/AdminAuthGroup/updateData', 'POST');
    Route::rule('AdminAuthGroup/retrieveData', '/admin/AdminAuthGroup/retrieveData', 'POST');
    Route::rule('AdminAuthGroup/view', '/admin/AdminAuthGroup/view', 'GET');
    Route::rule('AdminAuthGroup/viewAddEdit', '/admin/AdminAuthGroup/viewAddEdit', 'GET');
    /**
     * 代码生成
     */
    Route::rule('AdminGenerator/seeAll', '/admin/AdminGenerator/seeAll', 'POST');
    Route::rule('AdminGenerator/retrieveData', '/admin/AdminGenerator/retrieveData', 'POST');
    Route::rule('AdminTable/getAllTable', '/admin/AdminTable/getAllTable', 'POST');
    Route::rule('AdminTable/codeGenerator', '/admin/AdminTable/codeGenerator', 'POST');
    /**
     * 二级目录
     */
    Route::rule('AdminCatalogue/seeAll', '/admin/AdminCatalogue/seeAll', 'POST');
    Route::rule('AdminCatalogue/createData', '/admin/AdminCatalogue/createData', 'POST');
    Route::rule('AdminCatalogue/batchDeleteData', '/admin/AdminCatalogue/batchDeleteData', 'POST');
    Route::rule('AdminCatalogue/deleteData', '/admin/AdminCatalogue/deleteData', 'POST');
    Route::rule('AdminCatalogue/updateData', '/admin/AdminCatalogue/updateData', 'POST');
    Route::rule('AdminCatalogue/retrieveData', '/admin/AdminCatalogue/retrieveData', 'POST');

}) -> middleware(IsLogin::class) -> middleware(Auth::class);

//----------------------------------------------------------------------------------
/*
                          _ooOoo_
                         o8888888o
                         88" . "88
                         (| -_- |)
                         O\  =  /O
                      ____/`---'\____
                    .'  \\|     |//  `.
                   /  \\|||  :  |||//  \
                  /  _||||| -:- |||||-  \
                  |   | \\\  -  /// |   |
                  | \_|  ''\---/''  |   |
                  \  .-\__  `-`  ___/-. /
                ___`. .'  /--.--\  `. . __
             ."" '<  `.___\_<|>_/___.'  >'"".
            | | :  `- \`.;`\ _ /`;.`/ - ` : | |
            \  \ `-.   \_ __\ /__ _/   .-` /  /
       ======`-.____`-.___\_____/___.-`____.-'======
                          `=---='
       ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
                    佛祖保佑       永无BUG
       */
