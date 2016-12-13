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
		border-top: 1px solid #ccc;
	}
	.commentCard{
		border-radius: 0;
		box-shadow: 1px 1px #eee;
	}
	textarea{
		resize: none;
	}
	#events{
		border-radius: 0;
		overflow-y: auto;
		height: 150px;
		padding-left: 20px;
		border-top: 1px solid #ccc;
		border-bottom: 1px solid #ccc;
		background-color: #ccc;
	}
	.event{
		margin:5px 0px;
		border-radius: 0px;
		padding:5px 13px;
	}
	.list-group-item.player{
		border-radius: 0px;
	}
	.list-group-item.player:hover{
		cursor:pointer;
		background-color: #eee;
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
	<h3 style="color:#eee; margin-top: 10px; margin-bottom: 0;" id="mainTitle"><img src="/storage/{{$stadium->team->logo}}" style="width: 30px; max-height: 35px;"> <strong>{{$stadium->team->name}}</strong> <br class="hidden-md hidden-sm hidden-lg">VS <strong>{{$teams["visitor"]->name}}</strong> <img src="/storage/{{$teams['visitor']->logo}}" style="width: 30px; max-height: 35px;"></h3>
</div>
<br><br>
<div class="container">
	<h2 style="color:#111;">A match is taking place right now!<br><small id="stateIndicator"><span class="glyphicon glyphicon-time"></span> @if($match->state==1)1st time @elseif($match->state==2)Break time @elseif($match->state==3)2nd time @endif</small></h2>
	<input type="hidden" name="actualState" value="{{$match->state}}">
	<hr style="border-color: #111;">
	<div class="row" style="color:#444;">
		<div class="col-md-6 col-xs-12">
			<div id="goalSection" style="color:#111;">
				@include('user.goals')
			</div>
		</div>
		<div class="col-md-5 col-xs-12">
		<div class="hidden-md hidden-lg"><br><br><br></div>
			<div id="pieChart" style="width:100%; height:210px; margin: 0 auto"></div>
			<input type="hidden" name="possession1" value="{{$match->teams[0]->pivot->ball_possesion}}">
		<div class="hidden-md hidden-lg"><br></div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<br>
			<h4 style="color:#444; font-weight: bold;"><span class="glyphicon glyphicon-flash"></span> Events</h4>
			<div class="col-xs-11" id="events">
				@include('user.events')
			</div>
		</div>
	</div>
	<br>
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
				<div class="col-xs-12" id="commentForm">
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
		<div class="hidden-xs">
			<img src="/img/icons/stadium3flat.png" style="width: 15%; border-radius: 100%;">
		</div>
		<br>
		<h2 style="color:#eee; margin-top: 0px; margin-bottom: 0;" id="mainTitle">{{$stadium->name}}</h2>
	</div>
	<h3 style="color:#eee; margin-top: 10px; margin-bottom: 0;" id="mainTitle"><img src="/storage/{{$stadium->team->logo}}" style="width: 35px; max-height: 40px;"> <strong>{{$stadium->team->name}}</strong></h3>
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
				<span>Logo: <img style="width: 45px; max-height: 55px;" src="/storage/{{$stadium->team->logo}}"></span></p>

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
@if($stadium->team->players->count()>0)
<div class="container">
	<div class="row" style="padding-top: 50px; padding-bottom: 55px;">
		<div class="col-xs-12 col-md-8">
			<h3>{{$stadium->team->name}} team</h3>
			<ul class="list-group">
				@foreach($stadium->team->players as $player)
					<li style="font-weight: bold;" class="list-group-item player action" name="{{$player->id}}"><div align="center"><span class="pull-left">Shirt {{$player->shirt_number}}</span>{{$player->name.' '.$player->last_name}}<span id="littleToggle" class="glyphicon glyphicon-menu-down pull-right"></span></div></li>
					<li class="list-group-item submenu" id="{{$player->id}}">
					<section class="row">
						<section class="col-xs-5 col-sm-4" style="text-align: right;">
							<img style="width: 100px; border-radius: 100%;" src="/storage/{{$player->photo}}">
						</section>
						<section class="col-xs-7 col-sm-8" style="text-align: left;">
							<p style="font-size: 13px;"><b>Full name: </b>{{$player->name.' '.$player->last_name}}</p>
							<p style="font-size: 13px;"><b>Nationality: </b>{{$player->nationality}}</p>
							<p style="font-size: 13px;"><b>Shirt number: </b>{{$player->shirt_number}}</p>
						</section>
					</section>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endif
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

				var eC=$("input[name='eventsCount']").val()
				$.ajax({
					url:"/askevents",method:"post",
					data:{_token:t,matchid:match,ec:eC}
				}).done(function(response){
					if (response.change) {
						console.log("bool works!");
					}
				})
			}
			setInterval(askData,1000)
		});
		</script>
	@endif
	<!--Here ask for the state-->
	<script>
	$(function(){
		var askState=function(){
			var t=$("meta[name='toktok']").attr('content')
			var match=$("input[name='thematchid']").val()
			var actual=$("input[name='actualState']").val()
			$.ajax({
				url:'/askstate',method:'post',
				data:{_token:t,matchid:match,actualState:actual}
			}).done(function(response){
				if (response.change) {
					if (response.state==2) {
						$("#commentForm").hide()
						$("#stateIndicator").html("<span class='glyphicon glyphicon-time'></span> Break time")
					}else if(response.state==3){
						location.reload();
					}else if(response.state==4){
						document.location.href="/results/"+match
					}
				}
			})
		}
		setInterval(askState,1000)
	});
	</script>
