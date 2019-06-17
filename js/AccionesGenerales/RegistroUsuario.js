/**
 * 
 */
    $(document).ready(function(){
      /*Funcionalidades de comprobacion de email y de nombre de usuario*/
      $('#boton').prop('disabled', true);
        $('#valido0').addClass('label label-success tLetra');
        $('#valido1').addClass('label tLetra');
        $('#valido2').addClass('label tLetra');
        $('#valido3').addClass('label tLetra');
        
        //Comprueba la existencia del email en la base de datos
        $('#email').on('keydown focusout click input click',function(){
          if ($('#email').val() == '') {

          }else{
            var val = 's';
              $.ajax({
                    url: url1, 
                    type: "POST",
                    data: {email : $('#email').val()},
                    success: function(data){
                      var resultado = jQuery.parseJSON(data);
                     
                      if(resultado['respuesta'] == 'El correo es valido en el formulario.'){
                        $('#valido1').text('');
                        $('#boton').prop('disabled', false);
                        $('#valido1').removeClass('label-warning');
                        $('#valido1').addClass('label label-info');
                      }
                      else{
                          $('#valido1').text(resultado['respuesta']);
                          $('#boton').prop('disabled', true);
                          $('#valido1').addClass('label label-warning');

                      }

                    }
                });
          }
          

        });

        //Comprueba la existencia del nickname en la base de datos
        $('#nickname').on('keydown focusout input click',function(){
          console.log('entra!!!!');
           if ($('#nickname').val() == '') {

          }else{
                var val = 's';
              $.ajax({
                    url: url1, 
                    type: "POST",
                    data: {nickname : $('#nickname').val()},
                    success: function(data){
                      var resultado = jQuery.parseJSON(data);
                      
                      if(resultado['respuesta'] == 'El nickname es valido en el formulario.' && ($('#nickname').val().length)>=6 ){
                        $('#valido2').text(resultado['respuesta']);
                        $('#boton').prop('disabled', false);
                        $('#valido2').removeClass('label-warning');
                        $('#valido2').addClass('label label-info');
                      }
                      else{
                        if($('#nickname').val().length<6){
                          $('#valido2').text('Utilce al menos 6 caracteres en el nombre de usuario.');
                          $('#boton').prop('disabled', true);
                          $('#valido2').addClass('label label-warning');
                        }
                        else{
                          $('#valido2').text('Nombre de usuario ya en uso en el sistema.');
                          $('#boton').prop('disabled', true);
                          $('#valido2').addClass('label label-warning');
                        }
                      }
                    }
                });
          }
          

        });
    /*////////////////////////////////////////////////////////////////////////////////////*/
        
      /*Envio de datos de un usario nuevo al sistema*/
         

        $("#formularioRegistro").submit(function(e){
            

             var values = $(this).serialize();
             var values = JSON.stringify($('#formularioRegistro').serializeObject());
             var values = jQuery.parseJSON(values);
             e.preventDefault();
                  $.ajax({
                         type: "POST",
                         dataType: "json",
                         url: url2,
                         data: values,
                         success:function(data){
                        
                      
                      if(data['respuesta'] == 'Usuario registrado'){
                         $('#valido0').text('Usuario registrado correctamente, puede cerrar el formulario.');

                        // setTimeout('redireccionar()', 5000);
                      }else{
                        $('#valido0').text('El usuario no se ha podido registrar, intente de nuevo');
                      }
                         }
                          });

        

              });
    });
       /*////////////////////////////////////////////////////////////////////////////////////*/