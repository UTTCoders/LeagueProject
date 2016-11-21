function mapoptions(){
	return options={
		center: {lat: 40, lng: -3},
        zoom: 6,
        scrollwheel:false,
        maxZoom:9,
        minZoom:6,
        mapTypeControl: true,
        mapTypeControlOptions: {
        	style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        zoomControl: true,
	    zoomControlOptions: {
	        position: google.maps.ControlPosition.LEFT_CENTER
	    },
	    streetViewControl:false
    }
}
