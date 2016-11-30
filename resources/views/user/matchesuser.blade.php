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
		border: solid 1px #666;
		padding:0px;
		background-color: #fff;
		color: #111;
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
		padding-top: 10px;
		padding-bottom: 30px;
		padding-right: 43px;
		padding-left: 43px;
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
		padding-top: 13px;
		padding-bottom: 10px;
	}

	.matchcard:hover{
		box-shadow: 3px 3px #666;
		cursor: pointer;
	}

	.t-row:hover{
		cursor: pointer;
	}

	.favText{
		color: #E65100;
		font-weight: bold;
	}

	.favStarCard{
		color:#E65100; 
		position: absolute;
		margin-top: 15px;
		font-weight: bold;
		font-size: 20px;
	}

	.favStarRow{
		color:#E65100; 
		font-weight: bold;
		font-size: 18px;
		text-align: left;
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
		<br>
		<div class="thumbnail col-lg-10 col-xs-12" id="contcards">
		<h3 style="color:#111; margin-bottom: 15px;">Check them out!</h3>
		@foreach($matches as $match)
			<div class="row">
				<a href="{{'/stadiums/'.$match->teams->where('pivot.local',true)->first()->stadium->id}}" class="thumbnail col-sm-12 matchcard hidden-xs hidden-sm">
					<div class="col-sm-5 imgcard" style="background-image: url('{{'/storage/'.$match->teams->where('pivot.local',true)->first()->stadium->photo}}');" align="center">
						<img src="/img/icons/match1.png" style="width: 60%">
					</div>
					<div class="col-sm-7 padData" style="color:#111;">
					@if(isset($match->teams[0]['favorite']) || isset($match->teams[1]['favorite']))
					<span class="glyphicon glyphicon-star-empty favStarCard"></span>
					@endif
					<div>
						<h3 align="center"><img style="width: 30px; border-radius: 100%;" src="/storage/{{$match->teams->where('pivot.local',true)->first()->logo}}"> @if(isset($match->teams->where('pivot.local',true)->first()['favorite']))<span class="favText">@endif{{$match->teams->where('pivot.local',true)->first()->name}}@if(isset($match->teams->where('pivot.local',true)->first()['favorite']))</span>@endif VS @if(isset($match->teams->where('pivot.local',false)->first()['favorite']))<span class="favText">@endif{{$match->teams->where('pivot.local',false)->first()->name}}@if(isset($match->teams->where('pivot.local',false)->first()['favorite']))</span>@endif <img style="width: 30px; border-radius: 100%;" src="/storage/{{$match->teams->where('pivot.local',false)->first()->logo}}"></h3>
					</div>

					<hr style="border-color: #666;">
					<div>
						<div class="col-sm-5" align="left">
							<p><strong><span class="glyphicon glyphicon-flag"></span> Stadium: </strong>{{$match->teams->where('pivot.local',true)->first()->stadium->name}}</p>
							<p><strong><span class="glyphicon glyphicon-bookmark"></span> Local: </strong>{{$match->teams->where('pivot.local',true)->first()->name}}</p>
						</div>
						<div class="col-sm-7" align="left">	
							<p><strong><span class="glyphicon glyphicon-user"></span> Referee: </strong>{{$match->referee->name." ".$match->referee->last_name}}</p>
							@if($match->state==1)
							<p><strong><span class="glyphicon glyphicon-time"></span> State: </strong>1st Time</p>
							@elseif($match->state==2)
							<p><strong><span class="glyphicon glyphicon-time"></span> State: </strong>Breaktime</p>
							@else
							<p><strong><span class="glyphicon glyphicon-time"></span> State: </strong>2nd Time</p>
							@endif
						</div>
					</div>
					</div>
				</a>
			</div>
		@endforeach
		<div class="table-responsive hidden-md hidden-lg">
			<table class="table table-hover" style="border: solid 1px #666;">
				<tr align="center" style="background-color: #111; color: #eee;">
					<td><strong>Teams</strong></td>
					<td class="hidden-xs"><strong><span class="glyphicon glyphicon-flag"></span> Stadium</strong></td>
					<td><strong>State</strong></td>
				</tr>
				@foreach($matches as $match)
				<tr id="{{$match->teams->where('pivot.local',true)->first()->stadium->id}}" align="center" style="color:#111;" class="t-row">
					<td style="vertical-align: middle;">@if(isset($match->teams->where('pivot.local',true)->first()['favorite']))<span class="glyphicon glyphicon-star-empty favStarRow"></span>@endif<img style="width: 30px; border-radius: 100%;" src="/storage/{{$match->teams->where('pivot.local',true)->first()->logo}}"> @if(isset($match->teams->where('pivot.local',true)->first()['favorite']))<span class="favText">@endif{{$match->teams->where('pivot.local',true)->first()->name}}@if(isset($match->teams->where('pivot.local',true)->first()['favorite']))</span>@endif VS @if(isset($match->teams->where('pivot.local',false)->first()['favorite']))<span class="favText">@endif{{$match->teams->where('pivot.local',false)->first()->name}}@if(isset($match->teams->where('pivot.local',false)->first()['favorite']))</span>@endif <img style="width: 30px; border-radius: 100%;" src="/storage/{{$match->teams->where('pivot.local',false)->first()->logo}}">@if(isset($match->teams->where('pivot.local',false)->first()['favorite']))<span class="glyphicon glyphicon-star-empty favStarRow"></span>@endif</td>
					<td style="vertical-align: middle;" class="hidden-xs">{{$match->teams->where('pivot.local',true)->first()->stadium->name}}</td>
					<td style="vertical-align: middle;">
						@if($match->state==1)
						<span><strong><span class="glyphicon glyphicon-time"></span></strong> 1st Time</span>
						@elseif($match->state==2)
						<span><strong><span class="glyphicon glyphicon-time"></span></strong> Breaktime</span>
						@else
						<span><strong><span class="glyphicon glyphicon-time"></span></strong> 2nd Time</span>
						@endif
					</td>
				</tr>
				@endforeach
			</table>
		</div>
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