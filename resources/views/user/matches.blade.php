<table class="table">
	<tr align="center" style="background-color: #333; color:white; ">
		<td><b><span class="glyphicon glyphicon-flag"></span> Local</b></td>
		<td></td>
		<td><b>Visitor</b></td>
		<td><b><span class="glyphicon glyphicon-time"></span> DateTime</b></td>
		<td><b>Status</b></td>
		<td><b>Results</b></td>
	</tr>
	@foreach($matches as $match)
	<tr align="center">
		<td><img width="20px" src="/storage/{{$match['theteams']['local']->logo}}"> {{$match["theteams"]["local"]->name}}</td>
		<td>vs</td>
		<td><img width="20px" src="/storage/{{$match['theteams']['visitor']->logo}}"> {{$match["theteams"]["visitor"]->name}}</td>
		<td>{{date_format(date_create($match->start_date),"Y/M/d")}} - {{date_format(date_create($match->start_date),"g:i a")}}</td>
		<td>@if($match->state==0) - @elseif($match->state==1) 1st time @elseif($match->state==2) Break time @elseif($match->state==3) 2nd time @else Finished: <a style="color:#B71C1C;" href="/results/{{$match->id}}">More details</a> @endif</td>
		<td>@if($match->state==4) <b style="font-size: 16px;">{{$match["theteams"]["local"]["goals"]}}</b> {{$match["theteams"]["local"]->name}} vs {{$match["theteams"]["visitor"]->name}} <b style="font-size: 16px;">{{$match["theteams"]["visitor"]["goals"]}}</b> @else - @endif</td>
	</tr>
	@endforeach
</table>