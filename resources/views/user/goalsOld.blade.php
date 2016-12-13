<div class="col-xs-5">
	<div align="center">
		<img style="width: 60%" src="/storage/{{$teams['local']->logo}}">
	</div>
</div>
<div class="col-xs-2">
</div>
<div class="col-xs-5">
	<div align="center">
		<img style="width: 60%" src="/storage/{{$teams['visitor']->logo}}">
	</div>
</div>
<div class="col-xs-5">
	<div style="color:#B71C1C; font-size: 35px; font-weight: bold;" align="center">
		{{$teams["local"]["goals"]}}
	</div>
</div>
<div class="col-xs-2">
	<div style="font-size: 20px; font-weight: bold;" align="center">
		vs
	</div>
</div>
<div class="col-xs-5">
	<div style="color:#B71C1C; font-size: 35px; font-weight: bold;" align="center">
		{{$teams["visitor"]["goals"]}}
	</div>
</div>
<input type="hidden" name="goalsCount" value="{{$match->goals()->count()}}">
