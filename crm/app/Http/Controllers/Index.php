<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class Index extends Controller
{
    //首页
    public function index(){
        return view('index.index');
    }
    //管理员列表
    public function admin_list(){
        return view('admin.admin_list');
    }
    //删除
    public function admin_del(){
        return view('admin.admin_del');
    }

}
