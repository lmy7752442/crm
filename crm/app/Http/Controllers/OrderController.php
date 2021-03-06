<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;

class OrderController extends CommonController
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
        $order_data = DB::table('order')->where('status',1)->where('status','!=',3)->where($where)->where('a_id',session()->get('a_id')) ->orderBy('time','desc')-> paginate(10);
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

    public function user_order(){
        $user_id = Input::post('user_id');
        $order_data = DB::table('order')->where('status',1)->where('status','!=',3)->where('c_id' , $user_id)->orderBy('time','desc')-> paginate(10);
        $str = "<tr><td>订单编号</td><td>订单金额</td><td>实收金额</td><td>订单状态</td><td>订货方式</td><td>业务</td><td>管理</td></tr>";
        foreach($order_data as $v){
            $user_data = DB::table('customer')->where('c_id',$v->c_id)->first();
            $v->c_id = $user_data->c_name;
            $order_type = DB::table('ordertype')->where('id',$v->order_type)->first();
            $v->order_type =  $order_type->name;
            $v->a_id = session()->get('a_account');
            $str .= "<tr><td>".$v->o_number."</td><td>".$v->order_money."</td><td>".$v->instead_money."</td><td>".$v->send_type."</td><td></td><td>".$v->c_id."</td><td><a href=''>删除</a> | <a href=''>修改</a></td></tr>";
        }
        return $str;
        // dd($order_data);
        // $order_type = DB::table('ordertype')->where('status',1)->get();
        // return view('order.order_list',['order_data'=>$order_data,'order_type'=>$order_type,'order_type2'=>$order_type2,'order_number'=>$order_number,'end_time'=>$end_time,'start_time'=>$start_time]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 订单添加
     */
    public function order_add(){
		$cat=DB::table("cat")->get();
        $user_data = DB::table('customer')->where('status',1)->get();
        $order_number = time().rand(1000,9999);
        $product = DB::table('product')->where('status',1)->get();
        $order_type = DB::table('ordertype')->where('status',1)->get();
		$rand=time();
        return view('order.order_add',['user_data'=>$user_data,'order_number'=>$order_number,'product'=>$product,'order_type'=>$order_type,"cat"=>$cat,"rand"=>$rand]);
    }

    /**
     * @param Request $request
     * @return int
     * 订单添加执行
     */
    public function order_add_do(Request $request){
        $arr['o_number'] = $request->get('o_number');
        $data = (array)DB::table('order')->where('o_number',$arr['o_number'])->first();
		$info=$_GET['info'];
		foreach($info as $k=>$v){
			if(substr($k,0,5)=="pname"){
				$name[]=$v;
			}

			if(substr($k,0,3)=="num"){
				$num[]=$v;
			}
		}

		if($data){
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
        //$product_id = substr($request->get('product_id'),0,-1);
        $arr['time']=time();
        $arr['a_id']=session()->get('a_id');
        $res = DB::table('order') -> insert($arr);
        DB::table('record')->insert(['c_id'=>$arr['c_id'],'action'=>'添加订单','data_table'=>'订单表','a_id'=>$arr['a_id'],'time'=>$arr['time']]);
      for ($i=0;$i<count($name);$i++){
           DB::table('order_product')->insert(['product_id'=>$name[$i],'order_number'=>$arr['o_number'],'num'=>$num[$i]]);
      }
       return 1;
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
    public function wuliu_list(){
        $wuliu_data = DB::table('wuliu')->where('status',1)->paginate(10);
        foreach($wuliu_data as $v){
            $order_data = DB::table('order')->where('order_id',$v->order_id)->first();
            $v->order_id = $order_data->o_number;
            $wuliu_type = DB::table('wuliutype')->find($v->wuliu_id);
            $v->wuliu_id = $wuliu_type->name;
        }
        return view('order.wuliu_list',['data'=>$wuliu_data]);
    }
    public function wuliu_add(){
        $wuliutype_data = DB::table('wuliutype')->where('status',1)->get();
        $a_id = session()->get('a_id');
        $wuliustatus_data = DB::table('ordertype')->where('status',1)->get();
        $order_data = DB::table('order')->where('status',1)->where('a_id',$a_id)->get();
        return view('order.wuliu_add',['wuliutype_data'=>$wuliutype_data,'order_data'=>$order_data,'wuliustatus_data'=>$wuliustatus_data]);
    }
    public function wuliu_order(Request $request){
        $order_id = $request->get('order_id');
        $data = DB::table('order')->where('order_id',$order_id)->first();
        $user_data = DB::table('customer')->where('c_id',$data->c_id)->first();
        $arr = [
            'username'=>$user_data->c_name,
            'province'=>$user_data->c_province,
            'city'=>$user_data->c_city,
            'area'=>$user_data->c_area,
            'address'=>$user_data->address,
            'instead_money'=>$data->instead_money,
            'wuliustatus'=>$data->order_type,
            'admin' => session()->get('a_account')
        ];
        return $arr;
    }
    public function wuliu_add_do(Request $request){
        $arr['order_id'] = $request ->get('o_number');
        $arr['username'] = $request ->get('username');
        $arr['province'] = $request ->get('province');
        $arr['city'] = $request ->get('city');
        $arr['area'] = $request ->get('area');
        $arr['address'] = $request ->get('address');
        $arr['odd_number'] = $request ->get('wuliu_number');
        $arr['instead_money'] = $request ->get('instead_money');
        $arr['admin'] = $request ->get('admin');
        $arr['send_money'] = $request ->get('send_money');
        $arr['wuliu_id'] = $request ->get('wuliu_type');
        $arr['notes'] = $request ->get('notes');
        $arr['wuliustatus'] = $request ->get('wuliu_status');
        $arr['time'] = time();
        $res = DB::table('wuliu')->insert($arr);
        if($res > 0){
            return 1;
        }
    }
    public function wuliu_save(Request $request){
        $id = $request -> get('id');
        $data = DB::table('wuliu')->find($id);
        $wuliutype_data = DB::table('wuliutype')->get();
        $a_id = session()->get('a_id');
        $order_data = DB::table('order')->where('status',1)->where('a_id',$a_id)->get();
        $wuliustatus_data = DB::table('ordertype')->where('status',1)->get();
        return view('order.wuliu_save',['wuliutype_data'=>$wuliutype_data,'order_data'=>$order_data,'data'=>$data,'wuliustatus_data'=>$wuliustatus_data]);
    }
    public function wuliu_save_do(Request $request){
        $id = $request ->get('id');
        $arr['order_id'] = $request ->get('o_number');
        $arr['username'] = $request ->get('username');
        $arr['province'] = $request ->get('province');
        $arr['city'] = $request ->get('city');
        $arr['area'] = $request ->get('area');
        $arr['address'] = $request ->get('address');
        $arr['odd_number'] = $request ->get('wuliu_number');
        $arr['instead_money'] = $request ->get('instead_money');
        $arr['admin'] = $request ->get('admin');
        $arr['send_money'] = $request ->get('send_money');
        $arr['wuliu_id'] = $request ->get('wuliu_type');
        $arr['notes'] = $request ->get('notes');
        $arr['wuliustatus'] = $request ->get('wuliu_status');
        $res = DB::table('wuliu')->where('id',$id)->update($arr);
        if($res > 0){
            return 1;
        }
    }
    public function wuliu_del(Request $request){
        $id = $request->get('id');
        $res = DB::table('wuliu')->where('id',$id)->update(['status'=>3]);
        if($res > 0){
            return 1;
        }
    }
    public function wuliu_type_add(){
        return view('order.wuliu_type_add');
    }
    public function wuliu_type_add_do(Request $request){
        $name = $request ->get('name');
        $data = DB::table('wuliutype')->where('name',$name)->first();
        if(!empty($data)){
            return 2;
        }
        $res = DB::table('wuliutype')->insert(['name'=>$name,'time'=>time()]);
        if($res > 0){
            return 1;
        }
    }

	//商品
	public function goods_add(){
		$rand=time();
		print_r($rand);exit;
		return view("order.goods_add",["rand"=>$rand]);
	}

	//订单详情
	public function order_view(){
		$id=input::get("id");
		
		$res=DB::table("order_product")->where(['order_number'=>$id])->join("product as a","a.product_id","=","order_product.product_id")->paginate(6);

		//print_r($res); exit;

		return view("order/order_view",["res"=>$res]);
	}

	//chuhuodan
	public function order_product(){
		$order_number=input::get("order_number");
		//$p_id=input::get("id");
		//echo $order_number.$p_id;
		$where=["o_number"=>$order_number];
		$res=(array)DB::table("order")
			->where($where)
			->join("customer","order.c_id","=","customer.c_id")
			->first();

		$product=json_decode(DB::table("order_product")->where(['order_number'=>$order_number])->join("product as a","a.product_id","=","order_product.product_id")->get(),true);
		foreach($product as $k=>$v){
			$product[$k]['xulie']=$k+1;
		}
		//print_r($product);exit;

		$admin=json_decode(DB::table("admin")->get(),true);
		foreach($admin as $k=>$v){
			$new[$v['a_id']]=$v['a_account'];
		}
		return view("order.order_product",["res"=>$res,"product"=>$product,"admin"=>$new]);
	}

	public function del_opro(){
		$id=input::get("id");
		$order_number=input::get("order_number");
		$res=DB::table("order_product")->where(["product_id"=>$id,"order_number"=>$order_number])->delete();
		if($res){
			return 1;
		}
	}
}
