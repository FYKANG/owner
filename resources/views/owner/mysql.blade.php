<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>test</title>
	<link rel="stylesheet" href="{{ URL::asset('css/test.css') }}" type="text/css">
	<script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body>
<div class="test">
<img src="{{$url}}" alt="">
{{$user->getNickname()}}
<div class="visible-print text-center">
    {!! QrCode::size(100)->generate('Hello,LaravelAcademy!'); !!}
    <p>Scan me to return to the original page.</p>
    {{route('session')}}
</div>

</div>
</body>
</html>
