<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
//    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /** 防非法登录 */
//    function __construct(Request $request){
//        parent::__construct();
//
//        if(!session('?account')){
//            $this->error('请先登录',U('Login/login'));
//        }
//
//        //清空所有session
//        //Session::flush();
//
//        //删除session中指定的值
//        //Session::forget('key1');
//
//        //判断session中的某个值是否存在
//        /*if(Session::has('key1')){
//            $res = Session::all();
//            dd($res);
//        }else{
//            echo '不存在';
//        }*/
//    }

    /*
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user_data = $request->session() -> get('user_data');
            if(empty($user_data)) {
                redirect('/login')->send();
            }
            return $next($request);
        });
    }
    */

}
