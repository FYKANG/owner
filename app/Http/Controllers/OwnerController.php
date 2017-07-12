<?php

namespace App\Http\Controllers;	
use Config;
use App\Owner;		//MOdel的调用
use App\search;		//MOdel的调用
use Illuminate\Support\Facades\DB;	//查询构造器的调用
use Illuminate\Http\Request; 	//调用Request
use Illuminate\Support\Facades\Session;	//调用Session模型
use Illuminate\Support\Facades\Cache;	//调用缓存
use Illuminate\Support\Facades\Log; 	//调用错误日志
use EasyWeChat\Foundation\Application;	//实例化easywechat
use Overtrue\LaravelWechat\Events\WeChatUserAuthorized;	//wechat授权





class OwnerController extends Controller
{
    public function mysql(Request $request,Application $wechat)
    {	

    	// $response = $auth->oauth->scopes(['snsapi_userinfo'])
     //                      ->setRequest($request)
     //                      ->redirect();
     //                      return $response;
    	$user = session('wechat.oauth_user');
	   	$qrcode = $wechat->qrcode;
	   	$result = $qrcode->temporary(time(), 10);
	   	$ticket = $result->ticket;
	   	$expireSeconds = $result->expire_seconds;
	  	
	   	$url=$qrcode->url($ticket);
	   	// dd($qrcode);
	  
	    return view('owner.mysql',[
	    	'user'=> $user,
	    	'url'=> $url,

	    	]);


    }
    public function session(Request $request){
    	//获取缓存内容
		//Cache::get('key', 'default');	//(键,默认值)

		//取出后删除
		//Cache::pull('key');	//(键)

		//存在时删除缓存返回true，不存在时返回false
		//Cache::forget('key');	//(键)
    }

    public function from(Application $wechat){
 		
    	 $notice = $wechat->notice;


    $userId = 'oLiRv1HwbBzQL5NHNr3VB8Ru-1uA';
    $templateId = 'GlpcaxZK5rscHnXcNdtYE8rTAGwtbkWFuWr22_RTxS4';
    $url = route('mysql');
    $data = array(
         "first"  => "bilibili",
         "name"   => "b站",
         "addr"  => "https://www.baidu.com/",
         "time"	=>date('Y-m-d H:i:s', time()),
         "remark" => "welcome！",
        );
    $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
    var_dump($result);
    // {
    //      "errcode":0,
    //      "errmsg":"ok",
    //      "msgid":200228332
    //  }
    }

    public function fromsave(Request $request){
    	$mgs=$request->all();
    	// echo $mgs['test'];
    	// echo $mgs['test2'];
    	// $this->validate($request,[
    	// 		'test'=>'required|min:1|max:2',
    	// 		'test2'=>'required|integer',
    	// 	],[
    	// 		'required'=>':attribute 必填',
    	// 		'integer'=>':attribute 数字',
    	// 		'max'=>':attribute 最大为2位数',
    	// 		'min'=>':attribute 最小为1位数',
    	// 	],[
    	// 		'test'=>'测试1',
    	// 		'test2'=>'测试2'
    	// 	]);

    }

}