<?php
include '../Recoleccion.php';
include '../../Utilidad.php';
include '../../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un Recoleccion
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$Recoleccion = new Recoleccion($Conexion->getConexion()); //Se crea un objeto de tipo Recoleccion

$string = "string";
$int = "int";

//echo $Recoleccion->eliminarRecoleccion(24);//Ingresar Id del Recoleccion
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (isset ( $_POST ['id_form']) && isset ( $_POST ['eliminar']) ) {
	    $resultado = $Recoleccion->eliminarRecoleccion($Utilidad->test_input($_POST ['id_form'] ));
		ob_clean ();
		echo json_encode ('');
	}
	if (isset ( $_POST ['id_form']) && isset ( $_POST ['completo']) ) {
		$resultado = $Recoleccion->altaRecoleccion($Utilidad->test_input($_POST ['id_form'] ));
		ob_clean ();
		echo json_encode ('');
	}

}