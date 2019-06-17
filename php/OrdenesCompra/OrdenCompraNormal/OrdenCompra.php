<?php


	class OrdenCompra{
		
		private $nombreTabla = "ordenes_compra_normal";
		private $conn = null;


		function __construct($conn){
			$this->conn = $conn;
		}

		public function registrarOrdenCompra($arrayValues , $tiposDatos){
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

		public function addOrdenCompra(){

		}

		public function eliminarOrdenCompra($id_OrdenCompra){
			try {
				$conexion = $this->conn;
				$sth = $conexion->prepare('update '.$this->nombreTabla.' set estado = 0 where id_Orden = :id_OrdenCompra', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->bindParam(':id_OrdenCompra', $id_OrdenCompra, PDO::PARAM_INT);
				$sth->execute();
				return true;
			} catch (Exception $e) {
				echo "Connection failed: " . $e->getMessage();
				return false;
			}
		}
		public function agrgaObservacion($id_OrdenCompra, $observacion){
			try {
				$conexion = $this->conn;
				$sth = $conexion->prepare('update '.$this->nombreTabla.' set observaciones = :observaciones where id_Orden = :id_OrdenCompra', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->bindParam(':id_OrdenCompra', $id_OrdenCompra, PDO::PARAM_INT);
				$sth->bindParam(':observaciones', $observacion, PDO::PARAM_INT);
				$sth->execute();
				return true;
			} catch (Exception $e) {
				echo "Connection failed: " . $e->getMessage();
				return false;
			}
		}
		public function modificarOrdenCompra(){}
		
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
			 

		public function existeOrdenCompra($nickname){
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
			  $sth = $conexion->prepare('SELECT id_OrdenCompra FROM '.$this->nombreTabla.' where nickname = :nickname and email = :email', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->execute(array(':nickname' => $nickname, ':email' => $email));
              $row = $sth->fetch(PDO::FETCH_ASSOC);
              return $row['id_OrdenCompra'];
		}
		
		public function obteterEmail($nickname){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT email FROM '.$this->nombreTabla.' where nickname = :nickname ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row['email'];
		}
		
		//Proporciona ciertos datos de cualquier OrdenCompra a travez de su id
		public function obteterDatos($id_OrdenCompra){
			echo '---'.$id_OrdenCompra.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_OrdenCompra, nombre_OrdenCompra as nombre, fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' OrdenCompra , procendias_OrdenCompra prop, tipos tipop where estado = 1 and OrdenCompra.id_tipo_procedencia= prop.id_tipo_procedencia and OrdenCompra.id_tipo = tipop.id_tipo and id_OrdenCompra = :id_OrdenCompra', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
			$sth->bindParam(':id_OrdenCompra', $id_OrdenCompra, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		public function obteterIdProveedor($id_OrdenCompra){
			echo '---'.$id_OrdenCompra.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_proveedor , fecha from '.$this->nombreTabla.' where estado = 1 and id_orden = :id_OrdenCompra', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_OrdenCompra', $id_OrdenCompra, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		public function obtenerObservaciones($id_OrdenCompra){
			echo '---'.$id_OrdenCompra.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT observaciones from '.$this->nombreTabla.' where estado = 1 and id_orden = :id_OrdenCompra', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_OrdenCompra', $id_OrdenCompra, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		public function obteterNombre($id_OrdenCompra){
			echo '---'.$id_OrdenCompra.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT nombre_OrdenCompra'.$this->nombreTabla.' OrdenCompra , procendias_OrdenCompra prop, tipos tipop where estado = 1 and OrdenCompra.id_tipo_procedencia= prop.id_tipo_procedencia and OrdenCompra.id_tipo = tipop.id_tipo and id_OrdenCompra = :id_OrdenCompra', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_OrdenCompra', $id_OrdenCompra, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function editarOrdenCompra($arrayValues , $tiposDatos ,$id_OrdenCompra){
			try{
				$connl =  $this->conn;
				$utilidad = new Utilidad();
				$bindSql =	$utilidad->prepareAndBindSqlEdicionDiferente($this->nombreTabla,'id_OrdenCompra',$tiposDatos, $arrayValues,$id_OrdenCompra);
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
			$sth = $conexion->prepare('SELECT id_Orden, fecha , provee.id_proveedor , provee.nombre_proveedor from '.$this->nombreTabla.' actualorden , proveedores provee where provee.nombre_proveedor like :nombre AND actualorden.estado = 1 and provee.id_proveedor = actualorden.id_proveedor ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
				
		}
		public function busquedaNombreOrden($nombre){
		
		
			$conexion = $this->conn;
			$nombre = '%'.$nombre.'%';
			$sth = $conexion->prepare('SELECT id_OrdenCompra, provee.id_proveedor , nombre_OrdenCompra , fecha_registro , rfc, telefono , email , direccion , url_image from '.$this->nombreTabla.' OrdenCompra where nombre_OrdenCompra like :nombre and estado = 1', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		
		}
		public function busquedaUltimos(){
				
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Orden, provee.id_proveedor ,observaciones, fecha , provee.nombre_proveedor from '.$this->nombreTabla.' actualorden , proveedores provee where  actualorden.estado = 1 and provee.id_proveedor = actualorden.id_proveedor ORDER BY id_orden DESC  LIMIT 15', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function busquedaAnualidad($ano){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Orden, provee.id_proveedor , fecha , provee.nombre_proveedor from '.$this->nombreTabla.' actualorden, proveedores provee WHERE  year(actualorden.fecha) = :ano and actualorden.estado = 1  and provee.id_proveedor = actualorden.id_proveedor ORDER BY actualorden.fecha  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':ano', $ano, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function busquedaMesualidad($mes){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Orden,provee.id_proveedor, fecha , provee.nombre_proveedor from '.$this->nombreTabla.' actualorden, proveedores provee WHERE  month(actualorden.fecha) = :mes and actualorden.estado = 1  and provee.id_proveedor = actualorden.id_proveedor ORDER BY actualorden.id_orden  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':mes', $mes, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function BusquedaEspecifica($fecha_inicio , $fechaFinal){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Orden, provee.id_proveedor , fecha , provee.nombre_proveedor from '.$this->nombreTabla.'  actualorden, proveedores provee WHERE   actualorden.fecha BETWEEN :fechai and :fechaf   and actualorden.estado = 1  and provee.id_proveedor = actualorden.id_proveedor ORDER BY actualorden.fecha  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));			
			$sth->bindParam(':fechai', $fecha_inicio , PDO::PARAM_STR );
			$sth->bindParam(':fechaf',  $fechaFinal, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		}
		

	}
?>