<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;


class CountController extends CommonController{
    /** 统计 */
    public function count_list(){
        $a_id = session()->get('a_id');
        $admin_data = DB::table('admin')->where('a_id',$a_id)->first();
        $user_count = DB::table('customer')->where('a_id',$a_id)->where('status',1)->count();
        $documentary_count = DB::table('documentary')->where('status',1)->where('admin_id',$a_id)->count();
        $order_data = DB::table('order')->where('status',1)->where('a_id',$a_id)->get();
        $order_count = count($order_data);
        $sales = 0;
        foreach($order_data as $v){
            $sales += $v->get_money;
        }
        $del_count = DB::table('record')->where('a_id',$a_id)->where('action','like','%删除%')->count();
        $save_count = DB::table('record')->where('a_id',$a_id)->where('action','like','%修改%')->count();
        return view('count.count_list',['user_count'=>$user_count,'documentary_count'=>$documentary_count,'order_count'=>$order_count,'sales'=>$sales,'del_count'=>$del_count,'save_count'=>$save_count,'admin_data'=>$admin_data]);
    }
}