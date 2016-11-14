@extends('layouts.master')

@section('title')
Welcome to the official site of the spain league
@endsection

@section('css')
<style>
    .coverContainer{
        background-image: url("{{asset('img/campnou.jpg')}}");
        background-size: cover;
        width: 100%;
        height: 100%;
        position: relative;
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
        margin: 0px;
        margin-top: 5px;
        background-color: transparent;
        float: right;
    }
    #fbIcon{
        position: relative;
        top: 2px;
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
        position: relative;
        height: 60%;
        margin: 8%;
        margin-top: 0%;
        margin-left: 30%;
        margin-right: 30%;
        border: 1px solid #444;
        box-shadow: 0px 0px 20px 10px #111;
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
    .ctrls-group{
        position: relative;
        width: 100%;
        margin: 10px;
        padding: 0px;
    }
    .ctrls-group > .symbol{
        background-color: dodgerblue;
        border: 1px solid white;
        font-size: 16px;
        height: 20px;
        width: 15%;
        float:left;
        padding: 8px;
        padding-left: 10px;
        padding-right: 10px;
        text-align: center;
        color: white;
        font-weight: 600;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
        margin-top: 20px;
        margin-bottom: 10px;
    }
    .myInput{
        background-color: transparent;
        color: #ddd;
        border: 1px solid #fff;
        font-size: 16px;
        height: 20px;
        width: 70%;
        float:left;
        padding: 8px;
        padding-left: 16px;
        padding-right: 16px;
        font-weight: 200;
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
        position: absolute;
        bottom: 20px;
        background-color: transparent;
        color: white;
        border-radius: 3px;
        margin: 10px;
        border: 1px solid white;
        font-size: 16px;
    }
    #myLogBtn:hover{
        background-color: rgba(255, 255, 255, .1);
    }
</style>
@endsection

@section('body')
<div class="coverContainer">
    <h2 id="mainTitle">Get in news about your favorite teams, follow their matches in real time,<br>view statistics and more...</h2>
    <a href="/signup" id="loginBtn" class="btn btnTrans">Sign up</a>
    <a href="#" id="fbBtn1" class="btn fbBtn"><img id="fbIcon" src="{{asset('img/_f_logo_online/png/FB-f-Logo__white_29.png')}}"><p>Log in with facebook</p></a>
</div>
<div class="loginMargin">
    <div class="loginContainer">
        <h2 style="margin:10px; color: white; margin-bottom: 70px;">Log in</h2>
        <form method="post" action="/">
            <div class="ctrls-group">
                <div class="symbol">Email</div>
                <input type="email" class="myInput">
            </div>
            <div class="ctrls-group">
                <div class="symbol">Password</div>
                <input type="password" class="myInput">
            </div>
            <button class="btn" id="myLogBtn">Log in</button>
        </form> 
        <a href="/signup" style="margin-left: 10px;">Don't you have an account?</a>
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
    });
</script>
@endsection


