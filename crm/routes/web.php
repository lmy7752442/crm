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

########## Login控制器 ##########
//显示登录页面
Route::get('/login','LoginController@login');
//执行登录
Route::get('/login_do','LoginController@login_do');
//退出
Route::get('/login_out','LoginController@login_out');


########## Admin控制器 ##########
//管理员添加
Route::get('/admin_add','AdminController@admin_add');
//管理员执行添加
Route::get('/admin_add_do','AdminController@admin_add_do');
//管理员展示
Route::get('/admin_list','AdminController@admin_list');
//管理员修改
Route::get('/admin_update','AdminController@admin_update');
//管理员执行修改
Route::get('/admin_update_do','AdminController@admin_update_do');
//管理员删除
Route::get('/admin_del','AdminController@admin_del');
//建议添加
Route::get('/advince_add','AdmAdminControllerin@advince_add');
//建议执行添加
Route::get('/advince_add_do','AdminController@advince_add_do');
//客户建议列表
Route::get('/advince_list','AdminController@advince_list');
//客户建议删除
Route::get('/advince_del','AdminController@advince_del');


########## Department控制器 ##########
//部门添加
Route::get('/department_add','DepartmentController@department_add');
//部门执行添加
Route::get('/department_add_do','DepartmentController@department_add_do');
//部门展示
Route::get('/department_list','DepartmentController@department_list');
//部门修改
Route::get('/department_update','DepartmentController@department_update');
//部门执行修改
Route::get('/department_update_do','DepartmentController@department_update_do');
//部门删除
Route::get('/department_del','DepartmentController@department_del');


########## Role控制器 ##########
//角色添加
Route::get('/role_add','RoleController@role_add');
//角色执行添加
Route::get('/role_add_do','RoleController@role_add_do');
//角色展示列表
Route::get('role_list','RoleController@role_list');
//角色修改
Route::get('/role_update','RoleController@role_update');
//角色执行修改
Route::get('/role_update_do','RoleController@role_update_do');
//角色删除
Route::get('/role_del','RoleController@role_del');


########## Power控制器 ##########
//权限添加
Route::get('/power_add','PowerController@power_add');
//权限执行添加
Route::get('/power_add_do','PowerController@power_add_do');
//权限展示列表
Route::get('power_list','PowerController@power_list');
//权限修改
Route::get('/power_update','PowerController@power_update');
//权限执行修改
Route::get('/power_update_do','PowerController@power_update_do');
//权限删除
Route::get('/power_del','PowerController@power_del');



Route::get('/','IndexController@index');
Route::get('welcome','IndexController@welcome');


########## Documentary控制器 ##########

//跟单添加
Route::get('documentary_add','DocumentaryController@documentary_add');
//跟单添加执行
Route::get('documentary_add_do','DocumentaryController@documentary_add_do');
//跟单删除
Route::get('documentary_del','DocumentaryController@documentary_del');
//跟单修改
Route::get('documentary_save','DocumentaryController@documentary_save');
//跟单修改执行
Route::get('documentary_save_do','DocumentaryController@documentary_save_do');
//跟单列表
Route::get('documentary_list','DocumentaryController@documentary_list');
//跟单类型列表
Route::get('documentary_dtype_list','DocumentaryController@documentary_dtype_list');
//跟单类型添加
Route::get('documentary_dtype_add','DocumentaryController@documentary_dtype_add');
//跟单类型添加执行
Route::get('documentary_dtype_add_do','DocumentaryController@documentary_dtype_add_do');
//跟单类型删除
Route::get('documentary_dtype_del','DocumentaryController@documentary_dtype_del');
//跟单类型修改
Route::get('documentary_dtype_save','DocumentaryController@documentary_dtype_save');
//跟单类型修改执行
Route::get('documentary_dtype_save_do','DocumentaryController@documentary_dtype_save_do');
//跟单进度列表
Route::get('documentary_dprogress_list','DocumentaryController@documentary_dprogress_list');
//跟单进度添加
Route::get('documentary_dprogress_add','DocumentaryController@documentary_dprogress_add');
//跟单进度添加执行
Route::get('documentary_dprogress_add_do','DocumentaryController@documentary_dprogress_add_do');
//跟单进度删除
Route::get('documentary_dprogress_del','DocumentaryController@documentary_dprogress_del');
//跟单进度修改
Route::get('documentary_dprogress_save','DocumentaryController@documentary_dprogress_save');
//跟单进度修改执行
Route::get('documentary_dprogress_save_do','DocumentaryController@documentary_dprogress_save_do');

