<?php
include '../Database/Conexion.php';
include '../Utilidad.php';
include '../Usuarios/Usuario.php';

session_start ();
//
$respuesta;
$Conexion = new Conexion ();
$Usuario = new Usuario ( $Conexion->getConexion () );
// Variable ue almacena el email de usuario a traves de consulta.
$email = $Usuario->obteterEmail ( $_SESSION ['nombre'] );
// Variable que almacena el id del usuario a traves de consulta.
$id_user = $Usuario->obteterID ( $_SESSION ['nombre'], $email );

if (isset ( $_POST ['email'] )) {
	
	$resultado = $Usuario->existeEmail ( $_POST ['email'] );
	// Vericar que los email sean iguales
	if ($_POST ['email'] == $email) {
		$respuesta = json_encode ( array (
				'respuesta' => 'El correo es valido en el formulario.' 
		) );
	} else {
		if ($resultado) {
			$respuesta = json_encode ( array (
					'respuesta' => 'El correo es valido en el formulario.' 
			) );
		} else {
			$respuesta = json_encode ( array (
					'respuesta' => 'El correo no es valido en el formulario.' 
			) );
		}
	}
	ob_clean ();
	echo $respuesta;
}

if (isset ( $_POST ['nickname'] )) {
	$resultado = $Usuario->existeUsuario($_POST['nickname']);
	
	if ($_POST ['nickname'] == $_SESSION ['nombre']) {
		$respuesta = json_encode ( array (
				'respuesta' => 'El nickname es valido en el formulario.' 
		) );
		
	}else{
	if ($resultado) {
		$respuesta = json_encode ( array (
				'respuesta' => 'El nickname es valido en el formulario.' 
		) );
	} else {
		$respuesta = json_encode ( array (
				'respuesta' => 'El nickname no es valido en el formulario.' 
		) );
	}}
	ob_clean ();
	echo $respuesta;
}

?>