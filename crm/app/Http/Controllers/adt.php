<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;


class adt extends CommonController{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 公告展示
     */
    public function publicnotice_list(){
        $data = DB::table('publicnotice')->where('status',1)->paginate(10);
        return view('adt.publicnotice_list',['data'=>$data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 公告添加
     */
    public function publicnotice_add(){
        return view('adt.publicnotice_add');
    }

    /**
     * @param Request $request
     * @return int
     * 公告添加执行
     */
    public function publicnotice_add_do(Request $request){
        $content = $request -> get('content');
        $res = DB::table('publicnotice')->insert(['content'=>$content,'time'=>time()]);
        if($res > 0){
            return 1;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 公告修改
     */
    public function publicnotice_save(Request $request){
        $id = $request->get('id');
        $data = DB::table('publicnotice')->find($id);
        return view('adt.publicnotice_save',['data'=>$data]);
    }

    /**
     * @param Request $request
     * @return int
     * 公告修改执行
     */
    public function publicnotice_save_do(Request $request){
        $id = $request->get('id');
        $content = $request->get('content');
        $res = DB::table('publicnotice')->where('id',$id)->update(['content'=>$content]);
        if($res > 0){
            return 1;
        }
    }

    /**
     * @param Request $request
     * @return int
     * 公告删除
     */
    public function publicnotice_del(Request $request){
        $id = $request->get('id');
        $res = DB::table('publicnotice')->where('id',$id)->update(['status'=>3]);
        if($res > 0){
            return 1;
        }
    }
}