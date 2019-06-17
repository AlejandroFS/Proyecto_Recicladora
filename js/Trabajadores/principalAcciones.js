
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
            var arrayData = ['id_trabajador','nombre_trabajador','fecha_inicio','telefono','email','domicilio'];
            var obj = {};
            var arrayValues = [];
         
            if($(this).attr('value')== 0){
            
            	for (var i = 0; i < 6; i++) {
                	var subhijo = $(hijos[i]).children();
                	var hijo = $(subhijo[0]);
                	$(hijo).attr('readOnly',false);
                    
    			}
            	$(this).attr('value',1)
            	$(this).text('Terminar edición');
                }else{
                	$(this).text('Editar Trabajador');
					$(this).attr('value',0)
                   
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
                    ///Edicion 
                    
                	$.ajax({
				              type: "POST",
				              dataType: "json",
				              url: AltaTrabajador,
				              data: valores_editados,
				              success:function(data){
				            	  recargaUtimos($('#link1'));
              }});
        			}
        			
        			}
        			
        			else{
        			var padre = $($(this).parent()).parent();
            var hijos = $(padre).children();
            var arrayData = ['id_trabajador','nombre_trabajador','fecha_inicio','telefono','email','domicilio'];
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
        			variableGlobal = valores_editados['nombre_trabajador'];
        			variableGlobalId = valores_editados['id_trabajador'];
        			console.log(variableGlobal );
        			$('#bodyAdd > p').remove();
        			$('#bodyAdd').prepend('<p style="background-color: transparent; color: black;" >¿Desea eliminar a '+variableGlobal+'?</p>');
        			}
                   
                    
            
            });
        /*////////////////////////////////////////////////////////////////////////////////////*/
        
        $('#botonElmininar').on('click', function(e){
        console.log('click elimina'+variableGlobalId);
        $.ajax({
				              type: "POST",
				              dataType: "json",
				              url: ElminarTrabajador,
				              data: {id_trabajador: variableGlobalId},
				              success:function(data){
				              recargaUtimos($('#link1'));
              }});
              
        });
        });