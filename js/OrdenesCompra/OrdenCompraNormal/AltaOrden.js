

$(document).ready(function(){
 $('#botonFormularioRegistro').prop('disabled', true);
        

function encode_utf8(s) {
  return unescape(encodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}

		
		//Agregamos el formulario de alta default
		
         $('#panelBody').empty();
		    recargaUtimos($('#link3'));
          
	   //------------------------------------------------------------------------------------------- 
	   
	   
	///Funcionamineto administrador de paneles en link 1
	$('#panelAdministrador li').click(function(){
		  switch($(this).attr('id')) {
		    case ('link1'):
		    $('#panelAdministrador li').removeClass('active');
	        $(this).addClass('active');
		    $('#panelBody').empty();
		    recargaUtimosProv($(this));
	        break;
	}
		
	});
	 //---------------------------------------------------------------------------------- 
	
	
	
	

	////Accion del boton actualizar
	$(document).on('click','#botnGeneral', function(e){
			recargaUtimosProv($('#link1'));
			
		});
		
	$(document).on('keyup','#botonNombre', function(e){
			if($(this).val()==''){
			recargaUtimosProv($('#link1'));
			}else{busquedaNombre2($(this),$(this).val());}
			
			
			
		});
		
	$(document).on('keyup','#botonanulidad', function(e){
			if($(this).val()==''){
			recargaUtimosProv($('#link1'));
			}else{busquedaAnualidad($(this),$(this).val());}
			
			
			
		});
		
	$(document).on('keyup','#botonMensualidad', function(e){
			if($(this).val()==''){
			recargaUtimosProv($('#link1'));
			}else{busquedaMensualidad($(this),$(this).val());}
			
			
			
		});			
		$(document).on('click','#botonEspecifico', function(e){
			if($('#fechaInicio').val()=='' && $('#fechaFinal').val()=='' ){
			recargaUtimosProv($('#link1'));
			}else{busquedaEspecifica($(this),$('#fechaInicio').val(),$('#fechaFinal').val());}
			
			
			
		});			
			$(document).on('click','#generaOrden', function(e){
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
        			console.log(variableGlobalId );
        			
        			$.ajax({
				              type: "POST",
				              dataType: "json",
				              url: AltaOrden,
				              data: {id_proveedor: variableGlobalId,hora: new Date().getFullYear()+'-'+new Date().getMonth()+'-'+new Date().getDay()+' '+ new Date().getHours()+':'+ new Date().getMinutes() + ':'+new Date().getSeconds() },
				              success:function(data){
				            	  $('#panelBody').empty();
				            	recargaUtimos($('#link3'));
				             	$('#panelAdministrador li').removeClass('active');
				             	$('#link3').addClass('active');
				            
				             
              }});
			});
			
			 
	});//-------------------Final jquerry----------------------------------------->

	
	//Pasar el selector del primer id
	
	function recargaUtimosProv(selector){

	 var contenidoDinamico = '';	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores,
					  data: { muestra: "General"},
					  success: function(data){
					 datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 ResultadoProv(data);
	
	}}
	
	
	function busquedaNombre2(selector , valorCaja){
	var contenidoDinamico = '';	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores,
					  data: { muestra: "bnombre", nombre: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					  ResultadoProv(data);
	}
	
	}
		function busquedaAnualidad(selector , valorCaja){
	var contenidoDinamico = '';	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores,
					  data: { muestra: "banualidad", anualidad: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 ResultadoProv(data);
	}
	
	}
		function busquedaMensualidad(selector , valorCaja){
	var contenidoDinamico = '';	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores,
					  data: { muestra: "bmensualidad",mensualidad: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 ResultadoProv(data);
	}
	
	}
	
function busquedaEspecifica(selector , valorCaja1 ,valorCaja2){
	var contenidoDinamico = '';	
	
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores,
					  data: { muestra: "besp",  fecha_inicio: valorCaja1, fecha_final: valorCaja2},
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					  ResultadoProv(data);
	                    }
	
	}
	
	function ResultadoProv(data){
	var contenidoDinamico;
	var resultado = '';
	for(var item in data) {

	
	                            resultado+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			resultado+=data[item]['id_Proveedor'];
					 			resultado+='</label></td>';	
					 			resultado+=data[item]['id_trabajador'];
					 			resultado+='</label>';
	                            resultado+= '<td>'+'Nombre: '+ data[item]['nombre_proveedor'] +'<hr>';					 		
					 			resultado+= 'RFC: ' + data[item]['rfc'] +'<hr>';		 			
					 			resultado+='</p></td>';
					 			resultado+='<td><button type="button" class="btn btn-warning" value = "0" id="generaOrden" role="crear">Generar orden</button>';					 				 
					 			resultado+='</td>';	
					 			contenidoDinamico+='</td></tr>>';	
					 			
								}
									contenidoDinamico = resultado;
									//console.log(contenidoDinamico);
									$('#tableValores2 tbody').empty();
			var contenido ='<div id="formListado" action="#" class="hideElement"> <table  class="table table-striped"><thead id="banner"> <tr> <th><button type="button" class="btn btn-primary" id="botnGeneral">Act.</button></th> <th> <input class="form-control" id="botonNombre" maxlength="60" placeholder="Ingrese nombre" type="text"></th> <th> <input class="form-control" id="botonanulidad" maxlength="40" placeholder="Ingrese un año" type="text"></th> <th> <input class="form-control" id="botonMensualidad" maxlength="13" placeholder="Ingrese un mes " type="text"></th> <th><label>Busqueda entre fechas --&gt;</label></th> <th> <input class="form-control" maxlength="13" id="fechaInicio" placeholder="Fecha inicial" type="date"></th> <th> <input class="form-control" maxlength="13" id="fechaFinal" placeholder="Fecha final" type="date"></th> <th><button type="button" class="btn btn-success" id="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead></table><table class="table table-striped" id="tableValores2"> <thead> <tr> <th>#</th> <th>Informacion del proveedor</th> <th>Generar Orden</th></tr> </thead> <tbody>  </tbody> </table> </div>';   		
    		$('#panelBody').append( contenido );
    		$('#tableValores2').append( contenidoDinamico );
    		$('#formListado').slideDown("slow");
	}