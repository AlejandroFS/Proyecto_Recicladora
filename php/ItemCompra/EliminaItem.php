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

//echo $ItemCompra->eliminarItemCompra(24);//Ingresar Id del ItemCompra
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['id_item'])) {
		$resultado = $ItemCompra->eliminarItem_Compra($Utilidad->test_input($_POST ['id_item'] ));
		echo $_POST ['id_ItemCompra'];
		ob_clean ();
		echo json_encode ( $resultado );
	}
	
}