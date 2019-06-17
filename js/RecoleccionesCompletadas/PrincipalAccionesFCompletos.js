
var variableGlobal;
var variableGlobalId;
 $(document).ready(function(){
         /*////////////////////////////Obtiene los datos de una row/////////////////////////////*/
       
       
       $(document).on('click','#tableValores :button', function(){
			console.log('click');
            //Identificacion del boton de edicion
            if($(this).attr('role')=='editar'){   
           
        			}
        			
        			
        			
        			else{
        			var padre = $($(this).parent()).parent();
            var hijos = $(padre).children();
             var arrayData = ['id_form'];
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
        			variableGlobalId = valores_editados['id_form'];
        			console.log(variableGlobal );
        			$('#bodyAdd > p').remove();
        			$('#bodyAdd').prepend('<p style="background-color: transparent; color: black;" >¿Desea eliminar ese formulario?</p>');
        			}
                   
                    
            
            });
        /*////////////////////////////////////////////////////////////////////////////////////*/
        
        $('#botonElmininar').on('click', function(e){
        console.log('click elimina'+variableGlobalId);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: urlEliminacionRecoleccion ,
            data: {id_form: variableGlobalId,eliminar: "eliminar"},
            success: function(data){
          	 
          	  recargaUtimos($('#link1'));
 }});
              
        });
        
        });