<?php

	
	class MaterialDesecho{
		
		private $nombreTabla = "materiales_desecho";
		private $conn = null;


		function __construct($conn){
			$this->conn = $conn;
		}

		public function registrarMaterialDesecho($arrayValues , $tiposDatos){
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
		public function eliminarMaterialDesecho($id_MaterialDesecho){
			
			try {
				$conexion = $this->conn;
				$sth = $conexion->prepare('update '.$this->nombreTabla.' set estado = 0 where id_material  = :id_MaterialDesecho', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->bindParam(':id_MaterialDesecho', $id_MaterialDesecho, PDO::PARAM_INT);
				$sth->execute();
				return true;
			} catch (Exception $e) {
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
			 

		public function existeMaterialDesecho($nickname){
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
			  $sth = $conexion->prepare('SELECT id_MaterialDesecho FROM '.$this->nombreTabla.' where nickname = :nickname and email = :email', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			  $sth->execute(array(':nickname' => $nickname, ':email' => $email));
              $row = $sth->fetch(PDO::FETCH_ASSOC);
              return $row['id_MaterialDesecho'];
		}
		public function obteterEmail($nickname){
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT email FROM '.$this->nombreTabla.' where nickname = :nickname ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row['email'];
		}
		
		//Proporciona ciertos datos de cualquier MaterialDesecho a travez de su id
		public function obteterDatos($id_user){
			echo '---'.$id_user.'---';
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT nombre,telefono,email,nickname,password,url_image from '.$this->nombreTabla.' where id_MaterialDesecho= :id_user ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_user', $id_user, PDO::PARAM_INT );
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function editarMaterialDesecho($arrayValues , $tiposDatos ,$id_MaterialDesecho){
			try{
				$connl =  $this->conn;
				$utilidad = new Utilidad();
				$bindSql =	$utilidad->prepareAndBindSqlEdicionDiferente($this->nombreTabla,'id_Material',$tiposDatos, $arrayValues,$id_MaterialDesecho);
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
		//Funciones de busqueda.
		public function busquedaNombre($nombre){
	
			
			$conexion = $this->conn;
			$nombre = '%'.$nombre.'%';
			$sth = $conexion->prepare('SELECT id_Material,  nombre_material , precio_kg_compra , precio_kg_venta from '.$this->nombreTabla.' where nombre_material like :nombre and estado = 1', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);   
			return $row;
		
			
		}
		public function busquedaUltimos(){
			
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_Material, nombre_material ,precio_kg_compra, precio_kg_venta from '.$this->nombreTabla.' where estado = 1 ORDER BY id_Material DESC ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		
		public function busquedaAnualidad($ano){
				
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_MaterialDesecho,  email ,  asunto, comentarios, fecha from '.$this->nombreTabla.' WHERE  year(fecha) = :ano  and estado = 1', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':ano', $ano, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		public function busquedaMesualidad($mes){
		
			$conexion = $this->conn;
			$sth = $conexion->prepare('SELECT id_MaterialDesecho,  email ,  asunto, comentarios, fecha from '.$this->nombreTabla.' WHERE month(fecha) =:mes  and estado = 1', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':mes', $mes, PDO::PARAM_STR );
			$sth->execute();
			$row = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
	public function BusquedaEspecifica($fecha_inicio , $fechaFinal){
		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT id_MaterialDesecho,  email , asunto, comentarios, fecha from '.$this->nombreTabla.' where fecha  BETWEEN :fechai and :fechaf and estado = 1 ORDER BY fecha  ASC ; ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':fechai', $fecha_inicio , PDO::PARAM_STR );
		$sth->bindParam(':fechaf',  $fechaFinal, PDO::PARAM_STR );
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;
		
		}
	}
?>