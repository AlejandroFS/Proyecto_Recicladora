<?php

include 'php/AccionesGenerales/SesionObjeto.php';
$url =  htmlspecialchars('php/AccionesGenerales/VerificaUsuario.php');
$url2 = htmlspecialchars('php/Usuarios/Registro_Usuario.php');
$url3 = htmlspecialchars('php/AccionesGenerales/Inicio_sesion.php');
$url4 = htmlspecialchars('php/AccionesGenerales/CerrarSesion.php');
$url5 = htmlspecialchars('php/AccionesGenerales/EdicionPerfil.php');
$url6 = htmlspecialchars('php/AccionesGenerales/RegistroPerfilEditado.php');
$url8 = htmlspecialchars('php/MaterialesDesecho/MostrarMateriales.php');
$url9 = htmlspecialchars('php/MaterialesReciclaje/MostrarMateriales.php');



$urlVer = htmlspecialchars('php/AccionesGenerales/VerificaUsuario.php');


//Proveedores
$MostrarProveedores = htmlspecialchars('php/Proveedores/MostrarProveedores.php');
$AltaProveedor= htmlspecialchars('php/Proveedores/AltaProveedor.php');
//Materiales de desecho
$DatosDesechos = htmlspecialchars('php/MaterialesDesecho/MostrarMateriales.php');
//Items
$AltaItem = htmlspecialchars('php/ItemCompra/AltaItem.php');
$MostrarItems = htmlspecialchars('php/ItemCompra/MostrarItems.php');
$EliminaItem= htmlspecialchars('php/ItemCompra/EliminaItem.php');

//Ordenes

$Observaciones = htmlspecialchars('php/OrdenesCompra/OrdenCompraNormal/observaciones.php');
$MostrarOrdenes = htmlspecialchars('php/OrdenesCompra/OrdenCompraNormal/MostrarOrdenes.php');
$EliminarOrdenes =  htmlspecialchars('php/OrdenesCompra/OrdenCompraNormal/EliminarOrdenes.php');
$AltaOrden = htmlspecialchars('php/OrdenesCompra/OrdenCompraNormal/AltaOrden.php');


$nombre ='Anonimo';
$fecha = 'Sin sesion iniciada';
$tipoUsuario ='Anonimo';
$url_image ='imagenes/blankImage.png';
$addContent = false;
$valoresop;
session_start();

if(!isset($_COOKIE['datos'])) {
	
} else {
	//echo "Value is: " . $_COOKIE['datos'];

	$valores = json_decode( $_COOKIE['datos'], true);

	$Sesion = new Sesion();
	$Sesion->iniciar_Sesion( $valores['nombre'],  $valores['password']);
	
	//print_r($valores);
}
if( !isset($_SESSION["nombre"]) ){


}else{
  //  echo "<p>Existe usuario de sesion</p>".$_SESSION["nombre"];
	$valoresop = $_SESSION['datos'];

    $nombre = $_SESSION["nombre"];
    $fecha = $_SESSION["fecha"];
    $url_image = $_SESSION["urlImage"];
    $tipoUsuario = $_SESSION["tipoUsuario"];
    $addContent = true;
}
?>

<!DOCTYPE html> 
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Recicladora Frias</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/index/index.css">
  	<link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">
  	<script type="text/javascript" src="js/jquery-1.12.3.js"></script>
  	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
  	<script type="text/javascript" src="js/AccionesGenerales/InicioSesion.js"></script>
  	<script type="text/javascript" src="js/AccionesGenerales/CerrarSesion.js"></script>
  	<script type="text/javascript" src="js/AccionesGenerales/RegistroUsuario.js"></script>
  	<script type="text/javascript" src="js/AccionesGenerales/PanelControl1.js"></script>
  	<script type="text/javascript" src="js/AccionesGenerales/EdicionPerfil.js"></script>
  	<script type="text/javascript" src="js/AccionesGenerales/Recoleccion.php"></script>

  	<script type="text/javascript" src="js/ValidaCamposNumericos.js"></script>
	
	<script type="text/javascript" src="js/OrdenesCompra/OrdenCompraNormal/AltaOrden.js"></script>
	<script type="text/javascript" src="js/OrdenesCompra/OrdenCompraNormal/MirarOrden.js"></script>
	<script type="text/javascript" src="js/OrdenesCompra/OrdenCompraNormal/MuestraOrdenes.js"></script>

    
  	<script type="text/javascript">
  	 var MostrarOrdenes ='<?php echo $MostrarOrdenes; ?>';
  	 var EliminarOrdenes ='<?php echo $EliminarOrdenes; ?>';
  	 var AltaOrden ='<?php echo $AltaOrden; ?>';
	 var MostrarProveedores ='<?php echo $MostrarProveedores; ?>';
	 
	 //Lista de materiales de desecho
	 var DatosDesechos ='<?php echo $DatosDesechos; ?>';
	 //Observaciones en Orden
	 var Observaciones ='<?php echo $Observaciones; ?>';
	 //ITEMS en orden
	 var MostrarItems ='<?php echo $MostrarItems; ?>';
	 var AltaItem ='<?php echo $AltaItem; ?>';
	 var EliminaItem ='<?php echo $EliminaItem; ?>';
	 
  	
  	 var url9 ='<?php echo $url9; ?>';
  	 var url8 ='<?php echo $url8; ?>';
  	 var url6 ='<?php echo $url6; ?>';
  	 var url5 ='<?php echo $url5; ?>';
     var url4 ='<?php echo $url4; ?>';
	 var url3 ='<?php echo $url3; ?>';
	 var url2 ='<?php echo $url2; ?>';
	 var url1 ='<?php echo $url; ?>';
	 var urlImage = '<?php echo  $url_image;?>';
	 var addContent = '<?php echo $addContent; ?>';
	 var tipoUsuario = '<?php echo $tipoUsuario; ?>' ;	 
  	</script>


  
   
 
  <!-- Script de registro-->


