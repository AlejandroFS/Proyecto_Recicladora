<?php
include 'ItemCompra.php';
include '../Utilidad.php';
include '../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un ItemCompra
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$ItemCompra = new ItemCompra($Conexion->getConexion()); //Se crea un objeto de tipo ItemCompra

$string = "string";
$int = "int";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(!isset($_POST['id_item'])){

	$total_Kg = $Utilidad->test_input ( $_POST ["total_Kg"] );
	$id_Material = $Utilidad->test_input ( $_POST ["id_Material"] );
	$precio_kg_compra = $Utilidad->test_input ( $_POST ["precio_kg_compra" ] );
	$id_orden = $Utilidad->test_input ( $_POST ["id_orden"] );

	$arrayValues = array(
			'totalKg' => $total_Kg,
			'id_Material' => $id_Material,
			'precio_kg_compra' => $precio_kg_compra,
			'id_orden' => $id_orden ,
			'estado'=> 1
	);
	
	$arrayTiposDatos = array(
			'totalKg' => $int,
			'id_Material' => $int,
			'precio_kg_compra' => $int,
			'id_orden' => $int ,
			'estado' => $int
	);
	
	$respuesta = $ItemCompra->registrarItemCompra($arrayValues , $arrayTiposDatos );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'ItemCompra registrado'
		) );
	} else {
	
		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido registrar al ItemCompra'
		) );
	
	}
   ob_clean();
	echo $respuesta;
}}


