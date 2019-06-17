

$(document).ready(function(){

        

function encode_utf8(s) {
  return unescape(encodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}

		
		//Agregamos el formulario de alta default
		  $('#panelBody').empty();
			var contenido =' <div id="divRegistro" action="#" class="controlPanel hideElement"><form id ="formRegistro">  <label id="estatusRegistro"></label> <div class="form-group" > <label for="nombre">Nombre del material de desecho:</label> <input type="text" class="form-control" maxlength="40" placeholder="Ingrese el nombre del material de desecho" autofocus required name="nombre_material"> </div> <div class="form-group" ><label >Precio de compra por Kg o pieza:</label> <input type="text" class="form-control cajaNumerica" maxlength="7" placeholder="Ingrese el precio de compra del material de desecho" required name="precio_kg_compra"> </div><div class="form-group" ><label >Precio de venta por Kg o pieza:</label> <input type="text" class="form-control cajaNumerica" maxlength="7" placeholder="Ingrese el precio de venta del material de desecho" required name="precio_kg_venta"> </div> <button type="submit" id="botonAlta" class="btn btn-default">Registrar material de desecho.</button> </form></div> ';
			$('#panelBody').append( contenido );
        	$('#divRegistro').slideDown("slow");
        
	   //------------------------------------------------------------------------------------------- 
	   
	   
	///Funcionamineto administrador de paneles
	$('#panelAdministrador li').click(function(){
		  switch($(this).attr('id')) {
		   case ('link1'):
		   $('#panelBody').empty();
		    recargaUtimos($(this));
		    
	        break;
	        case ('link2'):
	       	$('#panelAdministrador li').removeClass('active');
	        $(this).addClass('active');
	         $('#panelBody').empty();
			var contenido =' <div id="divRegistro" action="#" class="controlPanel hideElement"><form id ="formRegistro">  <label id="estatusRegistro"></label> <div class="form-group" > <label for="nombre">Nombre del material de desecho:</label> <input type="text" class="form-control" maxlength="15" placeholder="Ingrese el nombre del material de desecho" autofocus required name="nombre_material"> </div> <div class="form-group" ><label >Precio de compra por Kg:</label> <input type="text" class="form-control cajaNumerica" maxlength="7" placeholder="Ingrese el precio de compra del material de desecho" required name="precio_kg_compra"> </div><div class="form-group" ><label >Precio de venta por Kg:</label> <input type="text" class="form-control cajaNumerica" maxlength="7" placeholder="Ingrese el precio de venta del material de desecho" required name="precio_kg_venta"> </div> <button type="submit" id="botonAlta" class="btn btn-default">Registrar material de desecho.</button> </form></div> ';
			$('#panelBody').append( contenido );
        	$('#divRegistro').slideDown("slow");
	        break;
	    

	}
		
	});
	 //---------------------------------------------------------------------------------- 
	
	
	
	
	//Funcionamiento formulario de registro de contacto--------------------------------------------------------------
	$(document).on('submit','#formRegistro', function(e){
		 e.preventDefault('pp');
		  var values = JSON.stringify($('#formRegistro').serializeObject());
          var values = jQuery.parseJSON(values);
          console.log(values);
          $.ajax({
              type: "POST",
              dataType: "json",
              url: urlAltaMaterialDesecho,
              data: values,
              success:function(data){
              console.log(data['respuesta'] );
               if(data['respuesta'] == 'Material de Desecho registrado'){              
               $('#estatusRegistro').text('Datos correctos, limpiado campos...');
               $('#estatusRegistro').addClass('label label-info  tLetra');
               setTimeout(function(){ 
               $('#formRegistro').trigger("reset");
               $('#estatusRegistro').text(' ');
               $('#estatusRegistro').removeClass('label-warning  label-info tLetra');
               }, 1500);     
           }else{
             $('#estatusRegistro').text('Ingrese los datos correctos.!');
             $('#estatusRegistro').addClass('label label-warning  tLetra');
           }
              }});
	});
	////Accion del boton actualizar
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
	});//-------------------Final jquerry----------------------------------------->

	
	//Pasar el selector del primer id
	
	function recargaUtimos(selector){
	console.log('-->');
	 var contenidoDinamico = '';	
		$('#panelAdministrador li').removeClass('active');
		$(selector).addClass('active');
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: urlMostrarMateriales,
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
					  url: urlMostrarMateriales,
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
					  url: urlMostrarMateriales,
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
					  url: urlMostrarMateriales,
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
					  url: urlMostrarMateriales,
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
	var i = 0;
	for(var item in data) {
					 			contenidoDinamico+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			contenidoDinamico+= data[item]['id_Material'];
					 			contenidoDinamico+='</label></td>';
					 			contenidoDinamico+='<td><input type="email" readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del contacto." name="email"';	
					 			contenidoDinamico+='value = "'+data[item]['nombre_material']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion cajaNumerica" maxlength="100" placeholder="Ingrese el domicilio del contacto" required name="domicilio"';	
					 			contenidoDinamico+='value = "'+data[item]['precio_kg_compra']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion cajaNumerica" maxlength="100" placeholder="Ingrese el domicilio del contacto" required name="domicilio"';	
					 			contenidoDinamico+='value = "'+data[item]['precio_kg_venta']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-warning" value = "0" role="editar" data-toggle="modal" data-target="#myModalVisual">Editar material</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-danger" value = "0" role="eliminar" data-toggle="modal" data-target="#modalDeletes">Eliminar Material</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='</td></tr></td>';	
					 			i++;				
								}
									
									//console.log(contenidoDinamico);
									$('#tableValores tbody').empty();
			var contenido ='<div id="formListado" action="#" class="hideElement"> <table  class="table table-striped resetDisplay"><thead id="banner"> <tr> <th><button type="button" class="btn btn-primary" id="botnGeneral">Act.</button></th> <th> <input class="form-control" id="botonNombre" maxlength="15" placeholder="Ingrese nombre" type="text"></th> <th> </th> </tr> </thead></table><table class="table table-striped" id="tableValores"> <thead> <tr> <th>#</th> <th>Nombre del material</th> <th>Precio x kg compra</th>  <th>Precio x kg venta</th><th>Editar material</th><th>Eliminar Material</th></tr> </thead> <tbody>  </tbody> </table> </div>';   		
    		$('#panelBody').append( contenido );
    		$('#tableValores').append( contenidoDinamico );
    		$('#formListado').slideDown("slow");
	}
	