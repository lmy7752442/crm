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

Route::get('/','index@index');
//管理员展示
Route::get('admin_list','Index@admin_list');
//删除
Route::get('admin_del','Index@admin_del');
//订单列表
Route::get('order_list','OrderController@order_list');
//角色列表
Route::get('role_list','RoleController@role_list');
//权限列表
Route::get('power_list','PowerController@power_list');


