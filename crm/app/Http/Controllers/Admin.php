<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;


class Admin extends BaseController
{
    /** 显示登录页面 */
    public function login(){
        return view("admin.login");
    }

    /** 执行登录 */
    public function login_do(Request $request){
        $data = $_POST;
//        print_r($data);exit;
        $find_data = [
            'a_account' => $data['a_account'],
            'a_pwd' => $data['a_pwd']
        ];
//        print_r($find_data);exit;
        $res = DB::table('admin')->where($find_data)->first();
//        print_r($res);exit;
        $old = json_encode($res,true);
        $new = json_decode($old,true);
//        print_r($new);exit;
        if($new){
            # 将 a_id a_account 存入到session中
            $request->session()->put(['a_id'=>$new['a_id'],'a_account'=>$new['a_account']]);
            echo "登录成功";
            header("refresh:2;url=/");
        }else{
            echo "登录失败";
            header("refresh:2;url=/login");
        }
    }

    /** 退出 */
    public function login_out(){

    }

    /** 管理员添加 */
    public function admin_add(){
        return view('admin.admin_add');
    }

    /** 执行添加 */
    public function admin_add_do(){
        $data = $_GET;
//        print_r($data);exit;
        if($data['a_pwd'] == $data['a_repwd']){
            $insert_data = [
                'a_account' => $data['a_account'],
                'a_phone' => $data['a_phone'],
                'a_name' => $data['a_name'],
                'a_birthday' => $data['a_birthday'],
                'a_email' => $data['a_email'],
                'a_pwd' => $data['a_pwd'],
                'a_address' => $data['a_address'],
                'a_idcard' => $data['a_idcard'],
                'a_client_num' => $data['a_client_num'],
            ];
            $res = DB::table('admin')->insert($insert_data);
//            print_r($res);exit;
            if($res){
                return 1;
            }else{
                return 2;
            }
        }else{
            return 3;
        }
    }

    /** 管理员展示列表 */
    public function admin_list(Request $request){
        $res = DB::table('admin')->paginate(5);
//        print_r($res);exit;
        //查询总共条数
        $count = DB::table('admin')->count();
//        print_r($count);exit;
        return view('admin.admin_list')->with('new',$res)->with('count',$count);
    }

    /** 管理员修改 */
    public function admin_update(){
        $a_id = $_GET['a_id'];
//        print_r($a_id);exit;
        $res = DB::table('admin')->where(['a_id'=>$a_id])->first();
//        print_r($res);exit;
        return view('admin.admin_update')->with('res',$res);
    }

    /** 管理员执行修改 */
    public function admin_update_do(){
        $data = $_GET;
//        print_r($data);exit;
        $update_data = [
            'a_account' => $data['a_account'],
            'a_phone' => $data['a_phone'],
            'a_name' => $data['a_name'],
            'a_birthday' => $data['a_birthday'],
            'a_email' => $data['a_email'],
            'a_pwd' => $data['a_pwd'],
            'a_address' => $data['a_address'],
            'a_idcard' => $data['a_idcard'],
            'a_client_num' => $data['a_client_num'],
        ];
        $res = DB::table('admin')->where(['a_id'=>$data['a_id']])->update($update_data);
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /** 管理员删除 */
    public function admin_del(){
        $a_id = $_GET;
//        print_r($a_id);exit;
        $res = DB::table('admin')->where(['a_id'=>$a_id])->delete();
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
}
