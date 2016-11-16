<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="tok" content="{{csrf_token()}}">
	<title>@yield('title')</title>
	<!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    @yield('css')
</head>
<body>
@yield('body')
<!-- Scripts -->
<script src="/js/app.js"></script>
@yield('js')
</body>
</html>