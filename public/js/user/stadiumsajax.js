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
		$.each(response,function(index,val){
			var image={
				url: '/img/icons/stadium8.png',
				// This marker is 20 pixels wide by 32 pixels high.
				scaledSize: new google.maps.Size(65, 65), // scaled size
			    origin: new google.maps.Point(0,0), // origin
			    anchor: new google.maps.Point(0, 0)
			}
			Stadiums[index]=new google.maps.Marker({
				position:{
					lat:val.location.lat,
					lng:val.location.lng
				},
				map:map,
				icon: image
			});
			Stadiums[index].id=val.id;
			Stadiums[index].addListener('click',function(){
				alert(this.id);
			});
		});
	});
	return Stadiums;
}