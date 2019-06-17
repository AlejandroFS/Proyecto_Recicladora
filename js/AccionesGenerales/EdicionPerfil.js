/**
 * 
 */
    $(document).ready(function(){
      /*Funcionalidades de comprobacion de email y de nombre de usuario*/
        $('#botonEdit').prop('disabled', false);
        $('#valido0').addClass('label label-success tLetra');
        $('#valido4').addClass('label tLetra'); //1
        $('#valido5').addClass('label tLetra'); //2
        $('#valido6').addClass('label tLetra label-success tLetra');//2
        $('#emailEdit').on('keydown focusout click input click',function(){
        	console.log('entra');
          if ($('#emailEdit').val() == '') {

          }else{
            var val = 's';
              $.ajax({
                    url: url5, 
                    type: "POST",
                    data: {email : $('#emailEdit').val()},
                    success: function(data){
                      var resultado = jQuery.parseJSON(data);
                     
                      if(resultado['respuesta'] == 'El correo es valido en el formulario.'){
                        $('#valido4').text('');
                        $('#botonEdit').prop('disabled', false);
                        $('#valido4').removeClass('label-warning');
                        $('#valido4').addClass('label label-info');
                        console.log('entra2');
                      }
                      else{
                          $('#valido4').text(resultado['respuesta']);
                          $('#botonEdit').prop('disabled', true);
                          $('#valido4').addClass('label label-warning');

                      }

                    }
                });
          }
          

        });


        $('#nicknameEdit').on('keydown focusout input click',function(){
          console.log('entra!!!!');
           if ($('#nicknameEdit').val() == '') {

          }else{
                var val = 's';
              $.ajax({
                    url: url5, 
                    type: "POST",
                    data: {nickname : $('#nicknameEdit').val()},
                    success: function(data){
                      var resultado = jQuery.parseJSON(data);
                      
                      if(resultado['respuesta'] == 'El nickname es valido en el formulario.' && ($('#nicknameEdit').val().length)>=6 ){
                        $('#valido5').text(resultado['respuesta']);
                        $('#botonEdit').prop('disabled', false);
                        $('#valido5').removeClass('label-warning');
                        $('#valido5').addClass('label label-info');
                        console.log('entra1');
                      }
                      else{
                        if($('#nicknameEdit').val().length<6){
                          $('#valido5').text('Utilce al menos 6 caracteres en el nombre de usuario.');
                          $('#botonEdit').prop('disabled', true);
                          $('#valido5').addClass('label label-warning');
                        }
                        else{
                          $('#valido5').text('Nombre de usuario ya en uso en el sistema.');
                          $('#botonEdit').prop('disabled', true);
                          $('#valido5').addClass('label label-warning');
                        }
                      }
                    }
                });
          }
          

        });
    /*////////////////////////////////////////////////////////////////////////////////////*/
        
      /*Envio de datos de un usario nuevo al sistema*/
         

        $("#formularioEdicion").submit(function(e){
            

             var values = $(this).serialize();
             var values = JSON.stringify($('#formularioEdicion').serializeObject());
             var values = jQuery.parseJSON(values);
             console.log(values);
             e.preventDefault();
                  $.ajax({
                         type: "POST",
                         dataType: "json",
                         url: url6,
                         data: values,
                         success:function(data){
                        
                      
                      if(data['respuesta'] == 'Usuario Editado!'){
                         $('#valido6').text('Usuario Editado correctamente, rcargando datos.');

                         setTimeout('redireccionar()', 2000);
                      }else{
                        $('#valido6').text('El usuario no se ha podido editar, intente de nuevo');
                      }
                         }
                          });

        

              });
    });
       /*////////////////////////////////////////////////////////////////////////////////////*/