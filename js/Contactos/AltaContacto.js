$(document).on('submit','#formRegistro', function(e){
		 e.preventDefault();
		  var values = JSON.stringify($('#formRegistro').serializeObject());
          var values = jQuery.parseJSON(values);
          console.log(values);
          $.ajax({
              type: "POST",
              dataType: "json",
              url:  urlContacto,
              data: values,
              success:function(data){
              console.log(data['respuesta'] );
               if(data['respuesta'] == 'Contacto registrado'){              
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
/**
 * 
 */