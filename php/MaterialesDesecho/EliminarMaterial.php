<?php
include 'MaterialDesecho.php';
include '../Utilidad.php';
include '../Database/Conexion.php';
//Objetos
//El proposito de este archivo es el de dar de alta un MaterialDesecho
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$MaterialDesecho = new MaterialDesecho($Conexion->getConexion()); //Se crea un objeto de tipo MaterialDesecho

$string = "string";
$int = "int";

//echo $MaterialDesecho->eliminarMaterialDesecho(24);//Ingresar Id del MaterialDesecho
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['id_material'])) {
		$resultado = $MaterialDesecho->eliminarMaterialDesecho($Utilidad->test_input($_POST ['id_material'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}}