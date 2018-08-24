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

//Route::get('/', function () {
//    return view('index');
//});
//控制器 @ 方法

Route::get('/','Index@index');
Route::get('welcome','Index@welcome');
//管理员展示
Route::get('admin_list','Index@admin_list');
//删除
Route::get('admin_del','Index@admin_del');
//跟单添加
Route::get('documentary_add','DocumentaryController@documentary_add');
//执行跟单添加
Route::get('documentary_add_do','DocumentaryController@documentary_add_do');
//跟单删除
Route::get('documentary_del','DocumentaryController@documentary_del');
//跟单修改
Route::get('documentary_save','DocumentaryController@documentary_save');
//执行跟单修改
Route::get('documentary_save_do','DocumentaryController@documentary_save_do');
//跟单列表
Route::get('documentary_list','DocumentaryController@documentary_list');
//跟单类型列表
Route::get('documentary_dtype_list','DocumentaryController@documentary_dtype_list');
//跟单类型添加
Route::get('documentary_dtype_add','DocumentaryController@documentary_dtype_add');
//执行跟单类型添加
Route::get('documentary_dtype_add_do','DocumentaryController@documentary_dtype_add_do');
//跟单类型删除
Route::get('documentary_dtype_del','DocumentaryController@documentary_dtype_del');
//跟单类型修改
Route::get('documentary_dtype_save','DocumentaryController@documentary_dtype_save');
//订单列表
Route::get('order_list','OrderController@order_list');
//角色列表
Route::get('role_list','RoleController@role_list');
//权限列表
Route::get('power_list','PowerController@power_list');
//客户管理列表
Route::get('user_list','UserController@user_list');
//添加客户
Route::get('user_add','UserController@user_add');
Route::get('user_add_do','UserController@user_add_do');
//客户类型列表
Route::get('ctype_list','UserController@ctype');
//类型添加
Route::get('ctype_add','UserController@ctype_add');
Route::get('ctype_add_do','UserController@ctype_add_do');
//类型删除
Route::get('ctype_del','UserController@ctype_del');
//修改类型
Route::get('ctype_update','UserController@ctype_update');
Route::get('ctype_update_do','UserController@ctype_update_do');
//等级展示
Route::get('clevel_list','UserController@clevel_list');
//等级添加
Route::get('clevel_add','UserController@clevel_add');
Route::get('clevel_add_do','UserController@clevel_add_do');
//修改等级
Route::get('clevel_update','UserController@clevel_update');
Route::get('clevel_update_do','UserController@clevel_update_do');
//删除等级
Route::get('clevel_del','UserController@clevel_del');
//展示来源
Route::get('csource_list','UserController@csource_list');
//来源添加
Route::get('csource_add','UserController@csource_add');
Route::get('csource_add_do','UserController@csource_add_do');
//修改来源
Route::get('csource_update','UserController@csource_update');
Route::get('csource_update_do','UserController@csource_update_do');
//删除来源
Route::get('csource_del','UserController@csource_del');


