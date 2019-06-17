<?php


	class Cliente{
		
		private $nombreTabla = "Clientes";
		private $conn = null;


		function __construct($conn){
			$this->conn = $conn;
		}

		public function registrarCliente($arrayValues , $tiposDatos){
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

		public function addCliente(){

		}

		public function eliminarCliente($id_Cliente){
			
			try {
				$conexion = $this->conn;
				$sth = $conexion->prepare('update '.$this->nombreTabla.' set estado = 0 where id_Cliente = :id_Cliente', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->bindParam(':id_Cliente', $id_Cliente, PDO::PARAM_INT);
				$sth->execute();
				return true;
			} catch (Exception $e) {
				echo "Connection failed: " . $e->getMessage();
				return false;
			}
		}

		public function modificarCliente(){}
		
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
			 

		public function existeCliente($nickname){
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
			  $sth = $conexion->prepare('SELECT id_Cliente FROM '.$this->nombreTabla.' where nickname = :nickname and email = :email', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->execute(array(':nickname' => $nickname, ':email' => $email));
              $row = $sth->fetch(PDO::FETCH_ASSOC);
              return $row['id_Cliente'];
		}
		public function obteterEmail($nickname){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT email FROM '.$this->nombreTabla.' where nickname = :nickname ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row['email'];
		}
		
		//Proporciona ciertos datos de cualquier Cliente a travez de su id
		public function obteterDatos($id_cliente){
			echo '---'.$id_cliente.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Cliente , nombre_cliente as nombre,telefono,email,nickname,password,url_image, rfc, id_tipo from '.$this->nombreTabla.' where id_Cliente= :id_cliente ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function editarCliente($arrayValues , $tiposDatos ,$id_Cliente){
			try{
				$connl =  $this->conn;
				$utilidad = new Utilidad();
				$bindSql =	$utilidad->prepareAndBindSqlEdicion($this->nombreTabla,$tiposDatos, $arrayValues,$id_Cliente);
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
		public function busquedaNombre($nombre){
		
		
			$conexion = $this->conn;
			$nombre = '%'.$nombre.'%';
			$sth = $conexion->prepare('SELECT id_Cliente, nombre_Cliente , fecha_registro  , rfc, telefono , email  , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Cliente , tipos tipop where nombre_Cliente like :nombre and estado = 1  and Cliente.id_tipo = tipop.id_tipo', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		
		}
		public function busquedaUltimos(){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Cliente, nombre_Cliente , fecha_registro  , rfc, telefono , email  , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Cliente ,  tipos tipop where estado = 1  and Cliente.id_tipo = tipop.id_tipo ORDER BY id_Cliente DESC LIMIT 15', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function busquedaAnualidad($ano){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Cliente, nombre_Cliente , fecha_registro  , rfc, telefono , email  , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Cliente , tipos tipop WHERE  year(Cliente.fecha_registro) = :ano  and estado = 1  and Cliente.id_tipo = tipop.id_tipo ORDER BY Cliente.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':ano', $ano, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function busquedaMesualidad($mes){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Cliente, nombre_Cliente , fecha_registro  , rfc, telefono , email  , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Cliente , tipos tipop WHERE  month(Cliente.fecha_registro) =:mes    and estado = 1 and Cliente.id_tipo = tipop.id_tipo ORDER BY Cliente.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':mes', $mes, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function BusquedaEspecifica($fecha_inicio , $fechaFinal){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Cliente, nombre_Cliente , fecha_registro  , rfc, telefono , email  , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Cliente , tipos tipop WHERE  Cliente.fecha_registro BETWEEN :fechai and :fechaf   and estado = 1  and Cliente.id_tipo = tipop.id_tipo ORDER BY Cliente.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':fechai', $fecha_inicio , PDO::PARAM_STR );
			$sth->bindParam(':fechaf',  $fechaFinal, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		}
		
		
		

	}
?>