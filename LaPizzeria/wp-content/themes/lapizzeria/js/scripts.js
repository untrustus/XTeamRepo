
var map;
function initMap() {

	var latlng = {
		lat: parseFloat(opciones.latitud),
		lng: parseFloat(opciones.longitud)
	};

	map = new google.maps.Map(document.getElementById('mapa'), {
	  center: latlng,
	  zoom: parseInt(opciones.zoom)
	});

	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		title: 'La Pizzeria'
	});
}

$ = jQuery.noConflict();
$(document).ready(function()
{
	// Ocultar y mostrar menu
	$('.mobile-menu a').on('click', function () {
		$('nav.menu-sitio').toggle('slow');
	});

	// Reaccion a resize de pantalla
	var breakpoint = 768;
	if($(document).width() >= breakpoint)
		{
			$('nav.menu-sitio').show();
		}

	$(window).resize(function() {
		if($(document).width() >= breakpoint)
		{
			$('nav.menu-sitio').show();
		}else{
			$('nav.menu-sitio').hide();
		}
	});

	// FLuidBox

	jQuery('.gallery a').each(function() {
		jQuery(this).attr({'data-fluidbox' : ''});
	});

	if(jQuery('[data-fluidbox]').length > 0) {
		jQuery('[data-fluidbox]').fluidbox();
	}

	// Ajustar mapa
	var mapa = $('#mapa');
	if(mapa.length > 0)
	{
		if($(document).width() >= breakpoint)
		{
			ajustarMapa(0);
		}else{
			ajustarMapa(300);
		}
	}

	$(window).resize(function() {
		if($(document).width() >= breakpoint)
		{
			ajustarMapa(0);
		}else{
			ajustarMapa(300);
		}
	});

});

function ajustarMapa(altura){
	if(altura == 0)
	{
		var ubicacionSection = $('.ubicacion-reservacion');
		var ubicacionAltura = ubicacionSection.height();
		$('#mapa').css({'height': ubicacionAltura});
	}else{
		$('#mapa').css({'height': altura});
	}
	
}