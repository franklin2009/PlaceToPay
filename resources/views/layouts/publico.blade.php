<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		@yield('my-meta')
		<link rel="icon" href="{{ asset('favicon.ico') }}">
		
		<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet" type="text/css">
		
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		{!! Html::style('css/smoke.min.css') !!}
		{!! Html::style('css/myStyles.css') !!}

		@yield('my-prescripts')

	</head>

	<body>
		<div class="page-wrapper">
			<!-- header -->
			@include('elements.header')
			<div class="container">
				<!-- header -->
				@include('elements.nav')
				<!-- Menssages -->
				@include('elements.message')
				<!-- Contenedor -->
				@yield('my-contenido')
			</div>
			<!-- Footer -->
			@include('elements.footer')
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		{!! Html::script('js/smoke.min.js') !!}
		{!! Html::script('js/smoke-es.min.js') !!}
		{!! Html::script('js/myScript.js') !!}
		
		@yield('my-postscripts')
	</body>

</html>

