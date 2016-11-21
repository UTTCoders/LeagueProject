$(document).ready(function(){
	$(".submenu").hide();

	$(".event").click(function(){
		var string = "#" + $(this).attr("name");
		$(string).slideToggle(200);
	});
});