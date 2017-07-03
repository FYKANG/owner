<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>test</title>
	<link rel="stylesheet" href="{{ URL::asset('css/test.css') }}" type="text/css">
</head>
<body>
<div class="test">
@foreach($workout as $val)
          <p >{{$val->userName}}</p>
@endforeach
</div>
</body>
</html>