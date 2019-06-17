<?php 
include '../Database/Conexion.php';
include '../Utilidad.php';
include '../Usuarios/Usuario.php';
include '../Administradores/Administrador.php';
include '../Clientes/Cliente.php';
include '../Proveedores/Proveedor.php';
	// creacion de objeto de uso general
	$Conexion = new Conexion();
	$Usuario = new Usuario($Conexion->getConexion());
	$Administrador = new Administrador($Conexion->getConexion());
	$Cliente = new Cliente($Conexion->getConexion()); //Se crea un objeto de tipo Cliente
	$Proveedor = new Proveedor($Conexion->getConexion()); //Se crea un objeto de tipo Proveedor
	$Utilidad = new Utilidad();
	// Evasion de ataques xss a traves de un filtro de limpieza!
	$nickname = $Utilidad->test_input($_POST['nickname']);
	$password = $Utilidad->test_input($_POST['password']);
	

//Verificamos que exista realmente el usuario en la table de administradore primero!
	if($Administrador->inicioSesion($nickname , $password)){
		// Si el usuario existe, verificar si quiere recordar sus cookies.!
		if(isset($_POST['recordar'])){
		//Agregamos el nombre de usuario a la cookie
		$cookie_name = 'nombre';
		$cookie_name_value = $nickname;
		//Agregamos el password del usuario a la cookie
		$cookie_password = 'password';
		$cookie_password_value = $password;
		//Agregamos la img del usuario a traves de un consulta a mysql.
		$cookie_image = 'url_image';
		$cookie_image_value = $Administrador->obtenerImagen($nickname);
		
		
		//Iniciamos la sesion
		session_start();
		//Agregamos parametros al array de sesiones que serviran para mostrar informacion del usuario.
		$_SESSION["nombre"] = $cookie_name_value ;
        $_SESSION["fecha"] = $Utilidad->fechaPreparada();
        $_SESSION["urlImage"] = $cookie_image_value;
        $_SESSION["tipoUsuario"] = 'Usuario Administrador';
        $_SESSION['password'] = $cookie_password_value;
        $email = $Administrador->obteterEmail($nickname);
        $_SESSION['datos'] = $Administrador->obteterDatos($Administrador->obteterID($nickname, $email));
        
        //Lenamos el array cookies de los valores anteriores y anadimos un dia de duracion a la cookie
        
        setcookie('datos' ,json_encode( array($cookie_name =>  $cookie_name_value , $cookie_password => $cookie_password_value)), time() + (86400 * 30), "/");
		}else{
		//Solo inisialisamos session si el usuario no quiere hacer uso de cookies.	
		$cookie_image_value = $Administrador->obtenerImagen($nickname);
		session_start();
		//Agregamos parametros al array de sesiones que serviran para mostrar informacion del usuario.
		$_SESSION["nombre"] = $nickname ;
        $_SESSION["fecha"] = $Utilidad->fechaPreparada();
        $_SESSION["urlImage"] = $cookie_image_value;
        $_SESSION["tipoUsuario"] = 'Usuario Administrador';
        $_SESSION['password'] = $cookie_password_value;
        $email = $Administrador->obteterEmail($nickname);
        $_SESSION['datos'] = $Administrador->obteterDatos($Administrador->obteterID($nickname, $email));
		}

		$respuesta = json_encode( array('respuesta' =>  'Login correcto'));
		ob_clean();
		//Enviamos respuesta de que el usuario se logeo correctamente.
		
	    echo $respuesta;
	    exit();
	}
	
	//Verificamos que exista realmente el usuario en la table de Proveedore
	if($Proveedor->inicioSesion($nickname , $password)){
		// Si el usuario existe, verificar si quiere recordar sus cookies.!
		if(isset($_POST['recordar'])){
			//Agregamos el nombre de usuario a la cookie
			$cookie_name = 'nombre';
			$cookie_name_value = $nickname;
			//Agregamos el password del usuario a la cookie
			$cookie_password = 'password';
			$cookie_password_value = $password;
			//Agregamos la img del usuario a traves de un consulta a mysql.
			$cookie_image = 'url_image';
			$cookie_image_value = $Proveedor->obtenerImagen($nickname);
			//Lenamos el array cookies de los valores anteriores y anadimos un dia de duracion de la sesion.
			setcookie('datos' ,json_encode( array($cookie_name =>  $cookie_name_value , $cookie_password => $cookie_password_value)), time() + (86400 * 30), "/");
			//Iniciamos la sesion
			session_start();
			//Agregamos parametros al array de sesiones que serviran para mostrar informacion del usuario.
			$_SESSION["nombre"] = $cookie_name_value ;
			$_SESSION["fecha"] = $Utilidad->fechaPreparada();
			$_SESSION["urlImage"] = $cookie_image_value;
			$_SESSION["tipoUsuario"] = 'Proveedor';
			$_SESSION['password'] = $cookie_password_value;
			$email = $Proveedor->obteterEmail($nickname);
			$_SESSION['datos'] = $Proveedor->obteterDatos($Proveedor->obteterID($nickname, $email));
	
		}else{
			//Solo inisialisamos session si el usuario no quiere hacer uso de cookies.
			$cookie_image_value = $Proveedor->obtenerImagen($nickname);
	
			session_start();
			//Agregamos parametros al array de sesiones que serviran para mostrar informacion del usuario.
			$_SESSION["nombre"] = $nickname ;
			$_SESSION["fecha"] = $Utilidad->fechaPreparada();
			$_SESSION["urlImage"] = $cookie_image_value;
			$_SESSION["tipoUsuario"] = 'Proveedor';
			$_SESSION['password'] = $cookie_password_value;
			$email = $Proveedor->obteterEmail($nickname);
			$_SESSION['datos'] = $Proveedor->obteterDatos($Proveedor->obteterID($nickname, $email));
		}
	
		$respuesta = json_encode( array('respuesta' =>  'Login correcto'));
		ob_clean();
		//Enviamos respuesta de que el usuario se logeo correctamente.
		echo $respuesta;
		exit();
	}
	//Verificamos que exista realmente el usuario en la table de Clientes!
	if($Cliente->inicioSesion($nickname , $password)){
		// Si el usuario existe, verificar si quiere recordar sus cookies.!
		if(isset($_POST['recordar'])){
			//Agregamos el nombre de usuario a la cookie
			$cookie_name = 'nombre';
			$cookie_name_value = $nickname;
			//Agregamos el password del usuario a la cookie
			$cookie_password = 'password';
			$cookie_password_value = $password;
			//Agregamos la img del usuario a traves de un consulta a mysql.
			$cookie_image = 'url_image';
			$cookie_image_value = $Cliente->obtenerImagen($nickname);
			//Lenamos el array cookies de los valores anteriores y anadimos un dia de duracion de la sesion.
			 setcookie('datos' ,json_encode( array($cookie_name =>  $cookie_name_value , $cookie_password => $cookie_password_value)), time() + (86400 * 30), "/");
			//Iniciamos la sesion
			session_start();
			//Agregamos parametros al array de sesiones que serviran para mostrar informacion del usuario.
			$_SESSION["nombre"] = $cookie_name_value ;
			$_SESSION["fecha"] = $Utilidad->fechaPreparada();
			$_SESSION["urlImage"] = $cookie_image_value;
			$_SESSION["tipoUsuario"] = 'Cliente';
			$_SESSION['password'] = $cookie_password_value;
			$email = $Cliente->obteterEmail($nickname);
			$_SESSION['datos'] = $Cliente->obteterDatos($Cliente->obteterID($nickname, $email));
	
		}else{
			//Solo inisialisamos session si el usuario no quiere hacer uso de cookies.
			$cookie_image_value = $Cliente->obtenerImagen($nickname);
	
			session_start();
			//Agregamos parametros al array de sesiones que serviran para mostrar informacion del usuario.
			$_SESSION["nombre"] = $nickname ;
			$_SESSION["fecha"] = $Utilidad->fechaPreparada();
			$_SESSION["urlImage"] = $cookie_image_value;
			$_SESSION["tipoUsuario"] = 'Cliente';
			$_SESSION['password'] = $cookie_password_value;
			$email = $Cliente->obteterEmail($nickname);
			$_SESSION['datos'] = $Cliente->obteterDatos($Cliente->obteterID($nickname, $email));
		}
	
		$respuesta = json_encode( array('respuesta' =>  'Login correcto'));
		ob_clean();
		//Enviamos respuesta de que el usuario se logeo correctamente.
		echo $respuesta;
		exit();
	}
	
	
	
	//Verificamos que exista en usuarios generales
	if($Usuario->inicioSesion($nickname , $password)){
		// Si el usuario existe, verificar si quiere recordar sus cookies.!
		if(isset($_POST['recordar'])){
			//Agregamos el nombre de usuario a la cookie
			$cookie_name = 'nombre';
			$cookie_name_value = $nickname;
			//Agregamos el password del usuario a la cookie
			$cookie_password = 'password';
			$cookie_password_value = $password;
			//Agregamos la img del usuario a traves de un consulta a mysql.
			$cookie_image = 'url_image';
			$cookie_image_value = $Usuario->obtenerImagen($nickname);
			//Lenamos el array cookies de los valores anteriores y anadimos un dia de duracion de la sesion.
			  setcookie('datos' ,json_encode( array($cookie_name =>  $cookie_name_value , $cookie_password => $cookie_password_value)), time() + (86400 * 30), "/");
			session_start();
			//Agregamos parametros al array de sesiones que serviran para mostrar informacion del usuario.
			$_SESSION["nombre"] = $cookie_name_value ;
			$_SESSION["fecha"] = $Utilidad->fechaPreparada();
			$_SESSION["urlImage"] = $cookie_image_value;
			$_SESSION["tipoUsuario"] = 'Usuario normal';
			$_SESSION['password'] = $cookie_password_value;
			$email = $Usuario->obteterEmail($nickname);
			$_SESSION['datos'] =  $Usuario->obteterDatos( $Usuario->obteterID($nickname, $email));
	
		}else{
			//Solo inisialisamos session si el usuario no quiere hacer uso de cookies.
			$cookie_image_value = $Usuario->obtenerImagen($nickname);
	
			session_start();
			//Agregamos parametros al array de sesiones que serviran para mostrar informacion del usuario.
			$_SESSION["nombre"] = $nickname ;
			$_SESSION["fecha"] = $Utilidad->fechaPreparada();
			$_SESSION["urlImage"] = $cookie_image_value;
			$_SESSION["tipoUsuario"] = 'Usuario normal';
			$_SESSION['password'] = $cookie_password_value;
			$email = $Usuario->obteterEmail($nickname);
			$_SESSION['datos'] =  $Usuario->obteterDatos( $Usuario->obteterID($nickname, $email));
		}
	
		$respuesta = json_encode( array('respuesta' =>  'Login correcto'));
		ob_clean();
		//Enviamos respuesta de que el usuario se logeo correctamente.
		echo $respuesta;
		exit();
	
	}else{
		$respuesta = json_encode( array('respuesta' =>  'Login incorrecto'));
		ob_clean();
		//Enviamos respuesta de que el usuario se logeo correctamente.
		echo $respuesta;
		exit();
	}
	
 ?>