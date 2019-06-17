<?php


	class ItemVenta{
		
		private $nombreTabla = "item_venta";
		private $conn = null;


		function __construct($conn){
			$this->conn = $conn;
		}

		public function registrarItemVenta($arrayValues , $tiposDatos){
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

		public function addItem_Venta(){

		}

		public function eliminarItem_Venta($id_Item){
			try {
				$conexion = $this->conn;
				$sth = $conexion->prepare('update '.$this->nombreTabla.' set estado = 0 where id_Venta = :id_Item', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->bindParam(':id_Item', $id_Item, PDO::PARAM_INT);
				$sth->execute();
				return true;
			} catch (Exception $e) {
				echo "Connection failed: " . $e->getMessage();
				return false;
			}
		}
		

		public function modificarItem_Venta(){}
		
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
			 

		public function existeItem_Venta($nickname){
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
			  $sth = $conexion->prepare('SELECT id_Item_Venta FROM '.$this->nombreTabla.' where nickname = :nickname and email = :email', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->execute(array(':nickname' => $nickname, ':email' => $email));
              $row = $sth->fetch(PDO::FETCH_ASSOC);
              return $row['id_Item_Venta'];
		}
		
		public function obteterEmail($nickname){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT email FROM '.$this->nombreTabla.' where nickname = :nickname ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row['email'];
		}
		
		//Proporciona ciertos datos de cualquier Item_Venta a travez de su id
		public function obteterDatos($id_Item_Venta){
			echo '---'.$id_Item_Venta.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Item_Venta, nombre_Item_Venta as nombre, fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Item_Venta , procendias_Item_Venta prop, tipos tipop where estado = 1 and Item_Venta.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Venta.id_tipo = tipop.id_tipo and id_Item_Venta = :id_Item_Venta', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
			$sth->bindParam(':id_Item_Venta', $id_Item_Venta, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		public function obteterNombre($id_Item_Venta){
			echo '---'.$id_Item_Venta.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT nombre_Item_Venta'.$this->nombreTabla.' Item_Venta , procendias_Item_Venta prop, tipos tipop where estado = 1 and Item_Venta.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Venta.id_tipo = tipop.id_tipo and id_Item_Venta = :id_Item_Venta', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_Item_Venta', $id_Item_Venta, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function editarItem_Venta($arrayValues , $tiposDatos ,$id_Item_Venta){
			try{
				$connl =  $this->conn;
				$utilidad = new Utilidad();
				$bindSql =	$utilidad->prepareAndBindSqlEdicionDiferente($this->nombreTabla,'id_Item_Venta',$tiposDatos, $arrayValues,$id_Item_Venta);
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
			$sth = $conexion->prepare('SELECT id_Item_Venta, nombre_Item_Venta , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Item_Venta , procendias_Item_Venta prop, tipos tipop where nombre_Item_Venta like :nombre and estado = 1 and Item_Venta.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Venta.id_tipo = tipop.id_tipo', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
				
		}
		public function busquedaNombreOrden($nombre){
		
		
			$conexion = $this->conn;
			$nombre = '%'.$nombre.'%';
			$sth = $conexion->prepare('SELECT id_Item_Venta, nombre_Item_Venta , fecha_registro , rfc, telefono , email , direccion , url_image from '.$this->nombreTabla.' Item_Venta where nombre_Item_Venta like :nombre and estado = 1', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		
		}
		public function busquedaUltimos($id_orden){
				
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT itemVenta.id_venta,  itemVenta.totalkg , material.nombre_material ,material.precio_kg_Venta ,itemVenta.Precio_kg_Venta   from '.$this->nombreTabla.' itemVenta , ordenes_Venta_normal ordenVenta, materiales_desecho material where itemVenta.estado = 1 and itemVenta.id_orden = ordenVenta.id_orden   and itemVenta.id_material = material.id_material and itemVenta.id_orden='.$id_orden.'  ORDER BY itemVenta.id_venta ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_orden', $id_orden, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function busquedaAnualidad($ano){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Item_Venta, nombre_Item_Venta , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Item_Venta , procendias_Item_Venta prop, tipos tipop WHERE  year(Item_Venta.fecha_registro) = :ano  and estado = 1 and Item_Venta.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Venta.id_tipo = tipop.id_tipo ORDER BY Item_Venta.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':ano', $ano, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function busquedaMesualidad($mes){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Item_Venta, nombre_Item_Venta , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Item_Venta , procendias_Item_Venta prop, tipos tipop WHERE  month(Item_Venta.fecha_registro) =:mes    and estado = 1 and Item_Venta.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Venta.id_tipo = tipop.id_tipo ORDER BY Item_Venta.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
			$sth->bindParam(':mes', $mes, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function BusquedaEspecifica($fecha_inicio , $fechaFinal){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Item_Venta, nombre_Item_Venta , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Item_Venta , procendias_Item_Venta prop, tipos tipop WHERE  Item_Venta.fecha_registro BETWEEN :fechai and :fechaf   and estado = 1 and Item_Venta.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Venta.id_tipo = tipop.id_tipo ORDER BY Item_Venta.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));			
			$sth->bindParam(':fechai', $fecha_inicio , PDO::PARAM_STR );
			$sth->bindParam(':fechaf',  $fechaFinal, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		}
		

	}
?>