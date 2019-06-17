

$(document).ready(function(){
 $('#botonFormularioRegistro').prop('disabled', true);
        
var texto = "Mamá";
var textoISO = encode_utf8(texto); 
console.log(decode_utf8(textoISO));
function encode_utf8(s) {
  return unescape(encodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}

		
		//Agregamos el formulario de alta default
		 $('#panelBody').empty();
		 var contenido ='<div class="controlPanel hideElement" id="divRegistro"> <form id="formularioRegistroProv" action="#" > <label id="estatusRegistro"></label> <div class="form-group" > <label for="nombre">Nombre del proveedor:</label> <input type="text" class="form-control" maxlength="50" placeholder="Ingrese el nombre del proveedor" autofocus required name="nombre_proveedor"> </div> <div class="form-group" > <label for="nombre">RFC del proveedor:</label> <input type="text" class="form-control" maxlength="20" placeholder="Ingrese el RFC del proveedor" autofocus required name="rfc"> </div> <div class="form-group"> <label for="tel">Telefono del proveedor:</label> <input type="tel" class="form-control" maxlength="15" placeholder="Ingrese el telefono del proveedor." name="telefono"> </div> <div class="form-group"> <label for="email">Correo electronico:</label> <input type="email" class="form-control" id="email" maxlength="40" placeholder="Ingrese algun correo electronico." required name="email"> <label id="validoEmailForm"></label> </div> <div class="form-group"> <label for="text">Direccion del proveedor:</label> <input type="text" class="form-control" maxlength="50" placeholder="Direccion del proveedor" required name="direccion">  </div> <div class="form-group"> <label for="text">Nickname del proveedor:</label> <input type="text" class="form-control" id="nickname" maxlength="15" placeholder="nickname del proveedor" required name="nickname"> <label id="validoNickname"></label> </div> <div class="form-group"> <label for="psw">Contraseña:</label> <input type="password" class="form-control" maxlength="20" placeholder="Contraseña del proveedor." required name="password"> </div><div class="form-group" > <label for="nombre">URL de imagen de perfil:</label> <input type="text" class="form-control" maxlength="150" placeholder="Ingrese url de imagen de perfil" autofocus required name="url_image"> </div> <div class="form-group resetDisplay"> <label for="sel1">Tipo de proveedor:</label> <select class="form-control" id="list1" name="listatipo"> <option value="1">Comercial</option> <option value="2">Industrial</option> </select> </div> <div class="form-group resetDisplay"> <label for="sel1">Procedencia del proveedor:</label> <select class="form-control" id="list2" name="listaprocedencia"> <option value="1">Local</option> <option value="2">Foraneo</option> </select> </div> <br> <button type="submit" id="botonFormularioRegistro" class="btn btn-default" disabled>Registra al proveedor</button> </form> </div>';
		 $('#panelBody').append( contenido );
		 $('#divRegistro').slideDown("slow");
         
          
	   //------------------------------------------------------------------------------------------- 
	   
	   
	///Funcionamineto administrador de paneles
	$('#panelAdministrador li').click(function(){
		  switch($(this).attr('id')) {
		    case ('link1'):
		    	 $('#panelAdministrador li').removeClass('active');
			 $(this).addClass('active');
		    $('#panelBody').empty();
		    recargaUtimos($(this));
	        break;
	        case ('link2'):
	        //Agregamos el formulario de alta default
	        $('#panelAdministrador li').removeClass('active');
		 $(this).addClass('active');
		 $('#panelBody').empty();
		 var contenido ='<div class="controlPanel hideElement" id="divRegistro"> <form id="formularioRegistroProv" action="#" > <label id="estatusRegistro"></label> <div class="form-group" > <label for="nombre">Nombre del proveedor:</label> <input type="text" class="form-control" maxlength="50" placeholder="Ingrese el nombre del proveedor" autofocus required name="nombre_proveedor"> </div> <div class="form-group" > <label for="nombre">RFC del proveedor:</label> <input type="text" class="form-control" maxlength="20" placeholder="Ingrese el RFC del proveedor" autofocus required name="rfc"> </div> <div class="form-group"> <label for="tel">Telefono del proveedor:</label> <input type="tel" class="form-control" maxlength="15" placeholder="Ingrese el telefono del proveedor." name="telefono"> </div> <div class="form-group"> <label for="email">Correo electronico:</label> <input type="email" class="form-control" id="email" maxlength="40" placeholder="Ingrese algun correo electronico." required name="email"> <label id="validoEmailForm"></label> </div> <div class="form-group"> <label for="text">Direccion del proveedor:</label> <input type="text" class="form-control" maxlength="50" placeholder="Direccion del proveedor" required name="direccion">  </div> <div class="form-group"> <label for="text">Nickname del proveedor:</label> <input type="text" class="form-control" id="nickname" maxlength="15" placeholder="nickname del proveedor" required name="nickname"> <label id="validoNickname"></label> </div> <div class="form-group"> <label for="psw">Contraseña:</label> <input type="password" class="form-control" maxlength="20" placeholder="Contraseña del proveedor." required name="password"> </div><div class="form-group" > <label for="nombre">URL de imagen de perfil:</label> <input type="text" class="form-control" maxlength="150" placeholder="Ingrese url de imagen de perfil" autofocus required name="url_image"> </div> <div class="form-group resetDisplay"> <label for="sel1">Tipo de proveedor:</label> <select class="form-control" id="list1" name="listatipo"> <option value="1">Comercial</option> <option value="2">Industrial</option> </select> </div> <div class="form-group resetDisplay"> <label for="sel1">Procedencia del proveedor:</label> <select class="form-control" id="list2" name="listaprocedencia"> <option value="1">Local</option> <option value="2">Foraneo</option> </select> </div> <br> <button type="submit" id="botonFormularioRegistro" class="btn btn-default" disabled>Registra al proveedor</button> </form> </div>';
		 $('#panelBody').append( contenido );
		 $('#divRegistro').slideDown("slow");
	        break;
	    

	}
		
	});
	 //---------------------------------------------------------------------------------- 
	
	
	
	
	//Funcionamiento formulario de registro de proveedores--------------------------------------------------------------
	$(document).on('submit','#formularioRegistroProv', function(e){
		 e.preventDefault();
		  var values = JSON.stringify($('#formularioRegistroProv').serializeObject());
		   console.log(values);
          var values = jQuery.parseJSON(values);
          console.log(values);
          $.ajax({
              type: "POST",
              dataType: "json",
              url: AltaProveedor,
              data: values,
              success:function(data){              
              console.log(data['respuesta'] );
               if(data['respuesta'] == 'Proveedor registrado'){      
               console.log('llega?');        
               $('#estatusRegistro').text('Datos correctos, limpiado campos...');
               $('#estatusRegistro').addClass('label label-info  tLetra');
               setTimeout(function(){     
               $('#formularioRegistroProv').trigger("reset");
               $('#estatusRegistro').text(' ');
               $('#estatusRegistro').removeClass('label-warning  label-info tLetra');
               }, 1500);     
           }else{
             $('#estatusRegistro').text('Ingrese los datos correctos.!');
             $('#estatusRegistro').addClass('label label-warning  tLetra');
           }
              }});
	});
	///Vericiacion de email
	$(document).on('keydown focusout click input click','#email',function(){
		 
			var texto = $(this).val();
          if ($(this).val() == '') {

          }else{
            var val = 's';
              $.ajax({
                    dataType: "json",
                    url: VerificaUsuario, 
                    type: "POST",
                    data: {email : texto},
                    success: function(data){                           
                     
                      if(data['respuesta'] == 'El correo es valido en el formulario.'){
                         $('#validoEmailForm').text('');
                        $('#botonFormularioRegistro').prop('disabled', false);
                        $('#validoEmailForm').removeClass('label-warning');
                        $('#validoEmailForm').addClass('label label-info');
                      }
                      else{
                          $('#validoEmailForm').text(data['respuesta']);
                          $('#botonFormularioRegistro').prop('disabled', true);
                          $('#validoEmailForm').addClass('label label-warning');

                      }

                    }
                });
          }
          

        });
       ////////Varificacion de nombre de usuario
     $(document).on('keydown focusout click input click','#nickname',function(){
          var largo = ($(this).val()).length;
          console.log('entra!!!!'+ largo);
          var texto = $(this).val();
           if (texto == '') {

          }else{
                var val = 's';
              $.ajax({
                 dataType: "json",
                    url: VerificaUsuario, 
                    type: "POST",
                    data: {nickname : texto },
                    success: function(data){
                     resultado = data;
                      if(resultado['respuesta'] == 'El nickname es valido en el formulario.' && (largo>=6)){
                        $('#validoNickname').text(resultado['respuesta']);
                        $('#botonFormularioRegistro').prop('disabled', false);
                        $('#validoNickname').removeClass('label-warning');
                        $('#validoNickname2').addClass('label label-info');
                      }
                      else{
                        if(largo<6){
                       
                          $('#validoNickname').text('Utilce al menos 6 caracteres en el nombre de usuario.');
                         $('#botonFormularioRegistro').prop('disabled', true);
                          $('#validoNickname').addClass('label label-warning');
                        }
                        else{
                          $('#validoNickname').text('Nombre de usuario ya en uso en el sistema.');
                        $('#botonFormularioRegistro').prop('disabled', true);
                          $('#validoNickname').addClass('label label-warning');
                        }
                      }
                    }
                });
          }
          

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
	console.log('-->i');
	console.log('-->i');	console.log('-->i');
	 var contenidoDinamico = '';	
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores ,
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
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores ,
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
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores ,
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
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores ,
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
		
		
	   
	   
	    	$.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores ,
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
	var resultado = '';
	for(var item in data) {
	                            resultado+='<tr><td><label  class="form-control table-striped table-hover visualizacion">';	
					 			resultado+=data[item]['id_Proveedor'];
					 			resultado+='</label></td>';	
					 			resultado+=data[item]['id_trabajador'];
					 			resultado+='</label>';
	                            resultado+= '<td>'+'Nombre: '+ data[item]['nombre_proveedor'] +'<hr>';
					 			resultado+= 'Fecha: ' + data[item]['fecha_registro'] +'<hr>';
					 			resultado+= 'Direccion: ' + data[item]['direccion'] +'<hr>';
					 			resultado+= 'Email: ' + data[item]['email'] +'<hr>';
					 			resultado+= 'Nickname: ' + data[item]['nickname'] +'<hr>';
					 			resultado+= 'Password: ' + data[item]['password'] +'<hr>';
					 			resultado+= 'RFC: ' + data[item]['rfc'] +'<hr>';
					 			resultado+= 'Telefono: ' + data[item]['telefono'] +'<hr>';
					 			resultado+= 'Tipo: ' + data[item]['tipo'] +'<hr>';
					 			resultado+= 'Procedencia: ' + data[item]['tipo_procedencia']+'<hr>';
					 			resultado+= 'Url imagen: ' + data[item]['url_image'] +'</p></td>';
					 			resultado+='<td><button type="button" class="btn btn-warning" value = "0" role="editar">Editar Proveedor</button>';	
					 				 
					 			resultado+='</td><td>';	
					 			if(data[item]['id_Proveedor'] != 1){
					 			resultado+='<button type="button" class="btn btn-danger" value = "0" role="eliminar" data-toggle="modal" data-target="#modalDeletes">Eliminar proveedor</button>';	
					 			}
					 			contenidoDinamico+='</td></tr>>';	
					 			
								}
									contenidoDinamico = resultado;
									//console.log(contenidoDinamico);
									$('#tableValores tbody').empty();
			var contenido ='<div id="formListado" action="#" class="hideElement"> <table  class="table table-striped"><thead id="banner"> <tr> <th><button type="button" class="btn btn-primary" id="botnGeneral">Act.</button></th> <th> <input class="form-control" id="botonNombre" maxlength="60" placeholder="Ingrese nombre" type="text"></th> <th> <input class="form-control" id="botonanulidad" maxlength="40" placeholder="Ingrese un año" type="text"></th> <th> <input class="form-control" id="botonMensualidad" maxlength="13" placeholder="Ingrese un mes " type="text"></th> <th><label>Busqueda entre fechas --&gt;</label></th> <th> <input class="form-control" maxlength="13" id="fechaInicio" placeholder="Fecha inicial" type="date"></th> <th> <input class="form-control" maxlength="13" id="fechaFinal" placeholder="Fecha final" type="date"></th> <th><button type="button" class="btn btn-success" id="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead></table><table class="table table-striped" id="tableValores"> <thead> <tr> <th>#</th> <th>Informacion del proveedor</th> <th>Editar</th> <th>Eliminar</th></tr> </thead> <tbody>  </tbody> </table> </div>';   		
    		$('#panelBody').append( contenido );
    		$('#tableValores').append( contenidoDinamico );
    		$('#formListado').slideDown("slow");
	}