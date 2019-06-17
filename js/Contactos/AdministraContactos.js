

$(document).ready(function(){


		
		// Agregamos el formulario de alta default
		$('#panelBody').empty();
		var contenido ='<div id="formListado" action="#" class="hideElement"> <table  class="table table-striped"><thead id="banner"> <tr> <th><button type="button" class="btn btn-primary" id="botnGeneral">Act.</button></th> <th> <input class="form-control" id="botonNombre" maxlength="60" placeholder="Ingrese email" type="text"></th> <th> <input class="form-control" id="botonanulidad" maxlength="40" placeholder="Ingrese un año" type="text"></th> <th> <input class="form-control" id="botonMensualidad" maxlength="13" placeholder="Ingrese un mes " type="text"></th> <th><label>Busqueda entre fechas --&gt;</label></th> <th> <input class="form-control" maxlength="13" id="fechaInicio" placeholder="Fecha inicial" type="date"></th> <th> <input class="form-control" maxlength="13" id="fechaFinal" placeholder="Fecha final" type="date"></th> <th><button type="button" class="btn btn-success" id="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead></table><table class="table table-striped" id="tableValores"> <thead> <tr> <th>#</th> <th>Email</th> <th>Asunto</th> <th>Comentario</th> <th>Fecha</th></tr> </thead> <tbody>  </tbody> </table> </div>';   		
        $('#panelBody').append( contenido );
         $('#formListado').slideDown("slow");
          recargaUtimos($('#formListado'));
	   // -------------------------------------------------------------------------------------------
	   
	   
	// /Funcionamineto administrador de paneles
	$('#panelAdministrador li').click(function(){
		  switch($(this).attr('id')) {
		   case ('link1'):
		    recargaUtimos($(this));
	        break;
	    

	}
		
	});
	 // ----------------------------------------------------------------------------------
	
	
	
	
	// Funcionamiento formulario de registro de
	// contacto--------------------------------------------------------------
	
	// //Accion del boton actualizar
	$(document).on('click','#botnGeneral', function(e){
			recargaUtimos($('#link1'));
			
		});
		
	$(document).on('keyup','#botonNombre', function(e){
			if($(this).val()==''){
			recargaUtimos($('#link1'));
			}else{busquedaNombre($(this),$(this).val());}
			
			
			
		});
		
	$(document).on('keyup','#botonanulidad', function(e){
			if($(this).val()==''){
			recargaUtimos($('#link1'));
			}else{busquedaAnualidad($(this),$(this).val());}
			
			
			
		});
		
	$(document).on('keyup','#botonMensualidad', function(e){
			if($(this).val()==''){
			recargaUtimos($('#link1'));
			}else{busquedaMensualidad($(this),$(this).val());}
			
			
			
		});			
		$(document).on('click','#botonEspecifico', function(e){
			if($('#fechaInicio').val()=='' && $('#fechaFinal').val()=='' ){
			recargaUtimos($('#link1'));
			}else{busquedaEspecifica($(this),$('#fechaInicio').val(),$('#fechaFinal').val());}
			
			
			
		});			
	});// -------------------Final
		// jquerry----------------------------------------->

	
	// Pasar el selector del primer id
	
	function recargaUtimos(selector){

	 var contenidoDinamico = '';	
		$('#panelAdministrador li').removeClass('active');
		$(selector).addClass('active');
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: urlMostrarMensajes,
					  data: { muestra: "General"},
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 Resultado(data);
	
	}}
	
	
	function busquedaNombre(selector , valorCaja){
	var contenidoDinamico = '';	
		$('#panelAdministrador li').removeClass('active');
		$(selector).addClass('active');
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: urlMostrarMensajes,
					  data: { muestra: "bnombre", nombre: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					  Resultado(data);
	}
	
	}
		function busquedaAnualidad(selector , valorCaja){
	var contenidoDinamico = '';	
		$('#panelAdministrador li').removeClass('active');
		$(selector).addClass('active');
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: urlMostrarMensajes,
					  data: { muestra: "banualidad", anualidad: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 Resultado(data);
	}
	
	}
		function busquedaMensualidad(selector , valorCaja){
	var contenidoDinamico = '';	
		$('#panelAdministrador li').removeClass('active');
		$(selector).addClass('active');
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: urlMostrarMensajes,
					  data: { muestra: "bmensualidad",mensualidad: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 Resultado(data);
	}
	
	}
	
function busquedaEspecifica(selector , valorCaja1 ,valorCaja2){
	var contenidoDinamico = '';	
		$('#panelAdministrador li').removeClass('active');
		$(selector).addClass('active');
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: urlMostrarMensajes,
					  data: { muestra: "besp",  fecha_inicio: valorCaja1, fecha_final: valorCaja2},
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					  Resultado(data);
	                    }
	
	}
	
	function Resultado(data){
	var contenidoDinamico;
	$('#link1').addClass('active');
	for(var item in data) {
					 			contenidoDinamico+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			contenidoDinamico+=data[item]['id_Contacto'];
					 			contenidoDinamico+='</label></td>';
					 			contenidoDinamico+='<td><input type="email" readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del contacto." name="email"';	
					 			contenidoDinamico+='value = "'+data[item]['email']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="100"  required name="domicilio"';	
					 			contenidoDinamico+='value = "'+data[item]['asunto']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="100"  required name="domicilio"';	
					 			contenidoDinamico+='value = "'+data[item]['comentarios']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			contenidoDinamico+='<td><input type="date" readonly class="form-control visualizacion" maxlength="100"  required name="domicilio"';	
					 			contenidoDinamico+='value = "'+data[item]['fecha']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-warning" value = "0" role="editar" data-toggle="modal" data-target="#myModalVisual">Mirar mensaje</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-danger" value = "0" role="eliminar" data-toggle="modal" data-target="#modalDeletes">Eliminar contacto</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='</td></tr></td>';					
								}
									
									// console.log(contenidoDinamico);
									$('#tableValores tbody').empty();
			var contenido ='<div id="formListado" action="#" class="hideElement"> <table  class="table table-striped"><thead id="banner"> <tr> <th><button type="button" class="btn btn-primary" id="botnGeneral">Act.</button></th> <th> <input class="form-control" id="botonNombre" maxlength="60" placeholder="Ingrese email" type="text"></th> <th> <input class="form-control" id="botonanulidad" maxlength="40" placeholder="Ingrese un año" type="text"></th> <th> <input class="form-control" id="botonMensualidad" maxlength="13" placeholder="Ingrese un mes " type="text"></th> <th><label>Busqueda entre fechas --&gt;</label></th> <th> <input class="form-control" maxlength="13" id="fechaInicio" placeholder="Fecha inicial" type="date"></th> <th> <input class="form-control" maxlength="13" id="fechaFinal" placeholder="Fecha final" type="date"></th> <th><button type="button" class="btn btn-success" id="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead></table><table class="table table-striped" id="tableValores"> <thead> <tr> <th>#</th> <th>Email</th> <th>Asunto</th> <th>Comentario</th> <th>Fecha</th></tr> </thead> <tbody>  </tbody> </table> </div>';   		
    		$('#panelBody').append( contenido );
    		$('#tableValores').append( contenidoDinamico );
    		$('#formListado').slideDown("slow");
	}