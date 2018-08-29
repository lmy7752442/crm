<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PowerController extends Controller
{
    public function power_list(){
        return view('power.power_list');
    }
}
