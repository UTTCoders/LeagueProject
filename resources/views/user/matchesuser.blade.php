@extends('user.userhome')

@section('title',"All matches")

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
		background-color: #fff;
	}
	.matchcard{
		border-radius:0; 
		border: 0px; 
		padding:0px;
		background-color: #111;
		color: #eee;
  		transition: box-shadow 0.2s ease-in-out;
	}
	.imgcard{
		background-color: #000;
		padding:30px 20px;
		height: 100%;
		background-position: center;
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
		border: solid 1px #666;
		border-radius: 0;
		box-shadow: 5px 5px #666;
		background-color: #fff;
	}
	#infoside{
		border-radius: 0;
		box-shadow: 5px 5px #00695C;
		padding: 10px 15px;
		font-size: 13px;
		text-align: justify;
		color: #666;
	}

	.padData{
		padding-top: 10px;
		padding-bottom: 10px;
	}

	.matchcard:hover{
		box-shadow: 3px 3px 3px black;
		cursor: pointer;
	}

	.t-row:hover{
		cursor: pointer;
	}
</style>
@endsection

@section('body2')
<div id="con">
	<div class="container">
	<div align="center">
		<img src="/img/soccer_player.jpg" style="width: 30%;">
	</div>
	@if($matches->count()>0)
		<h1 align="center" style="color:#111; margin-top: 20px; margin-bottom: 30px;">There are matches<br>taking place right now!</h1>
		<hr>
		<div class="thumbnail col-lg-9 col-xs-12" id="contcards">
		
		</div>
	@else
		<h1 align="center" style="color:#111; margin-top: 20px; margin-bottom: 30px;">Here you can see all of the matches!</h1>
	@endif
	</div>
</div>
<div class="jumbotron" style="margin-bottom: 0; background-color: #009688; color: #eee;">
	<div class="container">
		<div class="thumbnail col-lg-9" style="border-radius: 0; color: #111; padding-top: 20px; padding-bottom: 20px; box-shadow: 5px 5px #00695C;">
			<h2 align="center"><span class="glyphicon glyphicon-th-list"></span> Calendar</h2>
			@if(!App\League\Match::where('state',0)->count()>0)
			<div class="container">
				<div class="table-responsive">
					<table class="table">
						<tr align="center">
							<td><strong>Teams</strong></td>
							<td><strong>Stadium</strong></td>
							<td><strong>Date</strong></td>
							<td><strong>Start hour</strong></td>
						</tr>
						@foreach(App\League\Match::where('state',0)->get() as $match)
						<tr align="center">
							
						</tr>
						@endforeach
					</table>
				</div>
			</div>
			@else
			<h3 align="center">There're no matches</h3>
			@endif
		</div>
		<div class="thumbnail col-lg-2 col-lg-offset-1 hidden-xs hidden-sm hidden-md" id="infoside" style="color: #111;">
			<img src="/img/Logo La Liga Spain.png" class="img-responsive">
			<span style="font-size: 13px;"><span class="glyphicon glyphicon-euro"></span> Lorem ipsum dolor sit amet.<br>Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat.</span>
		</div>
	</div>
</div>
@endsection

@section('js2')
<script>
$(document).ready(function(){
	$(".t-row").click(function(){
		document.location.href="/stadiums/"+$(this).attr('id');
	});
});
</script>
@endsection