@extends('layouts.master')

@section('title',Auth::user()->name." | Home")

@section('css')
<link rel="stylesheet" type="text/css" href="/css/someanyicss.css">
<style type="text/css">
#map{
	width: 100%;
	height: 90%;
}
html, body { 
	height: 100%;
	width: 100%;
	margin: 0; 
	padding: 0;
	background-image: url(/img/stadium.jpg);
	background-repeat: no-repeat;
	background-size: 100%;
	background-position: center;
}
.navBar{
	width: 100%;
	top: 0px;
    left: 0px;
    position: fixed;
    z-index: 1;
    background-color: #000;
    display: inline-block;
    padding: 10px;
    -webkit-transition: background-color .4s;
    margin-bottom: 0;
}
.footer{
	display: block;
	background-color: #212121;
}
#mainTitle{
	text-align: center;
	color: rgba(255,255,255,0);
	margin-top: 200px;
	text-shadow: 0px 0px 5px #000;
	-webkit-transition: margin-top .9s, color .8s;
}
</style>
@endsection

@section('body')
<div class="container">
<div align="center" style="margin-top: 150px;">
	<img src="/img/cucu3.gif" style="width: 15%; color: white;">
</div>
   	<h2 style="color:white; margin-top: 0;" id="mainTitle">Follow your passion!<br>Here you can visit all of the stadiums!</h2>
</div>
<br><br><br>
<div style="margin-bottom: 0; background-color:#B71C1C; " class="jumbotron">
	
</div>
<div id="map"></div>
@endsection

@section('js')
<script>
var map;
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 0, lng: 0},
        zoom: 6
    });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqiB2cyhlFaZJmw6_x1Cz7-AvGH5dkTLU&callback=initMap&language=EN" async defer></script>
@endsection