@extends('layouts.master')

@section('title',Auth::user()->name." | Home")

@section('css')
<link rel="stylesheet" type="text/css" href="/css/someanyicss.css">
<style type="text/css"></style>
@endsection

@section('body')
<div class="coverContainer">
    <h2 style="color:white; margin-top: 100px;" id="mainTitle">Get in news about your favorite teams, follow their matches in real time,<br>view statistics and more...</h2>
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