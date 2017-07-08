# OWNER
## 2017/06/30
  * 我重新建了一个库，原本打算用TP做为框架写这个项目的，但是考虑到正在学习laravel框架，就打算用laravel框架来进行项目。
  * 服务器使用centos 7系统，laravel5.2框架，php版本为5.6.3，使用mysql数据库。
  * 关于laravel的安装
    * 使用官方提供的安装方法，首先安装composer
    ```
    #yum install composer
    ```
    * 使用composer在当前目录下安装laravel(根据你的需要可以替换owner目录，以及5.2的版本号，注意安装目录的权限设置，以及使用composer进行安装需要在非root用户下进行）
    ```
    #composer create-project laravel/laravel owner --prefer-dist "5.2.*"
    ```
    * 用浏览器进入localhost/项目根目录/public，如果浏览器出现下面这张图就表示安装成功了
    ![](https://github.com/FYKANG/owner/raw/master/githubIMG/laravelCheck.png)
## 2017/07/01
### laravel的路由使用
* 在根目录下的app/Http/routes.php添加路由，路由的基本请求类型有get,post,put,patch,delete,options.
### 基本的书写格式
```
Route::get('test', function () {
return 'test';
});
```
* 通过访问 `localhost/laravel/public/index.php/test` web页面上会显示test字样。(其中laravel框架的存放目录)
### 路由规则的修改，除去index.php
* 我们可以通过修改apache的配置去修改路由规则，具体如下。
	* 修改apache安装目录下的conf/httpd.conf
		* 将#LoadModule rewrite_module modules/mod_rewrite.so前面的#除去，部分httpd.conf配置文件里面会出现没有这一段情况，我们可以去modules目录下确认一下有无mod_rewrite.so文件，如果有那么我们可以直接在httpd.conf中添加LoadModule rewrite_module modules/mod_rewrite.so.
	* 将AllowOverride None修改为AllowOverride All，可以根据你自己的需要修改相应位置的AllowOverride None，如果你对apache的配置不熟悉你可以将全部的AllowOverride None都修改掉，或者一个个试着去修改。
	* 重启apache服务
		```
		# service httpd restart
		```
		* 这是linux系统下的重启命令，window下可以打开任务管理器，选择服务，找到apache右键重启启动服务
* 现在我们可以通过访问`localhost/laravel/public/test`得到test字样了。
## 2017/07/03
### laravel中关于数据库连接的配置
* 配置文件在`.env`中
```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=数据库名
DB_USERNAME=用户名
DB_PASSWORD=密码
```
### 控制器的创建及其使用
#### Controller的创建
* 在./app/Http/Controllers下创建OwnerController.php(注意控制器命名规则~Controller.php)
* 基本的Controller模型
```php
<?php
namespace App\Http\Controllers;	//
class OwnerController extends Controller
{
    public function mysql()
    {
	 return 'Hellow world'
    }
}

```
#### Controller的使用
	* 在./app/Http/routes.php中添加路由
	```php
	Route::any('mysql',[
		'uses'=>'OwnerController@mysql',
		'as'=>'mysql'
		]);
	```
	* 这段代码作用为添加一个名为mysql的路由,使用OwnerController控制器中的mysql方法，为路由起一个msyql的别名
* 当我们访问`http://localhost:/根目录/public/mysql`后就会出现Hellow world.
### Model的创建及使用
#### Model的创建
* 在./app目录下创建search.php
* 基本的Model模型
```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class search extends Model
{
	//指定表名
    protected $table='search';

    //指定主键
    protected $primaryKey='id';

    //设置允许批量赋值的字段
    protected  $fillable=['userName'];
    
    //指定不允许批量赋值的字段
     protected $guarded=[];

    //是否时间自动维护
     public $timestamps=true;

     //将时间变为时间戳
     // protected function getDateFormat(){

     // 	return time();
     // }
     
     //关闭自动格式化时间戳
     // protected function asDateTime($val){
     // 	return $val;
     // }
}
```
#### Model的使用
* 在控制器中为model添加命名空间`use App\Owner;`
* 以下我们会用到DB模型所以需要添加命名空间`use Illuminate\Support\Facades\DB;`
* 在控制器中添加一个方法
```php
public function mysql()
    {
    	//all()获取全部数据
    	//$workout=search::all();

    	//find()根据主键获取数据
    	//$workout=search::find(1);

    	//findOrFail()根据主键查找，如果没有此主键则报错
    	//$workout=search::findOrFail(1);

    	//查询构造器get()获取全部数据
    	// $workout=search::get();
	
	//where查询语句
	//$workout=search::where('id','>=','1')->get();
		

    	/* chunk(num,function($workout){});
    	其中num为需要查询出来的条数，$workout为返回的结果
    	$workout=search::chunk(2,function($search){
    		dd($search);
    	});
    	*/

    	//聚合函数

    	//count()查询结果的条数
    	//$num=search::count();//返回条数

    	//max('字段')获取此字段中最大值并输出所在行
    	//min('字段')获取此字段中最小值并输出所在行


    	//使用模型新增数据
    	// $search=new search();
    	// $search->userName='ormTest2';
    	// $bool=$search->save();返回bool值

    	//使用create方法新增数据
    	// $workout=search::create(
    	// 	['userName'=>'createteset2']
    	// 	);

    	//使用firstOrCreate()，查询指定字段，如果存在则返回实例，如果不存在则新增数据
    	// $workout=search::firstOrCreate(
    	// 	['userName'=>'ok']
    	// 	);

    	//使用firstOrNew(),与firstOrCreate()基本一致但出现不存在时不会自动保存数据需手动使用save();
    	// $workout=search::firstOrNew(
    	// 	['userName'=>'okok']
    	// 	);


    	// //通过模型更新数据
    	// $workout=search::find(17);
    	// $workout->userName='addNews';
    	// $bool=$workout->save();//返回布尔值

    	//批量更新
    	// $workout=search::where('id','>','10')->update(
    	// 	['userName'=>'groupUpdate']
    	// 	);//返回被修改的条数

    	//通过模型删除数据
    	// $workout=search::find(17);
    	// $bool=$workout->delete();//返回bool值

    	//通过主键删除
    	// $num=search::destroy(10);//返回被删的条数，如果失败则报错(可多条删除如destroy([10,9])表示删除主键为10和9的数据)

    	//删除指定条件数据
    	// $num=search::where('userName','=','test')
    	// 	->delete();//返回没删除的条数

    	//将数据转换为数组形式
    	// $arr=$workout->toArray();

	//如果我们想输出数据我们可以这样做
	//$workout=search::where('id','=','1')->get();
	//dd($workout->userName)//userName为字段名
	
	//如果取出多条数据我们可以使用chunk或者使用foreach

    }
```
### view的创建及使用
#### view的创建
* 通常我们会为用到的Controller创建对应的view文件夹，如：在./resources/views下创建一个owner文件夹在里面我们创建一个mysql.blade.php(你也可直接创建mysql.php,使用mysql.blade.php的好处是我们能使用blade模板使用里面的各种标签)
	* 我们在里面写一些简单的html
```html
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>test</title>
	<link rel="stylesheet" href="" type="text/css">
</head>
<body>
<div class="test">
          <p >{{$workout}}</p>
</div>
</body>
</html>	
```
#### view的使用
* 在控制器中的方法中我们添加以下方法
```
 public function mysql()
    {

    	// 向模板中传递数据
    	return view('owner/mysql',[
    		'workout'=>'Hellow World'
		]);
    }
```
* 我们访问`http://localhost:/根目录/public/mysql`就会出现Hellow world
#### view中blade模板的实用标签(循环输出数组)
```php
@foreach($workout as $val)
          <p >{{$val->userName}}</p>
@endforeach
```
### css与js的调用
#### css
* css存放路径`./public/css`
* css的调用
```html
<link rel="stylesheet" href="{{ URL::asset('css/test.css') }}" type="text/css">
```
#### js
* js存放路径`./public/js`
* js的调用
```html
<script src="{{ URL::asset('js/test.js') }}" type="text/javascript" charset="utf-8" async defer></script>
```
## 2017/07/04
### 使用Simple QrCode库进行二维码转换
#### Simple QrCode的安装
* 首先,添加 QrCode 包添加到你的 composer.json 文件的 require 里:
```json
"require": {
    "simplesoftwareio/simple-qrcode": "~1"
}
```
* 然后,运行 
```
# composer update 
```
* 添加 Service Provider(laravel5的注册方法
	* 注册SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class 至 config/app.php 的 providers 数组里.
* 添加 Aliases(laravel5的注册方法
	* 注册'QrCode' => SimpleSoftwareIO\QrCode\Facades\QrCode::class 至 config/app.php 的 aliases 数组里.
#### Simple QrCode的使用
* 在blade模型模板中添加以下代码(具体的使用方法可以参考[simple-qrcode官方文档](https://www.simplesoftware.io/docs/simple-qrcode/zh#docs-ideas))
```html
<div class="visible-print text-center">
    {!! QrCode::size(100)->generate(Request::url()); !!}
    <p>Scan me to return to the original page.</p>
</div>
```
## 2017/07/05
### request以及Session
```php
<?php

namespace App\Http\Controllers;	
use App\Owner;		//MOdel的调用
use App\search;		//MOdel的调用
use Illuminate\Support\Facades\DB;	//查询构造器的调用
use Illuminate\Http\Request; 	//调用Request
use Illuminate\Support\Facades\Session;	//调用Session模型
class OwnerController extends Controller
{
    public function mysql(Request $request)
    {

    	//request模型

	    	//取值
	    	//$request->input('key');

	    	//判断是否存在数据
	    	// $request->has('key');

	    	//获取全部参数
	    	// $request->all();

	    	//判断请求类型
	    	// $request->method();

	    	//判断是否为指定类型
	    	// $request->isMethod('GET');

	    	//判断是否为ajax请求
	    	// $request->ajax();

	    	//判断指定请求地址是否正确
	    	//$request->is('mysql');

	    	//获取当前url
	    	//$request->url();
	    	

	    //session操作

	    	//HTTP request session()
	    		//session存值
	    		// $request->session()->put('key','valuesl');
	    		//session取值
	    		// dd($request->session()->get('key4'));

    		//session()辅助函数
	    		//存
	    		// session()->put('key2','lalues2');
	    		//取
	    		// session()->get('key2');

    		//Session模型
	    		//存
	    		// Session::put('key3','values3');
    			// Session::put(['key3'=>'values33']);

	    		// //取
	    		// dd(Session::get('key3'));
    			//添加不存在时的默认值
    			// Session::get('key3','none');

	    		//把数据放入Session的数组中
	    			// Session::push('key4','values41');
	    			// Session::push('key4','values42');


	    		//取后删除
	    			// dd(Session::pull('key4'));

	    		//取出所有值
	    			//Session::all();

	    		//判断是否存在某key
	    			//Session::has('key);

    			//删除某个key
    			//Session::forget('key');

    			//删除全部ksession
    			// Session::flush();

    			//暂存数据访问一次后消失
    			// Session::flash('key','values');
    }

}
```
## 2017/07/06
### Middleware中间件的是使用
#### 创建中间件
* 在/App/Http/Middleware下创建中间件，命名为Time.php
* 基本的中间件模型
	```php
	<?php
	
	namespace App\Http\Middleware;
	
	use Closure;
	
	class Time
	{
	
	    public function handle($request, Closure $next)
	    {
	        if(time()<strtotime('2017-07-06')){
	            return redirect()->route('ready');
	           
	        }
	        else
	            return $next($request);
	    }
	}
	```
* 注册中间件，在/App/Http/Kenmel.php中的$routeMiddleware中注册，示例如下(注意键名time首字母小写)
	```php
	    protected $routeMiddleware = [
	
	        'time' => \App\Http\Middleware\Time::class,
	
	    ];
	```
* 将中间件应用到路由中
	* 创建路由群组(注意'middleware'=>'time'首字母都是小写)
		```php
			Route::any('ready',[
			'uses'=>'OwnerController@ready',
			'as'=>'ready'
			]);
		Route::group(['middleware'=>'time'], function() {
    		Route::any('active',[
			'uses'=>'OwnerController@active',
			'as'=>'active'
			]);
		});
		```
* 当我们访问active控制器时会先去到中间件进行条件判断，示例中如果当前时间在2017-07-06以前则会定向到ready控制器，反之则定向到当前控制器
#### 关于post数据的提交
* 使用post提交数据的时候laravel默认开启了Csrf验证所以我们需要在from表单中添加以下代码
	* 第一种方式
		```html
		<input type="hidden" name="_token"         value="{{ csrf_token() }}"/>
		```
	* 第二种方式
		```html
		{{csrf_field()}}
		```
## 2017/07/07
### 控制器验证
* 基础流程
	* 进入$this->validate()进行字段验证如果通过验证则继续执行后面的代码，如果验证失败则抛出一个全局的$errors对象然后返回上一层路由
* 基本的验证模型
	```php
		public function fromsave(Request $request){

			$this->validate($request,[
				//字段的规则设定
				'test'=>'required|min:1|max:2',
					'test2'=>'required|integer',
				],[
				//错误信息的提示设置
					'required'=>':attribute 必填',
					'integer'=>':attribute 数字',
					'max'=>':attribute 最大为2位数',
					'min'=>':attribute 最小为1位数',
				],[
				//错误字段的名称设置
					'test'=>'测试1',
					'test2'=>'测试2'
				]);
				
		}
	```
* $errors在模型中的基本调用
	```html
	@if(count($errors))
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	@endif
	```
## 2017/07/08
### composer的基础使用
* 配置文件的初始化
	```
	composer init
	```
* search命令的使用
	```
	composer search laravel
	```
* show命令的使用
	```
	composer show --all laravel
	```
* 使用composer.json进行管理	
	* 在生成的composer.json中写入项目的库信息
		```
		  "require": {
			"php": ">=5.5.9",
			"laravel/framework": "5.2.*",
			"simplesoftwareio/simple-qrcode":"~1"
		},
		```
	* 通过`composer update`使配置文件生效
### Artisan的基础使用
* list查看所有可用命令
	```
	php artisan list
	```
* help查看帮助信息(查看make命令帮助)
	```
	php artisan help help make
	```
* make创建(创建一个OwnerControlller控制器)
	```
	php artisan make:controller OwnerControlller
	```
	
