
function initMap() {
	var map;
	var options={
		center: {lat: 40, lng: -3},
        zoom: 6,
        scrollwheel:false
    }
	map = new google.maps.Map(document.getElementById('map'), options);
}

