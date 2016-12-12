@extends('layouts.master')

@section('title')
{{$match->localTeam->name." vs ".$match->visitorTeam->name}}
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
.subTitle{
  text-align:center;color: #fff;text-shadow: 0px 0px 2px #000,0px 0px 10px #000;
}
</style>
@endsection

@section('body')
<div class="coverContainer">
  <h3 class="mainTitle">{{$match->localTeam->name." vs ".$match->visitorTeam->name}}</h3>
  <h4 style="margin-top: 190px;" class="subTitle">{{$states[$match->state]}}</h4>
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
<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:90px;margin-bottom:40px;">

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

  $(function ($) {

    $('.team-container').height($('.team-container').width());
    $(window).resize(function () {
      $('.team-container').height($('.team-container').width());
    });

    function showMessages(title,msg,type) {
      $('.black-transparent-back').fadeIn('slow',function () {
        $('.messageBox').css('margin-top','20%').css('opacity',1);
        $('.messageBox').children('.hearder').children('h4').text(title);
        $('.messageBox').children('.body').text(msg);
      });
    }

    $('.black-transparent-back').click(function () {
      $('.messageBox').css('margin-top','10%').css('opacity',0);
      $(this).fadeOut(1000);
    });

  });
</script>
@endsection
