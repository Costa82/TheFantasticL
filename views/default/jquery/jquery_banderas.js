$(document).ready(function() {
	// Función que muestra textos en inglés o en español.
	$('.inglesa').click(function(e) {
		e.stopPropagation();
		$(".ingles").show();
		$(".espanol").hide();
		$(".inglesa").hide();
		$(".espanola").show();
	});
	
	$('.espanola').click(function(e) {
		e.stopPropagation();
		$(".espanol").show();
		$(".ingles").hide();
		$(".inglesa").show();
		$(".espanola").hide();
	});
	
});