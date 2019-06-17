<?php
include 'ItemVenta.php';
include '../Utilidad.php';
include '../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un ItemVenta
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$ItemVenta = new ItemVenta($Conexion->getConexion()); //Se crea un objeto de tipo ItemVenta

$string = "string";
$int = "int";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(!isset($_POST['id_item'])){

	$total_Kg = $Utilidad->test_input ( $_POST ["total_Kg"] );
	$id_Material = $Utilidad->test_input ( $_POST ["id_Material"] );
	$precio_kg_Venta = $Utilidad->test_input ( $_POST ["precio_kg_venta" ] );
	$id_orden = $Utilidad->test_input ( $_POST ["id_orden"] );

	$arrayValues = array(
			'totalKg' => $total_Kg,
			'id_Material' => $id_Material,
			'precio_kg_venta' => $precio_kg_Venta,
			'id_orden' => $id_orden ,
			'estado'=> 1
	);
	
	$arrayTiposDatos = array(
			'totalKg' => $int,
			'id_Material' => $int,
			'precio_kg_venta' => $int,
			'id_orden' => $int ,
			'estado' => $int
	);
	
	$respuesta = $ItemVenta->registrarItemVenta($arrayValues , $arrayTiposDatos );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'ItemVenta registrado'
		) );
	} else {
	
		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido registrar al ItemVenta'
		) );
	
	}
   ob_clean();
	echo $respuesta;
}}


