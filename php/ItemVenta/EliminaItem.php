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

//echo $ItemVenta->eliminarItemVenta(24);//Ingresar Id del ItemVenta
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['id_item'])) {
		$resultado = $ItemVenta->eliminarItem_Venta($Utilidad->test_input($_POST ['id_item'] ));
		
		ob_clean ();
		echo json_encode ( $resultado );
	}
	
}