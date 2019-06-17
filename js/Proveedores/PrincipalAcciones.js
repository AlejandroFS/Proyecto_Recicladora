
var variableGlobal;
var variableGlobalId;

 $(document).ready(function(){

       
     
         /*////////////////////////////Obtiene los datos de una row/////////////////////////////*/
       $(document).on('click','#tableValores :button', function(){
			
            if($(this).attr('role')=='editar'){   
            var padre = $($(this).parent()).parent();
            var hijos = $(padre).children();
            var arrayData = ['id_Proveedor'];
            var obj = {};
            var arrayValues = [];
         
            if($(this).attr('value')== 0){
            
            	for (var i = 0; i < 6; i++) {
                	var subhijo = $(hijos[i]).children();
                	var hijo = $(subhijo[0]);
                
                    
    			}
            	    
				
                   $(this).attr('value',1)
                   $(this).text('Editar Trabajador');
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
                  //  console.log(valores_editados);
                    
                    ///Edicion 
                    variableGlobalId = valores_editados['id_Proveedor'];
        			console.log(variableGlobalId);
					//Abrimos el link3
				
				
				
        			  console.log('eee');
				 $.ajax({
					  method: "Post",
					  dataType: "json",
					  url: MostrarProveedores ,
					  data: { muestra: "bid", id_Proveedor:  variableGlobalId },
					  success: function(data){
						
					      cargarEdicion(data);
					 		}
					});
	       
					///////////
					
        			}
        			}
        			
        			else{
        			var padre = $($(this).parent()).parent();
            var hijos = $(padre).children();
            var arrayData = ['id_Proveedor'];
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
        			variableGlobal = valores_editados['nombre_proveedor'];
        			variableGlobalId = valores_editados['id_Proveedor'];
        			console.log(variableGlobalId);
        			$('#bodyAdd > p').remove();
        			$('#bodyAdd').prepend('<p style="background-color: transparent; color: black;" >¿Seguro que desea eliminar al proveedor?</p>');
        			}
                   
                    
            
            
              });
       //////////////////////////////////////////////////////////////////////////////////////////
       
       
             
        /*////////////////////////////////////////////////////////////////////////////////////*/
        
        $('#botonElmininar').on('click', function(e){
        console.log('click elimina'+variableGlobalId);
        $.ajax({
				              type: "POST",
				              dataType: "json",
				              url:  EliminarProveedor,
				              data: {id_Proveedor: variableGlobalId},
				              success:function(data){
				              recargaUtimos($('#link1'));
              }});
              
        });
        
        function cargarEdicion(data){
         variableGlobal = data;
         console.log( variableGlobal);
        $('#panelAdministrador li').removeClass('active');
				 $('#link3').addClass('active');
				 $('#panelBody').empty();
				 var contenido ='<div class="controlPanel hideElement " id="divEdicion"> <form id="formularioEdicionProv" action="#"> <label id="estatusEdicion">Editando</label> <label id="idEdicionProveedor">#</label> <div class="form-group"> <label for="nombre">Nombre del proveedor:</label> <input type="text" class="form-control" maxlength="50" placeholder="Ingrese el nombre del proveedor" autofocus required name="nombre_proveedor" id="nombreProveedor"> </div> <div class="form-group"> <label for="nombre">RFC del proveedor:</label> <input type="text" class="form-control" maxlength="20" placeholder="Ingrese el RFC del proveedor" autofocus required name="rfc" id="rfcProveedor"> </div> <div class="form-group"> <label for="tel">Telefono del proveedor:</label> <input type="tel" class="form-control" maxlength="15" placeholder="Ingrese el telefono del proveedor." name="telefono" id="telefonoProveedor"> </div> <div class="form-group"> <label for="email">Correo electronico:</label> <input type="email" class="form-control" id="emailEdicion" maxlength="40" placeholder="Ingrese algun correo electronico." required name="email"> <label id="validoEmailFormEdit"></label> </div> <div class="form-group"> <label for="text">Direccion del proveedor:</label> <input type="text" class="form-control" maxlength="50" placeholder="Direccion del proveedor" required name="direccion" id="direccionProveedor"> </div> <div class="form-group"> <label for="text">Nickname del proveedor:</label> <input type="text" class="form-control" id="nicknameEdicion" maxlength="15" placeholder="nickname del proveedor" required name="nickname"> <label id="validoNicknameForm"></label> </div> <div class="form-group"> <label for="psw">Contraseña:</label> <input type="password" class="form-control" maxlength="20" placeholder="Contraseña del proveedor." required name="password" id="passwordEdicion"> </div> <div class="form-group"> <label for="nombre">URL de imagen de perfil:</label> <input type="text" class="form-control" maxlength="150" placeholder="Ingrese url de imagen de perfil" autofocus required name="url_image" id="imageEdicion"> </div> <div class="form-group resetDisplay"> <label for="sel1">Tipo de proveedor:</label> <select class="form-control" id="list1Edicion" name="listatipo"> <option value="1">Comercial</option> <option value="2">Industrial</option> </select> </div> <div class="form-group resetDisplay"> <label for="sel1">Procedencia del proveedor:</label> <select class="form-control" id="list2Edicion" name="listaprocedencia"> <option value="1">Local</option> <option value="2">Foraneo</option> </select> </div> <br> <button type="submit" id="botonFormularioEdicion" class="btn btn-default" disabled>Editar al proveedor</button> </form> </div>';
				 $('#panelBody').append( contenido );
				 $('#divEdicion').slideDown("slow");
			     $("#nombreProveedor").val(data['nombre']);
			     $('#rfcProveedor').val(data['rfc']);
			     $('#telefonoProveedor').val(data['telefono']);
			     $('#emailEdicion').val(data['email']);
			     $('#direccionProveedor').val(data['direccion']);
			     $('#nicknameEdicion').val(data['nickname']);
			     $('#passwordEdicion').val(data['password']);
			     $('#imageEdicion').val(data['url_image']);
			     switch(data['tipo']) {
					    case 'Comercial': //1
					       $('#list1Edicion').val('1');
					        break;
					    case 'Industrial':
					         $('#list1Edicion').val('2');
					        break;

					}
					 switch(data['tipo_procedencia']) {
					    case 'Local': //1
					       $('#list2Edicion').val('1');
					        break;
					    case 'Foraneo':
					         $('#list2Edicion').val('2');
					        break;

					}
					
					$('#botonFormularioEdicion').prop('disabled', false);
					
					//Quitar eso de arriba
		
        
        }
        
        
        
        //Funcionamiento formulario de edicion de proveedores--------------------------------------------------------------
	$(document).on('submit','#formularioEdicionProv', function(e){
		 e.preventDefault();
		  var values = $('#formularioEdicionProv').serializeObject();
          values.id_proveedor = variableGlobalId ;
           console.log(values);
          
        
          
          $.ajax({
              type: "POST",
              dataType: "json",
              url: AltaProveedor,
              data: values,
              success:function(data){              
              console.log(data['respuesta'] );
               if(data['respuesta'] == 'Proveedor editado'){      
               console.log('llega?');        
               $('#estatusEdicion').text('Datos correctos, regresando al listado');
               $('#estatusEdicion').addClass('label label-info  tLetra');
               setTimeout(function(){     
               $('#estatusRegistro').text(' ');
               $('#estatusRegistro').removeClass('label-warning  label-info tLetra');
               $('#panelAdministrador li').removeClass('active');
				 $('#link1').addClass('active');
			    $('#panelBody').empty();
			    recargaUtimos($('#link1'));
               }, 1500);     
               
              
           }else{
             $('#estatusEdicion').text('Ingrese los datos correctos.!');
             $('#estatusEdicion').addClass('label label-warning  tLetra');
           }
              }});
	});
	///Vericiacion de email
	$(document).on('keydown focusout click input click','#emailEdicion',function(){
		 
		var texto = $(this).val();
          if ($(this).val() == '' || $(this).val() == variableGlobal['email']) {

          }else{
            var val = 's';
              $.ajax({
                    dataType: "json",
                    url: VerificaUsuario, 
                    type: "POST",
                    data: {email : texto},
                    success: function(data){                           
                     
                      if(data['respuesta'] == 'El correo es valido en el formulario.'){
                         $('#validoEmailFormEdit').text('');
                        $('#botonFormularioEdicion').prop('disabled', false);
                        $('#validoEmailFormEdit').removeClass('label-warning');
                        $('#validoEmailFormEdit').addClass('label label-info');
                      }
                      else{
                          $('#validoEmailFormEdit').text(data['respuesta']);
                          $('#botonFormularioEdicion').prop('disabled', true);
                          $('#validoEmailFormEdit').addClass('label label-warning');

                      }

                    }
                });
          }
          

        });
        ////////Varificacion de nombre de usuario
     $(document).on('keydown focusout click input click','#nicknameEdicion',function(){
         var largo = ($(this).val()).length;
        console.log('editing');
          var texto = $(this).val();
           if (texto == '' || texto == variableGlobal['nickname']) {
             	$('#botonFormularioEdicion').prop('disabled', false);
          }else{
                var val = 's';
              $.ajax({
                 dataType: "json",
                    url: VerificaUsuario, 
                    type: "POST",
                    data: {nickname : texto },
                    success: function(data){
                     console.log(data['respuesta']);
                      if(data['respuesta'] == 'El nickname es valido en el formulario.' && (largo>=6)){
                        $('#validoNicknameForm').text(data['respuesta']);
                    	$('#botonFormularioEdicion').prop('disabled', false);
                        $('#validoNicknameForm').removeClass('label-warning');
                        $('#validoNicknameForm').addClass('label label-info');
                      }
                      else{
                        if(largo<6){
                       
                          $('#validoNicknameForm').text('Utilce al menos 6 caracteres en el nombre de usuario.');
                         $('#botonFormularioEdicion').prop('disabled', true);
                          $('#validoNicknameForm').addClass('label label-warning');
                        }
                        else{
                          $('#validoNicknameForm').text('Nombre de usuario ya en uso en el sistema.');
                          $('#botonFormularioEdicion').prop('disabled', true);
                          $('#validoNicknameForm').addClass('label label-warning');
                        }
                      }
                    }
                });
          }
          

        });
        });