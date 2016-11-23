@extends('user.userhome')

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
	<h1 style="color:#eee; margin-top: 0px; margin-bottom: 0;" id="mainTitle">{{$stadium->name}}</h1>
	<br>

	<img src="/img/soccerball.png" style="width: 15%;">
	<h3 style="color:#eee; margin-top: 10px; margin-bottom: 0;" id="mainTitle">
		<strong>{{$stadium->team->name}}</strong> VS <span>Other team</span>
	</h3>
	</div>
</div>
<div class="">
	
</div>
@endsection