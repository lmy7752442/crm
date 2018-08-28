<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class IndexController extends CommonController
{
    //首页
    public function index(Request $request){
////        echo 123;exit;
        $a_account = $request->session()->get('a_account');
//        print_r($a_account);exit;
        return view('index.index')->with('data',$a_account);
    }
    public function welcome(){
        return view('index.welcome');
    }




}
