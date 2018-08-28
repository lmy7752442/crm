<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *  订单展示
     */
    public function order_list(Request $request){
        $start_time = $request->get('start_time');
        $end_time = $request->get('end_time');
        $order_type2 = $request->get('order_type');
        $order_number = $request->get('order_number');
        $where = [];
        if(!empty($start_time)){
            $start_time = strtotime($start_time);
            $where[] = ['time','>',$start_time];
        }
        if(!empty($end_time)){
            $end_time = strtotime($end_time);
            $where[] = ['time','<',$end_time];
        }
        if(!empty($order_type2)){
            $where[] = ['order_type','=',$order_type2];
        }
        if(!empty($order_number)){
            $where[] = ['o_number','like',"%$order_number%"];
        }
        $order_data = DB::table('order')->where('status',1)->where('status','!=',3)->where($where)-> paginate(10);
        foreach($order_data as $v){
            $user_data = DB::table('customer')->where('c_id',$v->c_id)->first();
            $v->c_id = $user_data->c_name;
            $order_type = DB::table('ordertype')->where('id',$v->order_type)->first();
            $v->order_type =  $order_type->name;
            $v->a_id = session()->get('a_account');
        }
        $order_type = DB::table('ordertype')->where('status',1)->get();
        return view('order.order_list',['order_data'=>$order_data,'order_type'=>$order_type,'order_type2'=>$order_type2,'order_number'=>$order_number,'end_time'=>$end_time,'start_time'=>$start_time]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 订单添加
     */
    public function order_add(){
        $user_data = DB::table('customer')->where('status',1)->get();
        $order_number = time().rand(1000,9999);
        $product = DB::table('product')->where('status',1)->get();
        $order_type = DB::table('ordertype')->where('status',1)->get();
        return view('order.order_add',['user_data'=>$user_data,'order_number'=>$order_number,'product'=>$product,'order_type'=>$order_type]);
    }

    /**
     * @param Request $request
     * @return int
     * 订单添加执行
     */
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
        $arr['order_type'] = $request->get('order_type');
        $product_id = substr($request->get('product_id'),0,-1);
        $arr['time']=time();
        $arr['a_id']=session()->get('a_id');
        $res = DB::table('order') -> insert($arr);
        DB::table('record')->insert(['c_id'=>$arr['c_id'],'action'=>'添加订单','data_table'=>'订单表','a_id'=>$arr['a_id'],'time'=>$arr['time']]);
        $product_arr = explode(',',$product_id);
        foreach ($product_arr as $v){
            $res2 = DB::table('order_product')->insert(['product_id'=>$v,'order_number'=>$arr['o_number']]);
        }
        if($res>0 && $res2>0){
            return 1;
        }
    }

    /**
     * @param Request $request
     * @return string
     * 订单展示用户信息
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 订单修改
     */
    public function order_save(Request $request){
        $id = $request -> get('id');
        $order_data = DB::table('order')->where('order_id',$id)->first();
        $order_product = DB::table('order_product')->where('order_number',$order_data->o_number)->get();
        $user_data = DB::table('customer')->where('status',1)->get();
        $user = DB::table('customer')->where('c_id',$order_data->c_id)->first();
        $product = DB::table('product')->where('status',1)->get();
        $order_type = DB::table('ordertype')->where('status',1)->get();
        return view('order.order_save',['order_data'=>$order_data,'user_data'=>$user_data,'user'=>$user,'product'=>$product,'order_product'=>$order_product,'order_type'=>$order_type]);
    }

    /**
     * @param Request $request
     * @return int
     * 订单修改执行
     */
    public function order_save_do(Request $request){
        $o_number = $request->get('o_number');
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
        $arr['order_type'] = $request->get('order_type');
        $res = DB::table('order')->where('o_number', $o_number)->update($arr);
        DB::table('record')->insert(['c_id'=>$arr['c_id'],'action'=>'修改订单','data_table'=>'订单表','a_id'=>session()->get('a_id'),'time'=>time()]);
        $product_id = substr($request->get('product_id'),0,-1);
        $product_arr = explode(',',$product_id);
        DB::table('order_product')->where('order_number',$o_number)->delete();
        foreach($product_arr as $v){
            $res1 = DB::table('order_product')->insert(['product_id'=>$v,'order_number'=>$o_number]);
        }
        if($res>0 or $res1>0 ){
            return 1;
        }
    }

    /**
     * @param Request $request
     * @return int
     * 订单删除
     */
    public function order_del(Request $request){
          $id = $request -> get('id');
          $data = DB::table('order')->where('order_id',$id)->first();
          $res = DB::table('order')->where('order_id',$id)->update(['status'=>3]);
          DB::table('record')->insert(['c_id'=>$data->c_id,'action'=>'删除订单','data_table'=>'订单表','a_id'=>session()->get('a_id'),'time'=>time()]);
          if($res > 0){
              return 1;
          }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 订单状态展示
     */
    public function order_type_list(){
        $data = DB::table('ordertype')->where('status',1)->paginate(10);
        return view('order.order_type_list',['data'=>$data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 订单状态添加
     */
    public function order_type_add(){
        return view('order.order_type_add');
    }

    /**
     * @param Request $request
     * @return int
     * 订单状态添加执行
     */
    public function order_type_add_do(Request $request){
        $ordertype = $request ->get('ordertype');
        $res = DB::table('ordertype')->insert(['name'=>$ordertype,'time'=>time()]);
        if($res > 0){
            return 1;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 订单状态修改
     */
    public function order_type_save(Request $request){
        $ordertype_id = $request ->get('id');
        $data = DB::table('ordertype')->where('id',$ordertype_id)->first();
        return view('order.order_type_save',['data'=>$data]);
    }

    /**
     * @param Request $request
     * @return int
     * 订单状态修改执行
     */
    public function order_type_save_do(Request $request){
        $ordertype_id = $request ->get('ordertype_id');
        $ordertype_name = $request ->get('ordertype');
        $res = DB::table('ordertype')->where('id',$ordertype_id)->update(['time'=>time(),'name'=>$ordertype_name]);
        if($res > 0){
            return 1;
        }
    }

    /**
     * @param Request $request
     * @return int
     * 订单状态删除
     */
    public function order_type_del(Request $request){
        $ordertype_id = $request ->get('id');
        $res = DB::table('ordertype')->where('id',$ordertype_id)->update(['status'=>3]);
        if($res > 0){
            return 1;
        }
    }
    //订单方式列表
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
