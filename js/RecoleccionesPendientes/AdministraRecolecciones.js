function initMap() {
	$(document)
			.ready(
					function() {

						// Agregamos el formulario de alta default
						$('#panelBody').empty();
						var contenido = '<div id="formListado" action="#" class="hideElement"> <table  class="table table-striped"><thead id="banner"> <tr> <th><button type="button" class="btn btn-primary" id="botnGeneral">Act.</button></th> <th> <input class="form-control" id="botonNombre" maxlength="60" placeholder="Ingrese nombre" type="text"></th> <th> <input class="form-control" id="botonanulidad" maxlength="40" placeholder="Ingrese un año" type="text"></th> <th> <input class="form-control" id="botonMensualidad" maxlength="13" placeholder="Ingrese un mes " type="text"></th> <th><label>Busqueda entre fechas --&gt;</label></th> <th> <input class="form-control" maxlength="13" id="fechaInicio" placeholder="Fecha inicial" type="date"></th> <th> <input class="form-control" maxlength="13" id="fechaFinal" placeholder="Fecha final" type="date"></th> <th><button type="button" class="btn btn-success" id="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead></table><table class="table table-striped" id="tableValores"> <thead> <tr> <th>#</th> <th>Informacion</th> <th>Mapa</th> <th>Marcar completada</th> <th>Eliminar recoleccion</th></tr> </thead> <tbody>  </tbody> </table> </div>';
						$('#panelBody').append(contenido);
						$('#formListado').slideDown("slow");
						recargaUtimos($('#formListado'));
						// -------------------------------------------------------------------------------------------

						// /Funcionamineto administrador de paneles
						$('#panelAdministrador li').click(function() {
							switch ($(this).attr('id')) {
							case ('link1'):
								recargaUtimos($(this));
								break;

							}

						});
						// ----------------------------------------------------------------------------------

						// //Accion del boton actualizar
						$(document).on('click', '#botnGeneral', function(e) {
							recargaUtimos($('#link1'));

						});

						$(document).on('keyup', '#botonNombre', function(e) {
							if ($(this).val() == '') {
								recargaUtimos($('#link1'));
							} else {
								busquedaNombre($(this), $(this).val());
							}

						});

						$(document).on('keyup', '#botonanulidad', function(e) {
							if ($(this).val() == '') {
								recargaUtimos($('#link1'));
							} else {
								busquedaAnualidad($(this), $(this).val());
							}

						});

						$(document).on(
								'keyup',
								'#botonMensualidad',
								function(e) {
									if ($(this).val() == '') {
										recargaUtimos($('#link1'));
									} else {
										busquedaMensualidad($(this), $(this)
												.val());
									}

								});
						$(document).on(
								'click',
								'#botonEspecifico',
								function(e) {
									if ($('#fechaInicio').val() == ''
											&& $('#fechaFinal').val() == '') {
										recargaUtimos($('#link1'));
									} else {
										busquedaEspecifica($(this), $(
												'#fechaInicio').val(), $(
												'#fechaFinal').val());
									}

								});

					});// -------------------Final
	// jquerry----------------------------------------->
}

// Pasar el selector del primer id

function recargaUtimos(selector) {

	var contenidoDinamico = '';
	$('#panelAdministrador li').removeClass('active');
	$(selector).addClass('active');

	$.ajax({
		method : "Post",
		dataType : "json",
		url : urlMostrarRecolecciones,
		data : {
			muestra : "General"
		},
		success : function(data) {
			contenidoDinamicoA = datosAsincronos(data);
		}
	});
	function datosAsincronos(data) {
		Resultado(data);

	}
}

function busquedaNombre(selector, valorCaja) {
	var contenidoDinamico = '';
	$('#panelAdministrador li').removeClass('active');
	$(selector).addClass('active');

	$.ajax({
		method : "Post",
		dataType : "json",
		url : urlMostrarRecolecciones,
		data : {
			muestra : "bnombre",
			nombre : valorCaja
		},
		success : function(data) {
			contenidoDinamicoA = datosAsincronos(data);
		}
	});
	function datosAsincronos(data) {
		Resultado(data);
	}

}
function busquedaAnualidad(selector, valorCaja) {
	var contenidoDinamico = '';
	$('#panelAdministrador li').removeClass('active');
	$(selector).addClass('active');

	$.ajax({
		method : "Post",
		dataType : "json",
		url : urlMostrarRecolecciones,
		data : {
			muestra : "banualidad",
			anualidad : valorCaja
		},
		success : function(data) {
			contenidoDinamicoA = datosAsincronos(data);
		}
	});
	function datosAsincronos(data) {
		Resultado(data);
	}

}
function busquedaMensualidad(selector, valorCaja) {
	var contenidoDinamico = '';
	$('#panelAdministrador li').removeClass('active');
	$(selector).addClass('active');

	$.ajax({
		method : "Post",
		dataType : "json",
		url : urlMostrarRecolecciones,
		data : {
			muestra : "bmensualidad",
			mensualidad : valorCaja
		},
		success : function(data) {
			contenidoDinamicoA = datosAsincronos(data);
		}
	});
	function datosAsincronos(data) {
		Resultado(data);
	}

}

