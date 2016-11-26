function initMap() {
	var options=mapOptions();
	var map = new google.maps.Map(document.getElementById('map'), options);
	var m = new google.maps.Marker({
		position:{
			lat:options.center.lat, 
			lng:options.center.lng
		},
		map:map, title:"Welcome to Spain!"
	});
	console.log(getStadiums(google,map));
	
}

function incase(){
	google.maps.event.addListener(map,'click',function(e){
		console.log(e.latLng.lat());
		console.log(e.latLng.lng());
		//var m=new Stadium(1,"hola",e.latLng.lat(),e.latLng.lng());
		var m = new google.maps.Marker({
			position:{
				lat:e.latLng.lat(),lng:e.latLng.lng()
			},
			map:map
		});
		m.hola="holaa";
		console.log(m.hola);
		
	});
}