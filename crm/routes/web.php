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
//跟单列表
Route::get('documentary_list','DocumentaryController@documentary_list');
//订单列表
Route::get('order_list','OrderController@order_list');
//角色列表
Route::get('role_list','RoleController@role_list');
//权限列表
Route::get('power_list','PowerController@power_list');

