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
		background-color: #eee;
		border-radius: 0;
		box-shadow: 2px 2px 2px #111;
	}
	#infoside{
		border-radius: 0;
		box-shadow: 2px 2px 2px #000;
		padding: 10px 15px;
		font-size: 13px;
		text-align: justify;
		color: #666;
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
		background-color: #eee;
	}

	/*Select al classes containing ‘keyword’ whether it’s first, last or part of a name*/
	a[class*=Selected]{
		color:#111;
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
		<h1 style="color:#eee; margin-top: 20px; margin-bottom: 30px; text-shadow: 3px 3px 3px black;" id="mainTitle">Follow your passion!<br>Here you can see, all of the matches!</h1>
		<hr>
		<div class="thumbnail col-lg-9 col-xs-12" id="contcards">
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

				@if(isset($favorites))
					@include('user.favmatches')
				@else
					@include('user.nowmatches')
				@endif

			</div>
		</div>
		<div class="thumbnail col-lg-2 col-lg-offset-1 hidden-xs hidden-sm hidden-md" id="infoside">
			<img src="/img/Logo La Liga Spain.png" class="img-responsive">
			<p><span class="glyphicon glyphicon-euro"></span> Lorem ipsum dolor sit amet.<br>Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat.</p>
		</div>
	</div>
</div>
<div class="jumbotron">
	
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
				//$("#menuResults").slideUp().html(response).slideDown();
				$("#menuResults").html(response);
				//.html(response).slideDown('300');
			});
		}
	});

	$(".t-row").click(function(){
		document.location.href="/stadiums/"+$(this).attr('id');
	});
});
</script>
@endsection