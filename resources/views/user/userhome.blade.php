@extends('layouts.master')

@section('title',Auth::user()->name." | Home")

@section('css')
<link rel="stylesheet" type="text/css" href="/css/someanyicss.css">
<style type="text/css">
#map{
	margin-top: 70px;
	width: 100%;
	height: 90%;
}
html, body { 
	height: 100%;
	margin: 0; 
	padding: 0;
	background-color: #212121;
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
}      
</style>
@endsection

@section('body')
<div class="container">
   	<h2 style="color:white; margin-top: 140px;" id="mainTitle">Follow your passion!<br>Here you can see all of the stadiums.</h2>
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