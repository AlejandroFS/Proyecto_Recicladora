


///Funcionamineto administrador de paneles
var variableGlobalId ;
var varGlobalProveedor;
$(document).ready(function(){

	$('#panelAdministrador li').click(function(){
	
		  switch($(this).attr('id')) {
		   
	        case ('link3'):
	       
	         $('#panelBody').empty();
	       	 $('#panelAdministrador li').removeClass('active');
			 $(this).addClass('active');
			 recargaUtimos($(this));
	        break;
	     

	}
		
	});
	
	
	 ////Accion del boton actualizar
	$(document).on('click','#botnGeneral2', function(e){
			recargaUtimos($('#link3'));
			
		});
		
	$(document).on('keyup','#botonNombre2', function(e){
			if($(this).val()==''){
			recargaUtimos($('#link3'));
			}else{busquedaNombre2($(this),$(this).val());}
			
			
			
		});
			$(document).on('keyup','#botonanulidad2', function(e){
			if($(this).val()==''){
			recargaUtimos($('#link3'));
			}else{busquedaAnualidad2($(this),$(this).val());}
			
			
			
		});
		
	$(document).on('keyup','#botonMensualidad2', function(e){
			if($(this).val()==''){
			recargaUtimos($('#link3'));
			}else{busquedaMensualidad2($(this),$(this).val());}
			
			
			
		});			
		$(document).on('click','#botonEspecifico2', function(e){
			if($('#fechaInicio2').val()=='' && $('#fechaFinal2').val()=='' ){
			recargaUtimos($('#link3'));
			}else{busquedaEspecifica2($(this),$('#fechaInicio2').val(),$('#fechaFinal2').val());}
			
			
			
		});	
			function busquedaAnualidad2(selector , valorCaja){
	var contenidoDinamico = '';	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarOrdenes,
					  data: { muestra: "banualidad", anualidad: valorCaja },
					  success: function(data){
			  datosAsincronos(data);	
					 		}
					});
					
	
	}
		function busquedaMensualidad2(selector , valorCaja){
	var contenidoDinamico = '';	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarOrdenes,
					  data: { muestra: "bmensualidad",mensualidad: valorCaja },
					  success: function(data){
							  datosAsincronos(data);	
					 		}
					});
					 
	
	}
	
function busquedaEspecifica2(selector , valorCaja1 ,valorCaja2){
	var contenidoDinamico = '';	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarOrdenes,
					  data: { muestra: "besp",  fecha_inicio: valorCaja1, fecha_final: valorCaja2},
					  success: function(data){
					   datosAsincronos(data);	
					 		}
					});
					 
	
	}
		function busquedaNombre2(selector , valorCaja){
	
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarOrdenes,
					  data: { muestra: "bnombre", nombre: valorCaja },
					  success: function(data){
					  datosAsincronos(data);		
					 		}
					});
					 
	
	}
	 
					///////////////Funcionamiento de botones
		$(document).on('click','#tableValores :button', function(){
			console.log('click');
            //Identificacion del boton de edicion
if($(this).attr('role')!='editar'){  
        			var padre = $($(this).parent()).parent();
            var hijos = $(padre).children();
             var arrayData = ['id_orden','email','asunto','comentarios','fecha'];
            var obj = {};
            var arrayValues = [];
        			for (var i = 0; i < 6; i++) {
                    	var subhijo = $(hijos[i]).children();
                    	var hijo = $(subhijo[0]);
                    
                        if(i == 0){
                        	
                        	arrayValues.push($(hijo).text());
                        
                            }else{
                    	arrayValues.push($(hijo).val());}
                    	
                    	}
                    	 for ( i = 0; i < arrayData.length; i++) {
                        	obj[arrayData[i]] = arrayValues[i];
                 	   	}
                    var valores_editados = obj;
                    console.log(valores_editados);
        			variableGlobal = valores_editados['nombre_contacto'];
        			variableGlobalId = valores_editados['id_orden'];
        			console.log(variableGlobal );
        			$('#bodyAdd > p').remove();
        			$('#bodyAdd').prepend('<p style="background-color: transparent; color: black;" >¿Desea eliminar ese formulario?</p>');
        			
                   }
                    
            
            });
            $('#botonElmininar').on('click', function(e){
        console.log('click elimina'+variableGlobalId);
        $.ajax({
				              type: "POST",
				              dataType: "json",
				              url: EliminarOrdenes,
				              data: {id_orden: variableGlobalId},
				              success:function(data){
				            	recargaUtimos($('#link3'));
              }});
              
        });
        /*////////////////////////////////////////////////////////////////////////////////////*/
	 
	});
	 //---------------------------------------------------------------------------------- 
	 
	function recargaUtimos(selector){
	
	 var contenidoDinamico = '';	
	 
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarOrdenes,
					  data: { muestra: "General"},
					  success: function(data){
					 datosAsincronos(data);		
					 		}
					});}
	
	 		function datosAsincronos(data){
	 		
				       
	 		var contenidoDinamico;
					 for(var item in data) {
					 			contenidoDinamico+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			contenidoDinamico+=data[item]['id_Orden'];
					 			contenidoDinamico+='</label></td>';
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="60" placeholder="Ingrese el nombre completo del trabajador" autofocus required name="nombre"';		 
					 			contenidoDinamico+='value = "'+data[item]['nombre_proveedor']+'" >';
					 			contenidoDinamico+='</td>';	 
					 			contenidoDinamico+='<td><input type="date" readonly class="form-control visualizacion" placeholder="Fecha en la que inicio a labores el trabajador" required name="fecha_inicio"';		 
					 			contenidoDinamico+='value = "'+data[item]['fecha']+'" >';
					 			contenidoDinamico+='</td>';	
					 			
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-warning" value = "0" role="editar">Mirar orden</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-danger" value = "0" role="eliminar" data-toggle="modal" data-target="#modalDeletes">Eliminar orden</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='</td></tr></td>';		
																				 
								}
									
									//console.log(contenidoDinamico);
									$('#tableValores tbody').empty();
			var contenido ='<div id="formListadoA" action="#" class="hideElement"> <table  class="table table-striped"><thead id="banner"> <tr> <th><button type="button" class="btn btn-primary" id="botnGeneral2">Act.</button></th> <th> <input class="form-control" id="botonNombre2" maxlength="60" placeholder="Ingrese nombre" type="text"></th> <th> <input class="form-control" id="botonanulidad2" maxlength="40" placeholder="Ingrese un año" type="text"></th> <th> <input class="form-control" id="botonMensualidad2" maxlength="13" placeholder="Ingrese un mes " type="text"></th> <th><label>Busqueda entre fechas --&gt;</label></th> <th> <input class="form-control" maxlength="13" id="fechaInicio2" placeholder="Fecha inicial" type="date"></th> <th> <input class="form-control" maxlength="13" id="fechaFinal2" placeholder="Fecha final" type="date"></th> <th><button type="button" class="btn btn-success" id="botonEspecifico2">Busqueda entre fechas.</button></th> </tr> </thead></table><table class="table table-striped" id="tableValores"> <thead> <tr> <th>#</th> <th>Informacion del proveedor</th><th>Fecha</th> <th>Editar</th> <th>Eliminar</th></tr> </thead> <tbody>  </tbody> </table> </div>';   		
    		$('#panelBody').append( contenido );
    		$('#tableValores').append( contenidoDinamico );
    		$('#formListadoA').slideDown("slow");
	}
	