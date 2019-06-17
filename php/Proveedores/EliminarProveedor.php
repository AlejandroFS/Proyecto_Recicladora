<?php
include 'Proveedor.php';
include '../Utilidad.php';
include '../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un Proveedor
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$Proveedor = new Proveedor($Conexion->getConexion()); //Se crea un objeto de tipo Proveedor

$string = "string";
$int = "int";

//echo $Proveedor->eliminarProveedor(24);//Ingresar Id del Proveedor
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['id_Proveedor'])) {
		$resultado = $Proveedor->eliminarProveedor($Utilidad->test_input($_POST ['id_Proveedor'] ));
		echo $_POST ['id_Proveedor'];
		ob_clean ();
		echo json_encode ( $resultado );
	}}