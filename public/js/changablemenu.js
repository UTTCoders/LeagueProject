$(document).ready(function(){
	$(".submenu").hide();

	$(".action").click(function(){
		var string = "#" + $(this).attr("name");
		$(string).slideToggle(200);
	});
});