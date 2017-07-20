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
use Redirect;	//调用redirect类				




class OwnerController extends Controller
{
    public function mysql(Request $request,Application $wechat)
    {	

    	// $response = $auth->oauth->scopes(['snsapi_userinfo'])
     //                      ->setRequest($request)
     //                      ->redirect();
     //                      return $response;
    	$user = session('wechat.oauth_user');
    	//获取easywechat二维码实例
    	$qrcode = $wechat->qrcode;

  //   	$result = $qrcode->forever(56);// 或者 $qrcode->forever("foo");
		// $ticket = $result->ticket; // 或者 $result['ticket']
		// $url = $result->url;
	   	
	   	$result = $qrcode->temporary(time(), 10);
	   	$ticket = $result->ticket;
	   	$expireSeconds = $result->expire_seconds;
	  	$time=time();
	   	$url=$qrcode->url($ticket);
	   	// dd($qrcode);
	  	QrCode::format('png')->size(200)->errorCorrection('H')->merge('/public/qrcodes/log.png',.2)->generate('http://www.passowner.club/owner/public/from?discern=test','../public/qrcodes/'.$time.'.png');
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

    //寻物信息页面
    public function serach_message(Request $request){

    	$discern=$request->all();
    	$mgs=owner_info::where('discern','=',$discern)->first();
    	
    	return view('owner.owner_message',
    		[
    			'name'=>$mgs->name,
    			'phone'=>$mgs->phone,
    			'wechat'=>$mgs->phone, 
    			'message'=>$mgs->phone,
    			'img'=>$mgs->img,
    			'img2'=>$mgs->img2
    		]);
    }

    //个人页面
    public function person(){
    	$user = session('wechat.oauth_user');
    	return $user;

    }





    //表单
    public function from(Request $request,Application $wechat){
    	//获取get信息
    	$mgs=$request->input('discern');
    	//对比数据库
 		$discern=owner_qrcode::where('discern','=',$mgs)->first();
 		if($discern==null){
 			echo "无效二维码";
 		}
 		elseif($request->method()=='GET'&&$discern->statu==0&&$mgs!=null){
 			$user = session('wechat.oauth_user');
 			$js= $wechat->js;
    		return view('owner.from',
    			[	'opid'=>$user->getId(),
    				'js'=>$js,
    				'discern'=>$mgs,

    			]);
 		}else{
 			return Redirect::route('serach_message',array('discern'=>$mgs));
 		}
 	
    }

    //上传表单
    public function fromsave(Request $request,Application $wechat){
    	//获取表单数据
    	$mgs=$request->all();
    	//easywechat微信素材的实例化
    	$temporary = $wechat->material_temporary;
    	//获取public的绝对地址
    	$path = public_path();
    	//时间戳的处理
    	$time=date("Y-m-d H:i:s",time());
    	//下载素材
    	if(array_key_exists('media_id',$mgs)){
    		if(count($mgs['media_id'])!=2){
    			foreach ($mgs['media_id'] as $key => $value) {
    				if($key==0){
    					$mgs['media_id'][1]='null';
    					$temporary->download($mgs['media_id'][0], "$path/img/", $time.$mgs['media_id'][0]);
    				}else{
    					$mgs['media_id'][0]='null';
    					$temporary->download($mgs['media_id'][1], "$path/img/", $time.$mgs['media_id'][1]);
    				}		
    			}
    		}else{
    			
    			$temporary->download($mgs['media_id'][0], "$path/img/", $time.$mgs['media_id'][0]);
    			$temporary->download($mgs['media_id'][1], "$path/img/", $time.$mgs['media_id'][1]);
    		}
    	
    	}else{
    		$mgs['media_id'][0]='null';
    		$mgs['media_id'][1]='null';
    	}

    	

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

    		]);
    	//修改二维码状态
    	$qrcode=owner_qrcode::where('discern','=',$mgs['discern'])->first();
    	$qrcode->statu='1';
    	$bool=$qrcode->save();//返回布尔值
    	echo $workout;

    }

    //信息展示页面
    public function showInfo(){

    	$user = session('wechat.oauth_user');
    	return $user;


    }

}