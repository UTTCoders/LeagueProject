@extends('user.userhome')

@section('title',$stadium->name." | Stadium")

@section('css2')
<style type="text/css">
	#con{
		background-color: #000;
		width: 100%;
		margin-top: 62px;/*size of the navbar*/
		background-image: url(/storage/{{$stadium->photo}});
		background-repeat: no-repeat;
		background-size: 150%;
		background-position: center;
		margin-bottom: 0;
		margin-top: 0;
		border-bottom: 0;
		padding-top:90px;
		padding-bottom: 20px;
	}
	body{
		background-color: white;
	}
</style>
@endsection

@section('body2')
<div id="con">
	<div align="center">
	<h1 style="color:#eee; margin-top: 0px; margin-bottom: 0; text-shadow: 2px 2px 2px black;" id="mainTitle">{{$stadium->name}}</h1>
	<br>

	<img src="/img/soccerball.png" style="width: 15%;">
	<h3 style="color:#eee; margin-top: 10px; margin-bottom: 0;" id="mainTitle">
		<strong style="text-shadow: 2px 2px 2px black;">{{$stadium->team->name}}</strong> VS <span>Other team</span>
	</h3>
	</div>
</div>
@if(isset($match))
@else
<div class="jumbotron" style="background-color: #004D40; margin-bottom: 0;">
<h1 align="center" style="color:#eee; font-size: 40px; text-shadow: 1px 1px 1px black;">A match is taking place right now <br>at {{$stadium->name}}!</h1>
</div>
@endif
@endsection