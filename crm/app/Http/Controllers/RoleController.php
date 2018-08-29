<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;

class RoleController extends CommonController
{
    /** 显示角色添加页面 */
    public function role_add(){
        //查询权限数据
        $not = [
            10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,47,48,54,60,64,70,76,82,88,94,100,106,116,120,126,128,129,130,131,132,133,135,136,142
        ];
        $data = DB::table('power')->whereNotIn('power_id',$not)->get();
        //查询管理员数据
        $admin = DB::table('admin')->get();
        return view("Role.role_add")->with('data',$data)->with('admin',$admin);
    }

    /** 执行添加 */
    public function role_add_do(){
        $data = $_GET;
        $insert_data = [
            'r_name' => $data['r_name_arr'],
            'power_id' => $data['power_id_arr']
        ];
        $where = [
            'power_id' => $data['power_id_arr']
        ];
        //根据管理员id查询有没有数据
        $find = DB::table('role')->where(['r_name'=>$data['r_name_arr']])->first();
        if($find){
            $res = DB::table('role')->where(['r_name'=>$data['r_name_arr']])->update($where);
            return 1;
        }else{
            $res = DB::table('role')->insert($insert_data);
//            print_r($res);exit;
            if($res){
                return 1;
            }else{
                return 2;
            }
        }
    }

    /** 角色展示 */
    public function role_list(){
//        $res = DB::table('role')->join('power', 'role.power_id', '=', 'power.power_id')->where(['r_status'=>1])->paginate(5);
//        print_r($res);exit;
        $new = DB::table('role')->where('r_status',1)->paginate(10);

//        foreach($new as $k=>$v ){
//            $str = '';
//            $arr = explode(',',$v['power_id']);
//            $data = DB::table('power')->whereIn('power_id',$arr)->get();
//            foreach($data as $vv){
//                $str .= $vv->p_name.',';
//            }
//            $new[$k]['power_id']= $str;
//        }
//        print_r($data);exit;

//        print_r($new);exit;
        //查询总共条数
        $count = DB::table('role')->where(['r_status'=>1])->count();
//        print_r($count);exit;
        return view('role.role_list')->with('new',$new)->with('count',$count);
    }

    /** 修改 */
    public function role_update(){
        $role_id = $_GET['role_id'];
//        print_r($role_id);exit;
        $res = (array)DB::table('role')->where(['role_id'=>$role_id])->first();
//        print_r($res);exit;
        //查询权限表数据
        $power = DB::table('power')->get();
//        print_r($power);exit;
        $new = json_decode($power,true);
//        print_r($new);exit;
        $power_id = explode(',',$res['power_id']);
//        print_r($power_id);exit;
        foreach($new as $key=>$val){
            $new[$key]['a'] = '';
        }
        for($i=0;$i<count($power_id);$i++){
            foreach($new as $k=>$v){
                if($v['power_id']==$power_id[$i]){
                    $new[$k]['a'] = 'checked';
                }
            }
        }
//        print_r($new);exit;

        return view('role.role_update')->with('res',$res)->with('new',$new);
    }

    /** 执行修改 */
    public function role_update_do(){
        $data = $_GET;
//        print_r($data);
        $update_data = [
            'r_name' => $data['r_name_arr'],
            'power_id' => $data['power_id_arr']
        ];
//        print_r($update_data);exit;
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
        $update_data = [
            'r_status' => 2
        ];
        //根据角色id查询有没有相关数据
        $data = DB::table('role')->where(['role.role_id'=>$role_id])->join('admin', 'role.role_id', '=', 'admin.role_id')->first();
//       print_r($data);exit;
        if($data){
            return 3;
        }else{
            $res = DB::table('role')->where(['role_id'=>$role_id])->update($update_data);
//        print_r($res);exit;
            if($res){
                return 1;
            }else{
                return 2;
            }
        }
    }
}
