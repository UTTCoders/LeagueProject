@extends('user.userhome')

@section('css2')
<style type="text/css">
	#con{
		background-color: #000;
		width: 100%;
		margin-top: 62px;/*size of the navbar*/
		background-image: url(/storage/{{$stadium->photo}});
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
		margin-bottom: 0;
		margin-top: 0;
		border-bottom: 0;
		padding-top:100px;
		padding-bottom: 100px;
	}
	body{
		background-color: white;
	}
</style>
@endsection

@section('body2')
<div id="con">

</div>
<div class="">
	
</div>
@endsection