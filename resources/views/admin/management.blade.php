@extends('layouts.master')

@section('title')
League management
@endsection

@section('css')
<style>
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
</style>
@endsection

@section('body')
<div class="coverContainer">
    <h2 class="mainTitle">Add teams, stadiums, players, coaches and more</h2>
</div>
@endsection

@section('js')
@endsection