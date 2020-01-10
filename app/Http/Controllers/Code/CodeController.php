<?php

namespace App\Http\Controllers\Code;

use App\Http\Controllers\Controller;
use App\Tools\Curl;
use App\Tools\WeiXin;
use Illuminate\Http\Request;
use App\Model\Code;
class CodeController extends Controller
{
public function code_add()
{
   return view('codeadd.code_add');
}
    public function code_index(){
        $data = Code::all();
        return view('codeadd.code_index',['data'=>$data]);
    }
public function  add_do(Request $request)
{
    $channel_name = $request->input('channel_name');
    $channel_status = $request->input('channel_status');
    $access_token = WeiXin::getAccessToken();

    $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=" . $access_token;

  $postData = '{"expire_seconds": 2592000, "action_name": "QR_STR_SCENE", "action_info": {"scene": {"scene_str": "' . $channel_status . '"}}}';
//    $postData=[
//        'expire_seconds'=>'2592000',
//        'action_name'=>'QR_STR_SCENE',
//        'action_info'=>[
//            'scene'=>[
//                'scene_str'=>$channel_status,
//            ]
//        ]
//    ];
//     $res=json_encode($postData,JSON_UNESCAPED_UNICODE);
//     dump($res);die;
    $res = Curl::post($url, $postData);

    $res = json_decode($res, true);

    $ticket = $res['ticket'];
    Code::create([
        'channel_name' => $channel_name,
        'channel_status' => $channel_status,
        'ticket' => $ticket,
    ]);
}

}
