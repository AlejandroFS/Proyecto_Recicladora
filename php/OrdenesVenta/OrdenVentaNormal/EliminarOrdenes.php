<?php
include 'OrdenVenta.php';
include '../../Utilidad.php';
include '../../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un OrdenCompra
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$OrdenCompra = new OrdenVenta($Conexion->getConexion()); //Se crea un objeto de tipo OrdenCompra

$string = "string";
$int = "int";

//echo $OrdenCompra->eliminarOrdenCompra(24);//Ingresar Id del OrdenCompra
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['id_orden']) && !isset ( $_POST ['id_alta']) ) {
		$resultado = $OrdenCompra->eliminarOrdenVenta($Utilidad->test_input($_POST ['id_orden'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	
}