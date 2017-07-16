<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>owner</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/weui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css') }}">
</head>
<body style="margin:2px 2px 2px 2px;">
<img src="img/log.jpg" class="img-responsive" alt="Responsive image">
<form action="{{route('fromsave')}}" method="post" accept-charset="utf-8">
 {{csrf_field()}}
	<input type="hidden" name="opid" value="">
   <div class="weui-cell">
	                <div class="weui-cell__hd"><label class="weui-label">名称</label></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input" type="text" placeholder="请输入名称" name='name'/>
	                </div>
	    </div> 






	   <div class="weui-cell">
	                <div class="weui-cell__hd"><label class="weui-label">微信号</label></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入微信号" name="wechat" />
	                </div>
	    </div> 


  <div class="weui-cells">

            <div class="weui-cell weui-cell_select weui-cell_select-before">
                <div class="weui-cell__hd">
                    <select class="weui-select" name="phone_date">
                        <option value="1">+86</option>
                        <option value="2">+80</option>
                        <option value="3">+84</option>
                        <option value="4">+87</option>
                    </select>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入号码" name="phone" />
                </div>
            </div>
        </div>



   <div class="weui-cell">留言</div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" placeholder="请输入你想要的留言" rows="3" name="message"></textarea>
                    <div class="weui-textarea-counter"><span>0</span>/200</div>
                </div>
            </div>
        </div>




  			<div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <div class="weui-uploader">
                        <div class="weui-uploader__hd">
                            <p class="weui-uploader__title">图片上传</p>
                            <div class="weui-uploader__info">0/2</div>
                        </div>
                        <div class="weui-uploader__bd">
                     
                            <div class="weui-uploader__input-box">
                                <input id="uploaderInput" class="weui-uploader__input"  />
                            </div>
                            <div class="weui-uploader__input-box">
                                <input id="uploaderInput" class="weui-uploader__input"  />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="weui-cells weui-cells_radio">
            <label class="weui-cell weui-check__label" for="x11">
                <div class="weui-cell__bd">
                    <p>保存并公开</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" class="weui-check" name="radio1" id="x11" checked="checked"/>
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
            <label class="weui-cell weui-check__label" for="x12">

                <div class="weui-cell__bd">
                    <p>保存暂不公开</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" name="radio1" class="weui-check" id="x12" />
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
     
        </div>


    <button class="weui-btn weui-btn_plain-primary" >提交</button>

  
</form>





	





	
	<script src="{{ URL::asset('js/bootstrap.min.js') }}" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>