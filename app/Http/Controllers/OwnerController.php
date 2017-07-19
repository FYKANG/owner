<?php

namespace App\Http\Controllers;	
use Config;
use App\Owner;			//MOdel的调用
use App\search;			//MOdel的调用
use App\user_info;		//MOdel的调用
use App\owner_info;		//MOdel的调用
use App\owner_qrcode;	//MOdel的调用
use Illuminate\Support\Facades\DB;	//查询构造器的调用
use Illuminate\Http\Request; 	//调用Request
use Illuminate\Support\Facades\Session;	//调用Session模型
use Illuminate\Support\Facades\Cache;	//调用缓存
use Illuminate\Support\Facades\Log; 	//调用错误日志
use EasyWeChat\Foundation\Application;	//实例化easywechat
use Overtrue\LaravelWechat\Events\WeChatUserAuthorized;	//wechat授权
use SimpleSoftwareIO\QrCode\Facades\QrCode;





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
	  	$time=time();
	   	$url=$qrcode->url($ticket);
	   	// dd($qrcode);
	  	QrCode::format('png')->size(200)->errorCorrection('H')->merge('/public/qrcodes/log.png',.2)->generate('http://www.passowner.club/owner/public/mysql','../public/qrcodes/'.$time.'.png');
	    return view('owner.mysql',[
	    	'user'=> $user,
	    	'url'=> $url,
	    	'time'=>$time,

	    	]);


    }
    public function test(){

 		$user = session('wechat.oauth_user');

	    return view('owner.test',[
	    	'user'=> $user,
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


    //个人页面
    public function person(){
    	$user = session('wechat.oauth_user');
    	return $user;

    }





    //表单
    public function from(Request $request,Application $wechat){
 		
 		$user = session('wechat.oauth_user');
 		$js= $wechat->js;
 		// echo $js->config(array('onMenuShareQQ', 'onMenuShareWeibo'), true);
    	return view('owner.from',
    			[	'opid'=>$user->getId(),
    				'js'=>$js,

    			]);
    }

    //上传表单
    public function fromsave(Request $request,Application $wechat){
    	$mgs=$request->all();
    	$path = public_path();
    	$temporary = $wechat->material_temporary;
    	$temporary->download($mgs['media_id'][0], "$path/img/", $mgs['media_id'][0].'.jpg');
    	$temporary->download($mgs['media_id'][1], "$path/img/", $mgs['media_id'][1].'.jpg');
    	//使用create方法新增数据
    	$workout=owner_info::create(
    		[	'opid'=>$mgs['opid'],
    			'name'=>$mgs['name'],
    			'wechat'=>$mgs['wechat'],
    			'discern'=>$mgs['discern'],
    			'phone'=>$mgs['phone'],
    			'phone_date'=>$mgs['phone_date'],
    			'message'=>$mgs['message'],
    			'statu'=>$mgs['radio1'],
    			'img'=>$mgs['media_id'][0],
    			'img2'=>$mgs['media_id'][1]

    		]
    		);
    	echo $workout;

    }

    //信息展示页面
    public function showInfo(){

    	$user = session('wechat.oauth_user');
    	return $user;


    }

}