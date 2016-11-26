@extends('layouts.master')

@section('title')
Welcome to the official site of the spain league
@endsection

@section('css')
<style>
    body{
        background-color: #000;
    }
    .coverContainer{
        background-image: url("{{asset('img/campnou.jpg')}}");
        background-size: cover;
        width: 100%;
        height: 100%;
        position: fixed;
        overflow: hidden;
        box-shadow: inset 0px 0px 10px 0px #000;
    }
    .fbBtn{
        background-color: #4267B2;
        color: #ffffff;
        border-color: #4267B2;
        padding: 5px;
        padding-left: 0px;
        padding-right: 10px;
        width: 200px;
    }
    .fbBtn:hover{
        width: 220px;
    }
    .fbBtn > p{
        font-size: 14px;
        font-weight: 600;
        color: white;
        margin: 0px;
        background-color: transparent;
        float: right;
    }
    #fbIcon{
        position: relative;
        margin: 0px;
        width: 22px;
        margin-left: -14px;
    }
    #loginBtn{
        position: absolute;
        bottom: 20px;
        left: 20px;
    }
    #mainTitle{
        text-align: center;
        color: rgba(255,255,255,0);
        margin-top: 200px;
        text-shadow: 0px 0px 10px #000;
        -webkit-transition: margin-top .9s, color .8s;
    }
    #fbBtn1{
        position: absolute;
        bottom: 20px;
        right: 20px;
        padding-left: 0px;
    }
    .loginContainer{
        background-color: rgba(0, 0, 0, .9);
        border-radius: 3px;
        min-height: 60%;
        margin-top: 0%;
        border: 1px solid #444;
        display: inline;
        box-shadow: 0px 0px 20px 10px #000;
        padding: 20px;
        z-index: 2;
        -webkit-transition: margin-top .5s;
    }
    .loginMargin{
        display: none;
        z-index: 2;
        top: 0px;
        left: 0px;
        position: fixed;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, .6)
    }
    .form-group > .symbol{
        background-color: dodgerblue;
        border: 1px solid white;
        font-size: 12px;
        height: 40px;
        width: 20%;
        float:left;
        padding-left: 3px;
        padding-right: 3px;
        text-align: center;
        color: white;
        font-weight: 600;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
        margin: 0px;
        margin-top: 20px;
        margin-bottom: 10px;
    }.form-group > .symbol > p{
        margin-top: 10px;
    }
    .myInput{
        background-color: transparent;
        color: #ddd;
        border: 1px solid #fff;
        font-size: 16px;
        height: 40px;
        width: 80%;
        float:left;
        padding-left: 16px;
        padding-right: 16px;
        font-weight: 400;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
        margin-right: 0px;
        margin-left: -2px;
        box-shadow: inset 0px 0px 5px 0px #555;
        margin-top: 20px;
        margin-bottom: 10px;
    }
    .myInput:hover{
        color: #fff;
    }
    #myLogBtn{
        padding: 5px;
        padding-left: 10px;
        padding-right: 10px;
        background-color: transparent;
        color: white;
        border-radius: 3px;
        margin-top: 40px;
        margin-bottom: 10px;
        border: 1px solid white;
        font-size: 16px;
    }
    #myLogBtn:hover{
        background-color: rgba(255, 255, 255, .1);
    }
    .msg{
        background-color: white;
        border-radius: 3px;
        margin-top: 10px;
        margin-bottom: 10px;
        padding-left: 8px;
        padding-right: 8px;
        font-weight: 600;
    }
    .error{
        color: #e34;
    }
    .success{
        color: #6d9;
    }
    .footer{
        display: none;
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
      background: linear-gradient(to bottom,#6af,#48f);
      color: white;
      border: 0;
      padding: 5px 15px 5px 15px;
      border-top: 1px solid skyblue;
      border-bottom: 1px solid #67e;
      border-radius: 2px;
      box-shadow: 0px 1px 2px 0px #777;
    }
</style>
@endsection

@section('body')
<div class="coverContainer">
    <h2 id="mainTitle">Get in news about your favorite teams, follow their matches in real time,<br>view statistics and more...</h2>
    <a href="/signup" id="loginBtn" class="btn btnTrans">Sign up</a>
    <a href="/fblogin" id="fbBtn1" class="btn fbBtn"><img id="fbIcon" src="{{asset('img/_f_logo_online/png/FB-f-Logo__white_29.png')}}"><p>Log in with facebook</p></a>
</div>
<div class="loginMargin">
    <div class="loginContainer col-md-offset-4 col-md-4 col-xs-10 col-xs-offset-1">
        <h2 style="margin:10px; color: white; margin-bottom: 40px;">Log in</h2>
        <form method="post" action="/">
        {{csrf_field()}}
            <div class="form-group">
                <div class="symbol">
                    <p>Email</p>
                </div>
                @if(Session::has('emailreg'))
                    <input value="{{Session::get('emailreg')}}" type="email" class="myInput" name="email" autofocus>
                @else
                    <input type="email" class="myInput" name="email" value="{{old('email')}}" autofocus>
                @endif
            </div>
            <div class="form-group">
                <div class="symbol">
                    <p>Password</p>
                </div>
                <input type="password" class="myInput" name="password">
            </div>
            @if(Session::has('msgs'))
                <div class="col-md-12 col-xs-12" style="margin:0px; padding:0px;">
                    @foreach(Session::get('msgs') as $msg)
                    <p class="msg error">{{$msg}}</p>
                    @endforeach
                </div>
            @endif
            @if(Session::has('activate'))
                <div class="col-md-12 col-xs-12" style="margin:0px; padding:0px;">
                    @foreach(Session::get('activate') as $msg)
                    <p align="center" class="msg error" style="color:#090;">{{$msg}}</p>
                    @endforeach
                </div>
            @endif
            <div class="form-group">
                <button id="myLogBtn" class="btn col-md-12 col-xs-12">Log in</button>
            </div>
            <a href="/signup">Don't you have an account?</a>
        </form>
        <br>
    </div>
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
@endsection

@section('js')
<script>
$(function($){
    $('#mainTitle').css('margin-top','300px').css('color','white');
    $('.loginMargin').click(function(e){
        if(e.target === this){
            $(this).children('div').css('margin-top','0%');
            $(this).fadeOut('slow',function(){
                $(this).css('display','none');
            });
        }
    });
    $('#loginLauncher').click(function(){
        $('.loginMargin').fadeIn('slow',function(){
            $('.loginMargin').css('display','initial');
        });
        $('.loginContainer').css('margin-top','8%');
    });
    $('.black-transparent-back').click(function () {
      $('.messageBox').css('margin-top','10%').css('opacity',0);
      $(this).fadeOut(1000);
    });
});
</script>
@if(session('gonnaLogOut'))
<script type="text/javascript">
  window.fbAsyncInit = function() {
      FB.init({
        appId      : '1767846576800416',
        xfbml      : true,
        version    : 'v2.8'
      });
      FB.AppEvents.logPageView();
      FB.logout(function (response) {
        console.log(response);
      });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
@endif
@if(session('msg'))
<script>
$(function ($) {
  $('.black-transparent-back').fadeIn('slow',function () {
    $('.messageBox').css('margin-top','20%').css('opacity',1);
    $('.messageBox').children('.body').text('{{session("msg")}}');
  });
});
</script>
@endif
@if(Session::has('msgs') || Session::has('activate'))
<script>
    $(function($){
        $('.loginMargin').fadeIn('slow',function(){
            $('.loginMargin').css('display','initial');
        });
        $('.loginContainer').css('margin-top','8%');
    });
</script>
@endif
@endsection
