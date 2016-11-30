@extends('user.userhome')

@section('title',$stadium->name)

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
	@if(isset($match))
	<div>
		<img src="/img/icons/match1.png" style="width: 15%;">
	</div>
	<br>
	<h2 style="color:#eee; margin-top: 0px; margin-bottom: 0; text-shadow: 2px 2px 2px black;" id="mainTitle">{{$stadium->name}}</h2>
	@else
		<h1 style="color:#eee; margin-top: 0px; margin-bottom: 0; text-shadow: 2px 2px 2px black; font-size: 45px;" id="mainTitle">{{$stadium->name}}</h1>
		<br>
	<div>
		<img src="/img/icons/stadiumicon.png" style="width: 15%;">
	</div>
		<h2 style="color:#eee; margin-top: 10px; margin-bottom: 0;" id="mainTitle">{{$stadium->team->name}}</h2>
	@endif
	</div>
</div>
@if(isset($match))
	<h1 align="center" style="color:#eee; text-shadow: 1px 1px 1px black;">A match is taking place right now <br>at {{$stadium->name}}!</h1>
	<h3 style="color:#eee; margin-top: 10px; margin-bottom: 0;" id="mainTitle">
			<strong style="text-shadow: 2px 2px 2px black;">{{$stadium->team->name}}</strong> VS <span>{{$match->teams->where('id','!=',$stadium->team->id)->first()->name}}</span>
		</h3>
	
				<img src="/storage/{{$stadium->team->logo}}" style="width: 30%;">

				<img src="/storage/{{$stadium->team->logo}}" style="width: 30%;">

@else
<div class="jumbotron" style="background-color: #B71C1C; margin-bottom: 0;">
	<div class="container">
		<h1 style="color:#eee; font-size: 30px; text-shadow: 1px 1px 1px black;">Check the team information!</h1>
	</div>	
</div>
@endif
@endsection