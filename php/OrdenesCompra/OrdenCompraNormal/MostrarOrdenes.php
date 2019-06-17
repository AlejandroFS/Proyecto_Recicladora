<?php
include 'OrdenCompra.php';
include '../../Utilidad.php';
include '../../Database/Conexion.php';
header ( 'Content-type: text/html; charset=utf-8' );
// Objetos
// El proposito de este archivo es el de dar de alta un OrdenCompra
$Utilidad = new Utilidad (); // Objeto que contiene utilidades de uso general

$Conexion = new Conexion (); // Se crea objeto de conexion a bd.

$OrdenCompra = new OrdenCompra ( $Conexion->getConexion () ); // Se crea un objeto de tipo OrdenCompra

$string = "string";
$int = "int";

$busquedaNombre = 1; // Busqueda por nombre
$busquedAnoEspecifico = 2;
$busquedaMesEspecifico = 3;
$busquedaEntreAnos = 4;

// Mustra OrdenCompraes todos que coincidad.
/*
 * $resultado = $OrdenCompra->busquedaNombre('Garc');
 *
 * array_walk_recursive($resultado, function(&$value, $key) {
 * if (is_string($value)) {
 * $value = iconv('windows-1252', 'utf-8', $value);
 * }
 * });
 *
 * echo json_encode($resultado);
 */

// Mustra OrdenCompraes los ultimos 15 registros
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'General') {
		$resultado = $OrdenCompra->busquedaUltimos ();
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'bnombre'){
		$resultado = $OrdenCompra->busquedaNombre($Utilidad->test_input($_POST ['nombre'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'banualidad'){
		$resultado = $OrdenCompra->busquedaAnualidad($Utilidad->test_input($_POST ['anualidad'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'bmensualidad'){
		$resultado = $OrdenCompra->busquedaMesualidad($Utilidad->test_input($_POST ['mensualidad'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'besp'){
		$resultado = $OrdenCompra->BusquedaEspecifica($Utilidad->test_input($_POST ['fecha_inicio'] ),$Utilidad->test_input($_POST ['fecha_final'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'id'){
		$resultado = $OrdenCompra->obteterIdProveedor($Utilidad->test_input($_POST ['id_orden'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset($_POST ['id_ordecompra'])){
		$resultado = $OrdenCompra->obtenerObservaciones($Utilidad->test_input($_POST ['id_ordecompra'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
}


//Muestra registros por anos especificos
 /*$resultado = $OrdenCompra->busquedaAnualidad('2009');
array_walk_recursive($resultado, function(&$value, $key) {
	if (is_string($value)) {
		$value = iconv('windows-1252', 'utf-8', $value);
	}
});

	echo json_encode($resultado); */

//Muestra registros por meses especificos
/*$resultado = $OrdenCompra->busquedaMesualidad('12');
 array_walk_recursive($resultado, function(&$value, $key) {
 if (is_string($value)) {
 $value = iconv('windows-1252', 'utf-8', $value);
 }
 });

 echo json_encode($resultado); */


//Muestra registros por anos y  meses especificos
/*  $resultado = $OrdenCompra->BusquedaEspecifica('2007/06/06', '2015/06/22');
 array_walk_recursive($resultado, function(&$value, $key) {
 if (is_string($value)) {
 $value = iconv('windows-1252', 'utf-8', $value);
 }
 });

 echo json_encode($resultado); */

