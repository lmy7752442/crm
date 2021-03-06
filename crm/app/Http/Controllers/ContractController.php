<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class ContractController extends CommonController
{
    //合同展示
    public function contract_list(){
        $data = DB::table('contract')->where(['status'=>1,])->where('a_id',session()->get('a_id'))->orderByRaw('ctime DESC')->paginate(10);
        foreach($data as $k=>$v){
            $customer = DB::table('customer')->where(['c_id'=>$v->customer_id,'status'=>1])->first();
            $v->customer_id = $customer->c_name;
            $contype = DB::table('contype')->where(['contype_id'=>$v->contype_id,'status'=>1])->first();
            $v->contype_id = $contype->contype_name;
            $a_id = DB::table('admin')->where(['a_id'=>$v->a_id])->first();
            $v->a_id = $a_id->a_name;
        }
        return view('contract.contract_list')->with('data',$data);
    }

        //合同展示
    public function user_contract(){
        $user_id = Input::post('user_id');
        $data = DB::table('contract')->where(['status'=>1,'customer_id'=>$user_id])->orderByRaw('ctime DESC')->paginate(10);
        $str = "<tr><td>客户</td><td>定金</td><td>返利</td><td>合同类型</td><td>起始时间</td><td>到期时间</td><td>业务</td></tr>";
        foreach($data as $k=>$v){
            $customer = DB::table('customer')->where(['c_id'=>$v->customer_id,'status'=>1])->first();
            $v->customer_id = $customer->c_name;
            $contype = DB::table('contype')->where(['contype_id'=>$v->contype_id,'status'=>1])->first();
            $v->contype_id = $contype->contype_name;
            $a_id = DB::table('admin')->where(['a_id'=>$v->a_id])->first();
            $v->a_id = $a_id->a_name;
            $str .= "<tr><td>".$v->customer_id."</td><td>".$v->c_deposit."</td><td>".$v->c_rebate."</td><td>".$v->contype_id."</td><td>".$v->c_ctime."</td><td>".$v->c_utime."</td><td>".$v->a_id."</td></tr>";
        }

        return $str;
        // dd($data);
        // return view('contract.contract_list')->with('data',$data);
    }

    //合同添加
    public function contract_add(){
        $data = DB::table('customer')->where(['status'=>1])->get();
        $arr = DB::table('contype')->where(['status'=>1])->get();
        return view('contract.contract_add')->with('data',$data)->with('arr',$arr);
    }
    public function contract_add_do(Request $request){
        $a_id = $request->session()->get('a_id');
        $customer_id = input::get('customer_id');
        $contype_id = input::get('contype_id');
        $c_deposit = input::get('c_deposit');
        $c_rebate = input::get('c_rebate');
        $c_ctime = input::get('c_ctime');
        $c_utime = input::get('c_utime');
        $arr = [
            'customer_id'=>$customer_id,
            'contype_id'=>$contype_id,
            'c_deposit'=>$c_deposit,
            'c_rebate'=>$c_rebate,
            'c_ctime'=>$c_ctime,
            'c_utime'=>$c_utime,
            'ctime'=>time(),
            'status'=>1,
            'a_id'=>$a_id
        ];
        $res = DB::table('contract')->insert($arr);
        if($res){
            $arr2 = [
                'c_id'=>$customer_id,
                'action'=>'合同添加',
                'data_table'=>'合同表',
                'a_id'=>$a_id,
                'status'=>1,
                'time'=>time()
            ];
           $ressult =  DB::table('record')->insert($arr2);
            echo 1;
        }else{
            echo 2;
        }
    }
    //合同删除
    public function contract_del(Request $request){
        $a_id = $request->session()->get('a_id');
        $id = input::get('id');
        $res = DB::table('contract')->where(['contract_id'=>$id])->update(['status'=>3]);
        if($res){
            $arr2 = [
                'c_id'=>$id,
                'action'=>'合同删除',
                'data_table'=>'合同表',
                'a_id'=>$a_id,
                'status'=>1,
                'time'=>time()
            ];
            $ressult =  DB::table('record')->insert($arr2);
            echo 1;
        }else{
            echo 2;
        }
    }
    //合同修改
    public function contract_update(){
        $id = input::get('id');
        $data = DB::table('contract')->where(['contract_id'=>$id])->first();
        $contype = DB::table('contype')->where(['status'=>1])->get();
        $customer = DB::table('customer')->where(['status'=>1])->get();
        return view('contract.contract_update')->with('data',$data)->with('contype',$contype)->with('customer',$customer);
    }
    public function contract_update_do(Request $request){
        $a_id = $request->session()->get('a_id');
        $customer_id = input::get('customer_id');
        $contype_id = input::get('contype_id');
        $c_deposit = input::get('c_deposit');
        $c_rebate = input::get('c_rebate');
        $c_ctime = input::get('c_ctime');
        $c_utime = input::get('c_utime');
        $id = input::get('id');
        $arr = [
            'customer_id'=>$customer_id,
            'contype_id'=>$contype_id,
            'c_deposit'=>$c_deposit,
            'c_rebate'=>$c_rebate,
            'c_ctime'=>$c_ctime,
            'c_utime'=>$c_utime,
            'ctime'=>time(),
        ];
        $res = DB::table('contract')->where(['contract_id'=>$id])->update($arr);
        if($res){
            $arr2 = [
                'c_id'=>$customer_id,
                'action'=>'合同修改',
                'data_table'=>'合同表',
                'a_id'=>$a_id,
                'status'=>1,
                'time'=>time()
            ];
            $ressult =  DB::table('record')->insert($arr2);
            echo 1;
        }else{
            echo 2;
        }
    }
}
