<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class UserController extends Controller
{
    //客户展示
    public  function user_list(){
        return view('user.user_list');
    }
    public function user_add(){
        return view('user.user_add');
    }
    public function user_add_do(){

        $c_name = input::get('c_name');
        $c_phone = input::get('c_phone');
        //客户类型
        $ctype = input::get('ctype');
        //客户等级
        $clevel_id = input::get('clevel_id');
        //客户来源
        $csource_id = input::get('csource_id');
        //其他联系方式
        $c_other_connect = input::get('c_other_connect');
        //备注
        $c_notes = input::get('c_notes');
        $province = input::get('province');
        $city = input::get('city');
        $area = input::get('area');

        $arr = [
            'c_name'=>$c_name,
            'c_phone'=>$c_phone,
            'ctype_id'=>$ctype,
            'clevel_id'=>$clevel_id,
            'csource_id'=>$csource_id,
            'c_other_connect'=>$c_other_connect,
            'c_notes'=>$c_notes,
            'c_province'=>$province,
            'c_city'=>$city,
            'c_area'=>$area,
            'ctime'=>time()
        ];
        $res = DB::table('customer')->insert($arr);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    //类型展示
    public function ctype(){
        $data = DB::table('ctype')->get();
        return view('user.ctype_list')->with('data',$data);
    }
    //类型添加
    public function ctype_add(){

        return view('user.ctype_add');
    }
    public function ctype_add_do(){
        $ctype = input::get('ctype');
        $arr=[
            'ctype_name'=>$ctype
        ];
        $res = DB::table('ctype')->insert($arr);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //类型删除
    public function ctype_del(){
        $id = input::get('id');
        $arr = [
            'ctype_id'=>$id
        ];
        $res = DB::table('ctype')->where($arr)->delete();
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //修改类型
    public function ctype_update(){
        $id = input::get('id');
        $arr = [
            'ctype_id'=>$id
        ];
        $data = DB::table('ctype')->where($arr)->first();
        return view('user.ctype_update')->with('data',$data);
    }
    public function ctype_update_do(){
        $id = input::get('id');
        $ctype = input::get('ctype');
        $res = DB::table('ctype')->where(['ctype_id'=>$id])->update(['ctype_name'=>$ctype]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //等级展示
    public function clevel_list(){
        $data = DB::table('clevel')->get();
        return view('user.clevel_list')->with('data',$data);
    }
    public function clevel_add(){
        return view('user.clevel_add');
    }
}
