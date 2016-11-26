@if($favorites["count"]>0)
@foreach($favorites["matches"] as $match)
<div class="row">
	<a href="{{'/stadiums/'.$match->teams->where('pivot.local',true)->first()->stadium->id}}" style="background-color: #004D40;" class="thumbnail col-sm-12 matchcard hidden-xs hidden-sm">
		<div class="col-sm-5 imgcard" style="background-image: url('{{'/storage/'.$match->teams->where('pivot.local',true)->first()->stadium->photo}}');" align="center">
		<img src="/img/soccerball.png" style="width: 60%">
		</div>
		<div class="col-sm-7 padData">
			<h3 align="center" style="text-shadow: 1px 1px 1px black;"><strong><span class="glyphicon glyphicon-star-empty"></span> {{$match['fav']->name}}</strong> VS {{$match['nofav']->name}}</h3>
			<hr>
			<div class=" col-sm-5" align="left">
				<p><strong><span class="glyphicon glyphicon-flag"></span> Stadium: </strong>{{$match->teams->where('pivot.local',true)->first()->stadium->name}}</p>
				<p><strong><span class="glyphicon glyphicon-bookmark"></span> Local: </strong>{{$match->teams->where('pivot.local',true)->first()->name}}</p>
			</div>
			<div class="col-sm-7" align="left">	
				<p><strong><span class="glyphicon glyphicon-user"></span> Referee: </strong>{{$match->referee->name." ".$match->referee->last_name}}</p>
				@if($match->state==1)
				<p><strong><span class="glyphicon glyphicon-time"></span> State: </strong>1st Time</p>
				@elseif($match->state==2)
				<p><strong><span class="glyphicon glyphicon-time"></span> State: </strong>Breaktime</p>
				@else
				<p><strong><span class="glyphicon glyphicon-time"></span> State: </strong>2nd Time</p>
				@endif
			</div>
		</div>
	</a>
</div>
@endforeach
<div class="table-responsive hidden-md hidden-lg">
	<table class="table table-hover">
		<tr align="center" style="background-color: #004D40; color: #eee;">
			<td><strong>Teams</strong></td>
			<td><strong><span class="glyphicon glyphicon-flag"></span> Stadium</strong></td>
			<td><strong>Referee</strong></td>
			<td><strong>State</strong></td>
		</tr>
		@foreach($favorites["matches"] as $match)
		<tr id="{{$match->teams->where('pivot.local',true)->first()->stadium->id}}" align="center" style="color:#111;" class="t-row">
			<td><strong><span class="glyphicon glyphicon-star-empty"></span> {{$match['fav']->name}}</strong> VS {{$match['nofav']->name}}</td>
			<td>{{$match->teams->where('pivot.local',true)->first()->stadium->name}} | {{$match->teams->where('pivot.local',true)->first()->name}}</td>
			<td>{{$match->referee->name}}</td>
			<td>
				@if($match->state==1)
				<span><strong><span class="glyphicon glyphicon-time"></span></strong> 1st Time</span>
				@elseif($match->state==2)
				<span><strong><span class="glyphicon glyphicon-time"></span></strong> Breaktime</span>
				@else
				<span><strong><span class="glyphicon glyphicon-time"></span></strong> 2nd Time</span>
				@endif
			</td>
		</tr>
		@endforeach
	</table>
</div>
@else
<h1 align="center">Sorry dude :(</h1>
@endif