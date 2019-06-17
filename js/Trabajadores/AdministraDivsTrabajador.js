

$(document).ready(function(){

        

function encode_utf8(s) {
  return unescape(encodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}

		
		//Agregamos el formulario de alta default
		$('#panelBody').empty();
		var contenido =' <form id="formRegistro" action="#" class="controlPanel"> <label id="estatusRegistro"></label> <div class="form-group" > <label for="nombre">Nombre completo del trabajador:</label> <input type="text" class="form-control" maxlength="60" placeholder="Ingrese el nombre completo del trabajador" autofocus required name="nombre"> </div> <div class="form-group"> <label >Fecha inicio de labores del trabajador:</label> <input type="date" class="form-control" placeholder="Fecha en la que inicio a labores el trabajador" required name="fecha_inicio" value="2013-01-08"> </div> <div class="form-group"> <label >Telefono del trabajador:</label> <input type="tel" class="form-control" maxlength="10" placeholder="Ingrese algun telefono de contacto del trabajador" required name="telefono"> </div> <div class="form-group"> <label for="text">Correo electronico del trabajador:*</label> <input type="email" class="form-control" maxlength="40" placeholder="Ingrese el correo electronico del trabajador." name="email"> </div> <div class="form-group"> <label >Domicilio del trabajador:</label> <input type="text" class="form-control" maxlength="100" placeholder="Ingrese el domicilio del trabajador" required name="domicilio"> </div> <button type="submit" id="botonAlta" class="btn btn-default">Registrar Trabajador</button> </form> ';
		$('#panelBody').append( contenido );
	   //------------------------------------------------------------------------------------------- 
	   
	   
		///Funcionamineto administrador de paneles
	$('#panelAdministrador li').click(function(){
		  switch($(this).attr('id')) {
		   case ('link1'):
		    recargaUtimos($(this));
	        break;
	    case ('link2'):
	    $('#panelAdministrador li').removeClass('active');
		$(this).addClass('active');
	    	$('#panelBody').empty();
    		var contenido =' <form id="formRegistro" action="#" class="controlPanel  hideElement"> <label id="estatusRegistro"></label> <div class="form-group" > <label for="nombre">Nombre completo del trabajador:</label> <input type="text" class="form-control" maxlength="60" placeholder="Ingrese el nombre completo del trabajador" autofocus required name="nombre"> </div> <div class="form-group"> <label >Fecha inicio de labores del trabajador:</label> <input type="date" class="form-control" placeholder="Fecha en la que inicio a labores el trabajador" required name="fecha_inicio" value=""> </div> <div class="form-group"> <label >Telefono del trabajador:</label> <input type="tel" class="form-control" maxlength="10" placeholder="Ingrese algun telefono de contacto del trabajador" required name="telefono"> </div> <div class="form-group"> <label for="text">Correo electronico del trabajador:*</label> <input type="email" class="form-control" maxlength="40" placeholder="Ingrese el correo electronico del trabajador." name="email"> </div> <div class="form-group"> <label >Domicilio del trabajador:</label> <input type="text" class="form-control" maxlength="100" placeholder="Ingrese el domicilio del trabajador" required name="domicilio"> </div> <button type="submit" id="botonAlta" class="btn btn-default">Registrar Trabajador</button> </form> ';
	    	$('#panelBody').append( contenido );
	    	$('#formRegistro').slideDown("slow");
	        break;

	}
		
	});
	 //---------------------------------------------------------------------------------- 
	
	
	
	
	//Funcionamiento formulario de registro de trabajador--------------------------------------------------------------
	$(document).on('submit','#formRegistro', function(e){
		 e.preventDefault();
		  var values = JSON.stringify($('#formRegistro').serializeObject());
          var values = jQuery.parseJSON(values);
          console.log(values);
          $.ajax({
              type: "POST",
              dataType: "json",
              url:  AltaTrabajador,
              data: values,
              success:function(data){
              console.log(data['respuesta'] );
               if(data['respuesta'] == 'Trabajador registrado'){              
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
	
	 var contenidoDinamico = '';	
		$('#panelAdministrador li').removeClass('active');
		$(selector).addClass('active');
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarTrabajadores,
					  data: { muestra: "General"},
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 for(var item in data) {
					 			contenidoDinamico+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			contenidoDinamico+=data[item]['id_trabajador'];
					 			contenidoDinamico+='</label></td>';
					 			contenidoDinamico+='<td ><input type="text" readonly class="form-control visualizacion" maxlength="60" placeholder="Ingrese el nombre completo del trabajador" autofocus required name="nombre"';		 
					 			contenidoDinamico+='value = "'+data[item]['nombre_trabajador']+'" >';
					 			contenidoDinamico+='</td>';	 
					 			contenidoDinamico+='<td><input type="date" readonly class="form-control visualizacion"  placeholder="Fecha en la que inicio a labores el trabajador" required name="fecha_inicio"';		 
					 			contenidoDinamico+='value = "'+data[item]['fecha_inicio']+'" >';
					 			contenidoDinamico+='</td>';	
					 			contenidoDinamico+='<td s><input type="tel" readonly class="form-control visualizacion" maxlength="10" placeholder="Ingrese algun telefono de contacto del trabajador" required name="telefono"';	
					 			contenidoDinamico+='value = "'+data[item]['telefono']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td  ><input type="email" readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del trabajador." name="email"';	
					 			contenidoDinamico+='value = "'+data[item]['email']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="100" placeholder="Ingrese el domicilio del trabajador" required name="domicilio"';	
					 			contenidoDinamico+='value = "'+data[item]['domicilio']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td ><button type="button" class="btn btn-warning" value = "0" role="editar">Editar</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td ><button type="button" class="btn btn-danger" value = "0" role="eliminar" data-toggle="modal" data-target="#modalDeletes">Eliminar</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='</td></tr></td>';		
								
													 
								}
									
									//console.log(contenidoDinamico);
									$('#panelBody').empty();
			var contenido ='<div id="formListado" action="#" class="controlPanel  hideElement table-responsive"> <table class="table table-striped "><caption>Operaciones</caption><thead id="banner"> <tr> <th><button type="button" class="btn btn-primary" id="botnGeneral">Act.</button></th> <th> <input class="form-control" id="botonNombre" maxlength="60" placeholder="Ingrese nombre" type="text"></th> <th> <input class="form-control" id="botonanulidad" maxlength="40" placeholder="Ingrese un año" type="text"></th> <th> <input class="form-control" id="botonMensualidad" maxlength="13" placeholder="Ingrese un mes " type="text"></th> <th><label>Busqueda entre fechas --&gt;</label></th> <th> <input class="form-control" maxlength="13" id="fechaInicio" placeholder="Fecha inicial" type="date"></th> <th> <input class="form-control" maxlength="13" id="fechaFinal" placeholder="Fecha final" type="date"></th> <th><button type="button" class="btn btn-success" id="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead></table><table class="table table-striped" id="tableValores"> <thead> <tr> <th>#</th> <th>Nombre</th> <th>Fecha Registro</th> <th>Telefono</th> <th>Email</th> <th>Domicilio</th> <th>Editar</th> <th>Eliminar</th> </tr> </thead> <tbody>  </tbody> </table> </div>';   		
    		$('#panelBody').append( contenido );
    		$('#tableValores').append( contenidoDinamico );
    		$('#formListado').slideDown("slow");
	
	}}
	
	
	function busquedaNombre(selector , valorCaja){
	var contenidoDinamico = '';	
		
	
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarTrabajadores,
					  data: { muestra: "bnombre", nombre: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 for(var item in data) {
					 			contenidoDinamico+='<tr><td><label  class="form-control table-hover visualizacion">';	
					 			contenidoDinamico+=data[item]['id_trabajador'];
					 			contenidoDinamico+='</label></td>';
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="60" placeholder="Ingrese el nombre completo del trabajador" autofocus required name="nombre"';		 
					 			contenidoDinamico+='value = "'+data[item]['nombre_trabajador']+'" >';
					 			contenidoDinamico+='</td>';	 
					 			contenidoDinamico+='<td><input type="date" readonly class="form-control visualizacion" placeholder="Fecha en la que inicio a labores el trabajador" required name="fecha_inicio"';		 
					 			contenidoDinamico+='value = "'+data[item]['fecha_inicio']+'" >';
					 			contenidoDinamico+='</td>';	
					 			contenidoDinamico+='<td><input type="tel" readonly class="form-control visualizacion" maxlength="10" placeholder="Ingrese algun telefono de contacto del trabajador" required name="telefono"';	
					 			contenidoDinamico+='value = "'+data[item]['telefono']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="email" readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del trabajador." name="email"';	
					 			contenidoDinamico+='value = "'+data[item]['email']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="100" placeholder="Ingrese el domicilio del trabajador" required name="domicilio"';	
					 			contenidoDinamico+='value = "'+data[item]['domicilio']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-warning" value = "0" role="editar">Editar Trabajador</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-danger" value = "0" role="eliminar" data-toggle="modal" data-target="#modalDeletes">Eliminar Trabajador</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='</td></tr></td>';		
								
													 
								}
									
									//console.log(contenidoDinamico);
									$('#tableValores tbody').empty();
			var contenido ='<form id="formListado" action="#" class="controlPanel  hideElement"> <table class="table table-striped" id="tableValores"><thead> <tr> <th><button type="button" class="btn btn-primary" id ="botnGeneral">Actualizar 15r.</button></th> <th> <input type="text" class="form-control" id = "botonNombre" maxlength="60" placeholder="Ingrese nombre"></th> <th> <input type="text" class="form-control" id = "botonanulidad" maxlength="4" placeholder="Ingrese un año especifico"></th> <th> <input type="text" class="form-control" id = "botonMensualidad" maxlength="13" placeholder="Ingrese un mes especifico"></th> <th><label>Busqueda entre fechas --></label></th> <th> <input type="date" class="form-control" maxlength="13" id = "fechaInicio" placeholder="Fecha inicial"></th> <th> <input type="date" class="form-control" maxlength="13" id = "fechaFinal" placeholder="Fecha final"></th> <th><button type="button" class="btn btn-success" id ="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead> <thead> <tr> <th>#</th> <th>Nombre</th> <th>Fecha Registro</th> <th>Telefono</th> <th>Email</th> <th>Domicilio</th> <th>Editar</th> <th>Eliminar</th> </tr> </thead> <tbody>  </tbody> </table> </form>';   		
    		$('#panelBody').append( contenido );
    		$('#tableValores').append( contenidoDinamico );
    		$('#formListado').slideDown("slow");
	}
	
	}
		function busquedaAnualidad(selector , valorCaja){
	var contenidoDinamico = '';	
		
	
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarTrabajadores,
					  data: { muestra: "banualidad", anualidad: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 for(var item in data) {
					 			contenidoDinamico+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			contenidoDinamico+=data[item]['id_trabajador'];
					 			contenidoDinamico+='</label></td>';
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="60" placeholder="Ingrese el nombre completo del trabajador" autofocus required name="nombre"';		 
					 			contenidoDinamico+='value = "'+data[item]['nombre_trabajador']+'" >';
					 			contenidoDinamico+='</td>';	 
					 			contenidoDinamico+='<td><input type="date" readonly class="form-control visualizacion" placeholder="Fecha en la que inicio a labores el trabajador" required name="fecha_inicio"';		 
					 			contenidoDinamico+='value = "'+data[item]['fecha_inicio']+'" >';
					 			contenidoDinamico+='</td>';	
					 			contenidoDinamico+='<td><input type="tel" readonly class="form-control visualizacion" maxlength="10" placeholder="Ingrese algun telefono de contacto del trabajador" required name="telefono"';	
					 			contenidoDinamico+='value = "'+data[item]['telefono']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="email" readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del trabajador." name="email"';	
					 			contenidoDinamico+='value = "'+data[item]['email']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="100" placeholder="Ingrese el domicilio del trabajador" required name="domicilio"';	
					 			contenidoDinamico+='value = "'+data[item]['domicilio']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-warning" value = "0" role="editar">Editar Trabajador</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-danger" value = "0" role="eliminar" data-toggle="modal" data-target="#modalDeletes">Eliminar Trabajador</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='</td></tr></td>';		
								
													 
								}
									
									//console.log(contenidoDinamico);
									$('#tableValores tbody').empty();
			var contenido ='<form id="formListado" action="#" class="controlPanel  hideElement"> <table class="table table-striped" id="tableValores"><thead> <tr> <th><button type="button" class="btn btn-primary" id ="botnGeneral">Actualizar 15r.</button></th> <th> <input type="text" class="form-control" id = "botonNombre" maxlength="60" placeholder="Ingrese nombre"></th> <th> <input type="text" class="form-control" id = "botonanulidad" maxlength="4" placeholder="Ingrese un año especifico"></th> <th> <input type="text" class="form-control" id = "botonMensualidad" maxlength="13" placeholder="Ingrese un mes especifico"></th> <th><label>Busqueda entre fechas --></label></th> <th> <input type="date" class="form-control" maxlength="13" id = "fechaInicio" placeholder="Fecha inicial"></th> <th> <input type="date" class="form-control" maxlength="13" id = "fechaFinal" placeholder="Fecha final"></th> <th><button type="button" class="btn btn-success" id ="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead> <thead> <tr> <th>#</th> <th>Nombre</th> <th>Fecha Registro</th> <th>Telefono</th> <th>Email</th> <th>Domicilio</th> <th>Editar</th> <th>Eliminar</th> </tr> </thead> <tbody>  </tbody> </table> </form>';   		
    		$('#panelBody').append( contenido );
    		$('#tableValores').append( contenidoDinamico );
    		$('#formListado').slideDown("slow");
	}
	
	}
		function busquedaMensualidad(selector , valorCaja){
	var contenidoDinamico = '';	
	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarTrabajadores,
					  data: { muestra: "bmensualidad",mensualidad: valorCaja },
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 for(var item in data) {
					 			contenidoDinamico+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			contenidoDinamico+=data[item]['id_trabajador'];
					 			contenidoDinamico+='</label></td>';
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="60" placeholder="Ingrese el nombre completo del trabajador" autofocus required name="nombre"';		 
					 			contenidoDinamico+='value = "'+data[item]['nombre_trabajador']+'" >';
					 			contenidoDinamico+='</td>';	 
					 			contenidoDinamico+='<td><input type="date" readonly class="form-control visualizacion" placeholder="Fecha en la que inicio a labores el trabajador" required name="fecha_inicio"';		 
					 			contenidoDinamico+='value = "'+data[item]['fecha_inicio']+'" >';
					 			contenidoDinamico+='</td>';	
					 			contenidoDinamico+='<td><input type="tel" readonly class="form-control visualizacion" maxlength="10" placeholder="Ingrese algun telefono de contacto del trabajador" required name="telefono"';	
					 			contenidoDinamico+='value = "'+data[item]['telefono']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="email" readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del trabajador." name="email"';	
					 			contenidoDinamico+='value = "'+data[item]['email']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="100" placeholder="Ingrese el domicilio del trabajador" required name="domicilio"';	
					 			contenidoDinamico+='value = "'+data[item]['domicilio']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-warning" value = "0" role="editar">Editar Trabajador</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-danger" value = "0" role="eliminar" data-toggle="modal" data-target="#modalDeletes">Eliminar Trabajador</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='</td></tr></td>';		
								
													 
								}
									
									//console.log(contenidoDinamico);
									$('#tableValores tbody').empty();
			var contenido ='<form id="formListado" action="#" class="controlPanel  hideElement"> <table class="table table-striped" id="tableValores"><thead> <tr> <th><button type="button" class="btn btn-primary" id ="botnGeneral">Actualizar 15r.</button></th> <th> <input type="text" class="form-control" id = "botonNombre" maxlength="60" placeholder="Ingrese nombre"></th> <th> <input type="text" class="form-control" id = "botonanulidad" maxlength="4" placeholder="Ingrese un año especifico"></th> <th> <input type="text" class="form-control" id = "botonMensualidad" maxlength="13" placeholder="Ingrese un mes especifico"></th> <th><label>Busqueda entre fechas --></label></th> <th> <input type="date" class="form-control" maxlength="13" id = "fechaInicio" placeholder="Fecha inicial"></th> <th> <input type="date" class="form-control" maxlength="13" id = "fechaFinal" placeholder="Fecha final"></th> <th><button type="button" class="btn btn-success" id ="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead> <thead> <tr> <th>#</th> <th>Nombre</th> <th>Fecha Registro</th> <th>Telefono</th> <th>Email</th> <th>Domicilio</th> <th>Editar</th> <th>Eliminar</th> </tr> </thead> <tbody>  </tbody> </table> </form>';   		
    		$('#panelBody').append( contenido );
    		$('#tableValores').append( contenidoDinamico );
    		$('#formListado').slideDown("slow");
	}
	
	}
	
function busquedaEspecifica(selector , valorCaja1 ,valorCaja2){
	var contenidoDinamico = '';	
	
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarTrabajadores,
					  data: { muestra: "besp",  fecha_inicio: valorCaja1, fecha_final: valorCaja2},
					  success: function(data){
					  contenidoDinamicoA =  datosAsincronos(data);		
					 		}
					});
					 function datosAsincronos(data){
					 for(var item in data) {
					 			contenidoDinamico+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			contenidoDinamico+=data[item]['id_trabajador'];
					 			contenidoDinamico+='</label></td>';
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="60" placeholder="Ingrese el nombre completo del trabajador" autofocus required name="nombre"';		 
					 			contenidoDinamico+='value = "'+data[item]['nombre_trabajador']+'" >';
					 			contenidoDinamico+='</td>';	 
					 			contenidoDinamico+='<td><input type="date" readonly class="form-control visualizacion" placeholder="Fecha en la que inicio a labores el trabajador" required name="fecha_inicio"';		 
					 			contenidoDinamico+='value = "'+data[item]['fecha_inicio']+'" >';
					 			contenidoDinamico+='</td>';	
					 			contenidoDinamico+='<td><input type="tel" readonly class="form-control visualizacion" maxlength="10" placeholder="Ingrese algun telefono de contacto del trabajador" required name="telefono"';	
					 			contenidoDinamico+='value = "'+data[item]['telefono']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="email" readonly class="form-control visualizacion" maxlength="40" placeholder="Ingrese el correo electronico del trabajador." name="email"';	
					 			contenidoDinamico+='value = "'+data[item]['email']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><input type="text" readonly class="form-control visualizacion" maxlength="100" placeholder="Ingrese el domicilio del trabajador" required name="domicilio"';	
					 			contenidoDinamico+='value = "'+data[item]['domicilio']+'" >';	 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-warning" value = "0" role="editar">Editar Trabajador</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='<td><button type="button" class="btn btn-danger" value = "0" role="eliminar" data-toggle="modal" data-target="#modalDeletes">Eliminar Trabajador</button>';	
					 				 
					 			contenidoDinamico+='</td>';	
					 			
					 			contenidoDinamico+='</td></tr></td>';		
								
													 
								}
									
									//console.log(contenidoDinamico);
									$('#tableValores tbody').empty();
			var contenido ='<form id="formListado" action="#" class="controlPanel  hideElement"> <table class="table table-striped" id="tableValores"><thead> <tr> <th><button type="button" class="btn btn-primary" id ="botnGeneral">Actualizar 15r.</button></th> <th> <input type="text" class="form-control" id = "botonNombre" maxlength="60" placeholder="Ingrese nombre"></th> <th> <input type="text" class="form-control" id = "botonanulidad" maxlength="4" placeholder="Ingrese un año especifico"></th> <th> <input type="text" class="form-control" id = "botonMensualidad" maxlength="13" placeholder="Ingrese un mes especifico"></th> <th><label>Busqueda entre fechas --></label></th> <th> <input type="date" class="form-control" maxlength="13" id = "fechaInicio" placeholder="Fecha inicial"></th> <th> <input type="date" class="form-control" maxlength="13" id = "fechaFinal" placeholder="Fecha final"></th> <th><button type="button" class="btn btn-success" id ="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead> <thead> <tr> <th>#</th> <th>Nombre</th> <th>Fecha Registro</th> <th>Telefono</th> <th>Email</th> <th>Domicilio</th> <th>Editar</th> <th>Eliminar</th> </tr> </thead> <tbody>  </tbody> </table> </form>';   		
    		$('#panelBody').append( contenido );
    		$('#tableValores').append( contenidoDinamico );
    		$('#formListado').slideDown("slow");
	}
	
	}
	