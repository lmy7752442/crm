<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function role_list(){
        return view('role.role_list');
    }
}
