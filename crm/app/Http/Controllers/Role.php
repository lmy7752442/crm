<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;

class Role extends BaseController
{
    /** 显示角色添加页面 */
    public function role_add(){
        //查询权限数据
        $data = DB::table('power')->get();
//        print_r($data);exit;
        return view("Role.role_add")->with('data',$data);
    }

    /** 执行添加 */
    public function role_add_do(){
        $data = $_GET;
//        print_r($data);exit;
        $insert_data = [
            'r_name' => $data['r_name'],
            'power_id' => $data['power_id']
        ];
        $res = DB::table('role')->insert($insert_data);
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /** 角色展示 */
    public function role_list(){
        $res = DB::table('role')->leftJoin('power', 'role.power_id', '=', 'power.power_id')->paginate(5);
//        print_r($res);exit;
        //查询总共条数
        $count = DB::table('role')->count();
//        print_r($count);exit;
        return view('role.role_list')->with('new',$res)->with('count',$count);
    }

    /** 修改 */
    public function role_update(){
        $role_id = $_GET['role_id'];
//        print_r($role_id);exit;
        $res = DB::table('role')->where(['role_id'=>$role_id])->leftJoin('power', 'role.power_id', '=', 'power.power_id')->first();
//        print_r($res);exit;
        //查询权限表数据
        $power = DB::table('power')->get();
//        print_r($power);exit;
        return view('role.role_update')->with('res',$res)->with('power',$power);
    }

    /** 执行修改 */
    public function role_update_do(){
        $data = $_GET;
//        print_r($data);exit;
        $update_data = [
            'r_name' => $data['r_name'],
            'power_id' => $data['power_id']
        ];
        $res = DB::table('role')->where(['role_id'=>$data['role_id']])->update($update_data);
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /** 删除 */
    public function role_del(){
        $role_id = $_GET;
//        print_r($role_id);exit;
        $res = DB::table('role')->where(['role_id'=>$role_id])->delete();
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
}