function busquedaEspecifica(selector, valorCaja1, valorCaja2) {
	var contenidoDinamico = '';
	$('#panelAdministrador li').removeClass('active');
	$(selector).addClass('active');

	$.ajax({
		method : "Post",
		dataType : "json",
		url : urlMostrarRecolecciones,
		data : {
			muestra : "besp",
			fecha_inicio : valorCaja1,
			fecha_final : valorCaja2
		},
		success : function(data) {
			contenidoDinamicoA = datosAsincronos(data);
		}
	});
	function datosAsincronos(data) {
		Resultado(data);
	}

}

function Resultado(data) {
	$('#link1').addClass('active');
	var contenidoDinamico;
	var resultado;
	var latitud = [];
	var longitud = [];
	for ( var item in data) {
		resultado += '<tr><td><label  class="form-control table-striped table-hover visualizacion">';
		resultado += data[item]['id_form'];
		resultado += '</label></td>';
		resultado += data[item]['id_form'];
		resultado += '</label>';
		resultado += '<td>' + 'Nombre: ' + data[item]['nombre'] + '<hr>';
		resultado += 'Fecha: ' + data[item]['fecha_form'] + '<hr>';
		resultado += '<p class="test">' + 'Sobre la recolección: '
				+ data[item]['comentarios'] + '</p><hr>';
		resultado += 'Telefono: ' + data[item]['telefono'] + '</p><hr> </td>';
		var divMapa = '<div class ="classMapa"style="width: 300px; height: 300px; display: inline-block" class="col-md-6  correcionPaneles" >';
		resultado += '<td>' + divMapa;

		resultado += '</td>';
		resultado += '<td><button type="button" class="btn btn-warning" value = "0" role="editar">Marcar competada</button>';

		resultado += '</td>';

		resultado += '<td><button type="button" class="btn btn-danger" value = "0" role="eliminar" data-toggle="modal" data-target="#modalDeletes">Eliminar recoleccion</button>';

		resultado += '</td></tr>';
		latitud.push(data[item]['latitud']);
		longitud.push(data[item]['longitud']);

	}
	contenidoDinamico = resultado;
	$('#tableValores tbody').empty();
	var contenido = '<div id="formListado" action="#" class="hideElement"> <table  class="table table-striped"><thead id="banner"> <tr> <th><button type="button" class="btn btn-primary" id="botnGeneral">Act.</button></th> <th> <input class="form-control" id="botonNombre" maxlength="60" placeholder="Ingrese nombre" type="text"></th> <th> <input class="form-control" id="botonanulidad" maxlength="40" placeholder="Ingrese un año" type="text"></th> <th> <input class="form-control" id="botonMensualidad" maxlength="13" placeholder="Ingrese un mes " type="text"></th> <th><label>Busqueda entre fechas --&gt;</label></th> <th> <input class="form-control" maxlength="13" id="fechaInicio" placeholder="Fecha inicial" type="date"></th> <th> <input class="form-control" maxlength="13" id="fechaFinal" placeholder="Fecha final" type="date"></th> <th><button type="button" class="btn btn-success" id="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead></table><table class="table table-striped" id="tableValores"> <thead> <tr> <th>#</th> <th>Informacion</th> <th>Mapa</th> <th>Marcar completada</th><th>Eliminar recoleccion</th></tr> </thead> <tbody>  </tbody> </table> </div>';
	$('#panelBody').append(contenido);
	$('#tableValores').append(contenidoDinamico);
	$('#formListado').slideDown("slow");
	estaListo(latitud, longitud);
}

function estaListo(latitud, longitud) {

	$(document).ready(function() {
		var markers = [];
		var divs = document.getElementsByClassName("classMapa");
		var map;
		for (var i = 0; i < latitud.length; i++) {
			initMap(divs[i], latitud[i], longitud[i]);
		}

		function initMap(div, latid, long) {
			map = new google.maps.Map(div, {
				center : {
					lat : Number(latid),
					lng : Number(long)
				},
				zoom : 15
			});
			addMarker({
				lat : Number(latid),
				lng : Number(long)
			}, map);
		}

		function addMarker(location, mapa) {
			var marker = new google.maps.Marker({
				position : location,
				map : mapa
			});

		}
	});
}