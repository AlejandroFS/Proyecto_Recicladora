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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(!isset($_POST['id_trabajador'])){

	$name = $Utilidad->test_input ( $_POST ["nombre"] );
	$fecha = $Utilidad->test_input ( $_POST ["fecha_inicio"] );
	$telefono = $Utilidad->test_input ( $_POST ["telefono"] );
	$email = $Utilidad->test_input ( $_POST ["email"] );
	$domicilio = $Utilidad->test_input ( $_POST ["domicilio"] );
	$arrayValues = array(
			'nombre_Trabajador' => $name,
			'Fecha_inicio' => $fecha,
			'telefono' => $telefono,
			'email' => $email,
			'domicilio' => $domicilio,
			'estado'=> 1
	);
	
	$arrayTiposDatos = array('nombre_Trabajador' => $string,
			'Fecha_inicio' => $string,
			'telefono' => $string,
			'email' => $string,
			'domicilio' => $string,
			'estado'=>$int
	);
	
	$respuesta = $Trabajador->registrarTrabajador($arrayValues , $arrayTiposDatos );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'Trabajador registrado'
		) );
	} else {
	
		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido registrar al trabajador'
		) );
	
	}
   ob_clean();
	echo $respuesta;
}
else{
	$id = $Utilidad->test_input ( $_POST ["id_trabajador"] );
	$name = $Utilidad->test_input ( $_POST ["nombre_trabajador"] );
	$fecha = $Utilidad->test_input ( $_POST ["fecha_inicio"] );
	$telefono = $Utilidad->test_input ( $_POST ["telefono"] );
	$email = $Utilidad->test_input ( $_POST ["email"] );
	$domicilio = $Utilidad->test_input ( $_POST ["domicilio"] );
	$arrayValues = array(
			'nombre_Trabajador' => $name,
			'Fecha_inicio' => $fecha,
			'telefono' => $telefono,
			'email' => $email,
			'domicilio' => $domicilio,
			'estado'=> 1
	);
	
	$arrayTiposDatos = array('nombre_Trabajador' => $string,
			'Fecha_inicio' => $string,
			'telefono' => $string,
			'email' => $string,
			'domicilio' => $string,
			'estado'=>$int
	);
	
	$respuesta = $Trabajador->editarTrabajador($arrayValues , $arrayTiposDatos,$id );
	if ($respuesta) {
		$respuesta = json_encode ( array (
				'respuesta' => 'Trabajador editado'
		) );
	} else {
	
		$respuesta = json_encode ( array (
				'respuesta' => 'No se ha podido editar al trabajador'
		) );
	
	}
	ob_clean();
	echo $respuesta;
}
}


