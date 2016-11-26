@if($favorites["count"]>0)
@foreach($favorites["matches"] as $match)
<div class="row">
	<a href="{{'/stadiums/'.$match->teams->where('pivot.local',true)->first()->stadium->id}}" style="background-color: #004D40;" class="thumbnail col-sm-12 matchcard hidden-xs fav">
		<div class="col-sm-5 imgcard" style="background-image: url('{{'/storage/'.$match->teams->where('pivot.local',true)->first()->stadium->photo}}');" align="center">
		<img src="/img/soccerball.png" style="width: 60%">
		</div>
		<div class="col-sm-7 padData">
			<h3 align="center" style="text-shadow: 1px 1px 1px black;"><strong><span class="glyphicon glyphicon-star-empty"></span> {{$match['fav']->name}}</strong> VS {{$match['nofav']->name}}</h3>
			<hr>
			<div class=" col-sm-6" align="left">
				<p><strong>Stadium: </strong>{{$match->teams->where('pivot.local',true)->first()->stadium->name}}</p>
				<p><strong>Local: </strong>{{$match->teams->where('pivot.local',true)->first()->name}}</p>
			</div>
			<div class="col-sm-6" align="left">	
				<p><strong>Referee: </strong>{{$match->referee->name}}</p>
				@if($match->state==1)
				<p><strong>State: </strong>1st Time</p>
				@elseif($match->state==2)
				<p><strong>State: </strong>Breaktime</p>
				@else
				<p><strong>State: </strong>2nd Time</p>
				@endif
			</div>
		</div>
	</a>
</div>
@endforeach
<div class="table-responsive hidden-sm hidden-md hidden-lg">
	<table class="table table-hover">
		<tr align="center" style="background-color: #004D40; color: #eee;">
			<td><strong>Teams</strong></td>
			<td><strong>Stadium</strong></td>
			<td><strong>Referee</strong></td>
		</tr>
		@foreach($favorites["matches"] as $match)
		<tr id="{{$match->teams->where('pivot.local',true)->first()->stadium->id}}" align="center" style="color:#111;" class="t-row">
			<td><strong><span class="glyphicon glyphicon-star-empty"></span> {{$match['fav']->name}}</strong> VS {{$match['nofav']->name}}</td>
			<td>{{$match->teams->where('pivot.local',true)->first()->stadium->name}} | {{$match->teams->where('pivot.local',true)->first()->name}}</td>
			<td>{{$match->referee->name}}</td>
		</tr>
		@endforeach
	</table>
</div>
@else
<h1 align="center">Sorry dude :(</h1>
@endif