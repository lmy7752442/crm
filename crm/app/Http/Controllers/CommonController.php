<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;

class CommonController extends BaseController
{
    public function __construct(Request $request){
//        echo 123;die;
        //放非法登陆
        $this->middleware(function ($request, $next) {
            $u_id = $request->session() -> get('a_id');
//            print_r($u_id);exit;
            if(empty($u_id)) {
                echo "<script>alert('你还没有登录，请先登录');location.href='/login';</script>";
//                redirect('/login')->send();
            }
//
//            //权限
//            $url = $_SERVER;
////            print_r($url);exit;
//            $data = Db::table('admin')
//                -> join('role', 'role.a_id', '=', 'admin.a_id')
//                -> join('power', 'role.power_id', '=', 'power.power_id')
//                -> where('admin.a_id',$u_id)
//                -> first();
////            print_r($data);exit;
////            $new_data = json_decode($data,true);
////            print_r($new_data);exit;
//            $a = explode(',',$data -> power_id);
////            print_r($a);exit;
//            $power_data = Db::table('power') -> whereIn('power_id',$a) -> get();
////            print_r($power_data);exit;
//            foreach($power_data as $k=>$v){
//                $default[]=$v -> p_rule;
//            }
//            print_r($default);exit;
//            if(!in_array($url,$default)){
//                exit('没有权限') ;
//            }
////            //print_r($default);
////
            return $next($request);
        });
    }

}