########## Order控制器 ##########
//订单列表
Route::get('order_list','OrderController@order_list');
//查询用户信息
Route::get('order_user','OrderController@order_user');
//订单添加
Route::get('order_add','OrderController@order_add');
//订单添加执行
Route::get('order_add_do','OrderController@order_add_do');
//订单修改
Route::get('order_save','OrderController@order_save');
//订单修改执行
Route::get('order_save_do','OrderController@order_save_do');
//订单删除
Route::get('order_del','OrderController@order_del');
//订单状态列表
Route::get('order_type_list','OrderController@order_type_list');
//订单状态添加
Route::get('order_type_add','OrderController@order_type_add');
//订单状态添加执行
Route::get('order_type_add_do','OrderController@order_type_add_do');
//订单状态修改
Route::get('order_type_save','OrderController@order_type_save');
//订单状态修改执行
Route::get('order_type_save_do','OrderController@order_type_save_do');
//订单状态删除
Route::get('order_type_del','OrderController@order_type_del');
//订单方式列表
Route::get('order_mode_list','OrderController@order_mode_list');
//订单方式添加
Route::get('order_mode_add','OrderController@order_mode_add');
//订单方式添加执行
Route::get('order_mode_add_do','OrderController@order_mode_add_do');
//订单方式修改
Route::get('order_mode_save','OrderController@order_mode_save');
//订单方式修改执行
Route::get('order_mode_save_do','OrderController@order_mode_save_do');
//订单方式删除
Route::get('order_mode_del','OrderController@order_mode_del');

###########User 控制器###########

//客户管理列表
Route::get('user_list','UserController@user_list');
//添加客户
Route::get('user_add','UserController@user_add');
Route::get('user_add_do','UserController@user_add_do');
//删除客户
Route::get('user_del','UserController@user_del');
//修改客户
Route::get('user_update','UserController@user_update');
Route::get('user_update_do','UserController@user_update_do');
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
//合同类型展示
Route::get('contype_list','UserController@contype_list');
//合同类型添加
Route::get('contype_add','UserController@contype_add');
Route::get('contype_add_do','UserController@contype_add_do');
//合同类型删除
Route::get('contype_del','UserController@contype_del');
//修改合同类型
Route::get('contype_update','UserController@contype_update');
Route::get('contype_update_do','UserController@contype_update_do');
//产品展示
Route::get('product_list','UserController@product_list');
//产品添加
Route::get('product_add','UserController@product_add');
Route::get('product_add_do','UserController@product_add_do');
//产品修改
Route::get('product_update','UserController@product_update');
Route::get('product_update_do','UserController@product_update_do');
//产品删除
Route::get('product_del','UserController@product_del');
//合同展示
Route::get('contract_list','ContractController@contract_list');
//合同添加
Route::get('contract_add','ContractController@contract_add');
Route::get('contract_add_do','ContractController@contract_add_do');
//合同删除
Route::get('contract_del','ContractController@contract_del');
//合同修改
Route::get('contract_update','ContractController@contract_update');
Route::get('contract_update_do','ContractController@contract_update_do');
//搜索
Route::get('seek','ContractCOntroller@seek');

//开共享
Route::get('/share_add','UserController@share_add');
//执行添加共享
Route::get('/share_add_do','UserController@share_add_do');
//共享列表展示  我的共享
Route::get('share_list','UserController@share_list');
//共享给我
Route::get('share_list_do','UserController@share_list_do');
########## Count控制器 ##########
//统计
Route::get('/count','CountController@count');



########## adt控制器 ##########
//公告展示
Route::get('/publicnotice_list','adt@publicnotice_list');
//公告添加
Route::get('/publicnotice_add','adt@publicnotice_add');
//公告添加执行
Route::get('/publicnotice_add_do','adt@publicnotice_add_do');
//公告修改
Route::get('/publicnotice_save','adt@publicnotice_save');
//公告修改执行
Route::get('/publicnotice_save_do','adt@publicnotice_save_do');
//公告删除
Route::get('/publicnotice_del','adt@publicnotice_del');
//公海展示
Route::get('seas_list','UserController@seas_list');
//扔入公海
Route::get('seas_add','UserController@seas_add');
//删除公海数据
Route::get('seas_del','UserController@seas_del');
//修改公海数据
Route::get('seas_update','UserController@seas_update');
Route::get('seas_update_do','UserController@seas_update_do');


