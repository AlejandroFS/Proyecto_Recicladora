//Ajax anidados
//-mostrarOrdenes
//MostrarProveedores
var objetoProveedor ;
var fecha_orden;
var MaterialesDesechos;
var arrayMaterialesDeseho;
var materialSeleccionado;
var id_material;
var observacion="";
$(document).ready(function(){
	
	function obtenerDatosProveedor(){
		//Obtenemos el id del proveedor
			//---->Este ajax funciona para sacar el id del proveedor de una orden de compra, la fecha y el numero de orden
			//---->El segundo ajax funciona para sacar los datos del proveedor
		$.ajax({
						              type: "POST",
						              dataType: "json",
						              url: MostrarOrdenes ,  
						              data: {muestra: "id", id_orden: variableGlobalId},
						              success:function(data){
						              var id_proveedorLocal = data['id_proveedor'];
						              fecha_orden = data['fecha'];
						            
						              //console.log(id_proveedorLocal+'Numero de proveedor');
						               //console.log(variableGlobalId +'Numero de orden');
						              $.ajax({
						              type: "POST",
						              dataType: "json",    //
						              url: MostrarProveedores,
						              data: {muestra: "bid",id_Proveedor: id_proveedorLocal },
						              success:function(data){
						           
						              objetoProveedor = data;
						              mostrarOrden();
						              busquedaDesechos();
						              mostrarItemsOrden();
						              obtenerObsevaciones();
						            
						             
						              
		              }});
		              }});


		}
	function mostrarOrden(){
		
		$('#panelBody').empty();
		var contenido = '<div id="ordenCompra" class="hideElement"> <header> ` <div class="container"> <div class="col-xs-3 col-md-3"> <img alt="logo" src="imagenes/Logo.png" height="120px;"> </div> <div class="col-xs-9 col-md-9"> <h4>RECUPERADORA DE METALES Y RECICLADOS FRIAS</h4> <p id="id_orden">Orden de compra #:'+ variableGlobalId+'</p> <p id="fecha">Fecha: '+fecha_orden+'</p> <p>Avenida del sol #8, Col: Ignacio López Rayón, Uruapan Michoacan.</p> </div> </div> <div class="container" id="datosPRoveedor"> <div class="col-xs-12 col-md-12"> <h4>Datos del proveedor</h4> <p id ="nombre_proveedor">Nombre: '+objetoProveedor["nombre"]+' </p> <p id="rfc">RFC:'+objetoProveedor["rfc"]+'</p> <p id ="telefono">Telefono: '+objetoProveedor["telefono"]+'</p> <p id="email">Email: '+objetoProveedor["email"]+'</p> </div> </div> </header> <!-- Cuerpo --> <section> <div class="container" id="cuerpoOrden" class="hideElement"> <div class="col-xs-12 col-md-12"> <table class="table table-striped"> <thead> <tr> <th>#id</th> <th>Material</th> <th>Total kg</th> <th id="precioCompra">Precio x kg</th> <th>Total</th> <td>Eliminar</td> </tr> </thead> <tbody id="bodyOrden"> <tr> <td>1</td> <td>Cobre</td> <td>20.5</td> <td>60</td> <td>$ 130</td> <td><button type="button" class="btn btn-danger">Remover</button></td> </tr> <tr> <td>2</td> <td>Fierro</td> <td>150</td> <td>2.5</td> <td>$ 375</td> <td><button type="button" class="btn btn-danger">Remover</button></td> </tr> </tbody> </table> </div> </div> </section> <!-- Pie --> <footer> <div class="container"> <div class="col-xs-5 col-md-5"> <table class="table table-striped"> <thead> <tr> <th>Total a pagar</th> </tr> </thead> <tbody> <tr> <td id="totalPagar" style="background-color: #8dcde3">$ 505</td> </tr> </tbody> </table> <table class="table table-striped"> <thead> <tr> <th>Observaciones</th> </thead> <tbody> <tr> <textarea class="form-control" rows="5" id="comment" maxlength="100" style="resize:none"></textarea> </td><tr> </tr> </tbody> </table><button type="button" id ="botonGuardarObservacio" class="btn btn-success">Guardar observaciones</button> </div> <div class="col-xs-offset-4 col-xs-3 "> <p style="text-align: center;">Sello</p> <p id="sello"></p> <h6>Para observaciones marcar al 5287270.</h6> </div> </div> </footer> <footer> <div class="container" id="altaItems"> <div class="col-xs-8 col-md-8"> <table class="table table-striped"> <thead> <tr> <th>#id</th> <th>Material</th> <th>Total kg</th> <th>Precio x kg</th> <th>Total</th> <th>Agregar</th> </tr> </thead> <tbody> <tr> <td>3</td> <td><select id="metales"></select> </td > <td id="totalKg" contenteditable="true" class="form-control cajaNumerica"></td> <td id="precioKg"></td> <td id="resultadoOperaciones"></td> <td><button id="botonAgregarItem" type="button" class="btn btn-success">Agregar a la orden</button></td> </tr> </tbody> </table> </div> <div class="col-xs-4 col-md-4 corrigeBotonGuardado">  </div> </div> </footer> </div>';
		$('#panelBody').append( contenido );
		$('#ordenCompra').slideDown("slow");
		$('#botonAgregarItem').prop('disabled', true);	 
	}
	
	
	function busquedaDesechos(){
		   $('#metales').empty();
		   //--> Ajax para sacar los valores de la tabla materiales de desecho
		 $.ajax({
						             type: "POST",
						              dataType: "json",
						              url: DatosDesechos,
						              data: {muestra: "General", nombre: $('#busquedaDesechos').val()},
						              success:function(data){
						              for(var item in data) {
						              var elemento = data[item];
						              // console.log(elemento);
						              var texto = elemento['nombre_material'];
						              var valor = elemento['precio_kg_compra'];
						              var option = ' <option value="'+ valor + '">'+texto+'</option>';
						              $('#metales').append(option);
						              }
						              arrayMaterialesDeseho = data;
						             }
		 });
		 }
	function mostrarItemsOrden(){
		$('#bodyOrden').empty();
		$('#totalPagar').empty();
		  var contenido ='';
		  var total = 0
		$.ajax({
						              type: "POST",
						              dataType: "json",
						              url: MostrarItems,  //--->Sacamos los items de una orden de compra
						              data: {muestra: "General" ,id_orden: variableGlobalId},
						              success:function(data){
						            console.log(data);
						            var i = 1;
						             for(var item in data) {
						              var elemento = data[item];
						              // console.log(elemento);
						               contenido +='<tr><td>'+ i+'</td>';
						               contenido +='<td>'+ elemento['nombre_material']+'</td>';
						               contenido +='<td>'+ elemento['totalkg']+'</td>';
						               contenido +='<td>'+ elemento['precio_kg_compra']+'</td>';
						             
						               var precioRow = elemento['precio_kg_compra'] * elemento['totalkg'];
						               total +=  precioRow ;
						               contenido +='<td> $'+ precioRow +'</td>';	 	       
						                  contenido +='<td>'+'<a value="'+elemento['id_item']+'"class="btn btn-danger">Eliminar</a>'+'</td></tr>';  
						                  i++; 
						              }
						                  $('#bodyOrden').append(contenido);
						                  $('#totalPagar').append('$ '+total);
		              }});

		}
	function obtenerObsevaciones(){
		console.log('obsers');
		$('#comment').empty();
			$.ajax({
						             type: "POST",
						              dataType: "json",
						              url: MostrarOrdenes,
						              data: { id_ordecompra: variableGlobalId} ,
						              success:function(data){
						              console.log(data);
						              $('#comment').append(data['observaciones']);
						              }});
						             
		}
$(document).on('click','#tableValores :button', function(){
if($(this).attr('role')=='editar'){   
            var padre = $($(this).parent()).parent();
            var hijos = $(padre).children();
            var arrayData = ['id_orden','observaciones','fecha','nombre_proveedor','fecha'];
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

                    variableGlobalId = valores_editados['id_orden'];
                    observacion = valores_editados['observaciones'];
                    varGlobalProveedor = valores_editados['id_proveedor'];
        			console.log(varGlobalProveedor+'--<' );
        			console.log(observacion+'--<' );
        			console.log(variableGlobalId );
        			$('#panelBody').empty();
	       	 		$('#panelAdministrador li').removeClass('active');
					 $('#link2').addClass('active');
					obtenerDatosProveedor();
				
                   
        			}

});




 //Funcionamiento para guardar las observaciones en notas (Notas)
 $(document).on('click','#botonGuardarObservacio', function(e){
	console.log('asasas1');
	$.ajax({
				             type: "POST",
				              dataType: "json",
				              url: Observaciones  ,
				              data: {id_orden:variableGlobalId, observacion: $('#comment').val() } ,
				              success:function(data){
				              obtenerDatosProveedor();
				             }
	});});
 //----------------------------------------------------------------------------------------
 
 
 
//Funcionamiento para guardar las items en la orden(Panel de control)
 $(document).on('click','#botonAgregarItem', function(e){
	  
	 materialSeleccionado = arrayMaterialesDeseho[ $("#metales option:selected").index()];
	 id_material = materialSeleccionado['id_Material'];
	 console.log('id_material'+id_material);
	 var datos = {total_Kg: Number($('#totalKg').text()), id_Material: id_material, precio_kg_compra : Number($('#precioKg').text()),id_orden: variableGlobalId};
	 console.log(datos);
$.ajax({
				             type: "POST",
				              dataType: "json",
				              url: AltaItem,
				              data: datos ,
				              success:function(data){
				              obtenerDatosProveedor();
				             }
 });
	}); 
 //----------------------------------------------------------------------------------------
 
 
//Funcionamiento para eliminar items de la orden compra (Oden)
	$(document).on('click','td a', function(e){
	
	var id_item = $(this).attr('value');
	$.ajax({
				             type: "POST",
				              dataType: "json",
				              url: EliminaItem ,
				              data: {id_item:id_item } ,
				              success:function(data){
				              obtenerDatosProveedor();
				             }
	});});
	//--------------------------------------------
	
	
	
	
	$(document).on('click','#metales', function(){
	    $( "select option:selected" ).each(function() {
	    $('#precioKg').empty();
		$('#precioKg').append($( this ).val());
		 operaciones();
	    });
		 });
		 $(document).on('keyup','#totalKg', function(){
		$('#precioKg').empty();
		 $('#precioKg').append($("#metales option:selected").val());
		 operaciones();
	  
		 });
		 function operaciones(){
		 	 $('#resultadoOperaciones').empty();
		
		 if($.isNumeric( Number($('#precioKg').text()) * Number($('#totalKg').text() ))&& $('#totalKg').text()!=''){
		  $('#resultadoOperaciones').append('$ '+Number($('#precioKg').text()) * Number($('#totalKg').text() ));
		 	$('#botonAgregarItem').prop('disabled', false);
		 	}else{
		 		$('#botonAgregarItem').prop('disabled', true);
		 	}
		 }
	
 
});

	 
	
