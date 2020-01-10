<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function index_v1(){
        return view('admin.index_v1 ');
    }
}
