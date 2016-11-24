@extends('user.userhome')

@section('title'," | Stadium")

@section('css2')
<style type="text/css">
	#con{
		width: 100%;
		margin-top: 62px;/*size of the navbar*/
		margin-bottom: 0;
		margin-top: 0;
		border-bottom: 0;
		padding-top:90px;
		padding-bottom: 20px;
	}
	body{
		background-color: #388E3C;
	}
	#matchcard{
		border-radius:0; 
		border: 0px; 
		padding:0px;
	}
	#imgcard{
		background-color: #000;
		padding:30px 20px;
		height: 100%;
	}
</style>
@endsection

@section('body2')
<div id="con">
	<div class="container">
		<div id="matchcard" class="thumbnail col-md-6 col-xs-12">
			<div class="col-xs-6" id="imgcard" align="center">
				<img src="/img/soccerball.png" style="width: 70%">
			</div>
			<div class="col-xs-6">
				<h3 align="center">Cucu Rucu Cu</h3>
				<p align="justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
		</div>
	</div>
</div>
@if(isset($match))
@else
<div class="jumbotron" style="background-color: #eee; margin-bottom: 0;">
<h1 align="center" style="color:#eee; font-size: 40px; text-shadow: 1px 1px 1px black;">OPtions!</h1>
</div>
@endif
@endsection