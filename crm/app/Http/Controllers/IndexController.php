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
        $notice_data = DB::table('publicnotice')->where('status',1)->orderBy('time','desc')->get();
        return view('index.welcome',['notice_data'=>$notice_data]);
    }




}
