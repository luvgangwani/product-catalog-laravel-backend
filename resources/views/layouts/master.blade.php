<!DOCTYPE html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html>
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="product, catalog, admin, console">

		<!-- CSRF Token -->

		<meta name="csrf-token" content = "{{ csrf_token() }}">

		<!-- Styles -->

		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

		<!-- Fonts -->

		<!-- Scripts -->
		<title>{{ config('app.name', 'Product Catalog') }}</title>
	</head>
<body>
	@yield('content')
</body>

		<script src="{{ asset('js/app.js') }}"></script>

</html>