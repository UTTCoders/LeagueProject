@extends('layouts.master')

@section('title')
League management
@endsection

@section('css')
<style>
    body{
      background:  #222525;
    }
    .coverContainer{
        height: 400px;
        background-image: url("{{asset('img/management.jpg')}}");
        box-shadow: inset 0px -2px 8px 0px #222;
    }
    .mainTitle{
        text-align: center;
        margin: 0;
        top: 180px;
        color: white;
        text-shadow: 0px 0px 2px #000;
        position: relative;
    }
    #manageMenu{
        margin-top: 50px;
        position: relative;
        border: 1px solid rgba(0,0,0,.4);
        border-radius: 3px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0px 1px 1px 0px rgba(0,0,0,.2);
    }
    .manageMenuHeader{
        background-color: dodgerblue;
        border-top: 1px solid skyblue;
        position: relative;
        text-align: center;
        margin: 0px;
        padding: 3px;
    }
    .manageMenuItem{
        background-color: rgba(0,0,0,.1);
        position: relative;
        border: 1px solid transparent;
        text-align: center;
        margin: 0px;
        padding: 3px;
        -webkit-transition: background-color .1s;
    }
    .manageMenuItem:hover{
        border: 1px solid #333;
        background-color: rgba(255,255,255,.01);
    }
</style>
@endsection

@section('body')
<div class="coverContainer">
    <h2 class="mainTitle">Add teams, stadiums, players, coaches and more</h2>
</div>
<div class="col-md-12">
    <div class="col-md-6">

    </div>
    <div class="col-md-2 col-md-offset-2" id="manageMenu">
      <a class="manageMenuHeader col-md-12">Manage...</a>
      <a href="#" class="manageMenuItem col-md-12">Stadiums</a>
      <a href="#" class="manageMenuItem col-md-12">Coaches</a>
        <a href="#" class="manageMenuItem col-md-12">Teams</a>
    </div>
</div>
@endsection

@section('js')
@endsection
