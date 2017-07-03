# OWNER
## 2017/6/30
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
## 2017/7/1
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