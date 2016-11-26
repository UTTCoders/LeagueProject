@if($matches->count()>0)
@foreach($matches as $match)
<div class="row">
	<a href="{{'/stadiums/'.$match->teams->where('pivot.local',true)->first()->stadium->id}}" class="thumbnail col-xs-12 matchcard">
		<div class="col-sm-5 col-xs-6 imgcard" style="background-image: url('{{'/storage/'.$match->teams->where('pivot.local',true)->first()->stadium->photo}}');" align="center">
		<img src="/img/soccerball.png" style="width: 60%">
		</div>
	<div class="col-sm-7 col-xs-6 padData">
		<h3 align="center"><strong>{{$match->teams->where('pivot.local',true)->first()->name}}</strong> VS {{$match->teams->where('pivot.local',false)->first()->name}}</h3>
		<div class="hidden-xs col-sm-6" align="center">
			<p><strong>Stadium: </strong>{{$match->teams->where('pivot.local',true)->first()->stadium->name}}</p>
			<p><strong>Local: </strong>{{$match->teams->where('pivot.local',true)->first()->name}}</p>
		</div>
		<div class="hidden-xs col-sm-6" align="center">	
			<p><strong>Stadium: </strong>{{$match->teams->where('pivot.local',true)->first()->stadium->name}}</p>
			<p><strong>Local: </strong>{{$match->teams->where('pivot.local',true)->first()->name}}</p>
		</div>
	</div>
	</a>
</div>
@endforeach
@else
<h1 align="center">Sorry dude :(</h1>
@endif