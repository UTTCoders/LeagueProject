<h1 align="center"><strong>{{$teams["local"]->name}}</strong> - {{$teams["local"]["goals"]}}</strong></h1>
<h1 align="center">vs</h1>
<h1 align="center"><strong>{{$teams["visitor"]->name}}</strong> - {{$teams["visitor"]["goals"]}}</h1>
<input type="hidden" name="goalsCount" value="{{$match->goals()->count()}}">