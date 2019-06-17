<?php
include 'Contacto.php';
include '../Utilidad.php';
include '../Database/Conexion.php';

// Objetos
// El proposito de este archivo es el de dar de alta un Contacto
$Utilidad = new Utilidad (); // Objeto que contiene utilidades de uso general

$Conexion = new Conexion (); // Se crea objeto de conexion a bd.

$Contacto = new Contacto ( $Conexion->getConexion () ); // Se crea un objeto de tipo Contacto

$string = "string";
$int = "int";

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	
	if (! isset ( $_POST ['id_contacto'] )) {
		
		$email = $Utilidad->test_input ( $_POST ["email"] );
		$asunto = $Utilidad->test_input ( $_POST ["asunto"] );
		$comentarios = $Utilidad->test_input ( $_POST ["comentarios"] );

		
		$arrayValues = array (
				'email' => $email,
				'asunto' => $asunto,
				'comentarios' => $comentarios,
				'fecha' => $Utilidad->fechaPreparada (),
				'estado' => 1 
		);
		
		$arrayTiposDatos = array (
				'email' => $string,
				'asunto' => $string,
				'comentarios' => $string,
				'fecha' => $string,
				'estado' => $int 
		);
		
		$respuesta = $Contacto->registrarContacto ( $arrayValues, $arrayTiposDatos );
		if ($respuesta) {
			$respuesta = json_encode ( array (
					'respuesta' => 'Contacto registrado' 
			) );
		} else {
			
			$respuesta = json_encode ( array (
					'respuesta' => 'No se ha podido registrar al Contacto' 
			) );
		}
		ob_clean ();
		echo $respuesta;
	} else {
		$id = $Utilidad->test_input ( $_POST ["id_contacto"] );
		$email = $Utilidad->test_input ( $_POST ["email"] );
		$asunto = $Utilidad->test_input ( $_POST ["asunto"] );
		$comentarios = $Utilidad->test_input ( $_POST ["comentarios"] );
		
		$arrayValues = array (
				'email' => $email,
				'asunto' => $asunto,
				'comentarios' => $comentarios,
				'fecha' => $Utilidad->fechaPreparada (),
				'estado' => 1 
		);
		
		$arrayTiposDatos = array (
				'email' => $string,
				'asunto' => $string,
				'comentarios' => $string,
				'fecha' => $string,
				'estado' => $int 
		);
		
		$respuesta = $Contacto->editarContacto ( $arrayValues, $arrayTiposDatos, $id );
		if ($respuesta) {
			$respuesta = json_encode ( array (
					'respuesta' => 'Contacto editado' 
			) );
		} else {
			
			$respuesta = json_encode ( array (
					'respuesta' => 'No se ha podido editar al Contacto' 
			) );
		}
		ob_clean ();
		echo $respuesta;
	}
}

