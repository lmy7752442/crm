<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;


class Department extends BaseController{
    /** 部门添加 */
    public function department_add(){
        return view('department.department_add');
    }

    /** 执行添加 */
    public function department_add_do(){
        $data = $_GET;
//        print_r($data);exit;
        $insert_into = [
            'd_name' => $data['d_name'],
            'd_time' => date('Y-m-d')
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
        $res = DB::table('department')->paginate(5);
//        print_r($res);exit;
        //查询总共条数
        $count = DB::table('department')->count();
//        print_r($count);exit;
        return view('department.department_list')->with('new',$res)->with('count',$count);
    }

    /** 部门修改 */
    public function department_update(){
        $department_id = $_GET['department_id'];
//        print_r($department_id);exit;
        $res = DB::table('department')->where(['department_id'=>$department_id])->first();
//        print_r($res);exit;
        return view('department.department_update')->with('res',$res);
    }

    /** 执行修改 */
    public function department_update_do(){
        $data = $_GET;
//        print_r($data);exit;
        $update_data = [
            'd_name' => $data['d_name'],
            'd_time' => date('Y-m-d')
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

        $res = DB::table('department')->where(['department_id'=>$department_id])->delete();
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
}