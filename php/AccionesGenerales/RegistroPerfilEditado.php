<?php
include '../Database/Conexion.php';
include '../Utilidad.php';
include '../Usuarios/Usuario.php';
session_start(); //Iniciamos sesion

$utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$conexion = new Conexion();  // Se crea objeto de conexion a bd.

$Usuario = new Usuario($conexion->getConexion());

$name = $telefono = $correo = $nickname = $password = $fecha= $url_image = null; //Variable para igualar los valores pasados por Post del form.

$fecha = $utilidad->fechaPreparada(); // Variable fecha prepara para introducir en mysql.

$arrayUserValues;      // Array con valores del formulario

$tiposDatos;  //array que contiene los tipos de datos de los valores.

$conexion;          //Variable utilizada para crear um objeto de conexion.

$string = "string";
$int = "int";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	/* EL uso de metodo test_imput funciona para limpiar la info llegada del form */
	$name = $utilidad->test_input($_POST["nombre"]);
	$telefono= $utilidad->test_input($_POST["telefono"]);
	$correo = $utilidad->test_input($_POST["correo"]);
	$nickname = $utilidad->test_input($_POST["nickname"]);
	$password = $utilidad->test_input($_POST["password"]);
	$url_image = $utilidad->test_input($_POST["url_image"]);

	                                        /*Este es un array asociativo que contiene todos los datos de un usuario completo*/
	$email = $Usuario->obteterEmail ( $_SESSION ['nombre'] );
	// Variable que almacena el id del usuario a traves de consulta.
	$id_user = $Usuario->obteterID ( $_SESSION ['nombre'], $email );
	
		$arrayUserValues = array('nombre' => $name
				,'telefono' => $telefono
				,'email' =>  $correo
				,'nickname' => $nickname
				,'password'=> $password
				,'url_image'=>$url_image 
				,'estado'=>1);

		$tiposDatos = array('nombre' => $string
				,'telefono' => $string
				,'email' => $string
				,'nickname' => $string
				,'password'=> $string
				,'url_image'=>$string
				,'estado'=>$int);

	
//echo '---'.$id_user.'ssss';
   if($Usuario->editarUsuario($arrayUserValues , $tiposDatos ,$id_user)){
   			$_SESSION["nombre"] = $_POST["nickname"];
		   	$_SESSION["fecha"] = $utilidad->fechaPreparada();
		   	$_SESSION["urlImage"] = $_POST["url_image"];
		   	$_SESSION["tipoUsuario"] = 'Usuario general';
		   	$_SESSION['password'] = $_POST["password"];
		   	$_SESSION['datos'] = $Usuario->obteterDatos($id_user);
   			ob_clean();
   			$respuesta = json_encode( array('respuesta' =>  'Usuario Editado!'));
   			echo $respuesta;
   }else{
   		ob_clean();
   		$respuesta = json_encode( array('respuesta' =>  'Hubo un error el la edicion!'));
   		echo $respuesta;
   }

}

?>