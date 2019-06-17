/*Imagen de perfil*/
		$(document).ready(function(){
			
		      $('#imagenPerfil').css("background-image", "url("+urlImage+")");
		      
		         /*////////////////////////////////////////////////////////////////////////////////////*/

		         /*////////////////////////////////////////////////////////////////////////////////////*/
		         /*Agrega contenido dinamicoxD*/
		         if (addContent) {
		          $("#mainPanel button ").remove();
		          $('#mainPanel').append('<button id="editPerfil" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal3">editar perfil.</button>');
		          $('#mainPanel').append('<button id ="cerrarSesion" type="button" class="btn btn-primary" data-toggle="modal" >Cerrar sesion</button>');
		          $('#sidebarOpciones li').removeClass('btn-is-disabled');
		          if(tipoUsuario == 'Usuario Administrador'){
		            $('#sidebarOpciones *').remove();
		            $('#sidebarOpciones').append('<li class="both"><a href="http://localhost/Proyecto_Recicladora/OrdenDeCompra.php">Compras locales</a>  <span class="glyphicon glyphicon-shopping-cart fa-2x"></span> </li>');
		            $('#sidebarOpciones').append('<li class="both"><a href="http://localhost/Proyecto_Recicladora/OrdenDeVenta.php">Ventas locales</a> <span class="fa fa-calculator fa-2x" aria-hidden="true"></span></li>');
		            $('#sidebarOpciones').append('<li class="both"><a href="#">Fletes</a>   <span class="fa fa-truck fa-2x" aria-hidden="true"></span></li>');
		            $('#sidebarOpciones').append('<li class="both"><a href="http://localhost/Proyecto_Recicladora/Proveedores.php">Proveedores</a>   <span class="fa fa-users fa-2x" aria-hidden="true"></span></li>');
		            $('#sidebarOpciones').append('<li class="both"><a href="http://localhost/Proyecto_Recicladora/Clientes.php">Clientes</a><span class="fa fa-child fa-2x" aria-hidden="true"></span></li>');
		            $('#sidebarOpciones').append('<li class="both"><a href="http://localhost/Proyecto_Recicladora/Trabajadores.php">Trabajadores</a><span class="fa fa-street-view fa-2x" aria-hidden="true"></span></li>');
		            $('#sidebarOpciones').append('<li class="both"><a href="http://localhost/Proyecto_Recicladora/RecoleccionesPendientes.php">Recolecciones pendientes</a>   <span class="fa fa-hourglass-start fa-2x" aria-hidden="true"></span></li>');
		            $('#sidebarOpciones').append('<li class="both" ><a href="http://localhost/Proyecto_Recicladora/RecoleccionesCompletadas.php">Recolecciones completadas</a>   <span class="fa fa fa-hourglass-end fa-2x" aria-hidden="true"></span></li>');
		            $('#sidebarOpciones').append('<li class="both" ><a href="http://localhost/Proyecto_Recicladora/ContactoAdmin.php">Consultas de Mensajes</a>   <span class="fa fa-commenting fa-2x" aria-hidden="true"></span></li>');
		            $('#sidebarOpciones').append('<li class="both" ><a href="http://localhost/Proyecto_Recicladora/MaterialesDesechoAdmin.php">Materiales de desecho</a>   <span class="fa fa-trash fa-2x" aria-hidden="true"></span></li>');
		            $('#sidebarOpciones').append('<li class="both" ><a href="http://localhost/Proyecto_Recicladora/MaterialesRecicladosAdmin.php">Materiales de reciclado</a>   <span class="fa fa-cubes fa-2x" aria-hidden="true"></span></li>');

		          }
		          if(tipoUsuario == 'Usuario normal'){
		        	  $('#sidebarOpciones *').remove();
		        	  $('#sidebarOpciones').append('<li class="both"><a href="http://localhost/Proyecto_Recicladora/RPendientesUsuario.php">Recolecciones pendientes</a>   <span class="fa fa-hourglass-start fa-2x" aria-hidden="true"></span></li>');
			          $('#sidebarOpciones').append('<li class="both" ><a href="http://localhost/Proyecto_Recicladora/RCompletadasUsuarios.php">Recolecciones completadas</a>   <span class="fa fa fa-hourglass-end fa-2x" aria-hidden="true"></span></li>');
			          $('#sidebarOpciones').append('<li class="both" ><a href="http://localhost/Proyecto_Recicladora/PreciosMateriales.php">Precios de materiales</a>   <span class="fa fa-recycle fa-2x" aria-hidden="true"></span></li>');
		          }
		          if(tipoUsuario == 'Proveedor'){
		        	  
		        	  $('#sidebarOpciones *').remove();
		        	  }
		          
		         }else{
		         
		         }
			
		});
   