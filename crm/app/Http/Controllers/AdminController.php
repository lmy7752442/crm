<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;


class AdminController extends CommonController
{
    /** 管理员添加 */
    public function admin_add(){
        //查询角色数据
        $role = DB::table('role')->where(['r_status'=>1])->get();
//        print_r($role);exit;
        return view('admin.admin_add')->with('role',$role);
    }

    /** 执行添加 */
    public function admin_add_do(){
        $data = $_GET;
//        print_r($data);exit;
        if($data['a_pwd'] == $data['a_repwd']){
            $insert_data = [
                'a_account' => $data['a_account'],
                'role_id' => $data['role_id'],
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
        $res = DB::table('admin')->where(['a_status'=>1])->join('role', 'admin.role_id', '=', 'role.role_id')->paginate(10);
//        print_r($res);exit;
        //查询总共条数
        $count = DB::table('admin')->where(['a_status'=>1])->count();
//        print_r($count);exit;
        return view('admin.admin_list')->with('new',$res)->with('count',$count);
    }

    /** 管理员修改 */
    public function admin_update(){
        $a_id = $_GET['a_id'];
//        print_r($a_id);exit;
        $res = DB::table('admin')->where(['a_id'=>$a_id])->join('role', 'admin.role_id', '=', 'role.role_id')->first();
//        print_r($res);exit;
        //查询角色数据
        $role = DB::table('role')->where(['r_status'=>1])->get();
//        print_r($role);exit;
        return view('admin.admin_update')->with('res',$res)->with('role',$role);
    }

    /** 管理员执行修改 */
    public function admin_update_do(){
        $data = $_GET;
//        print_r($data);exit;
        $update_data = [
            'a_account' => $data['a_account'],
            'role_id' => $data['role_id'],
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
        $update_data = [
            'a_status' => 2
        ];
        $res = DB::table('admin')->where(['a_id'=>$a_id])->update($update_data);
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /** 客户建议添加 */
    public function advince_add(Request $request){
        //获取当前管理员id
        $a_id = $request->session()->get('a_id');
        //获取所有客户id
        $c_data = DB::table('customer')->where(['a_id'=>$a_id])->get();
//        print_r($c_data);exit;
        return view('admin.advince_add')->with('data',$c_data);
    }

    /** 客户建议执行添加 */
    public function advince_add_do(Request $request){
        $data = $_GET;
//        print_r($data);exit;
        //获取当前管理员id
        $a_id = $request->session()->get('a_id');
        $insert_data = [
            'a_main' => $data['a_main'],
            'a_advince' => $data['a_advince'],
            'a_ctime' => time(),
            'a_solve' => time(),
            'a_id' => $a_id,
            'c_id' => $data['c_id']
        ];
//        print_r($insert_data);exit;
        $res = DB::table('advince')->insert($insert_data);
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /** 客户建议展示 */
    public function advince_list(Request $request){
        //获取当前管理员id
        $a_id = $request->session()->get('a_id');
        $a_account = $request->session()->get('a_account');
        $res = DB::table('advince')->leftJoin('customer', 'advince.c_id', '=', 'customer.c_id')->where(['a_status'=>1,'advince.a_id'=>$a_id])->paginate(5);
//        print_r($res);exit;
        //查询总共条数
        $count = DB::table('advince')->where(['a_status'=>1,'a_id'=>$a_id])->count();
//        print_r($count);exit;
        return view('admin.advince_list')->with('new',$res)->with('count',$count)->with('a_account',$a_account)->with('res',$res);
    }

    /** 客户建议删除 */
    public function advince_del(){
        $a_id = $_GET['advince_id'];
//        print_r($a_id);exit;
        $update_data = [
            'a_status' => 2
        ];
        $res = DB::table('advince')->where(['advince_id'=>$a_id])->update($update_data);
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
}
