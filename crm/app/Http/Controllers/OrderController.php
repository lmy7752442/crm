<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    //订单列表
    public function order_list(){
        $order_data = DB::table('order')->where('status',1)->get();
        return view('order.order_list',['order_data'=>$order_data]);
    }
    public function order_add(){
        $user_data = DB::table('customer')->where('status',1)->get();
        return view('order.order_add',['user_data'=>$user_data]);
    }
    public function order_add_do(){

    }
    public function order_user(Request $request){
        $uid = $request -> get('uid');
        $user_data = DB::table('customer')->where('status',1)->where('c_id',$uid)->first();
        $a_id = session()->get('a_id');
        $admin_data = DB::table('admin')->where('a_id',$a_id)->first();
        $admin_name= $admin_data->a_account;
        $arr = [
            'user'=>$user_data,
            'admin'=>$admin_name
        ];
        return json_encode($arr);
    }
    //订单列表
    public function order_mode_list(){
        $data = DB::table('ordermode')->where('status',1)->paginate(10);
        return view('order.order_mode_list',['data'=>$data]);
    }
    public function order_mode_add(){
        return view('order.order_mode_add');
    }
    public function order_mode_add_do(Request $request){
        $ordermode = $request ->get('ordermode');
        $res = DB::table('ordermode')->insert(['ordermode_name'=>$ordermode,'time'=>time()]);
        if($res > 0){
            return 1;
        }
    }
    public function order_mode_save(Request $request){
        $ordermode_id = $request ->get('id');
        $data = DB::table('ordermode')->where('ordermode_id',$ordermode_id)->first();
        return view('order.order_mode_save',['data'=>$data]);
    }
    public function order_mode_save_do(Request $request){
        $ordermode_id = $request ->get('ordermode_id');
        $ordermode_name = $request ->get('ordermode');
        $res = DB::table('ordermode')->where('ordermode_id',$ordermode_id)->update(['time'=>time(),'ordermode_name'=>$ordermode_name]);
        if($res > 0){
            return 1;
        }
    }
    public function order_mode_del(Request $request){
        $ordermode_id = $request ->get('id');
        $res = DB::table('ordermode')->where('ordermode_id',$ordermode_id)->update(['status'=>3]);
        if($res > 0){
            return 1;
        }
    }
}
