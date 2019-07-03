$(document).ready(function() {
	// Función que muestra textos en inglés o en español.
	$('.inglesa').click(function(e) {
		e.stopPropagation();
		$(".ingles").show();
		$(".espanol").hide();
	});
	
	$('.espanola').click(function(e) {
		e.stopPropagation();
		$(".espanol").show();
		$(".ingles").hide();
	});
	
});