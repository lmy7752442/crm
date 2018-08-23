<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DocumentaryController extends Controller
{
    public function documentary_list(Request $request){
        $start_time = $request->get('start');
        $end_time = $request->get('end');
        $username = $request->get('username');
        $where = [];
        if(!empty($start_time)){
            $start_time = strtotime($start_time);
            $where[] = ['d_time','>',$start_time];
        }
        if(!empty($end_time)){
            $end_time = strtotime($end_time);
            $where[] = ['d_time','<',$end_time];
        }
        $documentary_data = DB::table('documentary')-> where($where) -> paginate(10);
        $count = DB::table('documentary')->count();
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
        if(empty($where)){
            return view('documentary.documentary_list',['documentary_data'=>$documentary_data,'count'=>$count]);
        }else{
            return view('documentary.documentary_list_where',['documentary_data'=>$documentary_data,'count'=>$count]);
        }
    }
    public function documentary_add(){
        $admin_data = DB::table('customer')->get();
        $dtype_data = DB::table('dtype')->get();
        $dprogress_data = DB::table('dprogress')->get();
        return view('documentary.documentary_add',['admin_data'=>$admin_data,'dtype_data'=>$dtype_data,'dprogress_data'=>$dprogress_data]);
    }
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
                'warn'=>$warn
            ]);
        if($res>0){
            $data = DB::table('documentary')->where('documentary_id',$res)->first();
            $arr = [
                'data' => $data,
                'status'=>1
            ];
            return $arr;
        }
    }
    public function documentary_del(Request $request){
        $documentary_id = $request->get('documentary_id');
        $res = DB::table('documentary')->where('documentary_id',$documentary_id)->delete();
        if($res > 0 ){
            return '1';
        }
    }
    public function documentary_save(Request $request){
        $documentary_id = $request->get('id');
        $documentary_data = DB::table('documentary')->where('documentary_id',$documentary_id)->first();
        $admin_data = DB::table('customer')->get();
        $dtype_data = DB::table('dtype')->get();
        $dprogress_data = DB::table('dprogress')->get();
        return view('documentary.documentary_save',['admin_data'=>$admin_data,'dtype_data'=>$dtype_data,'dprogress_data'=>$dprogress_data,'documentary_data'=>$documentary_data]);
    }
    public function documentary_save_do(Request $request){
        $documentary_id = $request->get('id');
        $warn = $request -> get('warn');
        $user = $request -> get('user');
        $dtype = $request -> get('dtype');
        $dprogress = $request -> get('dprogress');
        $content = $request -> get('content');
        $next_time = strtotime($request -> get('next_time'));
        $admin = 1;
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
            $data = DB::table('documentary')->where('documentary_id',$res)->first();
            $arr = [
                'data' => $data,
                'status'=>1
            ];
            return $arr;
        }
    }
    public function documentary_dtype_list(){
        return view('documentary.documentary_dtype_list');
    }
}
