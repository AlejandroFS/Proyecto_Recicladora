<?php
include '../Recoleccion.php';
include '../../Utilidad.php';
include '../../Database/Conexion.php';
header ( 'Content-type: text/html; charset=utf-8' );
// Objetos
// El proposito de este archivo es el de dar de alta un Recoleccion
$Utilidad = new Utilidad (); // Objeto que contiene utilidades de uso general

$Conexion = new Conexion (); // Se crea objeto de conexion a bd.

$Recoleccion = new Recoleccion ( $Conexion->getConexion () ); // Se crea un objeto de tipo Recoleccion

$string = "string";
$int = "int";

$busquedaNombre = 1; // Busqueda por nombre
$busquedAnoEspecifico = 2;
$busquedaMesEspecifico = 3;
$busquedaEntreAnos = 4;


if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'General') {
		$resultado = $Recoleccion->busquedaUltimos ();
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'bnombre'){
		$resultado = $Recoleccion->busquedaNombre($Utilidad->test_input($_POST ['nombre'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'banualidad'){
		$resultado = $Recoleccion->busquedaAnualidad($Utilidad->test_input($_POST ['anualidad'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'bmensualidad'){
		$resultado = $Recoleccion->busquedaMesualidad($Utilidad->test_input($_POST ['mensualidad'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'besp'){
		$resultado = $Recoleccion->BusquedaEspecifica($Utilidad->test_input($_POST ['fecha_inicio'] ),$Utilidad->test_input($_POST ['fecha_final'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
}



