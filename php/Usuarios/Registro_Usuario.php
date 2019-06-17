<?php
include '../Database/Conexion.php';
include '../Utilidad.php';
include '../Usuarios/Usuario.php';
include '../Administradores/Administrador.php';
include '../Clientes/Cliente.php';


//Objetos
//El proposito de este archivo es el de verificar al usuario en el sistema, comprobando que no exista ni el email ni el nombre de usario en tablas de administradores, usuarios y clientes
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$Usuario = new Usuario($Conexion->getConexion()); //Se crea un objeto de tipo Usuario

$Cliente = new Cliente($Conexion->getConexion()); //Se crea un objeto de tipo Cliente

$Administrador = new Administrador($Conexion->getConexion()); //Se crea un objeto de tipo Usuario.

//Variables
$name = $telefono = $correo = $nickname = $password = $fecha= $url_image = null; //Variable para igualar los valores pasados por Post del form.
$fecha = $Utilidad->fechaPreparada(); // Variable fecha prepara para introducir en mysql.


//Arreglos
$arrayUserValues;      // Array con valores del formulario        
$tiposDatos;  //array que contiene los tipos de datos de los valores.                                              
$string = "string";
$int = "int";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	/* EL uso de metodo test_imput funciona para limpiar la info llegada del form */
	$name = $Utilidad->test_input ( $_POST ["nombre"] );
	$telefono = $Utilidad->test_input ( $_POST ["telefono"] );
	$correo = $Utilidad->test_input ( $_POST ["correo"] );
	$nickname = $Utilidad->test_input ( $_POST ["nickname"] );
	$password = $Utilidad->test_input ( $_POST ["password"] );	
                       /* Es posible que el usuario no tengo un numero de tel. */

   $arrayUserValues = array (
				'nombre' => $name,
   		        'telefono' => $telefono,
				'email' => $correo,
				'nickname' => $nickname,
				'password' => $password,
				'fecha_Registro' => $fecha,
				'url_image' => null,
				'estado' => 1 
		);

   $tiposDatos = array (
				'nombre' => $string,
   				'telefono' => $string,
				'email' => $string,
				'nickname' => $string,
				'password' => $string,
				'fecha_Registro' => $string,
				'url_image' => $string,
				'estado' => $int 
		);

   //Verifica que esta disponible tanto el nickname como el correo
$resultado = $Usuario->existeEmail($correo ) && $Administrador->existeEmail($correo ) && $Cliente->existeEmail($correo ); 
if ($resultado) {
		$respuesta = $Usuario->registrarUsuario ( $arrayUserValues, $tiposDatos );
		if ($respuesta) {
			$respuesta = json_encode ( array (
					'respuesta' => 'Usuario registrado' 
			) );
		} else {
			
			$respuesta = json_encode ( array (
					'respuesta' => 'No se ha podido registrar el usuario' 
			) );
		}
	}
ob_clean ();
	echo $respuesta;
 //$Utilidad->imprimeArray($arrayUserValues); /*Imprime los valores a enviar en un array asociativo*/


}

?> 