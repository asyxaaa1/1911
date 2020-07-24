<?php

namespace App\Http\Controllers\Teat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Model\TokenModel;
class ApiController extends Controller
{
    public function reg(Request $request)
    {
        $user_name = $request->post('user_name');
        $user_email = $request->post('user_email');
        $pass1 = $request->post('pass1');
        $pass2 = $request->post('pass2');
        $pass = password_hash($pass1, PASSWORD_BCRYPT);
        $user_info = [
            'user_name' => $user_name,
            'email' => $user_email,
            'password' => $pass,
            'reg_time' => time()
        ];
        $uid = UserModel::inserGetId($user_info);
        $response = [
            'error' => 0,
            'msg' => 'ok'
        ];
        return $response;
    }

    public function login(Request $request)
    {
        $user_name = $request->post('name');
        $pass = $request->post('pass');
        $u = UserModel::where(['user_name' => $user_name])->first();
        if ($u) {

            if(password_verify($pass,$u->password)){
                $token=str::random(32);
                $expire_seconds=7200;
                $data=[
                    'token'=>$token,
                    'uid'=>$u->user_id,
                    'expire_at'=>time()+7200
                ];
                $tid=TokenModel::inserGetId();
                $response = [
                    'error'=>0,
                    'msg'=>'ok',
                    'date'=>[
                        'token'=>$token,
                        'expire_in'=>$expire_seconds
                    ]
                ];

            }else{
                $response = [
                    'error'=>500001,
                    'msg'=>'密码不正确'

                ];


            }

        }else{

            $response = [
                'error' => 400001,
                'msg' => '用户名不存在'

            ];

        }
        return $response;
    }
    public  function center(Request $request)
    {
        $token = $request->get('token');
        if(empty($token)){
            $response = [
                'error' => 400003,
                'msg' => '未授权'

            ];

            return $response;
        }

        $t= TokenModel::where(['token'=>$token])->first();
        if(empty($t)){
            $response = [
                'error' => 400003,
                'msg' => 'token无效'

            ];
            return $response;

        }
        $user_info=UserModel::find($t->user_id);
        var_dump($user_info);
    }
}