</head>
<body class="bodyBackGround">
<div class="modal fade" id="modalDeletes" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content panel-primary ">
                <div class="modal-header panel-heading">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">¿Desea eliminar el registro?</h4>
        </div>
        <div class="modal-body" id="bodyAdd">
        <button type="button" class="btn btn-success" data-dismiss="modal">No eliminar</button>
        <button type="button" class="btn btn-danger"   data-dismiss="modal" id="botonElmininar">Eliminar</button>
        
        </div>
      </div>
      
    </div>
  </div>

<nav class="navbar  navbar-inverse resetMainNav "><!-- /.Inicio navbar -->
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Inicio</a></li>
            <li><a href="#Galeria">Galeria de productos</a></li>
            <li><a href="#Galeria">Precios Reciclaje/Desperdicio</a></li>
            <li><a href="#Sobre">Sobre la empresa</a></li>
            <li><a href="#Contacto">Contacto</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
</nav><!-- /.navbar -->

	<div class="row navMenu">
      <div class="container-fluid  col-sm-2 sidebarMenu">

        <div id = "mainPanel" class="controlPanel">
           <p>Panel de control.</p>
          <div id='imagenPerfil'class="circleBase imageProfile"></div>
            <p> <?php echo  'Nombre: '. utf8_encode($nombre); ?></p>
            <p><?php echo  'Fecha de sesion: '.$fecha; ?></p>
             <p> <?php echo  'Tipo Usuario: '.$tipoUsuario; ?></p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Iniciar sesion</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Registrarse.</button>
        </div>


         <!-- Modal  de inicio sesion-->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content panel-primary ">
                <div class="modal-header panel-heading">
                  <button type="button" class ="close correcionBoton" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title ">Formulario de inicio de sesion</h4>
                </div>
              <form action="#" id="formularioSesion" action="#" class="controlPanel">

                <div class="form-group ">
                   <label for="text">Nombre de usuario:</label>
                    <input type="text" class="form-control" id="nickname2" maxlength="15" placeholder="Ingrese su nombre de usuario." required name="nickname">
              </div>

              <div class="form-group">
               <label for="psw">Contraseña:</label>
                <input type="password" class="form-control"  maxlength="20" placeholder="Ingrese su contraseña." required name="password">
                <label id='valido3'></label>
              </div>
                <div class="checkbox">
                  <label><input type="checkbox" name="recordar"> Recordarme</label>
                 </div>
              <div class="form-group">  
                <button type="submit" id='boton2' class="btn btn-default l">Iniciar sesion</button>
              </div>
            
                

              </form>
            </div>
            
          </div>
        </div>
            <!-- Termina Modal de inisio de sesion-->

             <!-- Modal  de registro-->
        <div class="modal fade" id="myModal2" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
                <div class="modal-content panel-primary">
                <div class="modal-header panel-heading">
                  <button type="button" class ="close correcionBoton" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Formulario de Registro</h4>
                </div>

           <form id="formularioRegistro" action="#" class="controlPanel">
              <label id='valido0'></label>
              <div class="form-group" >
                <label for="nombre">Nombre completo:</label>
                  <input type="text" class="form-control"  maxlength="45"  placeholder="Ingrese nombre completo" autofocus required name="nombre">
            </div>

              <div class="form-group">
               <label for="tel">Telefono:</label>
                <input type="tel" class="form-control"  maxlength="10" placeholder="Ingrese algun numero de telefono." name="telefono">
              </div>

              <div class="form-group">
               <label for="email">Correo electronico:</label>
                <input type="email" class="form-control" id="email" maxlength="40" placeholder="Ingrese algun correo electronico." required name="correo">
                <label id='valido1'></label>
              </div>

              <div class="form-group">
               <label for="text">Nombre de usuario:</label>
                <input type="text" class="form-control" id="nickname" maxlength="15" placeholder="Ingrese su nombre de usuario." required name="nickname">
                <label id='valido2'></label>
              </div>

              <div class="form-group">
               <label for="psw">Contraseña:</label>
                <input type="password" class="form-control"  maxlength="20" placeholder="Ingrese su contraseña." required name="password">
              </div>

              

                       
                      <button type="submit" id='boton' class="btn btn-default">Registrarse</button>

                  </form>


                </div>
          </div>
        </div> 
           <!-- Termina Modal de insio de sesion-->



                  
      



          <ul id='sidebarOpciones' class="nav nav-sidebar">
          	<li>
          		<p>Menu</p>
          	</li>
            <li class="both btn-is-disabled" ><a href="#">Recolecciones completadas</a>   <span class="fa fa fa-truck fa-2x" aria-hidden="true"></span></li>
            <li  class="both btn-is-disabled" ><a href="#" >Recolecciones pendientes</a>   <span class="fa fa-hourglass-start fa-2x" aria-hidden="true"></span></li>
          </ul>
          </div>
              
              
              <!-- Inicia row de tablas -->
               <div class="col-sm-9">
                  <div class="row">
	                  <div class="col-md-11 col-md-offset-1 ">
		                  <ul class="nav nav-tabs" id='panelAdministrador'>					  
								  <li id ='link1'  ><a href="#">Nueva Orden de compra</a></li>								  
								  <li id ='link2' ><a href="#">Ordenes de compra</a></li>	
								  <li id ='link3' class="active"><a href="#">Listado de ordenes</a></li>							  						  
							</ul>
							<div class="modal-content panel-primary " id='panelBody'>XD1</div>

	                  </div>
					</div>
               </div>
                 
               

            


                 <!-- Termina row de precios de tablas -->
        </div>
    
        


			



  <!-- Modal  de Edicion de peorsona-->
