<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;


class Common extends BaseController
{
    public function __construct(){
//        echo 123;die;
        $this->middleware(function ($request, $next) {
            $user_data = $request->session() -> get('a_id');
            if(empty($user_data)) {
                echo "<script>alert('你还没有登录，请先登录');location.href='/login';</script>";
//                redirect('/login')->send();
            }
            return $next($request);
        });
    }

}