<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    //订单列表
    public function order_list(){
        $order_data = DB::table('order')->where('status',1)-> paginate(10);
        foreach($order_data as $v){
            $user_data = DB::table('customer')->where('c_id',$v->c_id)->first();
            $v->c_id = $user_data->c_name;
            if($v->status == 1){
                $v->status = '未支付';
            }else if($v->status == 2){
                $v->status = '已支付';
            }
            $v->a_id = session()->get('a_account');
        }
        return view('order.order_list',['order_data'=>$order_data]);
    }
    public function order_add(){
        $user_data = DB::table('customer')->where('status',1)->get();
        $order_number = time().rand(1000,9999);
        return view('order.order_add',['user_data'=>$user_data,'order_number'=>$order_number]);
    }
    public function order_add_do(Request $request){
        $arr['o_number'] = $request->get('o_number');
        $data = DB::table('order')->where('o_number',$arr['o_number'])->first();
        if(!empty($data)){
            return 2;
        }
        $arr['c_id'] = $request->get('username');
        $arr['instead_money'] = $request->get('instead_money');
        $arr['order_money'] = $request->get('order_money');
        $arr['discounts_money'] = $request->get('discounts_money');
        $arr['discounts_type'] = $request->get('discounts_type');
        $arr['get_money'] = $request->get('get_money');
        $arr['put_money'] = $request->get('put_money');
        $arr['order_mode'] = $request->get('order_mode');
        $arr['delivery_type'] = $request->get('delivery_type');
        $arr['send_type'] = $request->get('send_type');
        $product_id = substr($request->get('product_id'),0,-1);
        $arr['time']=time();
        $arr['a_id']=session()->get('a_id');
        $res = DB::table('order') -> insert($arr);
        $product_arr = explode(',',$product_id);
        foreach ($product_arr as $v){
            $res2 = DB::table('order_product')->insert(['product_id'=>$v,'order_number'=>$arr['o_number']]);
        }
        if($res>0 && $res2>0){
            return 1;
        }
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
