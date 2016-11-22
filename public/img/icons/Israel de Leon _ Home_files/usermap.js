function initMap() {
	var options=mapoptions();
	var map = new google.maps.Map(document.getElementById('map'), options);

	google.maps.event.addListener(map,'click',function(e){
		console.log(e.latLng.lat());
		console.log(e.latLng.lng());
		//var m=new Stadium(1,"hola",e.latLng.lat(),e.latLng.lng());
		var m = new google.maps.Marker({
			position:{
				lat:e.latLng.lat(),lng:e.latLng.lng()
			},
			map:map,
			icon:""
		});
		m.hola="holaa";
		console.log(m.hola);
		
	});
	console.log(getStadiums(google,map));
	
}
