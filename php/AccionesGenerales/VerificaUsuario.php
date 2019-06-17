<?php
include '../Database/Conexion.php';
include '../Utilidad.php';
include '../Usuarios/Usuario.php';
include '../Administradores/Administrador.php';
include '../Clientes/Cliente.php';
include '../Proveedores/Proveedor.php';


//Objetos
//El proposito de este archivo es el de verificar al usuario en el sistema, comprobando que no exista ni el email ni el nombre de usario en tablas de administradores, usuarios y clientes
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$Usuario = new Usuario($Conexion->getConexion()); //Se crea un objeto de tipo Usuario

$Cliente = new Cliente($Conexion->getConexion()); //Se crea un objeto de tipo Cliente

$Administrador = new Administrador($Conexion->getConexion()); //Se crea un objeto de tipo Usuario.

$Proveedor = new Proveedor($Conexion->getConexion()); //Se crea un objeto de proveedor




if (isset($_POST['email'])) {
	$correo = $Utilidad->test_input ( $_POST ["email"] );
	//La variable comprueba si existe el email en las 3 tablas
	$resultado = $Usuario->existeEmail($correo ) && $Administrador->existeEmail($correo ) && $Cliente->existeEmail($correo ) && $Proveedor->existeEmail($correo );
	
	if($resultado){
	$respuesta = json_encode( array('respuesta' => 'El correo es valido en el formulario.' ));
	}
	else{
	$respuesta = json_encode( array('respuesta' =>  'El correo no es valido en el formulario.'));
	}
	ob_clean();
	echo $respuesta;
}

 if (isset($_POST['nickname'])) {
 	$nickname = $Utilidad->test_input ( $_POST['nickname']);
	//La variable compruba de que el usuario no exista en las 3 tablas.
 	$resultado = $Usuario->existeUsuario($nickname) && $Administrador->existeAdministrador($nickname) && $Cliente->existeCliente($nickname) && $Proveedor-> existeProveedor($nickname);
	
	if($resultado){
	$respuesta = json_encode( array('respuesta' => 'El nickname es valido en el formulario.' ));
	}
	else{
	$respuesta = json_encode( array('respuesta' =>  'El nickname no es valido en el formulario.'));
	}
	ob_clean();
	echo $respuesta;
}


?>