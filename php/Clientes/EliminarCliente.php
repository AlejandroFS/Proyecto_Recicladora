<?php
include 'Cliente.php';
include '../Utilidad.php';
include '../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un Cliente
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$Cliente = new Cliente($Conexion->getConexion()); //Se crea un objeto de tipo Cliente

$string = "string";
$int = "int";

//echo $Cliente->eliminarCliente(24);//Ingresar Id del Cliente
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['id_Cliente'])) {
		$resultado = $Cliente->eliminarCliente($Utilidad->test_input($_POST ['id_Cliente'] ));
		echo $_POST ['id_Cliente'];
		ob_clean ();
		echo json_encode ( $resultado );
	}}