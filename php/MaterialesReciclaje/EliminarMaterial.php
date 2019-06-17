<?php
include 'MaterialReciclaje.php';
include '../Utilidad.php';
include '../Database/Conexion.php';
//Objetos
//El proposito de este archivo es el de dar de alta un MaterialReciclaje
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$MaterialReciclaje = new MaterialReciclaje($Conexion->getConexion()); //Se crea un objeto de tipo MaterialReciclaje

$string = "string";
$int = "int";

//echo $MaterialReciclaje->eliminarMaterialReciclaje(24);//Ingresar Id del MaterialReciclaje
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['id_material'])) {
		$resultado = $MaterialReciclaje->eliminarMaterialReciclaje($Utilidad->test_input($_POST ['id_material'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}}