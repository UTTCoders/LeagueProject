function getStadiums(google, map){
	var Stadiums=[];
	var tok=$("meta[name='toktok']").attr("content");
	alert(tok);
	$.ajax({
		url:"/getuserstadiums",
		method:"post",
		data:{
			_token:tok
		}
	}).done(function(response){
		$.each(response,function(index,val){
			Stadiums[index]=new google.maps.Marker({
				position:{
					lat:val.location.lat,
					lng:val.location.lng
				},
				map:map
			});
		});
	});
	return Stadiums;
}