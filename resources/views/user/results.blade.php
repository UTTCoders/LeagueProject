@extends('user.userhome')

@section('title','Match Results')

@section('css2')
<style type="text/css">
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
	.content{
		padding-top: 100px;
	}
	#goalSection{
		color:#111;
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
</style>
@endsection

@section('body2')
<div class="container content">
	<h2 style="color:#111;"><strong>@if($teams["local"]["goals"] > $teams["visitor"]["goals"])Victorious: {{$teams["local"]->name}}@elseif($teams["local"]["goals"] < $teams["visitor"]["goals"])Victorious: {{$teams["visitor"]->name}}@else Result: Equals!@endif</strong></h2>
	<hr style="border-color: #111;">
	<div class="row" style="color:#444;">
		<div class="col-md-6 col-xs-12">
			<div id="goalSection">
			<h3 align="center" style="font-weight: bold;">Final marker:</h3>
				@include('user.goals')
			</div>
		</div>
		<div class="col-md-5 col-xs-12">
		<br>
		<div class="hidden-md hidden-lg"><br><br><br></div>
			<div id="pieChart" style="width:100%; height:210px; margin: 0 auto"></div>
		<div class="hidden-md hidden-lg"><br></div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<br>
			<h4 style="color:#444; font-weight: bold;"><span class="glyphicon glyphicon-flash"></span> All the events</h4>
			<div class="col-xs-11" id="events">
				@include('user.events')
			</div>
		</div>
	</div>
	<div class="row">
	<br>
		<div class="col-sm-9 col-xs-11">
			<h4 id="commentsIndicator" style="color:#444;">Comments - {{$match->comments()->count()}}</h4>
			<div id="commentSection">
				@include('user.comments')
			</div>
			<br>
		</div>
	</div>
</div>
<br><br>
@endsection

@section('js2')
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
	            text: 'Final ball possession:',
	            style:{
	            	fontWeight:"bold"
	            }
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
});
</script>
@endsection