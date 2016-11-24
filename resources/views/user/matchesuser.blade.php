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
		background-color: #B71C1C;
	}
	#matchcard{
		border-radius:0; 
		border: 0px; 
		padding:0px;
		box-shadow: 3px 3px black;
		background-color: #111;
		color: #eee;
	}
	#imgcard{
		background-color: #000;
		padding:30px 20px;
		height: 100%;
		background-image: url('/img/stadium.jpg');
	}
	#contcard{
		padding-top: 20px;
		padding-bottom: 20px;
		padding-right: 30px;
		padding-left: 30px;
	}
	#contcards{
		padding-top: 20px;
		padding-bottom: 20px;
		padding-right: 30px;
		padding-left: 30px;
		background-color: #eee;
		border-radius: 0;
		box-shadow: 2px 2px 2px #111;
	}
	#infoside{
		border-radius: 0;
	}
	#matchesMenu{
		background-color: #111;
		margin-bottom: 20px;
		box-shadow: 3px 3px black;
	}
	.optionM:hover{
		border-radius: 0;
		color: #111;
	}
	.activeOp{
		background-color: #eee;
	}
	a[class=optionM_S]{
		color:#111;
	}
</style>
@endsection

@section('body2')
<div id="con">
	<div class="container">
		<h1 style="color:#eee; margin-top: 20px; margin-bottom: 30px; text-shadow: 3px 3px 3px black;" id="mainTitle">Follow your passion!<br>Here you can see, all of the matches!</h1>
		<hr>
		<div class="thumbnail col-md-8 col-xs-12" id="contcards">
			<div id="matchesMenu" class="col-xs-12">
				<ul class="nav nav-pills">
				  <li role="presentation" class="activeOp"><a href="#" class="optionM_S">Right now!</a></li>
				  <li role="presentation"><a href="#" class="optionM">History</a></li>
				</ul>
			</div>

			<div class="row">
				<div id="matchcard" class="thumbnail col-xs-12">
					<div class="col-sm-5 col-xs-6" id="imgcard" align="center">
						<img src="/img/soccerball.png" style="width: 60%">
					</div>
					<div class="col-sm-7 col-xs-6">
						<h3 align="center">Cucu Rucu Cu</h3>
						<div class="hidden-xs">	
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
				</div>
			</div>
			<!--<div class="row">	
				<div id="matchcard" class="thumbnail col-xs-12">
					<div class="col-sm-7 col-xs-6">
						<h3 align="center">Cucu Rucu Cu</h3>
						<p align="justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
					<div class="col-sm-5 col-xs-6" id="imgcard" align="center">
						<img src="/img/soccerball.png" style="width: 60%">
					</div>
				</div>
			</div>-->
		</div>
		<div class="thumbnail col-md-3 col-md-offset-1 col-xs-12" id="infoside">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>
</div>
@endsection