<?php


	class ItemCompra{
		
		private $nombreTabla = "Item_Compra";
		private $conn = null;


		function __construct($conn){
			$this->conn = $conn;
		}

		public function registrarItemCompra($arrayValues , $tiposDatos){
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

		public function addItem_Compra(){

		}

		public function eliminarItem_Compra($id_Item){
			try {
				$conexion = $this->conn;
				$sth = $conexion->prepare('update '.$this->nombreTabla.' set estado = 0 where id_Item = :id_Item', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->bindParam(':id_Item', $id_Item, PDO::PARAM_INT);
				$sth->execute();
				return true;
			} catch (Exception $e) {
				echo "Connection failed: " . $e->getMessage();
				return false;
			}
		}
		

		public function modificarItem_Compra(){}
		
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
			 

		public function existeItem_Compra($nickname){
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
			  $sth = $conexion->prepare('SELECT id_Item_Compra FROM '.$this->nombreTabla.' where nickname = :nickname and email = :email', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->execute(array(':nickname' => $nickname, ':email' => $email));
              $row = $sth->fetch(PDO::FETCH_ASSOC);
              return $row['id_Item_Compra'];
		}
		
		public function obteterEmail($nickname){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT email FROM '.$this->nombreTabla.' where nickname = :nickname ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row['email'];
		}
		
		//Proporciona ciertos datos de cualquier Item_Compra a travez de su id
		public function obteterDatos($id_Item_Compra){
			echo '---'.$id_Item_Compra.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Item_Compra, nombre_Item_Compra as nombre, fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Item_Compra , procendias_Item_Compra prop, tipos tipop where estado = 1 and Item_Compra.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Compra.id_tipo = tipop.id_tipo and id_Item_Compra = :id_Item_Compra', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
			$sth->bindParam(':id_Item_Compra', $id_Item_Compra, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		public function obteterNombre($id_Item_Compra){
			echo '---'.$id_Item_Compra.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT nombre_Item_Compra'.$this->nombreTabla.' Item_Compra , procendias_Item_Compra prop, tipos tipop where estado = 1 and Item_Compra.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Compra.id_tipo = tipop.id_tipo and id_Item_Compra = :id_Item_Compra', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_Item_Compra', $id_Item_Compra, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function editarItem_Compra($arrayValues , $tiposDatos ,$id_Item_Compra){
			try{
				$connl =  $this->conn;
				$utilidad = new Utilidad();
				$bindSql =	$utilidad->prepareAndBindSqlEdicionDiferente($this->nombreTabla,'id_Item_Compra',$tiposDatos, $arrayValues,$id_Item_Compra);
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
			$sth = $conexion->prepare('SELECT id_Item_Compra, nombre_Item_Compra , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Item_Compra , procendias_Item_Compra prop, tipos tipop where nombre_Item_Compra like :nombre and estado = 1 and Item_Compra.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Compra.id_tipo = tipop.id_tipo', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
				
		}
		public function busquedaNombreOrden($nombre){
		
		
			$conexion = $this->conn;
			$nombre = '%'.$nombre.'%';
			$sth = $conexion->prepare('SELECT id_Item_Compra, nombre_Item_Compra , fecha_registro , rfc, telefono , email , direccion , url_image from '.$this->nombreTabla.' Item_Compra where nombre_Item_Compra like :nombre and estado = 1', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		
		}
		public function busquedaUltimos($id_orden){
				
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT itemcompra.id_item,  itemcompra.totalkg , material.nombre_material ,material.precio_kg_compra ,itemcompra.Precio_kg_compra   from '.$this->nombreTabla.' itemcompra , ordenes_compra_normal ordencompra, materiales_desecho material where itemcompra.estado = 1 and itemcompra.id_orden = ordencompra.id_orden   and itemcompra.id_material = material.id_material and itemcompra.id_orden='.$id_orden.'  ORDER BY itemcompra.id_item ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_orden', $id_orden, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function busquedaAnualidad($ano){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Item_Compra, nombre_Item_Compra , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Item_Compra , procendias_Item_Compra prop, tipos tipop WHERE  year(Item_Compra.fecha_registro) = :ano  and estado = 1 and Item_Compra.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Compra.id_tipo = tipop.id_tipo ORDER BY Item_Compra.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':ano', $ano, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function busquedaMesualidad($mes){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Item_Compra, nombre_Item_Compra , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Item_Compra , procendias_Item_Compra prop, tipos tipop WHERE  month(Item_Compra.fecha_registro) =:mes    and estado = 1 and Item_Compra.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Compra.id_tipo = tipop.id_tipo ORDER BY Item_Compra.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
			$sth->bindParam(':mes', $mes, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function BusquedaEspecifica($fecha_inicio , $fechaFinal){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Item_Compra, nombre_Item_Compra , fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Item_Compra , procendias_Item_Compra prop, tipos tipop WHERE  Item_Compra.fecha_registro BETWEEN :fechai and :fechaf   and estado = 1 and Item_Compra.id_tipo_procedencia= prop.id_tipo_procedencia and Item_Compra.id_tipo = tipop.id_tipo ORDER BY Item_Compra.fecha_registro  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));			
			$sth->bindParam(':fechai', $fecha_inicio , PDO::PARAM_STR );
			$sth->bindParam(':fechaf',  $fechaFinal, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		
		}
		

	}
?>