@extends('user.userhome')

@section('title',"All teams")

@section('css2')
<style type="text/css">
	#con{
		background-color: #000;
		width: 100%;
		margin-top: 62px;/*size of the navbar*/
		background-image: url(/img/maxresdefault.jpg);
		background-repeat: no-repeat;
		background-size: 150%;
		background-position: center;
		margin-bottom: 0;
		margin-top: 0;
		border-bottom: 0;
		padding-top:90px;
		padding-bottom: 20px;
	}
	body,html{
		background-color: #fff;
		height: 100%;
		width: 100%;
		margin: 0; 
		padding: 0;
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
</style>
@endsection

@section('body2')
<div id="con">
	<div align="center">
		<img src="/img/cucu3.gif" style="width: 23%;">
		<h3 style=" color:#eee; margin-top: 0; margin-bottom: 0;" id="mainTitle"><b>Check all the teams of the Spain League!</b></h3>
	</div>
</div>
<div class="jumbotron" style="background-color: #B71C1C; padding-bottom: 70px; margin-bottom: 0; color: #eee;">
	<div class="container">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
			<h3>The list of the teams</h3>
			<hr>
			@if($teams->count()>0)
				<ul class="list-group">
				@foreach($teams as $team)
					<li style="font-weight: bold;" id="{{'list'.$team->id}}" class="list-group-item team action" name="{{$team->id}}"><div align="center"><span class="pull-left"><img src="/storage/{{$team->logo}}" style="width: 25px; max-height: 30px;"></span><span style="font-size: 17px;">{{$team->name}}</span><span class="glyphicon glyphicon-menu-down pull-right"></span></div></li>
					<li class="list-group-item submenu" id="{{$team->id}}">
					<section class="row">
						<section class="col-sm-6 col-xs-12" style="text-align: right;">
							<a href="/stadiums/{{$team->stadium->id}}"><img id="imgS"  style="border: 2px solid #90CAF9;" class="img-responsive" src="/storage/{{$team->stadium->photo}}"></a>
						</section>
						<section class="col-sm-6 col-xs-12" style=" padding-left: 20px; text-align: left;">
							<div style="margin-top: 15px; margin-bottom: 10px;">
								<span style="font-size: 18px;"><span><img src="/storage/{{$team->logo}}" style="width: 20px;"> {{$team->name}}</span>
								<br>
								<span style="font-size: 13px;"><b>Coach: </b>{{$team->coach->name.' '.$team->coach->last_name}}</span>
								<br>
								<span style="font-size: 13px;"><b>Stadium: </b>{{$team->stadium->name}}</span>
								<br><br>
								<input type="hidden" name="btn{{$team->id}}" value="{{$team->id}}">
								@if(in_array($team->id,$favorites))
								<button id="btn{{$team->id}}" style="border-radius: 0; border:1px solid #ccc;" class="btn btn-xs btn-default btnAddRemove" name="0"><span class="glyphicon glyphicon-remove"></span> Remove from favorites</button>
								@else
								<button id="btn{{$team->id}}" style="border-radius: 0; border:1px solid #ccc;" class="btn btn-xs btn-default btnAddRemove" name="1"><span class="glyphicon glyphicon-star-empty"></span> Add to favorites</button>
								@endif
							</div>
						</section>
					</section>
					</li>
				@endforeach
				</ul>
			@else
			<h3 align="center">There're no teams registered yet!</h3>
			@endif
		</div>
	</div>
	<br><br>
</div>
@endsection

@section('js2')
<script>
$(function(){
	$(".btnAddRemove").click(function(){
		var t=$("meta[name='toktok']").attr('content');
		var a=$(this).attr('name');
		var btnID=$(this).attr('id');
		var tid=$("input[name='"+btnID+"']").val();
		$.ajax({
			url:"/addremovefav",method:"post",
			data:{
				_token:t,action:a,teamid:tid
			}
		}).done(function(response){
			if (response.action) {
				$("#"+btnID).hide().html('<span class="glyphicon glyphicon-remove"></span> Remove from favorites').attr('name','0').delay(100).slideDown();
			}else{
				$("#"+btnID).hide().html('<span class="glyphicon glyphicon-star-empty"></span> Add to favorites').attr('name','1').delay(100).slideDown();
			}
		});
	});
});
</script>
<script src="/js/changablemenu.js"></script>
@endsection