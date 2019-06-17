<?php
include 'contacto.php';
include '../Utilidad.php';
include '../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un contacto
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$contacto = new contacto($Conexion->getConexion()); //Se crea un objeto de tipo contacto

$string = "string";
$int = "int";

//echo $contacto->eliminarcontacto(24);//Ingresar Id del contacto
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['id_contacto'])) {
		$resultado = $contacto->eliminarcontacto($Utilidad->test_input($_POST ['id_contacto'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}}