<?php

namespace App\Http\Controllers\WeiXin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\WeiXin;
class WxController extends Controller
{
    private $student = ['商业兴', '刘清原', '高泽东'];

    public function index()
    {
        $echostr = \request()->echostr;
        if (!empty($echostr)) {
            echo $echostr;
        }
        //echo 1;die;
        //接入后 微信服务器接以POST形式接收xml数据，发送到配置得url路径
        $xml = file_get_contents("php://input");
        //写入文件
        $res = file_put_contents("log.txt", $xml, FILE_APPEND);    //FILE_APPEND 在日志后面追加写
        //方便处理 把xml数据转化为对象
        $xml_obj = simplexml_load_string($xml);

        if ($xml_obj->MsgType == 'event' && $xml_obj->Event == 'subscribe') {         //如果是关注   回复
            $data = WeiXin::getUserInfoByOpenId($xml_obj->FromUserName);        //获取用户信息
            $nickname = $data['nickname'];      //获取用户名称
            $msg = "谢谢".$nickname."关注";
            WeiXin::response($xml_obj, $msg);
        }
        if ($xml_obj->MsgType == 'text') {          //如果是文本      回复
            $content = trim($xml_obj->Content);
            if ($content == '1') {              //文本内容是1 回复
                $msg = implode(',', $this->student);               //获取全部名字
                WeiXin::response($xml_obj, $msg);
            } else if ($content == '2') {                //文本内容是2 回复
                shuffle( $this->student);
                $msg =  $this->student[0];
                WeiXin::response($xml_obj, $msg);
            } else if ($content == '3') {                //文本内容是3回复
                WeiXin::response($xml_obj, "333");
            } else if (mb_strpos($content, '天气') !== false) {
                $city = rtrim($content, '天气');
                if (empty($city)) {
                    $city = '北京';
                }
                //天气接口
                $api = 'http://api.k780.com/?app=weather.future&weaid=' . $city . '&appkey=47857&sign=910252adfa683f0f3cf862bea6212adf&format=json';
                //请求天气接口
                $wechat = file_get_contents($api);
                //将json字符串转化为数组
                $wechat_arr = json_decode($wechat, true);
                $str = '';
                //查询一周得天气
                foreach ($wechat_arr['result'] as $k => $v) {
                    //拼接
                    $str .= $v['days'] . '' . $v['week'] . '' . $v['citynm'] . '' . $v['temperature'] . '' . $v['weather'] . "\n";
                }
                WeiXin::response($xml_obj, $str);
            }
            //文本内容回复
            WeiXin::response($xml_obj, $content);
        }
    }
}
