<?php
include 'ItemVenta.php';
include '../Utilidad.php';
include '../Database/Conexion.php';
header ( 'Content-type: text/html; charset=utf-8' );
// Objetos
// El proposito de este archivo es el de dar de alta un ItemVenta
$Utilidad = new Utilidad (); // Objeto que contiene utilidades de uso general

$Conexion = new Conexion (); // Se crea objeto de conexion a bd.

$ItemVenta = new ItemVenta ( $Conexion->getConexion () ); // Se crea un objeto de tipo ItemVenta

$string = "string";
$int = "int";

$busquedaNombre = 1; // Busqueda por nombre
$busquedAnoEspecifico = 2;
$busquedaMesEspecifico = 3;
$busquedaEntreAnos = 4;

// Mustra ItemVentaes todos que coincidad.
/*
 * $resultado = $ItemVenta->busquedaNombre('Garc');
 *
 * array_walk_recursive($resultado, function(&$value, $key) {
 * if (is_string($value)) {
 * $value = iconv('windows-1252', 'utf-8', $value);
 * }
 * });
 *
 * echo json_encode($resultado);
 */

// Mustra ItemVentaes los ultimos 15 registros
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'General') {
		$resultado = $ItemVenta->busquedaUltimos ($_POST ['id_orden']);
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'bnombre'){
		$resultado = $ItemVenta->busquedaNombre($Utilidad->test_input($_POST ['nombre'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'banualidad'){
		$resultado = $ItemVenta->busquedaAnualidad($Utilidad->test_input($_POST ['anualidad'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'bmensualidad'){
		$resultado = $ItemVenta->busquedaMesualidad($Utilidad->test_input($_POST ['mensualidad'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'besp'){
		$resultado = $ItemVenta->BusquedaEspecifica($Utilidad->test_input($_POST ['fecha_inicio'] ),$Utilidad->test_input($_POST ['fecha_final'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'id'){
		$resultado = $ItemVenta->obteterIdProveedor($Utilidad->test_input($_POST ['id_orden'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
}


//Muestra registros por anos especificos
 /*$resultado = $ItemVenta->busquedaAnualidad('2009');
array_walk_recursive($resultado, function(&$value, $key) {
	if (is_string($value)) {
		$value = iconv('windows-1252', 'utf-8', $value);
	}
});

	echo json_encode($resultado); */

//Muestra registros por meses especificos
/*$resultado = $ItemVenta->busquedaMesualidad('12');
 array_walk_recursive($resultado, function(&$value, $key) {
 if (is_string($value)) {
 $value = iconv('windows-1252', 'utf-8', $value);
 }
 });

 echo json_encode($resultado); */


//Muestra registros por anos y  meses especificos
/*  $resultado = $ItemVenta->BusquedaEspecifica('2007/06/06', '2015/06/22');
 array_walk_recursive($resultado, function(&$value, $key) {
 if (is_string($value)) {
 $value = iconv('windows-1252', 'utf-8', $value);
 }
 });

 echo json_encode($resultado); */

