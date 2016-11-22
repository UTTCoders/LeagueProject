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
			scaledSize: new google.maps.Size(70, 70),
			origin: new google.maps.Point(0,0),
			anchor: new google.maps.Point(0, 0)
		}
		$.each(response,function(index,val){
			var latLng=JSON.parse(val.location);
			Stadiums[index]=new google.maps.Marker({
				position:{
					lat:Number(latLng.lat),
					lng:Number(latLng.lng)
				},
				map:map,
				icon: image,
				title:"Stadium: "+val.name,
				animation: google.maps.Animation.DROP,
			});
			Stadiums[index].id=val.id;
			Stadiums[index].name=val.name;
			Stadiums[index].addListener('click',function(){
				document.location.href="/stadium/"+this.id;
			});
		});
	});
	return Stadiums;
}