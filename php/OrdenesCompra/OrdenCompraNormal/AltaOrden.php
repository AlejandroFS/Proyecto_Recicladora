<?php
include 'OrdenCompra.php';
include '../../Utilidad.php';
include '../../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un OrdenCompra
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$OrdenCompra = new OrdenCompra($Conexion->getConexion()); //Se crea un objeto de tipo OrdenCompra

$string = "string";
$int = "int";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(!isset($_POST['id_orden'])){

	echo  $Utilidad->test_input ( $_POST ["hora"] );
	$id_proveedor = $Utilidad->test_input ( $_POST ["id_proveedor"] );
	$arrayValues = array(
		
			'fecha' => $Utilidad->test_input ( $_POST ["hora"] ),
			'id_proveedor' => $id_proveedor,
			'estado'=> 1
	);
	
	$arrayTiposDatos = array(
		
			'fecha' => $string,
			'id_proveedor' => $int,
			'estado'=> $int
	);
	
	$respuesta = $OrdenCompra->registrarOrdenCompra($arrayValues , $arrayTiposDatos );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'Orden de compra registrada'
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
	
	$id = $Utilidad->test_input ( $_POST ["id_OrdenCompra"] );
	$name = $Utilidad->test_input ( $_POST ["nombre_OrdenCompra"] );
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
			'nombre_OrdenCompra' => $name,
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
			'nombre_OrdenCompra' => $string,
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
	
	$respuesta = $OrdenCompra->editarOrdenCompra($arrayValues , $arrayTiposDatos,$id );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'OrdenCompra editado'
		) );
	} else {
	
		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido editar al OrdenCompra'
		) );
	
	}
	ob_clean();
	echo $respuesta;
}
}
