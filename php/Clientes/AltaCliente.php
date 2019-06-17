<?php
include 'Cliente.php';
include '../Utilidad.php';
include '../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un Cliente
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$Cliente = new Cliente($Conexion->getConexion()); //Se crea un objeto de tipo Cliente

$string = "string";
$int = "int";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(!isset($_POST['id_Cliente'])){
		print_r($_POST);
 	
	$name = $Utilidad->test_input ( $_POST ["nombre_cliente"] );
	$rfc = $Utilidad->test_input ( $_POST ["rfc"] );
	$telefono = $Utilidad->test_input ( $_POST ["telefono"] );
	$email = $Utilidad->test_input ( $_POST ["email"] );
	$nickname = $Utilidad->test_input ( $_POST ["nickname"] );
	$password = $Utilidad->test_input ( $_POST ["password"] );
	$url_image= $Utilidad->test_input ( $_POST ["url_image"] );
	$listatipo= $Utilidad->test_input ( $_POST ["listatipo"] );
	$arrayValues = array(
			'nombre_Cliente' => $name,
			'fecha_registro' => $Utilidad->fechaPreparada(),
			'url_image' => $url_image,
			'telefono' => $telefono,
			'rfc' => $rfc ,
			'nickname' => $nickname,
			'password' => $password,	
			'email' => $email,
			'id_tipo' => $listatipo,
			'estado'=> 1
	);
	
	$arrayTiposDatos = array(
			'nombre_Cliente' => $string,
			'fecha_registro' => $string,
			'url_image' => $string,
			'telefono' => $string,
			'rfc' => $string,
			'nickname' => $string,
			'password' => $string,	
			'email' => $string,
			'id_tipo' => $int,
			'estado'=> $int
	);
	
	$respuesta = $Cliente->registrarCliente($arrayValues , $arrayTiposDatos );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'Cliente registrado'
		) );
	} else {
	
		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido registrar al Cliente'
		) );
	
	}
  ob_clean();
	echo $respuesta;
}
else{
	
	$id = $Utilidad->test_input ( $_POST ["id_Cliente"] );
	$name = $Utilidad->test_input ( $_POST ["nombre_Cliente"] );
	$rfc = $Utilidad->test_input ( $_POST ["rfc"] );
	$telefono = $Utilidad->test_input ( $_POST ["telefono"] );
	$email = $Utilidad->test_input ( $_POST ["email"] );
	$nickname = $Utilidad->test_input ( $_POST ["nickname"] );
	$password = $Utilidad->test_input ( $_POST ["password"] );
	$url_image= $Utilidad->test_input ( $_POST ["url_image"] );
	$listatipo= $Utilidad->test_input ( $_POST ["listatipo"] );
	$arrayValues = array(
			'nombre_Cliente' => $name,
			'fecha_registro' => $Utilidad->fechaPreparada(),
			'url_image' => $url_image,
			'telefono' => $telefono,
			'rfc' => $rfc ,
			'nickname' => $nickname,
			'password' => $password,	
			'email' => $email,
			'id_tipo' => $listatipo,
			'estado'=> 1
	);
	
	$arrayTiposDatos = array(
			'nombre_Cliente' => $string,
			'fecha_registro' => $string,
			'url_image' => $string,
			'telefono' => $string,
			'rfc' => $string,
			'nickname' => $string,
			'password' => $string,	
			'email' => $string,
			'id_tipo' => $int,
			'estado'=> $int
	);
	
	$respuesta = $Cliente->editarCliente($arrayValues , $arrayTiposDatos,$id );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'Cliente editado'
		) );
	} else {
	
		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido editar al Cliente'
		) );
	
	}
	ob_clean();
	echo $respuesta;
}
}
