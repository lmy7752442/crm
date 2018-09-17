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

//            $c = '';
//            for($i=10;$i<=141;$i++){
//                $c .= $i.',';
//            }
//            // 134
//            $c = rtrim($c,',');
//            print_r($c);exit;


            //权限
            $r_url = $_SERVER['REQUEST_URI'];
            $num = strpos($r_url,"?");
            $url = $r_url;
            if($num){
                $url = substr($r_url,0,$num);
            }
            $data = (array)Db::table('admin')
                -> join('role', 'admin.role_id', '=', 'role.role_id')
//                -> join('power', 'role.power_id', '=', 'power.power_id')
                -> where('admin.a_id',$u_id)
                -> first();
//            print_r($data);exit;
            //当前管理员 权限id
            $power_id = explode(',',$data['power_id']);
//            print_r($power_id);exit;

            $power_data = Db::table('power') -> whereIn('power_id',$power_id) -> get();
//            print_r($power_data);exit;
            $default=[
                ## 登陆 10,11,12,40,116
                '/',
                '/notpower',
                '/login',
                '/login_do',
                '/login_out',
                '/welcome',
                ## 统计 135
                '/count_list',
                ## 客户建议 21
                '/advince_list',
                ## 客户 70
                '/user_list',
                ## 客户类型 76
                '/ctype_list',
                ## 客户等级 82
                '/clevel_list',
                ## 客户来源 88
                '/csource_list',
                ## 合同 106
                '/contract_list',
                ## 合同类型 94
                '/contype_list',
                ## 产品 100
                '/product_list',
                ## 共享 126
                '/share_list',
                ## 公海 128 129 130 131 132
                '/seas_list',
                '/seas_add',
                '/seas_del',
                '/seas_update',
                '/seas_update_do',
                ## 公告 136
                '/publicnotice_list',
                ## 跟单 47
                '/documentary_list',
                ## 跟单类型 48
                '/documentary_dtype_list',
                ## 跟单进度 54
                '/documentary_dprogress_list',
                ## 订单 60
                '/order_list',
                ## 订单状态 120
                '/order_type_list',
                ## 订单方式 64
                '/order_mode_list',
                ## 物流 143,144,145,146,147,148,149,150,151
                '/wuliu_list',
                '/wuliu_add',
                '/wuliu_order',
                '/wuliu_add_do',
                '/wuliu_save',
                '/wuliu_save_do',
                '/wuliu_del',
                '/wuliu_type_add',
                '/wuliu_type_add_do',
                ## 个人中心 156,157,158
                '/personal',
                '/personal_update',
                '/personal_update_do',
				'/category',
				'/category_add',
				'/sel_cat',
				'/seo_cat',
				'/add_goods',
				'/seo_goods',
				'/order_view',
				'/order_product',
				'/del_opro',
            ];
            foreach($power_data as $k=>$v){
                $default[]=$v -> p_rule;
            }
         //print_r($default);
         //  echo $url;exit;

            if(!in_array($url,$default)){
                exit('没有权限'.$url) ;
               return redirect('/notpower');
            }
            //print_r($default);

            return $next($request);
        });
    }
 
}