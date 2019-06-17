$(document)
		.ready(
				function() {
					// Materiales de desecho.
					$.ajax({
						method : "Post",
						dataType : "json",
						url : url8,
						data : {
							muestra : "General"
						},
						success : function(data) {
							datosAsincronosMaterialesDesecho(data);
						}
					});
					function datosAsincronosMaterialesDesecho(data) {
						var contenidoDinamico;
						var i = 1;
						for ( var item in data) {
							if (i == 7) {
								break;
							}
							contenidoDinamico += '<tr><td><label  class="form-control table-striped table-hover visualizacion">';
							contenidoDinamico += i;
							contenidoDinamico += '</label></td>';
							contenidoDinamico += '<td><input readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del contacto." name="email"';
							contenidoDinamico += 'value = "'
									+ data[item]['nombre_material'] + '" >';
							contenidoDinamico += '</td>';

							contenidoDinamico += '<td><input type="text" readonly class="form-control visualizacion cajaNumerica" maxlength="100" placeholder="Ingrese el domicilio del contacto" required name="domicilio"';
							contenidoDinamico += 'value = "' + "$ "
									+ data[item]['precio_kg_compra'] + '" >';
							contenidoDinamico += '</td>';

							contenidoDinamico += '</td></tr></td>';
							i++;

						}
						var contenido = '<div id="formListado" action="#" class="hideElement"><table class="table table-striped" id="tableValores"> <thead> <tr> <th>#</th> <th>Material de desecho.  <span class="fa fa-magnet fa-2x" aria-hidden="true"></th>  <th>Precio de venta por Kg. <span class="fa fa-cubes fa-2x" aria-hidden="true"></span></th> </tr> </thead> <tbody>  </tbody> </table> </div>';
						$('#panelBody1').prepend(contenido);
						$('#tableValores').append(contenidoDinamico);
						$('#formListado').slideDown("slow");
					}
					// Termina el llenado de materiales de desecho.

					// Materiales de reciclaje.
					$.ajax({
						method : "Post",
						dataType : "json",
						url : url9,
						data : {
							muestra : "General"
						},
						success : function(data) {
							datosAsincronosRecilclaje(data);
						}
					});
					function datosAsincronosRecilclaje(data) {
						var contenidoDinamico = '';
						var i = 1;
						for ( var item in data) {
							if (i == 7) {
								break;
							}
							contenidoDinamico += '<tr><td><label  class="form-control table-striped table-hover visualizacion">';
							contenidoDinamico += i;
							contenidoDinamico += '</label></td>';
							contenidoDinamico += '<td><input readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del contacto." name="email"';
							contenidoDinamico += 'value = "'
									+ data[item]['nombre_material'] + '" >';
							contenidoDinamico += '</td>';

							contenidoDinamico += '<td><input type="text" readonly class="form-control visualizacion cajaNumerica" maxlength="100" placeholder="Ingrese el domicilio del contacto" required name="domicilio"';
							contenidoDinamico += 'value = "' + "$ "
									+ data[item]['precio_kg_venta'] + '" >';
							contenidoDinamico += '</td>';

							contenidoDinamico += '</td></tr></td>';
							i++;
						}

						// console.log(contenidoDinamico);

						var contenido = '<div id="formListado2" class="hideElement"> <table class="table table-striped" id="tableValores2"> <thead> <tr> <th>#</th> <th>Material de reciclaje.  <span class="fa fa-recycle fa-2x" aria-hidden="true"></th>  <th>Precio de venta por Kg. <span class="fa fa-cubes fa-2x" aria-hidden="true"></span></th></tr> </thead> <tbody>  </tbody> </table> </div>';
						$('#panelBody2').prepend(contenido);
						$('#tableValores2').append(contenidoDinamico);
						$('#formListado2').slideDown("slow");
					}
					// Termina el llenado de materiales de reciclaje.
				});