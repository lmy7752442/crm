<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;


class LoginController extends BaseController
{
    /** 显示登录页面 */
    public function login(){
        return view("admin.login");
    }

    /** 执行登录 */
    public function login_do(Request $request){
        $data = $_GET;
        $find_data = [
            'a_account' => $data['a_account'],
            'a_pwd' => $data['a_pwd'],
            'a_status' => 1
        ];
        $res = DB::table('admin')->where($find_data)->first();
        $old = json_encode($res,true);
        $new = json_decode($old,true);
        if($new){
            # 将 a_id a_account 存入到session中
            $request->session()->put(['a_id'=>$new['a_id'],'a_account'=>$new['a_account']]);
            $a_id = $new['a_id'];
            $arr = [
                'a_id'=>$a_id,
                'time'=>time(),
                'ip'=>$data['ip'],
                'status'=>1
            ];
            DB::table('login_log')->insert($arr);
            return 1;
        }else{
            return 2;
        }
    }
    /** 退出 */
    public function login_out(Request $request){
        //获取当前管理员id
        $a_id = $request->session()->get('a_id');
//        print_r($a_id);exit;
        $where = [
            'a_id' => $a_id
        ];
        $update_data = [
            'a_status' => 1
        ];
        $res = DB::table('admin')->where($where)->update($update_data);
//        print_r($res);exit;
        $request->session()->forget('a_id');
        $request->session()->forget('a_account');
        $a_id = $request->session()->has('a_id');
        if($a_id){
            return 2;
        }else{
            return 1;
        }
    }

}