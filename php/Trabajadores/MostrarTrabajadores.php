<?php
include 'Trabajador.php';
include '../Utilidad.php';
include '../Database/Conexion.php';
header ( 'Content-type: text/html; charset=utf-8' );
// Objetos
// El proposito de este archivo es el de dar de alta un trabajador
$Utilidad = new Utilidad (); // Objeto que contiene utilidades de uso general

$Conexion = new Conexion (); // Se crea objeto de conexion a bd.

$Trabajador = new Trabajador ( $Conexion->getConexion () ); // Se crea un objeto de tipo Trabajador

$string = "string";
$int = "int";

$busquedaNombre = 1; // Busqueda por nombre
$busquedAnoEspecifico = 2;
$busquedaMesEspecifico = 3;
$busquedaEntreAnos = 4;

// Mustra Trabajadores todos que coincidad.
/*
 * $resultado = $Trabajador->busquedaNombre('Garc');
 *
 * array_walk_recursive($resultado, function(&$value, $key) {
 * if (is_string($value)) {
 * $value = iconv('windows-1252', 'utf-8', $value);
 * }
 * });
 *
 * echo json_encode($resultado);
 */

// Mustra Trabajadores los ultimos 15 registros
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'General') {
		$resultado = $Trabajador->busquedaUltimos ();
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'bnombre'){
		$resultado = $Trabajador->busquedaNombre($Utilidad->test_input($_POST ['nombre'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'banualidad'){
		$resultado = $Trabajador->busquedaAnualidad($Utilidad->test_input($_POST ['anualidad'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'bmensualidad'){
		$resultado = $Trabajador->busquedaMesualidad($Utilidad->test_input($_POST ['mensualidad'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'besp'){
		$resultado = $Trabajador->BusquedaEspecifica($Utilidad->test_input($_POST ['fecha_inicio'] ),$Utilidad->test_input($_POST ['fecha_final'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
}


//Muestra registros por anos especificos
 /*$resultado = $Trabajador->busquedaAnualidad('2009');
array_walk_recursive($resultado, function(&$value, $key) {
	if (is_string($value)) {
		$value = iconv('windows-1252', 'utf-8', $value);
	}
});

	echo json_encode($resultado); */

//Muestra registros por meses especificos
/*$resultado = $Trabajador->busquedaMesualidad('12');
 array_walk_recursive($resultado, function(&$value, $key) {
 if (is_string($value)) {
 $value = iconv('windows-1252', 'utf-8', $value);
 }
 });

 echo json_encode($resultado); */


//Muestra registros por anos y  meses especificos
/*  $resultado = $Trabajador->BusquedaEspecifica('2007/06/06', '2015/06/22');
 array_walk_recursive($resultado, function(&$value, $key) {
 if (is_string($value)) {
 $value = iconv('windows-1252', 'utf-8', $value);
 }
 });

 echo json_encode($resultado); */

