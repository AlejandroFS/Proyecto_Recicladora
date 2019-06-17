<?php

$url8 = htmlspecialchars('php/MaterialesDesecho/MostrarMateriales.php');
$url9 = htmlspecialchars('php/MaterialesReciclaje/MostrarMateriales.php');

?>

$(document).ready(function(){

        

function encode_utf8(s) {
  return unescape(encodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}

		
		//Agregamos el formulario de alta default
		   $('#panelBody').empty();
		 
		   		recargaUtimosRec($('#link2'));
		   		  	  recargaUtimos($('#link2'));
			
		
		
		 
		
        
	   //------------------------------------------------------------------------------------------- 
	   
	   
	///Funcionamineto administrador de paneles
	$('#panelAdministrador li').click(function(){
		  switch($(this).attr('id')) {
		   case ('link1'):
		   $('#panelBody').empty();
		   recargaUtimosRec($(this));
		    
	        break;
	        case ('link2'):
	       	 $('#panelBody').empty();
		    recargaUtimos($(this));
	        break;
	    

	}
		
	});
	 //---------------------------------------------------------------------------------- 
	
	
	
	
	//Funcionamiento formulario de registro de contacto--------------------------------------------------------------
	
	////Accion del boton actualizar
	$(document).on('click','#botnGeneral', function(e){
			recargaUtimos($('#link2'));
			
		});
		$(document).on('click','#botnGeneralRec', function(e){
			 recargaUtimosRec($('#link1'));
			
		});
		
	$(document).on('keyup','#botonNombre', function(e){
			if($(this).val()==''){
			recargaUtimos($('#link1'));
			}else{busquedaNombre($(this),$(this).val());}
			
			
			
		});
		$(document).on('keyup','#botonNombreRec', function(e){
			if($(this).val()==''){
			recargaUtimosRec($('#link1'));
			}else{busquedaNombreRec($(this),$(this).val());}
			
			
			
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

	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: "<?php echo $url8;?>",
					  data: { muestra: "General"},
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 Resultado(data);
					 $('#formListado').slideDown("slow");
	
	}}
	function recargaUtimosRec(selector){
	console.log('-->');
	 var contenidoDinamico = '';	

	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: "<?php echo $url9;?>",
					  data: { muestra: "General"},
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					ResultadoReciclaje(data);
					 $('#formListado2').slideDown("slow");
	
	}}
	
	
	function busquedaNombre(selector , valorCaja){
		var contenidoDinamico = '';	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: "<?php echo $url8;?>",
					  data: { muestra: "bnombre", nombre: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					  Resultado(data);
	}
	
	}
	function busquedaNombreRec(selector , valorCaja){
		var contenidoDinamico = '';	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: "<?php echo $url9;?>",
					  data: { muestra: "bnombre", nombre: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					   ResultadoReciclaje(data);
	}}
	
		function busquedaAnualidad(selector , valorCaja){
	var contenidoDinamico = '';	
		$('#panelAdministrador li').removeClass('active');
		$(selector).addClass('active');
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: "<?php echo $url8;?>",
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
					  url: "<?php echo $url8;?>",
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
					  url: "<?php echo $url8;?>",
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
	var i = 1;
	for(var item in data) {
					 			contenidoDinamico+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			contenidoDinamico+=i;
					 			contenidoDinamico+='</label></td>';
					 			contenidoDinamico+='<td><input type="email" readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del contacto." name="email"';	
					 			contenidoDinamico+='value = "'+data[item]['nombre_material']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion cajaNumerica" maxlength="100" placeholder="Ingrese el domicilio del contacto" required name="domicilio"';	
					 			contenidoDinamico+='value = "'+"$ "+data[item]['precio_kg_compra']+'" >';	 
					 			contenidoDinamico+='</td>';	

					 			
					 			contenidoDinamico+='</td></tr></td>';	
					 			i++;
					 							
								}
									
									//console.log(contenidoDinamico);
									
			var contenido ='<div id="formListado" action="#">  <table class="table table-striped" id="tableValores"> <thead> <tr> <th>#</th> <th>Material de desecho.  <span class="fa fa-magnet fa-2x" aria-hidden="true"></th>  <th>Precio de venta por Kg. <span class="fa fa-cubes fa-2x" aria-hidden="true"></span></th> </tr> </thead> <tbody>  </tbody> </table> </div>';   		
    		$('#panelleft').append( contenido );
    		$('#tableValores').append( contenidoDinamico );
    	
	}
		function ResultadoReciclaje(data){
	var contenidoDinamico;
	var i = 1;
	for(var item in data) {
					 			contenidoDinamico+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			contenidoDinamico+= i;
					 			contenidoDinamico+='</label></td>';
					 			contenidoDinamico+='<td><input type="email" readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del contacto." name="email"';	
					 			contenidoDinamico+='value = "'+data[item]['nombre_material']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion cajaNumerica" maxlength="100" placeholder="Ingrese el domicilio del contacto" required name="domicilio"';	
					 			contenidoDinamico+='value = "'+"$ "+data[item]['precio_kg_venta']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			
					 			
					 			
					 			contenidoDinamico+='</td></tr></td>';		
					 			i++;			
								}
									
									//console.log(contenidoDinamico);
									
									$('#tableValores2 tbody, thead').empty();
			var contenido ='<div id="formListado2" action="#"> <table class="table table-striped" id="tableValores2"> <thead> <tr> <th>#</th> <th>Material de reciclaje.  <span class="fa fa-recycle fa-2x" aria-hidden="true"></th>  <th>Precio de venta por Kg. <span class="fa fa-cubes fa-2x" aria-hidden="true"></span></th></tr> </thead> <tbody>  </tbody> </table> </div>';   		
    		$('#panelright').append( contenido );
    		$('#tableValores2').append( contenidoDinamico );
    		
	}
	