@extends('user.userhome')

@section('title','Stats')

@section('css2')
<style type="text/css">
	body{
		background-color: #fff;
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
		<div class="row">
			<div align="center">
				<img src="/img/icons/soccerplayer2.jpeg" style="width: 33%;">
			</div>
			<h2 style="color: #111;" align="center">Here you can check the positions table!</h2>
			<br><br>
		</div>
		@if($currentSeason && $teamsS->count()>0)
		<div class="row" style="color:#111;">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1">
				<h3><img width="35px" src="/img/icons/cup.png"> Current points</h3>
				<div class="table-responsive">
					<table class="table table-condensed">
						<thead>
							<tr style="font-size: 15px;" align="center">
								<td></td>
								<td><b>Matches</b></td>
								<td><b>Differ goals</b></td>
								<td><b>Points</b></td>
							</tr>
						</thead>
						<tbody>
						@foreach($teamsS as $team)
							<tr align="center">
								<td style="vertical-align: middle; font-size: 15px;" ><img style="width: 30px" src="/storage/{{$team->logo}}"> <b>{{$team->name}}</b></td>
								<td style="vertical-align: middle;" >{{$team->matchesCount}}</td>
								<td style="vertical-align: middle;" >{{$team->differGoals}}</td>
								<td style="vertical-align: middle;" >{{$team->points}}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<br><br>
		<div class="row" style="color:#111;">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1">
				<h3><span class="glyphicon glyphicon-stats"></span> Chart</h3>
				<div id="chart" style="width:100%; max-height:700px; margin: 0 auto"></div>
			</div>
		</div>
		@else
		<div class="row">
			<h3 style="color:#111;" align="center">Sorry bro! :(</h3>
			<h4 style="color:#111;" align="center">There are no current season stats!</h4>
		</div>
		@endif
		<br><br>
	</div>
</div>
@endsection

@section('js2')
@if($currentSeason && $teamsS->count()>0)
<script src="/Highcharts/js/highcharts.js"></script>
<script>
$(function(){
	var t=$("meta[name='toktok']").attr('content')
	$.ajax({
		url:"/chartstats",method:"post",
		data:{
			_token:t
		}
	}).done(function(response){
		var teams = [];
		$.each(response, function(index, val){
            teams.push(val.name);
        });

		var points = [];
		$.each(response, function(index, val){
            points.push(val.points);
        });

		var chart = new Highcharts.Chart({
	            chart: {
	                renderTo: 'chart',
	                type: 'bar'
	            },
	            credits:{
	            	enabled:false
	            },
	            title: {text:''},
	            xAxis: {
	            	labels:{
	            		style:{
	            			fontSize:'13px',
	            			fontWeight:"bold",
	            			color:"#111"
	            		}
	            	},
	                categories: teams
	            },
	            yAxis: {
	                min: 0,
	                allowDecimals:false,
	                title: {text:''}
	            },
	            legend: {
	                reversed: true
	            },
	            plotOptions: {
	                series: {
	                    stacking: 'normal'
	                }
	            },
	            series: [{
	                name: 'Points',
	                data: points
	            }]
	        });
	});
});
</script>
@endif
@endsection