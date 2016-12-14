@extends('layouts.master')

@section('title')
Controlling matches
@endsection

@section('css')
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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
.black-transparent-back{
  display: none;
  position: fixed;
  z-index: 5;
  background-color: rgba(0, 0, 0, 0.7);
  height: 100%;
  width: 100%;
  left: 0;
  top: 0;
}
.black-transparent-back > .messageBox{
  opacity: 0;
  background-color: white;
  border-radius: 2px;
  box-shadow: 0px 0px 10px 0px #000;
  margin-top: 10%;
  overflow: hidden;
  padding: 0;
  margin-bottom: 0;
  padding-bottom: 0;
  -webkit-transition: margin-top .4s, opacity .5s;
}
.black-transparent-back > .messageBox > .header > h3{
  margin-top: 10px;
  color: dodgerblue;
  padding: 15px;
}
.black-transparent-back > .messageBox > .body{
  padding-left: 15px;
  color: #444;
  padding-right: 15px;
  padding-bottom: 15px;
}
.black-transparent-back > .messageBox > .btnBack{
  background-color: #eee;
  width: 106%;
  margin-left: -3%;
  display: inline-block;
  padding-top: 15px;
  padding-left: 3%;
  padding-right: 3%;
  padding-bottom: 10px;
  box-shadow: inset 0px 2px 3px 0px #aaa;
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
.tasks{
  background-color: white;
  color:#666;
  font-family: Roboto;
  border-radius: 3px;
  box-shadow: 0 1px 5px 0 #000;
}
.tasks>h4{
  color: dodgerblue;
}
</style>
@endsection

@section('body')
<div class="coverContainer">
  <h3 class="mainTitle">Upcoming matches</h3>
</div>
<div class="black-transparent-back">
  <div class="messageBox col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1">
    <div class="header">
      <h3>Ups...</h3>
    </div>
    <div class="body">
      You must give permissions to the app for continue
    </div>
    <div class="btnBack">
      <div class="btnContainer col-md-12 col-sm-12 col-xs-12">
        <button type="button" name="button" class="btnBlue2">Ok</button>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:40px;margin-bottom:40px;">
  <div class=" col-xs-12 col-md-4 tasks">
    <h4>Tasks</h4>
    @if(count($pendingTasks) > 0)
    @foreach($pendingTasks as $task)
    <p>{{$task['msg']}} <a href="{{$task['link']}}" style="color:dodgerblue;">Go!</a></p>
    @endforeach
    <p style="color:#888;">* Make sure of fix this at least 1 week beafore the league starts.</p>
    @else
    <p>No pending tasks</p>
    @endif
  </div>
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
    <div class="col-xs-12 no-padding" style="margin-top:5px;">
      <a href="control-matches/{{$match->id}}" class="btnBlue2">narrate</a>
    </div>
  </div>
</div>
@endforeach
@endif

</div>
@endsection

@section('js')

@if(session('msg'))
<script>
$(function ($) {
  $('.black-transparent-back').fadeIn('slow',function () {
    $('.messageBox').css('margin-top','20%').css('opacity',1);
    $('.messageBox').children('.header').children('h3').text('{{session("msg")["title"]}}');
    $('.messageBox').children('.body').text('{{session("msg")["content"]}}');
  });
});
</script>
@endif

<script type="text/javascript">
  var topPos=0;

  $(function ($) {

    $('.team-container').height($('.team-container').width());
    $(window).resize(function () {
      $('.team-container').height($('.team-container').width());
    });

    $('.black-transparent-back').click(function () {
      $('.messageBox').css('margin-top','10%').css('opacity',0);
      $(this).fadeOut(1000);
    });

  });
</script>
@endsection
