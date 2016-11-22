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
			Stadiums[index]=new google.maps.Marker({
				position:{
					lat:val.location.lat,
					lng:val.location.lng
				},
				map:map
			});
			Stadiums[index].id=val.id;
			Stadiums[index].addListener('click',function(){
				alert(this.id);
			});
		});
	});
	return Stadiums;
}