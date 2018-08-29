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
        $arr = [];
        if($admin_data->role_id == 1){
            $admin_data = DB::table('admin')->where('a_status',1)->get();
            foreach($admin_data as $k=>$v){
                $arr[$k]['admin_name'] = $v->a_account;
                $arr[$k]['user_count'] = DB::table('customer')->where('a_id',$v->a_id)->where('status',1)->count();
                $arr[$k]['documentary_count'] = DB::table('documentary')->where('status',1)->where('admin_id',$v->a_id)->count();
                $order_data = DB::table('order')->where('status',1)->where('a_id',$v->a_id)->get();
                $arr[$k]['order_count'] = count($order_data);
                $sales = 0;
                foreach($order_data as $v){
                    $sales += $v->get_money;
                }
                $arr[$k]['sale'] = $sales;

                $arr[$k]['del_count'] = DB::table('record')->where('a_id',$v->a_id)->where('action','like','%删除%')->count();
                $arr[$k]['save_count'] = DB::table('record')->where('a_id',$v->a_id)->where('action','like','%修改%')->count();
            }
        }else{
            foreach($admin_data as $k=>$v){
                $arr[$k]['admin_name'] = $v->a_account;
                $arr[$k]['user_count'] = DB::table('customer')->where('a_id',$v->a_id)->where('status',1)->count();
                $arr[$k]['documentary_count'] = DB::table('documentary')->where('status',1)->where('admin_id',$v->a_id)->count();
                $order_data = DB::table('order')->where('status',1)->where('a_id',$v->a_id)->get();
                $arr[$k]['order_count'] = count($order_data);
                $sales = 0;
                foreach($order_data as $v){
                    $sales += $v->get_money;
                }
                $arr[$k]['sale'] = $sales;

                $arr[$k]['del_count'] = DB::table('record')->where('a_id',$v->a_id)->where('action','like','%删除%')->count();
                $arr[$k]['save_count'] = DB::table('record')->where('a_id',$v->a_id)->where('action','like','%修改%')->count();
            }
//            $admin_name[] = $admin_data->a_account;
//            $user_count[] = DB::table('customer')->where('a_id',$a_id)->where('status',1)->count();
//            $documentary_count[] = DB::table('documentary')->where('status',1)->where('admin_id',$a_id)->count();
//            $order_data = DB::table('order')->where('status',1)->where('a_id',$a_id)->get();
//            $order_count[] = count($order_data);
//            $sales = 0;
//            foreach($order_data as $v){
//                $sales += $v->get_money;
//            }
//            $sale[] = $sales;
//            $del_count[] = DB::table('record')->where('a_id',$a_id)->where('action','like','%删除%')->count();
//            $save_count[] = DB::table('record')->where('a_id',$a_id)->where('action','like','%修改%')->count();
        }
        return view('count.count_list',['data'=>$arr]);
    }
}