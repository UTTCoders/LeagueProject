@extends('user.userhome')

@section('title','Favorites')

@section('css2')
<style type="text/css">
	.matchcard{
		border-radius:0; 
		border: solid 1px #666;
		padding:0px;
		margin:10px;
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
<div class="container" style="margin-top: 70px;">
	@if(Auth::user()->teams()->count()>0)
		@foreach(Auth::user()->teams as $team)
				<div class="thumbnail col-sm-5 matchcard">
					<div class="col-sm-5 imgcard" style="background-image: url('{{'/storage/'.$team->stadium->photo}}');" align="center">
						<img src="/img/icons/star.png" style="width: 60%;">
					</div>
					<div class="col-sm-7 padData" style="color:#111;">
						<div>
							<h3 align="center"><img style="width: 30px; border-radius: 100%;" src="/storage/{{$team->logo}}"> {{$team->name}}</h3>
						</div>
						<div>
							<p>lorem</p>
						</div>
					</div>
				</div>
				<div class="thumbnail col-sm-5 matchcard">
					<div class="col-sm-5 imgcard" style="background-image: url('{{'/storage/'.$team->stadium->photo}}');" align="center">
						<img src="/img/icons/star.png" style="width: 60%;">
					</div>
					<div class="col-sm-7 padData" style="color:#111;">
						<div>
							<h3 align="center"><img style="width: 30px; border-radius: 100%;" src="/storage/{{$team->logo}}"> {{$team->name}}</h3>
						</div>
						<div>
							<p>lorem</p>
						</div>
					</div>
				</div>
		@endforeach
	@else

	@endif
</div>
@endsection