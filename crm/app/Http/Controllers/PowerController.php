<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;

class PowerController extends CommonController
{
    /** 权限添加 */
    public function power_add(){
        return view('power.power_add');
    }

    /** 执行添加 */
    public function power_add_do(){
        $data = $_GET;
//        print_r($data);exit;
        $insert_data = [
            'p_rule' => $data['p_rule'],
            'p_name' => $data['p_name']
        ];
        $res = DB::table('power')->insert($insert_data);
//            print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /** 权限展示 */
    public function power_list(){
        $res = DB::table('power')->where(['p_status'=>1])->paginate(10);
//        print_r($res);exit;
        //查询总共条数
        $count = DB::table('power')->where(['p_status'=>1])->count();
//        print_r($count);exit;
        return view('power.power_list')->with('new',$res)->with('count',$count);
    }

    /** 修改 */
    public function power_update(){
        $power_id = $_GET['power_id'];
//        print_r($power_id);exit;
        $res = DB::table('power')->where(['power_id'=>$power_id])->first();
//        print_r($res);exit;
        return view('power.power_update')->with('res',$res);
    }

    /** 执行修改 */
    public function power_update_do(){
        $data = $_GET;
//        print_r($data);exit;
        $update_data = [
            'p_rule' => $data['p_rule'],
            'p_name' => $data['p_name']
        ];
        $res = DB::table('power')->where(['power_id'=>$data['power_id']])->update($update_data);
//            print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /** 删除 */
    public function power_del(){
        $power_id = $_GET;
//        print_r($power_id);exit;
        $update_data = [
            'p_status' => 2
        ];
        $res = DB::table('power')->where(['power_id'=>$power_id])->update($update_data);
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
}
