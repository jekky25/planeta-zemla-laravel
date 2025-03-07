<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title inertia>{{ config('app.name', 'Laravel') }}</title>

		<!-- Fonts -->
		<link href="{{ asset("favicon.ico") }}" rel="shortcut icon" type="image/x-icon" />
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="{{ asset("css/jcomments/style.css?v=19") }}" type="text/css" />
		<script type="text/javascript" src="{{ asset("js/system/mootools.js") }}"></script>
		<script type="text/javascript" src="{{ asset("js/system/caption.js") }}"></script>
		<script type="text/javascript" src="{{ asset("js/jcomments/jcomments-v2.1.js?t=5") }}"></script>
		<script type="text/javascript" src="{{ asset("js/jcomments/ajax.js?v=1") }}"></script>
		@stack('scripts')
		<link rel="stylesheet" href="{{ asset("css/style.css?t=9") }}" type="text/css" />
		<!-- Scripts -->
		@routes
		@vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
		@inertiaHead
	</head>
	<body class="font-sans antialiased">
		@inertia
	</body>
</html>