<div class="modal fade" id="myModal3" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
                <div class="modal-content panel-primary">
                <div class="modal-header panel-heading">
                  <button type="button" class ="close correcionBoton" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Formulario de edicion de perfil</h4>
                </div>

           <form id="formularioEdicion" action="#" class="controlPanel">
              <label id='valido6'></label>
              <div class="form-group" >
                <label for="nombre">Nombre completo:</label>
                  <input type="text" class="form-control"  maxlength="45"  placeholder="Ingrese nombre completo" autofocus required name="nombre" 
                  value="<?php if($addContent){
                  	
                  	print_r( utf8_encode($_SESSION['datos']['nombre']));}?>">
            </div>

              <div class="form-group">
               <label for="tel">Telefono:</label>
                <input type="tel" class="form-control"  maxlength="10" placeholder="Ingrese algun numero de telefono." name="telefono"
                value="<?php if($addContent){
                  	
                  	print_r( utf8_encode($_SESSION['datos']['telefono']));}?>">
              </div>

              <div class="form-group">
               <label for="email">Correo electronico:</label>
                <input type="email" class="form-control" id="emailEdit" maxlength="40" placeholder="Ingrese algun correo electronico." required name="correo"
                value="<?php if($addContent){
                  	
                  	print_r( utf8_encode($_SESSION['datos']['email']));}?>">
                <label id='valido4'></label>
              </div>
    
              <div class="form-group">
               <label for="text">Url de imagen de perfil:</label>
                <input type="text" class="form-control" id="imageEdit" maxlength="150" placeholder="Ingrese una url." required name="url_image"
                value="<?php if($addContent){
                  	
                  	print_r( utf8_encode($_SESSION['datos']['url_image']));}?>">
              </div>

              <div class="form-group">
               <label for="text">Nombre de usuario:</label>
                <input type="text" class="form-control" id="nicknameEdit" maxlength="15" placeholder="Ingrese su nombre de usuario." required name="nickname"
                value="<?php if($addContent){
                  	
                  	print_r( utf8_encode($_SESSION['datos']['nickname']));}?>">
                <label id='valido5'></label>
              </div>

              <div class="form-group">
               <label for="psw">Contraseña:</label>
                <input type="password" class="form-control"  maxlength="20" placeholder="Ingrese su contraseña." required name="password"
                value="<?php if($addContent){
                  	
                  	print_r( utf8_encode($_SESSION['datos']['password']));}?>">
   
                      <button type="submit" id='botonEdit' class="btn btn-default">Editar Mi perfil</button>
</div>
                  </form>


                </div>
          </div>
        </div> 
           <!-- Termina Modal de edicion de perfil-->    
            <!-- Modal  de registro-->
            
         <!-- Modal -->
  
           <!-- Termina Modal de eliminacion-->
           
</body>
</html>