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
@foreach($workout as $val)
          <p >{{$val->userName}}</p>
@endforeach
<div class="visible-print text-center">
    {!! QrCode::size(100)->generate('Hello,LaravelAcademy!'); !!}
    <p>Scan me to return to the original page.</p>
    {{route('session')}}
</div>
<form action="{{route('session')}}" method="post" accept-charset="utf-8">
<input type="number" name="owner[userName]" value="" placeholder="test">

<button >确定</button>
  </div>
</form>
</div>
</body>
</html>
