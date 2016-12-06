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
	body{
		background-color: white;
	}
	.comment{
		font-size: 13px;
		color: #666;
	}
	#commentSection{
		max-height: 500px;
		width: 100%;
		overflow-y: auto;
		padding: 10px;
		border-top: 1px solid #D9EDF7;
	}
	.commentCard{
		border-radius: 0;
		box-shadow: 1px 1px #eee;
	}
	textarea{
		resize: none;
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
	<h3 style="color:#eee; margin-top: 10px; margin-bottom: 0;" id="mainTitle"><img src="/storage/{{$stadium->team->logo}}" style="width: 30px; max-height: 35px; border-radius: 100%;"> <strong>{{$stadium->team->name}}</strong> VS <strong>{{$teams["visitor"]->name}}</strong> <img src="/storage/{{$teams['visitor']->logo}}" style="width: 30px; max-height: 35px; border-radius: 100%;"></h3>
</div>
<br><br>
<div class="container">
	<h2 style="color:#111;">A match is taking place right now!</h2>
	<hr style="border-color: #111;">
	<div class="row" style="color:#444;">
		<div class="col-md-6 col-xs-12">
			<div id="goalSection">
				@include('user.goals')
			</div>
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
	<br>
		<div class="col-sm-9 col-xs-11">
			<h4 id="commentsIndicator" style="color:#444;">Comments - {{$match->comments()->count()}}</h4>
			<div id="commentSection">
				@include('user.comments')
			</div>
			<input type="hidden" name="thematchid" value="{{$match->id}}">
			<br>
			@if(($match->state==1 || $match->state==3) && $allowComment)
				<div class="col-xs-12">
					<div class="form-group">
						<label>Leave a comment:</label><span class="pull-right" id="charIN">(140 left)</span>
						<textarea id="textareaC" style="border-radius: 0;" rows="3" maxlength="140" class="form-control"></textarea>
					</div>
					<button style="border-radius: 0; border:1px solid #ccc;" id="btnSendComment" class="btn btn-default pull-right">Send</button>
				</div>
			@endif
		</div>
	</div>
</div>
<br><br>
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

				<input type="hidden" name="teamid" value="{{$stadium->team->id}}">
				@if($isFav)
				<button style="border-radius: 0; border:1px solid #ccc;" id="btnAddRemove" class="btn btn-default" name="0"><span class="glyphicon glyphicon-remove"></span> Remove from favorites</button>
				@else
				<button style="border-radius: 0; border:1px solid #ccc;" id="btnAddRemove" class="btn btn-default" name="1"><span class="glyphicon glyphicon-star-empty"></span> Add to favorites</button>
				@endif
		</div>
	</div>
	</div>	
</div>
@endsection

@section('js2')
@if(isset($match))
	@if(($match->state==1 || $match->state==3))
		@if($allowComment)
		<script>
		$(function(){
			$("textarea").on('input', function() {
				$("#charIN").text("("+(140-$(this).val().length)+" left)");
			});

			$("#btnSendComment").click(function(){
				if (!$.trim($("textarea").val()).length == 0 
				&& $("textarea").val().length<=140){
					var t=$("meta[name='toktok']").attr('content');
					var comment=$("textarea").val();
					var match=$("input[name='thematchid']").val();
					$.ajax({
						url:"/sendcomment",method:"post",
						data:{_token:t,content:comment,matchid:match}
					}).done(function(response){
						if (response.result) {
							$("textarea").val('');
							$("#charIN").text("(140 left)");
						}
					});
				}
			});;
		});
		</script>
		@endif
		<!--here ask for the comments events and goals-->
		<script>
		$(function(){
			var askData=function(){
				var t=$("meta[name='toktok']").attr('content')
				var count=$("input[name='commentsCount']").val()
				var match=$("input[name='thematchid']").val()
				$.ajax({
					url:'/askcomments',method:'post',
					data:{_token:t,matchid:match,cc:count}
				}).done(function(response){
					if (response.new) {
						$("#commentSection").html(response.comments)
						$("#commentsIndicator").text("Comments - "+response.newcount)
					}
				})

				var goalsCount=$("input[name='goalsCount']").val()
				$.ajax({
					url:'/askgoals',method:'post',
					data:{_token:t,matchid:match,gc:goalsCount}
				}).done(function(response){
					if (response.newgoals) {
						$("#goalSection").html(response.marker)
					}
				})
			}
			setInterval(askData,1000)
		});
		</script>
	@endif
	<!--Here ask for the state-->
@endif
<script>
$(function(){
	$("#btnAddRemove").click(function(){
		var t=$("meta[name='toktok']").attr('content');
		var a=$(this).attr('name');
		var tid=$("input[name='teamid']").val();
		$.ajax({
			url:"/addremovefav",method:"post",
			data:{
				_token:t,action:a,teamid:tid
			}
		}).done(function(response){
			if (response.action) {
				$("#btnAddRemove").hide().html('<span class="glyphicon glyphicon-remove"></span> Remove from favorites').attr('name','0').delay(100).slideDown();
			}else{
				$("#btnAddRemove").hide().html('<span class="glyphicon glyphicon-star-empty"></span> Add to favorites').attr('name','1').delay(100).slideDown();
			}
		});
	});
});
</script>
@endsection