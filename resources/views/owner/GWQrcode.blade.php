<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>getWechatQrcode</title>
	<link rel="stylesheet" href="{{ URL::asset('css/test.css') }}" type="text/css">
	<script src="{{ URL::asset('js/jquery-2.1.1.min.js') }}" type="text/javascript" charset="utf-8"></script>
	



</head>
<body>
<div class="test">

<div class="visible-print text-center">
@if($discerns=='null')
<form action="{{route('getWechatQrcode')}}" method="post" accept-charset="utf-8">
	{{csrf_field()}}
	<input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输所需生成的二维码数量" name="num" />
	<button >生成</button>
</form>
@else
	@foreach ($discerns as $discern)
	    <img src="{{ URL::asset('wechatqrcode/'.$discern.'.jpg') }}" alt="">
	    <p>Scan me to return to the original page.</p>
	    
	@endforeach
@endif
</div>



</div>
	
</body>
</html>
