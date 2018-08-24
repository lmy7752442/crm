<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DocumentaryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 跟单展示
     */
    public function documentary_list(Request $request){
        $start_time = $request->get('start_time');
        $end_time = $request->get('end_time');
        $username = $request->get('username');
        $where = ['status'=>1];
        if(!empty($start_time)){
            $start_time = strtotime($start_time);
            $where[] = ['d_time','>',$start_time];
        }
        if(!empty($end_time)){
            $end_time = strtotime($end_time);
            $where[] = ['d_time','<',$end_time];
        }

        $documentary_data = DB::table('documentary') -> where($where) -> orderBy('d_time','desc') -> paginate(10);
        if(!empty($username)){
            $user_data = DB::table('customer')->where('c_name','like',"%$username%")->get();
            $str = '';
            foreach($user_data as $v){
                $str .= $v->c_id.',';
            }
            $str = rtrim($str,',');
            $str_arr = explode(',',$str);
            $documentary_data = DB::table('documentary') -> where($where) ->whereIn('c_id',$str_arr) -> orderBy('d_time','desc') -> paginate(10);
        }
        foreach ($documentary_data as $v){
            $user_data = DB::table('customer')->where('c_id',$v->c_id)->first();
            $v->c_id = $user_data->c_name;
            $admin_data = DB::table('admin')->where('a_id',$v->admin_id)->first();
            $v->admin_id = $admin_data->a_account;
            $dtype_data = DB::table('dtype')->where('dtype_id',$v->dtype_id)->first();
            $v->dtype_id = $dtype_data->dtype_name;
            $dprogress_data = DB::table('dprogress')->where('dprogress_id',$v->dprogress_id)->first();
            $v->dprogress_id = $dprogress_data->dprogress_name;
            $v->d_nexttime = date('Y-m-d H:i:s',$v->d_nexttime);
            $v->d_time = date('Y-m-d H:i:s',$v->d_time);
        }
        if($where == ['status'=>1] && empty($username)){
            return view('documentary.documentary_list',['documentary_data'=>$documentary_data]);
        }else{
            return view('documentary.documentary_list_where',['documentary_data'=>$documentary_data]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 跟单添加
     */
    public function documentary_add(){
        $admin_data = DB::table('customer')->get();
        $dtype_data = DB::table('dtype')->get();
        $dprogress_data = DB::table('dprogress')->get();
        return view('documentary.documentary_add',['admin_data'=>$admin_data,'dtype_data'=>$dtype_data,'dprogress_data'=>$dprogress_data]);
    }

    /**
     * @param Request $request
     * @return array
     * 跟单添加执行
     */
    public function documentary_add_do(Request $request){
        $warn = $request -> get('warn');
        $user = $request -> get('user');
        $dtype = $request -> get('dtype');
        $dprogress = $request -> get('dprogress');
        $content = $request -> get('content');
        $next_time = strtotime($request -> get('next_time'));
        $admin = 1;
        $res = DB::table('documentary')
            ->insert([
                'd_nexttime'=>$next_time,
                'd_detailed'=>$content,
                'd_time'=>time(),
                'dprogress_id'=>$dprogress,
                'dtype_id'=>$dtype,
                'c_id'=>$user,
                'admin_id'=>$admin,
                'warn'=>$warn,
                'status'=>1
            ]);
        if($res>0){
            $data = DB::table('documentary')->where('status',1)->orderBy('d_time','desc')->limit(10)->get();
            foreach ($data as $v){
                $user_data = DB::table('customer')->where('c_id',$v->c_id)->first();
                $v->c_id = $user_data->c_name;
                $admin_data = DB::table('admin')->where('a_id',$v->admin_id)->first();
                $v->admin_id = $admin_data->a_account;
                $dtype_data = DB::table('dtype')->where('dtype_id',$v->dtype_id)->first();
                $v->dtype_id = $dtype_data->dtype_name;
                $dprogress_data = DB::table('dprogress')->where('dprogress_id',$v->dprogress_id)->first();
                $v->dprogress_id = $dprogress_data->dprogress_name;
                $v->d_nexttime = date('Y-m-d H:i:s',$v->d_nexttime);
                $v->d_time = date('Y-m-d H:i:s',$v->d_time);
            }
            $str2 = '';
            $num = 0;
            foreach($data as $v){
                $num = $num+1;
                $str2 .= "<tr>
            <td>
                <div class='layui-unselect layui-form-checkbox' lay-skin='primary' data-id='2'><i class='layui-icon'>&#xe605;</i></div>
            </td>
            <td>$num</td>
            <td>$v->c_id</td>
            <td>$v->dtype_id</td>
            <td>$v->dprogress_id</td>
            <td>$v->d_nexttime</td>
            <td>$v->d_detailed</td>
            <td>$v->admin_id</td>
            <td>$v->d_time</td>
            <td>
                <a title='编辑'  onclick=\"x_admin_show('编辑','documentary_save?id=$v->documentary_id&num=$num')\" href='javascript:;'>
                    <i class='layui-icon'>&#xe642;</i>
                </a>
                <a title='删除' onclick=\"member_del(this,'$v->documentary_id')\"  href='javascript:;'>
                    <i class='layui-icon'>&#xe640;</i>
                </a>
            </td>
        </tr>";
            }
            $arr = [
                'data' => $str2,
                'status'=>1
            ];
            return $arr;
        }
    }

    /**
     * @param Request $request
     * @return string
     * 跟单删除
     */
    public function documentary_del(Request $request){
        $documentary_id = $request->get('documentary_id');
        $res = DB::table('documentary')->where('documentary_id',$documentary_id)->update(['status'=>3]);
        if($res > 0 ){
            return '1';
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 跟单修改
     */
    public function documentary_save(Request $request){
        $documentary_id = $request->get('id');
        $num = $request->get('num');
        $documentary_data = DB::table('documentary')->where('documentary_id',$documentary_id)->first();
        $admin_data = DB::table('customer')->get();
        $dtype_data = DB::table('dtype')->get();
        $dprogress_data = DB::table('dprogress')->get();
        return view('documentary.documentary_save',['admin_data'=>$admin_data,'dtype_data'=>$dtype_data,'dprogress_data'=>$dprogress_data,'documentary_data'=>$documentary_data,'num'=>$num]);
    }

    /**
     * @param Request $request
     * @return array
     * 跟单修改执行
     */
    public function documentary_save_do(Request $request){
        $documentary_id = $request->get('id');
        $num= $request->get('num');
        $warn = $request -> get('warn');
        $user = $request -> get('user');
        $dtype = $request -> get('dtype');
        $dprogress = $request -> get('dprogress');
        $content = $request -> get('content');
        $next_time = strtotime($request -> get('next_time'));
        $admin = session()->get('a_id');
        $res = DB::table('documentary')->where('documentary_id',$documentary_id)
            ->update([
                'd_nexttime'=>$next_time,
                'd_detailed'=>$content,
                'd_time'=>time(),
                'dprogress_id'=>$dprogress,
                'dtype_id'=>$dtype,
                'c_id'=>$user,
                'admin_id'=>$admin,
                'warn'=>$warn
            ]);
        if($res>0){
            $data = DB::table('documentary')->where('documentary_id',$documentary_id)->first();
            $str = "<tr>
            <td>
                <div class=\"layui-unselect layui-form-checkbox\" lay-skin=\"primary\" data-id='2'><i class=\"layui-icon\">&#xe605;</i></div>
            </td>
            <td>$num</td>
            <td>$data->c_id</td>
            <td>$data->dtype_id</td>
            <td>$data->dprogress_id</td>
            <td>$data->d_nexttime</td>
            <td>$data->d_detailed</td>
            <td>$data->admin_id</td>
            <td>$data->d_time</td>
   
            <td>
                <a title=\"编辑\"  onclick=\"x_admin_show('编辑','documentary_save?id=$data->documentary_id&num=$num')\" href=\"javascript:;\">
                    <i class=\"layui-icon\">&#xe642;</i>
                </a>
                <a title=\"删除\" onclick=\"member_del(this,'$data->documentary_id')\"  href=\"javascript:;\">
                    <i class=\"layui-icon\">&#xe640;</i>
                </a>
            </td>
        </tr>";
            $arr = [
                'data' => $str,
                'status'=>1,
                'num'=>$num
            ];
            return $arr;
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 跟单类型展示
     */
    public function documentary_dtype_list(){
        $data = DB::table('dtype')->where('status',1)->paginate(10);
        return view('documentary.documentary_dtype_list',['data'=>$data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 跟单类型添加
     */
    public function documentary_dtype_add(){
        return view('documentary.documentary_dtype_add');
    }

    /**
     * @param Request $request
     * @return int
     * 跟单类型添加执行
     */
    public function documentary_dtype_add_do(Request $request){
        $dtype = $request ->get('dtype');
        $res = DB::table('dtype')->insert(['dtype_name'=>$dtype,'time'=>time()]);
        if($res > 0){
            return 1;
        }
    }

    /**
     * @param Request $request
     * @return int
     * 跟单类型删除
     */
    public function documentary_dtype_del(Request $request){
        $dtype_id = $request ->get('id');
        $res = DB::table('dtype')->where('dtype_id',$dtype_id)->update(['status'=>3]);
        if($res > 0){
            return 1;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 跟单类型修改
     */
    public function documentary_dtype_save(Request $request){
        $dtype_id = $request ->get('id');
        $data = DB::table('dtype')->where('dtype_id',$dtype_id)->first();
        return view('documentary.documentary_dtype_save',['data'=>$data]);
    }

    /**
     * @param Request $request
     * @return int
     * 跟单类型修改执行
     */
    public function documentary_dtype_save_do(Request $request){
        $dtype_id = $request ->get('dtype_id');
        $dtype_name = $request ->get('dtype');
        $res = DB::table('dtype')->where('dtype_id',$dtype_id)->update(['time'=>time(),'dtype_name'=>$dtype_name]);
        if($res > 0){
            return 1;
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 跟单进度展示
     */
    public function documentary_dprogress_list(){
        $data = DB::table('dprogress')->where('status',1)->paginate(10);
        return view('documentary.documentary_dprogress_list',['data'=>$data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 跟单进度添加
     */
    public function documentary_dprogress_add(){
        return view('documentary.documentary_dprogress_add');
    }

    /**
     * @param Request $request
     * @return int
     * 跟单进度添加执行
     */
    public function documentary_dprogress_add_do(Request $request){
        $dprogress = $request ->get('dprogress');
        $res = DB::table('dprogress')->insert(['dprogress_name'=>$dprogress,'time'=>time()]);
        if($res > 0){
            return 1;
        }
    }

    /**
     * @param Request $request
     * @return int
     * 跟单进度删除
     */
    public function documentary_dprogress_del(Request $request){
        $dprogress_id = $request ->get('id');
        $res = DB::table('dprogress')->where('dprogress_id',$dprogress_id)->update(['status'=>3]);
        if($res > 0){
            return 1;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 跟单进度修改
     */
    public function documentary_dprogress_save(Request $request){
        $dprogress_id = $request ->get('id');
        $data = DB::table('dprogress')->where('dprogress_id',$dprogress_id)->first();
        return view('documentary.documentary_dprogress_save',['data'=>$data]);
    }

    /**
     * @param Request $request
     * @return int
     * 跟单进度修改执行
     */
    public function documentary_dprogress_save_do(Request $request){
        $dprogress_id = $request ->get('dprogress_id');
        $dprogress_name = $request ->get('dprogress');
        $res = DB::table('dprogress')->where('dprogress_id',$dprogress_id)->update(['time'=>time(),'dprogress_name'=>$dprogress_name]);
        if($res > 0){
            return 1;
        }
    }

}
