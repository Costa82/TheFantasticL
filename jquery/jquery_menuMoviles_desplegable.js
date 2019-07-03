$(document).ready(function() {
	// Función que abre y cierra, al hacer click, lentamente el menú principal
	// de los dispositivos móviles.
	$('#menu_moviles').click(function(e) {
		e.stopPropagation();
		if ($("#lista_movil").is(":hidden")) {
			$("#lista_movil").slideDown("slow");
		} else {
			$("#lista_movil").slideUp("slow");
		}
	});
	
	$('.desplegable a').on('mouseenter',function(e) {
		e.stopPropagation();
		$("#menu_consultoria").slideDown("slow");
	});
	
	$('.desplegable').on('mouseleave',function(e) {
		e.stopPropagation();
		$("#menu_consultoria").slideUp("slow");
	});
	
	$('html').click(function() {
		$("#lista_movil").slideUp("slow");
	});
	
	$('.rechazar').on('click',function() {
	    $('#overbox3').hide();
	});
});