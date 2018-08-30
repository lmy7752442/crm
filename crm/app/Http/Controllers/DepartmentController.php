<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;


class DepartmentController extends CommonController
{
    /** 部门添加 */
    public function department_add(){
        //查询管理员数据
        $admin = DB::table('admin')->where(['a_status'=>1])->get();
//        print_r($admin);exit;
        //查询角色数据
        $role = DB::table('role')->get();
//        print_r($role);exit;
        return view('department.department_add')->with('role',$role)->with('admin',$admin);
    }

    /** 执行添加 */
    public function department_add_do(){
        $data = $_GET;
//        print_r($data);exit;
        $insert_into = [
            'd_name' => $data['d_name'],
            'd_time' => date('Y-m-d'),
            'a_id' => $data['a_id'],
            'role_id' => $data['role_id'],
        ];
        $res = DB::table('department')->insert($insert_into);
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /** 部门展示 */
    public function department_list(){
        $res = DB::table('department')->join('role', 'department.role_id', '=', 'role.role_id')->join('admin', 'department.a_id', '=', 'admin.a_id')->where(['d_status'=>1])->paginate(10);
//        print_r($res);exit;
        //查询总共条数
        $count = DB::table('department')->where(['d_status'=>1])->count();
//        print_r($count);exit;
        return view('department.department_list')->with('new',$res)->with('count',$count);
    }

    /** 部门修改 */
    public function department_update(){
        $department_id = $_GET['department_id'];
//        print_r($department_id);exit;
        $res = DB::table('department')->join('role', 'department.role_id', '=', 'role.role_id')->join('admin', 'department.a_id', '=', 'admin.a_id')->where(['department_id'=>$department_id])->first();
//        print_r($res);exit;
        //查询管理员数据
        $admin = DB::table('admin')->get();
//        print_r($admin);exit;
        //查询角色数据
        $role = DB::table('role')->get();
//        print_r($role);exit;
        return view('department.department_update')->with('res',$res)->with('role',$role)->with('admin',$admin);
    }

    /** 执行修改 */
    public function department_update_do(){
        $data = $_GET;
//        print_r($data);exit;
        $update_data = [
            'd_name' => $data['d_name'],
            'd_time' => date('Y-m-d'),
            'a_id' => $data['a_id'],
            'role_id' => $data['role_id'],
        ];
        $res = DB::table('department')->where(['department_id'=>$data['department_id']])->update($update_data);
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /** 删除 */
    public function department_del(){
        $department_id = $_GET;
//        print_r($department_id);exit;
        $update_data = [
            'd_status' => 2
        ];
        //根据部门id查询有没有相关数据
        $data = DB::table('department')->join('role', 'department.role_id', '=', 'role.role_id')->join('admin', 'department.a_id', '=', 'admin.a_id')->where(['d_status'=>1])->paginate(5)->first();
//       print_r($data);exit;
        if($data){
            return 3;
        }else{
            $res = DB::table('department')->where(['department_id'=>$department_id])->update($update_data);
//        print_r($res);exit;
            if($res){
                return 1;
            }else{
                return 2;
            }
        }
    }
}