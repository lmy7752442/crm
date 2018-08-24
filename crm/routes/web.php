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

########## Admin控制器 ##########
//显示登录页面
Route::get('/login','Admin@login');
//执行登录
Route::post('/login_do','Admin@login_do');
//退出
Route::get('/login_out','Admin@login_out');
//管理员添加
Route::get('/admin_add','Admin@admin_add');
//管理员执行添加
Route::get('/admin_add_do','Admin@admin_add_do');
//管理员展示
Route::get('/admin_list','Admin@admin_list');
//管理员修改
Route::get('/admin_update','Admin@admin_update');
//管理员执行修改
Route::get('/admin_update_do','Admin@admin_update_do');
//管理员删除
Route::get('/admin_del','Admin@admin_del');

########## Department控制器 ##########
//部门添加
Route::get('/department_add','Department@department_add');
//部门执行添加
Route::get('/department_add_do','Department@department_add_do');
//部门展示
Route::get('/department_list','Department@department_list');
//部门修改
Route::get('/department_update','Department@department_update');
//部门执行修改
Route::get('/department_update_do','Department@department_update_do');
//部门删除
Route::get('/department_del','Department@department_del');

########## Role控制器 ##########
//角色添加
Route::get('/role_add','Role@role_add');
//角色执行添加
Route::get('/role_add_do','Role@role_add_do');
//角色展示列表
Route::get('role_list','Role@role_list');
//角色修改
Route::get('/role_update','Role@role_update');
//角色执行修改
Route::get('/role_update_do','Role@role_update_do');
//角色删除
Route::get('/role_del','Role@role_del');

########## Power控制器 ##########
//权限添加
Route::get('/power_add','Power@power_add');
//权限执行添加
Route::get('/power_add_do','Power@power_add_do');
//权限展示列表
Route::get('power_list','Power@power_list');
//权限修改
Route::get('/power_update','Power@power_update');
//权限执行修改
Route::get('/power_update_do','Power@power_update_do');
//权限删除
Route::get('/power_del','Power@power_del');


Route::get('/','Index@index');
Route::get('welcome','Index@welcome');

//订单列表
Route::get('order_list','OrderController@order_list');


