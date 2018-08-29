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
        $a_id = session()->get('a_id');
        $admin_data = DB::table('admin')->where('a_id',$a_id)->first();
        $user_count = DB::table('customer')->where('a_id',$a_id)->where('status',1)->count();
        //分组排序
        $documentary_arr = DB::table('documentary')
            ->select(DB::raw('max(documentary_id) as some_id,c_id'))
            ->where('status',1)
            ->where('admin_id',$a_id)
            ->groupBy('c_id')
            ->orderBy('some_id','desc')
            ->get();
        $documentary_count = DB::table('documentary')->where('status',1)->where('admin_id',$a_id)->count();;
        $order_data = DB::table('order')->where('status',1)->where('a_id',$a_id)->get();
        $order_count = count($order_data);
        $sales = 0;
        foreach($order_data as $v){
            $sales += $v->get_money;
        }
        $del_count = DB::table('record')->where('a_id',$a_id)->where('action','like','%删除%')->count();
        $save_count = DB::table('record')->where('a_id',$a_id)->where('action','like','%修改%')->count();
        $c_id = [];
        $time = time();
        foreach($documentary_arr as $v){
            $documentary_arr = DB::table('documentary')->where('documentary_id',$v->some_id)->first();
            if($documentary_arr->d_nexttime-$time <24*3600){
                $c_id []= $v->c_id;
            }
        }
        $user_data = DB::table('customer')->whereIn('c_id',$c_id)->get();
        return view('index.welcome',['notice_data'=>$notice_data,'user_count'=>$user_count,'documentary_count'=>$documentary_count,'order_count'=>$order_count,'sales'=>$sales,'del_count'=>$del_count,'save_count'=>$save_count,'admin_data'=>$admin_data,'user_data'=>$user_data,'time'=>$time]);
    }

    /** 没有权限  错误页面 */
    public function not_power(){
        return view('index.not_power');
    }




}
