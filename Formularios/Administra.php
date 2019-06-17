<?php
?>
 $(document).ready(function(){
 
       
     
         /*////////////////////////////Obtiene los datos de una row/////////////////////////////*/
        
        $("#tableValores :button").on("click",function(){
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
                    var valores_editados = JSON.stringify(obj);
                    console.log(valores_editados);
                	
        			}
        			///
        			
        			////
        			
        			}
        			 //Identificacion del boton de eliminacion
        			else{
        			}
                   
                    
            
            });
        /*////////////////////////////////////////////////////////////////////////////////////*/
        
        
        });