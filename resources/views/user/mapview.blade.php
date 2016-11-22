@extends('user.userhome')

@section('css2')
<style type="text/css">
#map{
	width: 100%;
	height: 100%;
	background-color: #212121;
}
#here{
	height: 80%;
	background-color: background-color:#B71C1C;
	padding: 0;
}
html, body { 
	height: 100%;
	width: 100%;
	margin: 0; 
	padding: 0;
	background-color: #FFB74D;
}
.cont{
	background-image: url(/img/stadium.jpg);
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
	margin-bottom: 0;
	margin-top: 0;
	border-bottom: 0;
	padding-top:100px;
	padding-bottom: 100px;
}
#other{
	color:#eee; 
	padding-top: 20px;
	padding-right: 50px;
	height: 80%;
	background-color: #388E3C;
}
</style>
@endsection

@section('body2')
<div class="cont">
	<div align="center">
		<img src="/img/cucu3.gif" style="width: 15%;">
	</div>
	<h2 style="color:#eee; margin-top: 0; margin-bottom: 0;" id="mainTitle">Follow your passion!<br>The house of your favorite teams of the Spain Soccer League!</h2>
</div>
<div style="color: #eee; margin-top: 0; margin-bottom: 0; background-color:#B71C1C;" class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">	
				<h3 align="left">Thanks for being part of League-project.com</h3>
				<hr>
			</div>
		</div>
	</div>
</div>
<div align="right" class="col-md-5" id="other">
	<h2>See all the stadiums!</h2>
	<div class="col-md-11 col-md-offset-1">
		<p style="font-size: 20px;">Here you can see all of the stadiums.</p>
		<div class="thumbnail">	
		<div style="font-size: 15px;">
			<p><span class=""></span> Do click on a stadium to go to check its events and more information.</p>
		</div>
		</div>
	</div>
</div>
<div class="col-md-7"  id="here">
	<div id="map"></div>
</div>
@endsection

@section('js2')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqiB2cyhlFaZJmw6_x1Cz7-AvGH5dkTLU&callback=initMap&language=EN" async defer></script>
<script src="/js/user/usermapoptions.js"></script>
<script src="/js/user/stadiumsajax.js"></script>
<script src="/js/user/usermap.js"></script>
@endsection