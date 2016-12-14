@if($match->events()->count() > 0)
	@foreach($match->events as $e)
		<div style="color:#eee; background-color: #444;" align="center" class="thumbnail event"><span class="pull-left"><img style="width:16px;" src="/{{$e->eventType->icon}}"></span>{{$e->content}}<span class="pull-right">Min: {{date_format(date_create((int)$e->minute),"i")}}</span></div>
	@endforeach
@else
	<br>
	<h5 style="color:#111;" align="center">Ups! Seems like there're no events registered!</h5>
@endif
<input type="hidden" name="eventsCount" value="{{$match->events()->count()}}">