<script src="/Highcharts/js/highcharts.js"></script>
<script>
$(document).ready(function(){
	var brands=[];
			brands[0]={name:"{{$match->teams[0]->name}}",y:Number("{{$match->teams[0]->pivot->ball_possesion}}") };
			brands[1]={name:"{{$match->teams[1]->name}}",y:Number("{{$match->teams[1]->pivot->ball_possesion}}") };
			var chart = new Highcharts.Chart({
	    	chart: {
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: false,
	            type: 'pie',
	            renderTo: 'pieChart'
	        },
	        credits: {
	        	enabled: false
	        },
	        title: {
	            text: 'Ball possession'
	        },
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	        },
	        plotOptions: {
	            pie: {
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: true,
	                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
	                    style: {
	                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
	                    }
	                }
	            }
	        },
	        series: [{
	            name: 'Ball',
	            colorByPoint: true,
	            data: brands
	        	}]
	    	});

	var askChart=function(){
		var t=$("meta[name='toktok']").attr('content')
		var match=$("input[name='thematchid']").val()
		var pos=$("input[name='possession1']").val();
	    $.ajax({                       
		    url:"/askchart", type:"post", 
		    data:{ _token:t,matchid:match,pos1:pos}
	    }).done(function(response){ 
	    	if (response.change) {
	    		$("input[name='possession1']").val(response.teams[0].pivot.ball_possesion);
			    var brands=[];
				brands[0]={name:response.teams[0].name,
					y:Number(response.teams[0].pivot.ball_possesion)};
				brands[1]={name:response.teams[1].name,
					y:Number(response.teams[1].pivot.ball_possesion)};
				var chart = new Highcharts.Chart({
		    	chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false,
		            type: 'pie',
		            renderTo: 'pieChart'
		        },
		        credits: {
		        	enabled: false
		        },
		        title: {
		            text: 'Ball possession'
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		        },
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: true,
		                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                    style: {
		                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                    }
		                }
		            }
		        },
		        series: [{
		            name: 'Ball',
		            colorByPoint: true,
		            data: brands
		        	}]
		    	});
	    	}
		});
	}
	setInterval(askChart,60000);
});
</script>
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
<script src="/js/changablemenu.js"></script>
@endsection