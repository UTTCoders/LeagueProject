@if($match->events()->count() > 0)
	@foreach($match->events as $e)
		<div style="color:#444;" class="thumbnail event"><span class="glyphicon glyphicon-ok"></span> Something happened!</div>
	@endforeach
@else
	<br>
	<h5 style="color:#111;" align="center">Ups! Seems like there're no events registered!</h5>
	<div style="color:#444;" class="thumbnail event"><span class="glyphicon glyphicon-ok"></span> Something happened!</div>
@endif
<input type="hidden" name="eventsCount" value="{{$match->events()->count()}}">