@extends('layouts.master')

@section('title')
League management
@endsection

@section('css')
<style>
    .coverContainer{
        height: 400px;
        background-image: url("{{asset('img/management.jpg')}}");
    }
</style>
@endsection

@section('body')
<div class="coverContainer">
    <h2>Program and control the seasons and their matches</h2>
</div>
@endsection

@section('js')
@endsection