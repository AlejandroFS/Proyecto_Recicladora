<?php
include 'OrdenVenta.php';
include '../../Utilidad.php';
include '../../Database/Conexion.php';
header ( 'Content-type: text/html; charset=utf-8' );
// Objetos
// El proposito de este archivo es el de dar de alta un OrdenVenta
$Utilidad = new Utilidad (); // Objeto que contiene utilidades de uso general

$Conexion = new Conexion (); // Se crea objeto de conexion a bd.

$OrdenVenta = new OrdenVenta ( $Conexion->getConexion () ); // Se crea un objeto de tipo OrdenVenta

$string = "string";
$int = "int";

$busquedaNombre = 1; // Busqueda por nombre
$busquedAnoEspecifico = 2;
$busquedaMesEspecifico = 3;
$busquedaEntreAnos = 4;

// Mustra OrdenVentaes todos que coincidad.
/*
 * $resultado = $OrdenVenta->busquedaNombre('Garc');
 *
 * array_walk_recursive($resultado, function(&$value, $key) {
 * if (is_string($value)) {
 * $value = iconv('windows-1252', 'utf-8', $value);
 * }
 * });
 *
 * echo json_encode($resultado);
 */

// Mustra OrdenVentaes los ultimos 15 registros
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'General') {
		$resultado = $OrdenVenta->busquedaUltimos ();
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'bnombre'){
		$resultado = $OrdenVenta->busquedaNombre($Utilidad->test_input($_POST ['nombre'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'banualidad'){
		$resultado = $OrdenVenta->busquedaAnualidad($Utilidad->test_input($_POST ['anualidad'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'bmensualidad'){
		$resultado = $OrdenVenta->busquedaMesualidad($Utilidad->test_input($_POST ['mensualidad'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'besp'){
		$resultado = $OrdenVenta->BusquedaEspecifica($Utilidad->test_input($_POST ['fecha_inicio'] ),$Utilidad->test_input($_POST ['fecha_final'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset ( $_POST ['muestra']) && $_POST ['muestra'] == 'id'){
		$resultado = $OrdenVenta->obteterIdcliente($Utilidad->test_input($_POST ['id_orden'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
	if(isset($_POST ['id_ordenVenta'])){
		$resultado = $OrdenVenta->obtenerObservaciones($Utilidad->test_input($_POST ['id_ordenVenta'] ));
		ob_clean ();
		echo json_encode ( $resultado );
	}
}


//Muestra registros por anos especificos
 /*$resultado = $OrdenVenta->busquedaAnualidad('2009');
array_walk_recursive($resultado, function(&$value, $key) {
	if (is_string($value)) {
		$value = iconv('windows-1252', 'utf-8', $value);
	}
});

	echo json_encode($resultado); */

//Muestra registros por meses especificos
/*$resultado = $OrdenVenta->busquedaMesualidad('12');
 array_walk_recursive($resultado, function(&$value, $key) {
 if (is_string($value)) {
 $value = iconv('windows-1252', 'utf-8', $value);
 }
 });

 echo json_encode($resultado); */


//Muestra registros por anos y  meses especificos
/*  $resultado = $OrdenVenta->BusquedaEspecifica('2007/06/06', '2015/06/22');
 array_walk_recursive($resultado, function(&$value, $key) {
 if (is_string($value)) {
 $value = iconv('windows-1252', 'utf-8', $value);
 }
 });

 echo json_encode($resultado); */

