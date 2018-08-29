<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //订单列表
    public function order_list(){
        return view('order.order_list');
    }
}
