@extends('layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href="/css/someanyicss.css">
<style type="text/css">
.navBar{
	width: 100%;
	top: 0px;
    left: 0px;
    position: fixed;
    z-index: 1;
    background-color: #000;
    display: inline-block;
    padding: 10px;
    -webkit-transition: background-color .4s;
    margin-bottom: 0;
}
.footer{
	display: block;
	background-color: #212121;
}
#mainTitle{
	text-align: center;
	color: rgba(255,255,255,0);
	margin-top: 200px;
	text-shadow: 0px 0px 5px #000;
	-webkit-transition: margin-top .9s, color .8s;
}
</style>
@yield('css2')
@endsection

@section('body')
@yield('body2')
@endsection

@section('js')
@yield('js2')
@endsection