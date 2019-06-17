<?php


	class Usuario{
		
		private $nombreTabla = "Usuarios";
		private $conn = null;


		function __construct($conn){
			$this->conn = $conn;
		}

		public function registrarUsuario($arrayValues , $tiposDatos){
			try{
			$connl =  $this->conn;
			$utilidad = new Utilidad();
			$bindSql =	$utilidad->prepareAndBindSql($this->nombreTabla, $arrayValues);
			$stmt = $connl->prepare($bindSql);
			$utilidad->bindingParameters($arrayValues , $tiposDatos , $stmt);
			$stmt->execute();
			return true;
		}

			catch(PDOException $e){
			   echo "Connection failed: " . $e->getMessage();
			   return false;
			    }
			
		}
		
		public function existeEmail($email){
		

			  $conexion = $this->conn;
			  $sth = $conexion->prepare('SELECT email , count(*) as total FROM '.$this->nombreTabla.' where email = :email', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->bindParam(':email', $email, PDO::PARAM_STR );
			  $sth->execute();
              $row = $sth->fetch(PDO::FETCH_ASSOC);
               
                 if($row['total']>0){
                 	return false;
                 }else{
                 	return true;
                 }
                  

			}
			 

		public function existeUsuario($nickname){
			$conexion = $this->conn;
			  $sth = $conexion->prepare('SELECT nickname , count(*) as total FROM '.$this->nombreTabla.' where nickname = :nickname', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			  $sth->execute();
              $row = $sth->fetch(PDO::FETCH_ASSOC);
               	
                 if($row['total']>0){
                 	return false;
                 }else{
                 	return true;
                 }
		}

		public function inicioSesion($nickname , $password){
			 $conexion = $this->conn;
			  $sth = $conexion->prepare('SELECT nickname , count(*) as total FROM '.$this->nombreTabla.' where nickname = :nickname and password=:password', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			  $sth->bindParam(':password', $password, PDO::PARAM_STR );
			  $sth->execute();
              $row = $sth->fetch(PDO::FETCH_ASSOC);
              
              if($row['total']>0){
                 	return true;
                 }else{
                 	return false;
                 }
		}

		public function obtenerImagen($nickname){
			  $conexion = $this->conn;
			  $sth = $conexion->prepare('SELECT url_image FROM '.$this->nombreTabla.' where nickname = :nickname', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			  $sth->execute();
              $row = $sth->fetch(PDO::FETCH_ASSOC);
              return $row['url_image'];
             
              
		}
		
		public function obteterID($nickname , $email){
			$conexion = $this->conn;
			  $sth = $conexion->prepare('SELECT id_usuario FROM '.$this->nombreTabla.' where nickname = :nickname and email = :email', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->execute(array(':nickname' => $nickname, ':email' => $email));
              $row = $sth->fetch(PDO::FETCH_ASSOC);
              return $row['id_usuario'];
		}
		public function obteterEmail($nickname){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT email FROM '.$this->nombreTabla.' where nickname = :nickname ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row['email'];
		}
		
		//Proporciona ciertos datos de cualquier usuario a travez de su id
		public function obteterDatos($id_user){
			echo '---'.$id_user.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT nombre,telefono,email,nickname,password,url_image from '.$this->nombreTabla.' where id_usuario= :id_user ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_user', $id_user, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
		
		public function editarUsuario($arrayValues , $tiposDatos ,$id_usuario){
			try{
				$connl =  $this->conn;
				$utilidad = new Utilidad();
				$bindSql =	$utilidad->prepareAndBindSqlEdicion($this->nombreTabla,$tiposDatos, $arrayValues,$id_usuario);
				echo $bindSql;
 				$stmt = $connl->prepare($bindSql);
				$utilidad->bindingParameters($arrayValues , $tiposDatos , $stmt);
				$stmt->execute();
 				return true;
			}
			
			catch(PDOException $e){
				echo "Connection failed: " . $e->getMessage();
				return false;
			}
		}
		public function addUsuario(){}
		
		public function eliminarUsuario(){}
		
		public function modificarUsuario(){}

	}
?>