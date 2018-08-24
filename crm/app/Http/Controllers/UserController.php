<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class UserController extends Controller
{
    //客户展示
    public  function user_list(){
        $data = DB::table('customer')->where(['status'=>1])->paginate(3);

        foreach($data as $k=>$v){
            $ctype = DB::table('ctype')->where(['ctype_id'=>$v->ctype_id,'status'=>1])->first();
            $v->ctype_id = $ctype->ctype_name;
            $clevel = DB::table('clevel')->where(['clevel_id'=>$v->clevel_id,'status'=>1])->first();
            $v->clevel_id = $clevel->clevel_name;
            $csource = DB::table('csource')->where(['csource_id'=>$v->csource_id,'status'=>1])->first();
            $v->csource_id = $csource->csource_name;
        }

        return view('user.user_list',['data'=>$data]);
    }
    //客户添加
    public function user_add(){
        $ctype = DB::table('ctype')->where(['status'=>1])->get();
        $clevel = DB::table('clevel')->where(['status'=>1])->get();
        $csource = DB::table('csource')->where(['status'=>1])->get();
        return view('user.user_add')->with('ctype',$ctype)->with('clevel',$clevel)->with('csource',$csource);
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
            'ctime'=>time(),
            'status'=>1
        ];
        $res = DB::table('customer')->insert($arr);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //客户删除
    public function user_del(){
        $id = input::get('id');
        $res = DB::table('customer')->where(['c_id'=>$id])->update(['status'=>3]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //修改客户
    public function user_update(){
        $id = input::get('id');
        $data = DB::table('customer')->where(['c_id'=>$id,'status'=>1])->first();
        $ctype = DB::table('ctype')->where(['status'=>1])->get();
        $clevel = DB::table('clevel')->where(['status'=>1])->get();
        $csource = DB::table('csource')->where(['status'=>1])->get();
        return view('user.user_update')->with('data',$data)->with('ctype',$ctype)->with('clevel',$clevel)->with('csource',$csource);
    }
    public function user_update_do(){
        $id = input::get('id');
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
        $res = DB::table('customer')->where(['c_id'=>$id])->update($arr);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    //类型展示
    public function ctype(){
        $data = DB::table('ctype')->where(['status'=>1])->paginate(3);
        return view('user.ctype_list')->with('data',$data);
    }
    //类型添加
    public function ctype_add(){

        return view('user.ctype_add');
    }
    public function ctype_add_do(){
        $ctype = input::get('ctype');
        $arr=[
            'ctype_name'=>$ctype,
            'status'=>1
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
        $res = DB::table('ctype')->where($arr)->update(['status'=>3]);
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
        $data = DB::table('ctype')->where($arr)->where(['status'=>1])->first();
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
        $data = DB::table('clevel')->where(['status'=>1])->paginate(3);
        return view('user.clevel_list')->with('data',$data);
    }
    //添加等级
    public function clevel_add(){
        return view('user.clevel_add');
    }
    public function clevel_add_do(){
        $clevel = input::get('clevel');
        $res = DB::table('clevel')->insert(['clevel_name'=>$clevel,'status'=>1]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //修改等级
    public function clevel_update(){
        $id = input::get('id');
        $arr = [
            'clevel_id'=>$id,
            'status'=>1
        ];
        $data = DB::table('clevel')->where($arr)->first();
        return view('user.clevel_update')->with('data',$data);
    }
    public function clevel_update_do(){
        $id = input::get('id');
        $clevel = input::get('clevel');
        $res = DB::table('clevel')->where(['clevel_id'=>$id])->update(['clevel_name'=>$clevel]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //类型删除
    public function clevel_del(){
        $id = input::get('id');
        $arr = [
            'clevel_id'=>$id,
            'status'=>1
        ];
        $res = DB::table('clevel')->where($arr)->update(['status'=>3]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //客户来源展示
    public function csource_list(){
        $data = DB::table('csource')->where(['status'=>1])->paginate(3);
        return view('user.csource_list')->with('data',$data);
    }
    //客户来源添加
    public function csource_add(){
        return view('user.csource_add');
    }
    public function csource_add_do(){
       $csource = input::get('csource');
        $res = DB::table('csource')->insert(['csource_name'=>$csource,'status'=>1]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //来源修改
    public function csource_update(){
        $id = input::get('id');
        $data = DB::table('csource')->where(['csource_id'=>$id,'status'=>1])->first();
        return view('user.csource_update')->with('data',$data);
    }
    public function csource_update_do(){
        $id = input::get('id');
        $csource = input::get('csource');
        $res = DB::table('csource')->where(['csource_id'=>$id])->update(['csource_name'=>$csource]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //来源删除
    public function csource_del(){
        $id = input::get('id');
        $arr = [
            'csource_id'=>$id,
            'status'=>1
        ];
        $res = DB::table('csource')->where($arr)->update(['status'=>3]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

}
