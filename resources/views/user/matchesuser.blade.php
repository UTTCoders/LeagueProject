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
		background-color: #eee;
		border-radius: 0;
		box-shadow: 2px 2px 2px #111;
		/*min-height: 200px;*/
	}
	#infoside{
		border-radius: 0;
	}

	/*CSS For the matches menu*/
	#matchesMenu{
		background-color: #111;
		margin-bottom: 20px;
		box-shadow: 3px 3px black;
	}
	.optionM:hover{
		border-radius: 0;
		color: #111;
		cursor:pointer;
	}
	.activeOp{
		background-color: #CDDC39;
	}

	/*Select al classes containing ‘keyword’ whether it’s first, last or part of a name*/
	a[class*=Selected]{
		color:#111;
	}

	.padData{
		padding-top: 10px;
		padding-bottom: 10px;
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
					@if(isset($favorites))
					<li role="presentation"><a class="optionM" id="now">Now!</a></li>
				  	<li role="presentation" class="activeOp"><a class="optionM Selected" id="favorites"><span class="glyphicon glyphicon-star-empty"></span><span class="hidden-xs"> My favorites</span></a></li>
					@else
				  	<li role="presentation" class="activeOp"><a class="optionM Selected" id="now">Now!</a></li>
				  	<li role="presentation"><a class="optionM" id="favorites"><span class="glyphicon glyphicon-star-empty"></span><span class="hidden-xs"> My favorites</span></a></li>
				  	@endif
				  	<li role="presentation"><a class="optionM" id="history">History</a></li>
				</ul>
			</div>
			<div id="menuResults">
				<div id="menuContent">
				@if(isset($favorites))

				@else
					@if($matches->count()>0)
					@foreach($matches as $match)
					<div class="row">
						<div id="matchcard" class="thumbnail col-xs-12">
							<div class="col-sm-5 col-xs-6" id="imgcard" style="background-image: url('{{'/storage/'.$match->teams->where('pivot.local',true)->first()->stadium->photo}}');" align="center">
								<img src="/img/soccerball.png" style="width: 60%">
							</div>
							<div class="col-sm-7 col-xs-6 padData">
								<h3 align="center"><strong>{{$match->teams->where('pivot.local',true)->first()->name}}</strong> VS {{$match->teams->where('pivot.local',false)->first()->name}}</h3>
								<div class="hidden-xs">	
								<p><strong>Stadium: </strong>{{$match->teams->where('pivot.local',true)->first()->stadium->name}}</p>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@else
					@endif
				@endif
				</div>
			</div>
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

@section('js2')
<script>
$(document).ready(function(){
$(".optionM").click(function(){
	if (!$(this).hasClass('Selected')) {
		$(".Selected").parent().removeClass('activeOp');
		$(".Selected").removeClass('Selected');
		$(this).addClass('Selected');
		$(this).parent().addClass('activeOp');
		var t=$("meta[name='toktok']").attr('content');
		var op=$(this).attr('id');
		$.ajax({
			url:"/getmatches",
			method:"post",
			data:{
				_token:t,
				option:op
			}
		}).done(function(response){
			$("#menuResults").children().slideUp('300').html(response).slideDown('300');
		});
	}
});

});
</script>
@endsection