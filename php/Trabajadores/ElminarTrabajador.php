<?php
include 'Trabajador.php';
include '../Utilidad.php';
include '../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un trabajador
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$Trabajador = new Trabajador($Conexion->getConexion()); //Se crea un objeto de tipo Trabajador

$string = "string";
$int = "int";

//echo $Trabajador->eliminarTrabajador(24);//Ingresar Id del trabajador
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['id_trabajador'])) {
		$resultado = $Trabajador->eliminarTrabajador($Utilidad->test_input($_POST ['id_trabajador'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}}