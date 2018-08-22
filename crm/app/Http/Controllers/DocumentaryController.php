<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DocumentaryController extends Controller
{
    public function documentary_list(){
        return view('documentary.documentary_list');
    }
    public function documentary_add(){
        $admin_data = DB::table('customer')->get();
        $dtype_data = DB::table('dtype')->get();
        $dprogress_data = DB::table('dprogress')->get();
        return view('documentary.documentary_add',['admin_data'=>$admin_data,'dtype_data'=>$dtype_data,'dprogress_data'=>$dprogress_data]);
    }
    public function documentary_add_do(){

    }
}
