<?php


	class Proveedor{
		
		private $nombreTabla = "Proveedores";
		private $conn = null;


		function __construct($conn){
			$this->conn = $conn;
		}

		public function registrarProveedor($arrayValues , $tiposDatos){
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

		public function addProveedor(){

		}

		public function eliminarProveedor($id_Proveedor){
			try {
				$conexion = $this->conn;
				$sth = $conexion->prepare('update '.$this->nombreTabla.' set estado = 0 where id_Proveedor = :id_Proveedor', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->bindParam(':id_Proveedor', $id_Proveedor, PDO::PARAM_INT);
				$sth->execute();
				return true;
			} catch (Exception $e) {
				echo "Connection failed: " . $e->getMessage();
				return false;
			}
		}

		public function modificarProveedor(){}
		
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
			 

		public function existeProveedor($nickname){
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
			  $sth = $conexion->prepare('SELECT id_Proveedor FROM '.$this->nombreTabla.' where nickname = :nickname and email = :email', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->execute(array(':nickname' => $nickname, ':email' => $email));
              $row = $sth->fetch(PDO::FETCH_ASSOC);
              return $row['id_Proveedor'];
		}
		
		public function obteterEmail($nickname){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT email FROM '.$this->nombreTabla.' where nickname = :nickname ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row['email'];
		}
		
		//Proporciona ciertos datos de cualquier Proveedor a travez de su id
		public function obteterDatos($id_Proveedor){
			echo '---'.$id_Proveedor.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Proveedor, nombre_proveedor as nombre, fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' proveedor , procendias_proveedor prop, tipos tipop where estado = 1 and proveedor.id_tipo_procedencia= prop.id_tipo_procedencia and proveedor.id_tipo = tipop.id_tipo and id_Proveedor = :id_Proveedor', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
			$sth->bindParam(':id_Proveedor', $id_Proveedor, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		public function obteterNombre($id_Proveedor){
			echo '---'.$id_Proveedor.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT nombre_proveedor'.$this->nombreTabla.' proveedor , procendias_proveedor prop, tipos tipop where estado = 1 and proveedor.id_tipo_procedencia= prop.id_tipo_procedencia and proveedor.id_tipo = tipop.id_tipo and id_Proveedor = :id_Proveedor', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_Proveedor', $id_Proveedor, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function editarProveedor($arrayValues , $tiposDatos ,$id_Proveedor){
			try{
				$connl =  $this->conn;
				$utilidad = new Utilidad();
				$bindSql =	$utilidad->prepareAndBindSqlEdicionDiferente($this->nombreTabla,'id_proveedor',$tiposDatos, $arrayValues,$id_Proveedor);
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
			$sth = $conexion->prepare('SELECT id_Proveedor, nombre_proveedor , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' proveedor , procendias_proveedor prop, tipos tipop where nombre_proveedor like :nombre and estado = 1 and proveedor.id_tipo_procedencia= prop.id_tipo_procedencia and proveedor.id_tipo = tipop.id_tipo', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
				
		}
		public function busquedaNombreOrden($nombre){
		
		
			$conexion = $this->conn;
			$nombre = '%'.$nombre.'%';
			$sth = $conexion->prepare('SELECT id_proveedor, nombre_proveedor , fecha_registro , rfc, telefono , email , direccion , url_image from '.$this->nombreTabla.' proveedor where nombre_proveedor like :nombre and estado = 1', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		
		}
		public function busquedaUltimos(){
				
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Proveedor, nombre_proveedor , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' proveedor , procendias_proveedor prop, tipos tipop where estado = 1 and proveedor.id_tipo_procedencia= prop.id_tipo_procedencia and proveedor.id_tipo = tipop.id_tipo ORDER BY id_Proveedor DESC LIMIT 15', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function busquedaAnualidad($ano){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Proveedor, nombre_proveedor , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' proveedor , procendias_proveedor prop, tipos tipop WHERE  year(proveedor.fecha_registro) = :ano  and estado = 1 and proveedor.id_tipo_procedencia= prop.id_tipo_procedencia and proveedor.id_tipo = tipop.id_tipo ORDER BY proveedor.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':ano', $ano, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function busquedaMesualidad($mes){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Proveedor, nombre_proveedor , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' proveedor , procendias_proveedor prop, tipos tipop WHERE  month(proveedor.fecha_registro) =:mes    and estado = 1 and proveedor.id_tipo_procedencia= prop.id_tipo_procedencia and proveedor.id_tipo = tipop.id_tipo ORDER BY proveedor.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
			$sth->bindParam(':mes', $mes, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function BusquedaEspecifica($fecha_inicio , $fechaFinal){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Proveedor, nombre_proveedor , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' proveedor , procendias_proveedor prop, tipos tipop WHERE  proveedor.fecha_registro BETWEEN :fechai and :fechaf   and estado = 1 and proveedor.id_tipo_procedencia= prop.id_tipo_procedencia and proveedor.id_tipo = tipop.id_tipo ORDER BY proveedor.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));			
			$sth->bindParam(':fechai', $fecha_inicio , PDO::PARAM_STR );
			$sth->bindParam(':fechaf',  $fechaFinal, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		}
		

	}
?>