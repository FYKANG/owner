<?php

namespace App\Http\Controllers;
use Config;
use Illuminate\Support\Facades\DB;  //查询构造器的调用
use Illuminate\Http\Request;    //调用Request
use Illuminate\Support\Facades\Session; //调用Session模型
use Illuminate\Support\Facades\Cache;   //调用缓存
use Illuminate\Support\Facades\Log;     //调用错误日志
use EasyWeChat\Foundation\Application;  //实例化easywechat

class WechatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve(Application $wechat)
    {

     $server = $wechat->server;
    //  $notice = $wechat->notice;

    // $userId = 'oLiRv1HwbBzQL5NHNr3VB8Ru-1uA';
    // $templateId = 'GlpcaxZK5rscHnXcNdtYE8rTAGwtbkWFuWr22_RTxS4';
    // $url = route('mysql');
    // $data = array(
    //      "first"  => "bilibili",
    //      "name"   => "b站",
    //      "addr"  => "https://www.baidu.com/",
    //      "time" =>date('Y-m-d H:i:s', time()),
    //      "remark" => "welcome！",
    //     );
    // $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
    // var_dump($result);
 

    $server->setMessageHandler(function ($message) {
    // $message->FromUserName // 用户的 openid
    // $message->MsgType // 消息类型：event, text....
    return $message->EventKey;
    });
    $response = $server->serve();
    return $response; // Laravel 里请使用：return $response;
    }

    public function demo(Application $wechat){
    $notice = $wechat->notice;

    $userId = 'oLiRv1HwbBzQL5NHNr3VB8Ru-1uA';
    $templateId = 'GlpcaxZK5rscHnXcNdtYE8rTAGwtbkWFuWr22_RTxS4';
    $url = route('mysql');
    $data = array(
         "first"  => "bilibili",
         "name"   => "b站",
         "addr"  => "https://www.baidu.com/",
         "time" =>date('Y-m-d H:i:s', time()),
         "remark" => "welcome！",
        );
    $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
    var_dump($result);
    }
}