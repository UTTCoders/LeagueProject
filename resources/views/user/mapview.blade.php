@extends('user.userhome')

@section('css2')
<style type="text/css">
#map{
	width: 100%;
	height: 90%;
	border: 3px solid #B71C1C;
	border-radius: 0;
	background-color: #212121;
}
html, body { 
	height: 100%;
	width: 100%;
	margin: 0; 
	padding: 0;
	background-color: #212121;
	background-image: url(/img/stadium.jpg);
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
</style>
@endsection

@section('body2')
<div class="container">
<div align="center" style=" margin-top: 150px;">
	<img src="/img/cucu3.gif" style="width: 15%;">
</div>
   	<h2 style="color:white; margin-top: 0;" id="mainTitle">Follow your passion!<br>Here you can visit all of the stadiums!</h2>
</div>
<br><br><br>
<div style="color: #eee; margin-bottom: 0; background-color:#B71C1C; " class="jumbotron">
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">	
		<h3 align="center">Checkout our google map to visit your favorite stadiums!</h3>
		<hr>
		</div>
	</div>
</div>
</div>
<div id="map"></div>
@endsection

@section('js2')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqiB2cyhlFaZJmw6_x1Cz7-AvGH5dkTLU&callback=initMap&language=EN" async defer></script>
<script src="/js/user/usermapoptions.js"></script>
<script src="/js/user/stadiumsajax.js"></script>
<script src="/js/user/usermap.js"></script>
@endsection