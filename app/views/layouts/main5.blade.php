<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta charset='utf-8'>
	<link rel="stylesheet" type="text/css" href="../../../../../bootstrap2/css/bootstrap.css">
	<script type="text/javascript" src="../../../../../js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="../../../../../bootstrap2/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
	@if(Session::has('global'))
	
		
		<div class="alert alert-success" role="alert">
			{{Session::get('global')}}
		</div>

	@endif
	@yield('contenido')
</body>
	
</html>