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
    .footer{
        background-color: #111;
        box-shadow: none;
    }
    #signupContainer{
        padding-top:90px; 
        background-color: transparent; 
        width: 100%;
        -webkit-transition: padding .6s, opacity 1s;
        opacity: 0;
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
            <div class="form-group ">
                <label style="margin-right: 10%;" for="">Name</label>
                <input type="text" class="myInputWhite myInput-large">
            </div>
            <div class="form-group ">
                <label style="margin-right: 10%;" for="">Email</label>
                <input type="email" class="myInputWhite myInput-large">
            </div>
            <div class="form-group ">
                <label style="margin-right: 10%;" for="">Password</label>
                <input type="password" class="myInputWhite myInput-large">
            </div>
            <div class="form-group ">
                <label style="margin-right: 10%;" for="">Password confirm</label>
                <input type="password" class="myInputWhite myInput-large">
            </div>
            <div class="form-group" style="margin-bottom: 0px; margin-top: 20px;">
                <button class="btn btnBlue" style="width:100%;">Sign up!</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function($){
        $('#signupContainer').css('padding-top','130px').css('opacity','1');
    });
</script>
@endsection