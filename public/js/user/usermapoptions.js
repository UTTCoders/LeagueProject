function mapOptions(){
	return options={
		center: {lat: 40.416786, lng: -3.703788},
        zoom: 6,
        scrollwheel:false,
        minZoom:6,
        zoomControl: true,
	    zoomControlOptions: {
	        position: google.maps.ControlPosition.LEFT_TOP
	    },
	    streetViewControl:false,
        mapTypeControl:false
    }
}