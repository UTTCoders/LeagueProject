function mapOptions(){
	return options={
		center: {lat: 40.416786, lng: -3.703788},
        zoom: 7,
        scrollwheel:false,
        maxZoom:9,
        minZoom:7,
        mapTypeControl: true,
        mapTypeControlOptions: {
        	style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        zoomControl: true,
	    zoomControlOptions: {
	        position: google.maps.ControlPosition.LEFT_TOP
	    },
	    streetViewControl:false,
        mapTypeControl:false
    }
}