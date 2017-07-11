<?php

namespace App\Http\Controllers;

use Log;

class WechatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎关注 overtrue！";
        });

        Log::info('return response.');

        return $wechat->server->serve();

        // ...
        $server->setMessageHandler(function ($message) {
            return "您好！欢迎关注我!";
        });
        $response = $app->server->serve();
        // 将响应输出
        return $response; // Laravel 里请使用：return $response;

    }
}