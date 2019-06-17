<?php
include 'Recoleccion.php';
include '../Utilidad.php';
include '../Database/Conexion.php';
include '../Usuarios/Usuario.php';

//Objetos
//El proposito de este archivo es el de dar de alta un Proveedor
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$Recoleccion = new Recoleccion($Conexion->getConexion()); //Se crea un objeto de tipo Proveedor

$Usuario = new Usuario($Conexion->getConexion());
$string = "string";
$int = "int";
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(!isset($_SESSION['datos'])){

	$name = $Utilidad->test_input ( $_POST ["nombre"] );
	$telefono = $Utilidad->test_input ( $_POST ["telefono"] );
	$cometarios = $Utilidad->test_input ( $_POST ["comentarios"] );
	$latitud = $Utilidad->test_input ( $_POST ["latitud"] );
	$longitud = $Utilidad->test_input ( $_POST ["longitud"] );
	
	$arrayValues = array(
			'id_usuario'=>66,
			'nombre' => $name,
			'fecha_form' => $Utilidad->fechaPreparada(),
			'longitud' => $longitud,
			'latitud' => $latitud ,
			'comentarios' => $cometarios,
			'telefono' => $telefono,
			'estatus' => 1,
			'estado' => 1,
			
	);
	
	$arrayTiposDatos = array(
			'id_usuario'=>$int,
			'nombre' => $string,
			'fecha_form' => $string,
			'longitud' => $string,
			'latitud' => $string ,
			'comentarios' => $string,
			'telefono' =>$string,
			'estatus' => $int,
			'estado' => $int,
			
	);
	
	
	$respuesta = $Recoleccion->registrarRecoleccion($arrayValues , $arrayTiposDatos );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'Formulario registrado'
		) );
	} else {
	
		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido registrar el formulario'
		) );
	
	}
    ob_clean();
	echo $respuesta;
}
else{
	$datos = $_SESSION['datos'];
	$datoEmail =  $datos['email'];
	$datNickname = $datos['nickname'];
	$idUsuario =$Usuario->obteterID($datNickname, $datoEmail);
	print_r( $datos);
	$name = $Utilidad->test_input ( $_POST ["nombre"] );
	$telefono = $Utilidad->test_input ( $_POST ["telefono"] );
	$cometarios = $Utilidad->test_input ( $_POST ["comentarios"] );
	$latitud = $Utilidad->test_input ( $_POST ["latitud"] );
	$longitud = $Utilidad->test_input ( $_POST ["longitud"] );

	$arrayValues = array(
			'id_usuario'=> $idUsuario,
			'nombre' => $name,
			'fecha_form' => $Utilidad->fechaPreparada(),
			'longitud' => $longitud,
			'latitud' => $latitud ,
			'comentarios' => $cometarios,
			'telefono' => $telefono,
			'estatus' => 1,
			'estado' => 1,

	);

	$arrayTiposDatos = array(
			'id_usuario'=>$int,
			'nombre' => $string,
			'fecha_form' => $string,
			'longitud' => $string,
			'latitud' => $string ,
			'comentarios' => $string,
			'telefono' =>$string,
			'estatus' => $int,
			'estado' => $int,

	);


	$respuesta = $Recoleccion->registrarRecoleccion($arrayValues , $arrayTiposDatos );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'Formulario registrado'
		) );
	} else {

		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido registrar el formulario'
		) );

	}
	ob_clean();
	echo $respuesta;

}
}