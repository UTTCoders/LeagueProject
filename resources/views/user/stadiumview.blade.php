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
	#con2{
		width: 100%;
		margin-top: 62px;/*size of the navbar*/
		background-repeat: no-repeat;
		background-size: 150%;
		background-position: center;
		margin-bottom: 0;
		margin-top: 0;
		border-bottom: 0;
		padding-top:90px;
		padding-bottom: 20px;
		text-align: center;
	}
	body{
		background-color: white;
	}
	.comment{
		font-size: 13px;
		color: #666;
	}
</style>
@endsection

@section('body2')

@if(isset($match))
<div id="con">
	<div align="center">
		<div>
			<img src="/img/icons/match1.png" style="width: 15%;">
		</div>
		<br>
		<h2 style="color:#eee; margin-top: 0px; margin-bottom: 0;" id="mainTitle">{{$stadium->name}}</h2>
	</div>
	<h3 style="color:#eee; margin-top: 10px; margin-bottom: 0;" id="mainTitle"><img src="/storage/{{$stadium->team->logo}}" style="width: 30px; max-height: 35px; border-radius: 100%;"> <strong>{{$stadium->team->name}}</strong> VS <strong>{{$match->teams->where('id','!=',$stadium->team->id)->first()->name}}</strong> <img src="/storage/{{$match->teams->where('id','!=',$stadium->team->id)->first()->logo}}" style="width: 30px; max-height: 35px; border-radius: 100%;"></h3>
</div>
<br><br>
<div class="container">
	<h2 style="color:#111;">A match is taking place right now!</h2>
	<hr style="border-color: #111;">
	<div class="row" style="color:#444;">
		<div class="col-md-6 col-xs-12">
			<h1 align="center"><strong>{{$stadium->team->name}} - 3</strong></h1>
			<h1 align="center">vs</h1>
			<h1 align="center"><strong>{{$match->teams->where('id','!=',$stadium->team->id)->first()->name}}</strong> - 2</h1>
		</div>
		<div class="col-md-5 col-xs-12 thumbnail">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-9 col-xs-12">	
			<h4 style="color:#444;">Comments section</h4>
			<div id="commentSecion">
			@foreach($match->comments as $comment)
				<div class="thumbnail col-xs-12">
					<div class="col-xs-12">
						<h4>{{$comment->name}} <small style="text-align: right;" class="pull-right">{{date_format(date_create($comment->pivot->date),"Y/F/d")}} <br>{{date_format(date_create($comment->pivot->date),"g:i a")}}</small></h4>
						<br>
						<p class="comment">{{$comment->pivot->content}}</p>
					</div>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>

@else
<div id="con">
	<div align="center">
		<div>
			<img src="/img/icons/stadium3flat.png" style="width: 18%; border-radius: 100%;">
		</div>
		<br>
		<h2 style="color:#eee; margin-top: 0px; margin-bottom: 0;" id="mainTitle">{{$stadium->name}}</h2>
	</div>
	<h3 style="color:#eee; margin-top: 10px; margin-bottom: 0;" id="mainTitle"><img src="/storage/{{$stadium->team->logo}}" style="width: 30px; max-height: 35px; border-radius: 100%;"> <strong>{{$stadium->team->name}}</strong></h3>
</div>
@endif
<div class="jumbotron" style="background-color: #43A047; margin-bottom: 0; color: #eee;">
	<div class="container">
	<div class="row">
		<div class="col-sm-5 hidden-xs" align="right">
			<img src="/img/icons/field.png" class="img-responsive">
		</div>
		<div class="col-xs-11 col-xs-offset-1 col-sm-6 col-sm-offset-1">
			<h1 style="color:#eee; font-size: 30px;">Check the team info!</h1>
				<p style="font-size: 15px; font-weight: bold;">
				<span>Name: {{$stadium->team->name}} ®</span><br>
				<span>Coach: {{$stadium->team->coach->name.' '.$stadium->team->coach->last_name}}</span><br>
				<span>Foundation date: {{date_format(date_create($stadium->team->foundation_date),"Y - F - d")}}</span><br>
				<span>Logo: <img style="width: 45px; max-height: 55px; border-radius: 100%;" src="/storage/{{$stadium->team->logo}}"></span></p>
			
		</div>
	</div>
	</div>	
</div>
@endsection