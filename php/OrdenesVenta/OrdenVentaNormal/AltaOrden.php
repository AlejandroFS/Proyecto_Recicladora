<?php
include 'OrdenVenta.php';
include '../../Utilidad.php';
include '../../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un OrdenVenta
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$OrdenVenta = new OrdenVenta($Conexion->getConexion()); //Se crea un objeto de tipo OrdenVenta

$string = "string";
$int = "int";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(!isset($_POST['id_orden'])){

	echo  $Utilidad->test_input ( $_POST ["hora"] );
	$id_cliente = $Utilidad->test_input ( $_POST ["id_cliente"] );
	$arrayValues = array(
		
			'fecha' => $Utilidad->test_input ( $_POST ["hora"] ),
			'id_cliente' => $id_cliente,
			'estado'=> 1
	);
	
	$arrayTiposDatos = array(
		
			'fecha' => $string,
			'id_cliente' => $int,
			'estado'=> $int
	);
	
	$respuesta = $OrdenVenta->registrarOrdenVenta($arrayValues , $arrayTiposDatos );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'Orden de Venta registrada'
		) );
	} else {
	
		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido registrar la orden'
		) );
	
	}
ob_clean();
	echo $respuesta;
}
else{
	
	$id = $Utilidad->test_input ( $_POST ["id_OrdenVenta"] );
	$name = $Utilidad->test_input ( $_POST ["nombre_OrdenVenta"] );
	$rfc = $Utilidad->test_input ( $_POST ["rfc"] );
	$telefono = $Utilidad->test_input ( $_POST ["telefono"] );
	$email = $Utilidad->test_input ( $_POST ["email"] );
	$direccion = $Utilidad->test_input ( $_POST ["direccion"] );
	$nickname = $Utilidad->test_input ( $_POST ["nickname"] );
	$password = $Utilidad->test_input ( $_POST ["password"] );
	$url_image= $Utilidad->test_input ( $_POST ["url_image"] );
	$listatipo= $Utilidad->test_input ( $_POST ["listatipo"] );
	$listaProcedencia = $Utilidad->test_input ( $_POST ['listaprocedencia'] );
	$arrayValues = array(
			'nombre_OrdenVenta' => $name,
			'fecha_registro' => $Utilidad->fechaPreparada(),
			'Id_tipo_procedencia' => $listaProcedencia,
			'rfc' => $rfc ,
			'telefono' => $telefono,
			'email' => $email,
			'direccion' => $direccion,
			'id_tipo' => $listatipo,
			'nickname' => $nickname,
			'password' => $password,
			'url_image' => $url_image,
			'estado'=> 1
	);
	
	$arrayTiposDatos = array(
			'nombre_OrdenVenta' => $string,
			'fecha_registro' => $string,
			'Id_tipo_procedencia' => $int,
			'rfc' => $string,
			'telefono' => $string,
			'email' => $string,
			'direccion' => $string,
			'id_tipo' => $int,
			'nickname' => $string,
			'password' => $string,
			'url_image' => $string,
			'estado'=> $int
	);
	
	$respuesta = $OrdenVenta->editarOrdenVenta($arrayValues , $arrayTiposDatos,$id );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'OrdenVenta editado'
		) );
	} else {
	
		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido editar al OrdenVenta'
		) );
	
	}
	ob_clean();
	echo $respuesta;
}
}
