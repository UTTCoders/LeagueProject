@extends('user.userhome')

@section('title','Favorites')

@section('css2')
<style type="text/css">
	body{
		background-color: #fff;
	}
	.matchcard{
		border-radius:0; 
		border: solid 1px #666;
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
</style>
@endsection

@section('body2')
<div class="container" style="margin-top: 100px; margin-bottom: 50px;">
			<div class="col-xs-6" align="right">
				<img src="/img/icons/user.png" class="img-responsive">
			</div>
			<div class="col-xs-6" style="color:#111;">
				<h2>User info</h2>
				<p><b>Name: </b>{{Auth::user()->name}}</p>
				<p><b>Email: </b>{{Auth::user()->email}}</p>
			</div>	
</div>
<div class="jumbotron" style="margin-bottom: 0px; color: #eee; background-color: #009688;">
	<div class="container">
		<h2>Your favorites</h2>
		<div class="row">
		@if(Auth::user()->teams()->count()>0)
			@foreach(Auth::user()->teams as $team)
					<div class="thumbnail col-sm-5 col-xs-10 matchcard hidden-sm" id="{{$team->id}}">
						<div class="col-sm-5 imgcard" style="background-image: url('{{'/storage/'.$team->stadium->photo}}');" align="center">
							<img src="/img/icons/star.png" style="width: 60%;">
						</div>
						<div class="col-sm-7 padData" style="color:#111;">
							<h3 align="center"><img style="width: 30px; border-radius: 100%;" src="/storage/{{$team->logo}}"> {{$team->name}}</h3>
							<span>Stadium: <a style="color:#111;" name="{{$team->id}}" href="/stadiums/{{$team->stadium->id}}">{{$team->stadium->name}}</a></span>
						</div>
					</div>
					
			@endforeach
		@else

		@endif
		</div>
	</div>
</div>


@endsection