<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractController extends Controller
{
    //合同展示
    public function contract_list(){
        $data = DB::table('contract')->where(['status'=>1])->paginate(3);
        return view('contract.contract_list')->with('data',$data);
    }
    //合同添加
    public function contract_add(){
        return view('contract.contract_add');
    }
}
