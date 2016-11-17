@extends('layouts.master')

@section('title')
Sign up on league-project
@endsection

@section('css')
<style>
    body{
        background-color: #222525;    
    }
    #signupCard{
        margin-bottom: 80px;
        padding: 0px;
    }
    .navBar{
        background-color: #000;
    }
    .header{
        background-color: dodgerblue;
        box-shadow: inset 0px -2px 1px 0px #1d80dd;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        padding: 10px;
        width: 100%;
        margin: 0px;
    }
    .header > h3{
        margin: 0px;
        color: white;
    }
    #signupContainer{
        padding-top:90px; 
        background-color: transparent; 
        width: 100%;
        -webkit-transition: padding .6s, opacity 1s;
        opacity: 0;
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
</style>
@endsection

@section('body')
<div id="signupContainer">
    <div class="blackCard col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1" id="signupCard">
        <div class="header">
            <h3>Sign up</h3>
        </div>
        <div style="padding: 20px;">
            <form action="/signup" method="post">
                {{csrf_field()}}
                <div class="form-group ">
                    <label style="margin-right: 10%;" for="name">Name</label>
                    <input type="text" name="name" class="myInputWhite myInput-large" value="{{old('name')}}" autofocus>
                </div>
                <div class="form-group ">
                    <label style="margin-right: 10%;" for="email">Email</label>
                    <input type="email" name="email" class="myInputWhite myInput-large" value="{{old('email')}}">
                </div>
                <div class="form-group ">
                    <label style="margin-right: 10%;" for="password">Password</label>
                    <input type="password" name="password" class="myInputWhite myInput-large">
                </div>
                <div class="form-group ">
                    <label style="margin-right: 10%;" for="password2">Password confirm</label>
                    <input type="password" name="password2" class="myInputWhite myInput-large">
                </div>
                <div class="form-group" style="margin-bottom: 0px; margin-top: 20px;">
                    <button class="btn btnBlue" style="width:100%;">Sign up!</button>
                </div>
            </form>
        </div>
    </div>
    @if(Session::has('msgsReg'))
    <div class="col-md-2 col-md-offset-1 col-xs-offset-1 col-xs-10">
        <h5 style="color: #ddd;">Check this...</h5>
        @foreach(Session::get('msgsReg') as $msg)
        <p class="msg error">{{$msg}}</p>
        @endforeach
    </div>
    @endif
    <div class="loginMargin">
        <div class="loginContainer col-md-offset-4 col-md-4 col-xs-10 col-xs-offset-1">
            <h2 style="margin:10px; color: white; margin-bottom: 40px;">Log in</h2>
            <form method="post" action="/">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="symbol">
                        <p>Email</p>
                    </div>
                    <input type="email" class="myInput" name="email">
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
                <div class="form-group">
                    <button id="myLogBtn" class="btn col-md-12 col-xs-12">Log in</button>
                </div>
            </form> 
            <br>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(function($){
        $('#signupContainer').css('padding-top','130px').css('opacity','1');
        $('#mainTitle').css('margin-top','300px').css('color','white');
        @if(Session::has('msgs'))
            $('.loginMargin').fadeIn('slow',function(){
                $('.loginMargin').css('display','initial');
            });
            $('.loginContainer').css('margin-top','8%');
        @endif
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