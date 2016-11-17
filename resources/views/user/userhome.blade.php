@extends('layouts.master')

@section('title',Auth::user()->name." | Home")

@section('css')
<link rel="stylesheet" type="text/css" href="/css/someanyicss.css">
@endsection

@section('body')
<div class="coverContainer">
    <h2 id="mainTitle">Get in news about your favorite teams, follow their matches in real time,<br>view statistics and more...</h2>
</div>
<div class="loginMargin">

</div>
@endsection