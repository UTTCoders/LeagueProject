@extends('user.userhome')

@section('title',Auth::user()->name." | Home")

@section('css2')
<style type="text/css">
	#con{
		background-color: #000;
		width: 100%;
		margin-top: 62px;/*size of the navbar*/
		background-image: url(/img/stadium.jpg);
		background-repeat: no-repeat;
		background-size: 150%;
		background-position: center;
		margin-bottom: 0;
		margin-top: 0;
		border-bottom: 0;
		padding-top:90px;
		padding-bottom: 20px;
	}
	body,html{
		background-color: #388E3C;
		height: 100%;
		width: 100%;
		margin: 0; 
		padding: 0;
	}
	#map{
		width: 100%;
		height: 100%;
	}
	#hereisthemap{
		height: 80%;
		background-color: #004D40;
		padding: 0;
	}
	#nexttomap{
		color:#eee;
		padding:50px 30px 50px 30px;
	}
</style>
@endsection

@section('body2')
<div id="con">
	<div align="center">
		<img src="/img/cucu3.gif" style="width: 20%;">
		<h3 style="color:#eee; margin-top: 0; margin-bottom: 0;" id="mainTitle">Follow your passion!<br>The house of your favorite teams of the Spain League!</h3>
	</div>
</div>
<div class="jumbotron" style="background-color: #B71C1C; margin-bottom: 0; color: #eee;">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">	
				<h3 align="left">Thanks for being part of the League Project!</h3>
				<hr>
				<div class="col-md-6">
					<img class="img-responsive" style="border: 5px solid black;" src="/img/biglogo.jpg">
					<h5>© The League-project.com</h5>
				</div>
				<div class="col-md-6">
				<br class="hidden-md hidden-lg">
					<h4>Some information of the site</h4>
					<p align="justify" style="font-size: 15px; font-weight: normal;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur.</p>
				</div>
			</div>
		</div>
		@if(App\League\Stadium::has('team')->get()->count()==0)
		<br>
		<h3 align="center">Wait for the Stadiums map! Soon! ;)</h3>
		@endif
	</div>
</div>
@if(App\League\Stadium::has('team')->get()->count()>0)
	<div align="center" class="col-md-5 col-sm-6" id="nexttomap">
		<div class="col-md-11 col-md-offset-1">
		<h2>See all the stadiums!</h2>
			<p style="font-size: 20px;">Here you can see all of the stadiums.</p>
			<div class="thumbnail" style="border-radius: 0; box-shadow: 5px 5px #1B5E20;">
				<div style="font-size: 15px; color: #000; padding: 20px 10px;">
					<p><span class="glyphicon glyphicon-asterisk"></span> Hover on a stadium to see its name and the team.</p>
					<p><span class="glyphicon glyphicon-asterisk"></span> Do click on a stadium to go to check more information.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-7 col-sm-6" id="hereisthemap">
		<div id="map"></div>
	</div>
@endif
@endsection

@section('js2')
	@if(App\League\Stadium::has('team')->get()->count()>0)
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqiB2cyhlFaZJmw6_x1Cz7-AvGH5dkTLU&callback=initMap&language=EN" async defer></script>
	<script src="/js/user/usermapoptions.js"></script>
	<!--<script src="/js/user/stadiumsajax.js"></script>-->
	<script type="text/javascript">
	function getStadiums(google, map){
		var Stadiums=[];
		var tok=$("meta[name='toktok']").attr("content");
		$.ajax({
			url:"/getuserstadiums",
			method:"post",
			data:{
				_token:tok
			}
		}).done(function(response){
			console.log(response.length);
			console.log(response);
			var image={
				url: '/img/icons/stadium8.png',
				scaledSize: new google.maps.Size(65, 65),
				origin: new google.maps.Point(0,0),
				anchor: new google.maps.Point(40, 40)
			}
			$.each(response.stadiums,function(index,val){
				var latLng=JSON.parse(val.location);
				var title="Stadium: "+val.name+
				"\nTeam: "+response.teams[index].name;
				Stadiums[index]=new google.maps.Marker({
					position:{
						lat:Number(latLng.lat),
						lng:Number(latLng.lng)
					},
					map:map,
					icon: image,
					title:title,
					animation: google.maps.Animation.DROP,
				});
				Stadiums[index].id=val.id;
				Stadiums[index].name=val.name;
				Stadiums[index].addListener('click',function(){
					document.location.href="/stadiums/"+this.id;
				});
			});
		});
		return Stadiums;
	}
	</script>
	<script src="/js/user/usermap.js"></script>
	@endif
@endsection