@extends('user.userhome')

@section('title','Favorites')

@section('css2')
<style type="text/css">
	body{
		background-color: #fff;
	}
	.matchcard{
		border-radius:0; 
		padding:0px;
		margin:20px;
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
	.favStarCard{
		color:#E65100; 
		position: absolute;
		margin-top: 15px;
		font-weight: bold;
		font-size: 20px;
	}
	.list-group-item{
		color:#444;
	}
	.list-group-item.team{
		color:#444;
		border-radius: 0px;
	}
	.list-group-item.team:hover{
		cursor: pointer;
		background-color: #eee;
	}
	.con{
		padding-top: 100px;
		padding-bottom: 50px;
	}
</style>
@endsection

@section('body2')
<div class="con">
	<div class="container">
				<div class="col-xs-6" align="right">
					<img src="/img/icons/user.png" class="img-responsive">
				</div>
				<div class="col-xs-6" style="color:#111;">
					<h2>User info</h2>
					<p><b>Name: </b>{{Auth::user()->name}}</p>
					<p><b>Email: </b>{{Auth::user()->email}}</p>
				</div>	
	</div>
</div>
<div class="jumbotron" style="margin-bottom: 0px; color: #eee; background-color: #009688;">
	<div class="container">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
			<h2 align="center"><span class="glyphicon glyphicon-star"></span> Your favorite teams!</h2>
			<hr>
			@if(Auth::user()->teams()->count()>0)
				<ul class="list-group">
				@foreach(Auth::user()->teams as $team)
					<li style="font-weight: bold;" id="{{'list'.$team->id}}" class="list-group-item team action" name="{{$team->id}}"><div align="center"><span class="pull-left"><img src="/storage/{{$team->logo}}" style="width: 20px;"></span>{{$team->name}}<span class="glyphicon glyphicon-menu-down pull-right"></span></div></li>
					<li class="list-group-item submenu" id="{{$team->id}}">
					<section class="row">
						<section class="col-sm-6 col-xs-12" style="text-align: right;">
							<a href="/stadiums/{{$team->stadium->id}}"><img id="imgS"  style="border: 2px solid #90CAF9;" class="img-responsive" src="/storage/{{$team->stadium->photo}}"></a>
						</section>
						<section class="col-sm-6 col-xs-12" style="text-align: left;">
							<div style="margin-top: 15px; margin-bottom: 10px;">
								<span style="font-size: 18px;"><span><img src="/storage/{{$team->logo}}" style="width: 20px;"> {{$team->name}}</span>
								<br>
								<span style="font-size: 14px;"><b>Coach: </b>{{$team->coach->name.' '.$team->coach->last_name}}</span>
								<br>
								<span style="font-size: 14px;"><b>Stadium: </b>{{$team->stadium->name}}</span>
								<br><br>
								<input type="hidden" name="teamid" value="{{$team->id}}">
								<button style="border-radius: 0; border:1px solid #ccc;" class="btn btn-default btn-sm remove"><span class="glyphicon glyphicon-remove"></span> Remove</button>
							</div>
						</section>
					</section>
					</li>
				@endforeach
				</ul>
			@else
			<h3 align="center">You have no favorites dude! :(</h3>
			@endif
		</div>
	</div>
</div>
@endsection

@section('js2')
<script>
$(function(){
	$(".remove").click(function(){
		var team=$("input[name='teamid']").val();
		var string="#list"+team;
		var t=$("meta[name='toktok']").attr('content');
		$.ajax({
			url:"/addremovefav",method:"post",
			data:{
				teamid:team,_token:t,action:0
			}
		}).done(function(response){
			if (!response.action) {
				$("#"+team).slideUp().delay(1000,function(){
					$(string).slideUp();
				});
			}
		});
	});
});
</script>
<script src="/js/changablemenu.js"></script>
@endsection