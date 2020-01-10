<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Tools\WeiXin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class IndexController extends Controller
{
    public function index(Request $request){
//        $access_token = Cache::get('access_token');
//           $res =WeiXin::getAccessToken();

        return view('test.index');
    }
}
