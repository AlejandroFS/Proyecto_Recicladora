
var variableGlobal;
var variableGlobalId;
 $(document).ready(function(){
 
       
     
         /*////////////////////////////Obtiene los datos de una row/////////////////////////////*/
       
       
       $(document).on('click','#tableValores :button', function(){
			console.log('click');
            //Identificacion del boton de edicion
            if($(this).attr('role')=='editar'){   
            var padre = $($(this).parent()).parent();
            var hijos = $(padre).children();
           var arrayData = ['id_contacto','email','asunto','comentarios','fecha'];
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
                    $('#modalBody').empty();
                    $('#modalBody').append('Asunto'+'<br>');
                    $('#modalBody').append('<textarea readonly class="form-control">'+valores_editados['asunto']+'</textarea>'+'<br>');
                    $('#modalBody').append('Mensaje: '+'<br>');
                    $('#modalBody').append('<textarea readonly class="form-control">'+valores_editados['comentarios']+'</textarea>'+'<br>');
                   $('#modalBody').append('Fecha'+'<br>');
                    $('#modalBody').append('<input type= "date" readonly class="form-control"value="'+valores_editados['fecha']+'">'+'<br>');
        			}

        			
        			else{
        			var padre = $($(this).parent()).parent();
            var hijos = $(padre).children();
             var arrayData = ['id_contacto','email','asunto','comentarios','fecha'];
            var obj = {};
            var arrayValues = [];
        			for (var i = 0; i < 6; i++) {
                    	var subhijo = $(hijos[i]).children();
                    	var hijo = $(subhijo[0]);
                    	$(hijo).attr('readOnly',true);
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
        			variableGlobalId = valores_editados['id_contacto'];
        			console.log(variableGlobal );
        			$('#bodyAdd > p').remove();
        			$('#bodyAdd').prepend('<p style="background-color: transparent; color: black;" >¿Desea eliminar el registro?</p>');
        			}
                   
                    
            
            });
        /*////////////////////////////////////////////////////////////////////////////////////*/
        
        $('#botonElmininar').on('click', function(e){
        console.log('click elimina'+variableGlobalId);
        $.ajax({
				              type: "POST",
				              dataType: "json",
				              url: urlEliminacion,
				              data: {id_contacto: variableGlobalId},
				              success:function(data){
				              recargaUtimos($('#link1'));
              }});
              
        });
        });