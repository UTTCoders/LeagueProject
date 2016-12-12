@extends('layouts.master')

@section('title')
Controling matches
@endsection

@section('css')
<style media="screen">
body{
  background:  #222525;
  color: #ddd;
}
.coverContainer{
    height: 400px;
    background-size: cover;
    background-image: url("{{asset('img/stadium77.jpg')}}");
    box-shadow: inset 0px -2px 8px 0px #222;
}
.mainTitle{
    text-align: center;
    font-size: 30px;
    margin: 0;
    top: 180px;
    color: #fff;
    text-shadow: 0px 0px 2px #000,0px 0px 10px #000;
    position: relative;
}
.no-padding{
  padding: 0;
}
.btnBlue2{
  background: linear-gradient(to bottom, dodgerblue,#0c70dd);
  border-radius: 2px;
  border: 0px;
  border-top: 1px solid skyblue;
  border-bottom: 1px solid dodgerblue;
  padding: 3px 10px 3px 10px;
  -webkit-transition: background .4s;
}
.btnBlue2:hover{
  background: linear-gradient(to bottom, #2fa1ff,#1b81ee);
}
.matchCard{
  display: inline-block;
  background: linear-gradient(to bottom,#111,#000);
  border: 1px solid #222;
  box-shadow: 0 0 10px 0 #000;
  margin-top: 5px;
  margin-bottom: 5px;
}
.team-container >div{
  padding-top: 15px;
  text-align: center;
  position: relative;
}
.team-container >div>img{
  position: relative;;
  height: 100px;
  width: auto;
  display: block;
  margin: auto;
}
</style>
@endsection

@section('body')
<div class="coverContainer">
  <h3 class="mainTitle">Uncoming matches</h3>
</div>
<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:40px;margin-bottom:40px;">
  <h3 class="col-xs-12">Today Matches</h3>
@if(count($todayMatches) < 1)
  <h4 class="col-xs-12">No matches found for today</h4>
@else
  @foreach($todayMatches as $match)
  <div class="col-xs-12 col-md-4 matchCard no-padding">
    <div class="col-xs-5 team-container">
      <div class="col-xs-12">
        <img src="{{asset('storage/'.$match->teams()->wherePivot("local",true)->first()->logo)}}" alt="">
      </div>
      <h5 class="col-xs-12" style="text-align:center">{{$match->teams()->wherePivot("local",true)->first()->name}}</h5>
    </div>
    <div class="col-xs-2" style="text-align:center;padding:0;">
      <p style="background:Red; font-weight:600;">VS</p>
      <p style="margin:0; font-size:12px;">{{date('d-m-Y',strtotime($match->start_date))}}</p>
      <p style="margin:0; font-size:12px;">{{date('H:i',strtotime($match->start_date))}}</p>
      <p style="margin:0; font-size:12px;">{{$states[$match->state]}}</p>
      @if($match->state != 0)
      <p style="margin:0; font-size:16px;">{{$match->localTeam->goalsCount.' - '.$match->visitorTeam->goalsCount}}</p>
      @endif()
    </div>
    <div class="col-xs-5 team-container">
      <div class="col-xs-12">
        <img src="{{asset('storage/'.$match->teams()->wherePivot("local",false)->first()->logo)}}" alt="">
      </div>
      <h5 class="col-xs-12" style="text-align:center">{{$match->teams()->wherePivot("local",false)->first()->name}}</h5>
    </div>

    <div class="col-xs-12" style="background:#111;text-align:center;padding:10px;">
      <p style="margin:0;">{{$match->referee->name." ".$match->referee->last_name}}</p>
      <div class="col-xs-12 no-padding" style="margin-top:5px;">
        <a href="control-matches/{{$match->id}}" class="btnBlue2">narrate</a>
      </div>
    </div>
  </div>
  @endforeach
@endif

<h3 class="col-xs-12">Tomorrow Matches</h3>
@if(count($tomorrowMatches) < 1)
<h4 class="col-xs-12">No matches found for tomorrow</h4>
@else
@foreach($tomorrowMatches as $match)
<div class="col-xs-12 col-md-4 matchCard no-padding">
  <div class="col-xs-5 team-container">
    <div class="col-xs-12">
      <img src="{{asset('storage/'.$match->teams()->wherePivot("local",true)->first()->logo)}}" alt="">
    </div>
    <h5 class="col-xs-12" style="text-align:center">{{$match->teams()->wherePivot("local",true)->first()->name}}</h5>
  </div>
  <div class="col-xs-2" style="text-align:center;padding:0;">
    <p style="background:Red; font-weight:600;">VS</p>
    <p style="margin:0; font-size:12px;">{{date('d-m-Y',strtotime($match->start_date))}}</p>
    <p style="margin:0; font-size:12px;">{{date('H:i',strtotime($match->start_date))}}</p>
    <p style="margin:0; font-size:12px;">{{$states[$match->state]}}</p>
  </div>
  <div class="col-xs-5 team-container">
    <div class="col-xs-12">
      <img src="{{asset('storage/'.$match->teams()->wherePivot("local",false)->first()->logo)}}" alt="">
    </div>
    <h5 class="col-xs-12" style="text-align:center">{{$match->teams()->wherePivot("local",false)->first()->name}}</h5>
  </div>

  <div class="col-xs-12" style="background:#111;text-align:center;padding:10px;">
    <p style="margin:0;">{{$match->referee->name." ".$match->referee->last_name}}</p>
  </div>
</div>
@endforeach
@endif

</div>
@endsection

@section('js')
<script type="text/javascript">
  var topPos=0;

  $(function ($) {

    $('.team-container').height($('.team-container').width());
    $(window).resize(function () {
      $('.team-container').height($('.team-container').width());
    });
  });
</script>
@endsection
