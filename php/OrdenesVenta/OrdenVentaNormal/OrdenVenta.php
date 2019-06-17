<?php


	class OrdenVenta{
		
		private $nombreTabla = "ordenes_Venta_normal";
		private $conn = null;


		function __construct($conn){
			$this->conn = $conn;
		}

		public function registrarOrdenVenta($arrayValues , $tiposDatos){
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

		public function addOrdenVenta(){

		}

		public function eliminarOrdenVenta($id_OrdenVenta){
			try {
				$conexion = $this->conn;
				$sth = $conexion->prepare('update '.$this->nombreTabla.' set estado = 0 where id_Orden = :id_OrdenVenta', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->bindParam(':id_OrdenVenta', $id_OrdenVenta, PDO::PARAM_INT);
				$sth->execute();
				return true;
			} catch (Exception $e) {
				echo "Connection failed: " . $e->getMessage();
				return false;
			}
		}
		public function agrgaObservacion($id_OrdenVenta, $observacion){
			try {
				$conexion = $this->conn;
				$sth = $conexion->prepare('update '.$this->nombreTabla.' set observaciones = :observaciones where id_Orden = :id_OrdenVenta', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->bindParam(':id_OrdenVenta', $id_OrdenVenta, PDO::PARAM_INT);
				$sth->bindParam(':observaciones', $observacion, PDO::PARAM_INT);
				$sth->execute();
				return true;
			} catch (Exception $e) {
				echo "Connection failed: " . $e->getMessage();
				return false;
			}
		}
		public function modificarOrdenVenta(){}
		
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
			 

		public function existeOrdenVenta($nickname){
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
			  $sth = $conexion->prepare('SELECT id_OrdenVenta FROM '.$this->nombreTabla.' where nickname = :nickname and email = :email', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->execute(array(':nickname' => $nickname, ':email' => $email));
              $row = $sth->fetch(PDO::FETCH_ASSOC);
              return $row['id_OrdenVenta'];
		}
		
		public function obteterEmail($nickname){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT email FROM '.$this->nombreTabla.' where nickname = :nickname ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row['email'];
		}
		
		//Proporciona ciertos datos de cualquier OrdenVenta a travez de su id
		public function obteterDatos($id_OrdenVenta){
			echo '---'.$id_OrdenVenta.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_OrdenVenta, nombre_OrdenVenta as nombre, fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' OrdenVenta , procendias_OrdenVenta prop, tipos tipop where estado = 1 and OrdenVenta.id_tipo_procedencia= prop.id_tipo_procedencia and OrdenVenta.id_tipo = tipop.id_tipo and id_OrdenVenta = :id_OrdenVenta', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
			$sth->bindParam(':id_OrdenVenta', $id_OrdenVenta, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		public function obteterIdcliente($id_OrdenVenta){
			echo '---'.$id_OrdenVenta.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_cliente , fecha from '.$this->nombreTabla.' where estado = 1 and id_orden = :id_OrdenVenta', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_OrdenVenta', $id_OrdenVenta, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		public function obtenerObservaciones($id_OrdenVenta){
			echo '---'.$id_OrdenVenta.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT observaciones from '.$this->nombreTabla.' where estado = 1 and id_orden = :id_OrdenVenta', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_OrdenVenta', $id_OrdenVenta, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		public function obteterNombre($id_OrdenVenta){
			echo '---'.$id_OrdenVenta.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT nombre_OrdenVenta'.$this->nombreTabla.' OrdenVenta , procendias_OrdenVenta prop, tipos tipop where estado = 1 and OrdenVenta.id_tipo_procedencia= prop.id_tipo_procedencia and OrdenVenta.id_tipo = tipop.id_tipo and id_OrdenVenta = :id_OrdenVenta', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_OrdenVenta', $id_OrdenVenta, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function editarOrdenVenta($arrayValues , $tiposDatos ,$id_OrdenVenta){
			try{
				$connl =  $this->conn;
				$utilidad = new Utilidad();
				$bindSql =	$utilidad->prepareAndBindSqlEdicionDiferente($this->nombreTabla,'id_OrdenVenta',$tiposDatos, $arrayValues,$id_OrdenVenta);
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
			$sth = $conexion->prepare('SELECT id_Orden, fecha , cliente.id_cliente , cliente.nombre_cliente from '.$this->nombreTabla.' actualorden , clientes cliente where cliente.nombre_cliente like :nombre AND actualorden.estado = 1 and cliente.id_cliente = actualorden.id_cliente ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
				
		}
		public function busquedaNombreOrden($nombre){
		
		
			$conexion = $this->conn;
			$nombre = '%'.$nombre.'%';
			$sth = $conexion->prepare('SELECT id_OrdenVenta, cliente.id_cliente , nombre_OrdenVenta , fecha_registro , rfc, telefono , email , direccion , url_image from '.$this->nombreTabla.' OrdenVenta where nombre_OrdenVenta like :nombre and estado = 1', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		
		}
		public function busquedaUltimos(){
				
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Orden, cliente.id_cliente ,observaciones, fecha , cliente.nombre_cliente from '.$this->nombreTabla.' actualorden , clientes cliente where  actualorden.estado = 1 and cliente.id_cliente = actualorden.id_cliente ORDER BY id_orden DESC  LIMIT 15', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function busquedaAnualidad($ano){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Orden, cliente.id_cliente , fecha , cliente.nombre_cliente from '.$this->nombreTabla.' actualorden, clientes cliente WHERE  year(actualorden.fecha) = :ano and actualorden.estado = 1  and cliente.id_cliente = actualorden.id_cliente ORDER BY actualorden.fecha  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':ano', $ano, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function busquedaMesualidad($mes){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Orden,cliente.id_cliente, fecha , cliente.nombre_cliente from '.$this->nombreTabla.' actualorden, clientes cliente WHERE  month(actualorden.fecha) = :mes and actualorden.estado = 1  and cliente.id_cliente = actualorden.id_cliente ORDER BY actualorden.id_orden  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':mes', $mes, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function BusquedaEspecifica($fecha_inicio , $fechaFinal){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Orden, cliente.id_cliente , fecha , cliente.nombre_cliente from '.$this->nombreTabla.'  actualorden, clientes cliente WHERE   actualorden.fecha BETWEEN :fechai and :fechaf   and actualorden.estado = 1  and cliente.id_cliente = actualorden.id_cliente ORDER BY actualorden.fecha  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));			
			$sth->bindParam(':fechai', $fecha_inicio , PDO::PARAM_STR );
			$sth->bindParam(':fechaf',  $fechaFinal, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		}
		

	}
?>