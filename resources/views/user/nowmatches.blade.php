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
<div style="color:#111; padding-top: 60px;" align="center">
	<h2>There're no matches taking place right now!</h2>
	<!--<h3>But you can see the calendar! ;)</h3>-->
</div>
@endif