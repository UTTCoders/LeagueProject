@extends('user.userhome')

@section('css2')
<style type="text/css">
	.footer{
		display: none;
	}
	body{
		background-color: #000;
	}
	#error{
		padding-top: 200px;
	}
</style>
@endsection

@section('body2')
<div class="container" id="error" align="center">
	<h1 style="font-size: 70px;">:'(</h1>
	<h1>404</h1>
	<h2>Page not found dude!</h2>
</div>
@endsection