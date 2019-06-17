 /*Inisio de sesion del sistemaa*/
 $(document).ready(function(){
         $("#formularioSesion").submit(function(e){
              e.preventDefault();
             var values = JSON.stringify($('#formularioSesion').serializeObject());
             var values = jQuery.parseJSON(values);
            console.log(values);
            console.log(url3);
            $.ajax({
                         type: "POST",
                         dataType: "json",
                         url: url3,
                         data: values,
                         success:function(data){
                         console.log(data['respuesta'] );
                          if(data['respuesta'] == 'Login correcto'){
                          $('#valido3').text('Datos correctos!, espere!');
                          $('#valido3').removeClass('label-warning');
                          $('#valido3').addClass('label label-info');
                          redireccionar();
                         
                      }else{
                        $('#valido3').text('Ingrese los datos correctos.!');
                        $('#valido3').addClass('label label-warning');
                      }
                         }});
         });
         
         $.fn.serializeObject = function(){
             var o = {};
             var a = this.serializeArray();
             $.each(a, function() {
                 if (o[this.name] !== undefined) {
                     if (!o[this.name].push) {
                         o[this.name] = [o[this.name]];
                     }
                     o[this.name].push(this.value || '');
                 } else {
                     o[this.name] = this.value || '';
                 }
             });
             return o;
         };
       
 });
        /*////////////////////////////////////////////////////////////////////////////////////*/