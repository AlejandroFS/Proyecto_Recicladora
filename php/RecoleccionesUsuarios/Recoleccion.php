
<?php


class Recoleccion{

	private $nombreTabla = "formularios_recoleccion";
	private $conn = null;


	function __construct($conn){
		$this->conn = $conn;
	}

	public function registrarRecoleccion($arrayValues , $tiposDatos){
		try{
			$connl =  $this->conn;
			$utilidad = new Utilidad();
			$bindSql =	$utilidad->prepareAndBindSql($this->nombreTabla, $arrayValues);
			//echo $bindSql.'<br>';
			$stmt = $connl->prepare($bindSql);
			$utilidad->bindingParameters($arrayValues , $tiposDatos , $stmt);
			$stmt->execute();
			return true;
		}

		catch(PDOException $e){
		//	echo "Connection failed: " . $e->getMessage();
			return false;
		}
			
	}

	public function addRecoleccion(){

	}

	public function eliminarRecoleccion($id_Recoleccion){
		try {
			$conexion = $this->conn;
			$sth = $conexion->prepare('update '.$this->nombreTabla.' set estado = 0 where id_form = :id_form', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_form', $id_Recoleccion, PDO::PARAM_INT);
			$sth->execute();
			return true;
		} catch (Exception $e) {
			echo "Connection failed: " . $e->getMessage();
			return false;
		}
	}
	public function altaRecoleccion($id_Recoleccion){
		try {
			$conexion = $this->conn;
			$sth = $conexion->prepare('update '.$this->nombreTabla.' set estatus = 0 where id_form = :id_form', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->bindParam(':id_form', $id_Recoleccion, PDO::PARAM_INT);
			$sth->execute();
			return true;
		} catch (Exception $e) {
			echo "Connection failed: " . $e->getMessage();
			return false;
		}
	}

	public function modificarRecoleccion(){}

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


	public function existeRecoleccion($nickname){
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
		$sth = $conexion->prepare('SELECT id_Recoleccion FROM '.$this->nombreTabla.' where nickname = :nickname and email = :email', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':nickname' => $nickname, ':email' => $email));
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		return $row['id_Recoleccion'];
	}

	public function obteterEmail($nickname){
		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT email FROM '.$this->nombreTabla.' where nickname = :nickname ', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':nickname', $nickname, PDO::PARAM_STR );
		$sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		return $row['email'];
	}

	//Proporciona ciertos datos de cualquier Recoleccion a travez de su id
	public function obteterDatos($id_Recoleccion){
		echo '---'.$id_Recoleccion.'---';
		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT id_Recoleccion, nombre_Recoleccion as nombre, fecha_registro ,prop.tipo_procedencia , rfc, telefono , email , direccion , tipop.tipo , nickname , password , url_image from '.$this->nombreTabla.' Recoleccion , procendias_Recoleccion prop, tipos tipop where estado = 1 and Recoleccion.id_tipo_procedencia= prop.id_tipo_procedencia and Recoleccion.id_tipo = tipop.id_tipo and id_Recoleccion = :id_Recoleccion', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':id_Recoleccion', $id_Recoleccion, PDO::PARAM_INT );
		$sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function obteterNombre($id_Recoleccion){
		echo '---'.$id_Recoleccion.'---';
		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT nombre_Recoleccion'.$this->nombreTabla.' Recoleccion , procendias_Recoleccion prop, tipos tipop where estado = 1 and Recoleccion.id_tipo_procedencia= prop.id_tipo_procedencia and Recoleccion.id_tipo = tipop.id_tipo and id_Recoleccion = :id_Recoleccion', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':id_Recoleccion', $id_Recoleccion, PDO::PARAM_INT );
		$sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function editarRecoleccion($arrayValues , $tiposDatos ,$id_Recoleccion){
		try{
			$connl =  $this->conn;
			$utilidad = new Utilidad();
			$bindSql =	$utilidad->prepareAndBindSqlEdicionDiferente($this->nombreTabla,'id_Recoleccion',$tiposDatos, $arrayValues,$id_Recoleccion);
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
		$sth = $conexion->prepare('SELECT id_form, nombre , fecha_form , longitud , latitud, comentarios ,telefono from '.$this->nombreTabla.' where nombre like :nombre and estado = 1 and estatus = 1', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;


	}
	//ultimos 15 para select de admin
	public function busquedaUltimos($id_usuario){
		
		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT id_form, nombre , fecha_form , longitud , latitud, comentarios ,telefono from '.$this->nombreTabla.'  where estado = 1 and estatus = 1 and id_usuario = '.$id_usuario.'  ORDER BY id_form DESC LIMIT 15', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	

	public function busquedaAnualidad($ano , $id_usuario){

		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT id_form, nombre , fecha_form , longitud , latitud, comentarios ,telefono from '.$this->nombreTabla.' WHERE  year(fecha_form) = :ano  and estado = 1 and estatus = 1 and id_usuario = '.$id_usuario.' ORDER BY fecha_form  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':ano', $ano, PDO::PARAM_STR );
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function busquedaMesualidad($mes , $id_usuario){

		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT id_form, nombre , fecha_form , longitud , latitud, comentarios ,telefono from '.$this->nombreTabla.' WHERE  month(fecha_form) = :mes    and estado = 1 and estatus = 1 and id_usuario = '.$id_usuario.' ORDER BY fecha_form  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':mes', $mes, PDO::PARAM_STR );
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function BusquedaEspecifica($fecha_inicio , $fechaFinal , $id_usuario){
		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT id_form, nombre , fecha_form , longitud , latitud, comentarios ,telefono from '.$this->nombreTabla.' WHERE  fecha_form BETWEEN :fechai and :fechaf   and estado = 1 and estatus = 1 and id_usuario = '.$id_usuario.' ORDER BY fecha_form  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':fechai', $fecha_inicio , PDO::PARAM_STR );
		$sth->bindParam(':fechaf',  $fechaFinal, PDO::PARAM_STR );
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}
	
	public function busquedaUltimosCompletadas($id_usuario){
	
		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT id_form, nombre , fecha_form , longitud , latitud, comentarios ,telefono from '.$this->nombreTabla.'  where estado = 1 and estatus = 0 and id_usuario = '.$id_usuario.' ORDER BY id_form DESC LIMIT 15', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function busquedaNombreCompleto($nombre){
	
	
		$conexion = $this->conn;
		$nombre = '%'.$nombre.'%';
		$sth = $conexion->prepare('SELECT id_form, nombre , fecha_form , longitud , latitud, comentarios ,telefono from '.$this->nombreTabla.' where nombre like :nombre and estado = 1 and estatus = 0', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':nombre', $nombre, PDO::PARAM_STR );
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	
	
	}
	public function busquedaAnualidadCompleto($ano ,$id_usuario){
	
		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT id_form, nombre , fecha_form , longitud , latitud, comentarios ,telefono from '.$this->nombreTabla.' WHERE  year(fecha_form) = :ano  and estado = 1 and estatus = 0  and id_usuario = '.$id_usuario.'  ORDER BY fecha_form  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':ano', $ano, PDO::PARAM_STR );
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function busquedaMesualidadCompleto($mes, $id_usuario){
	
		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT id_form, nombre , fecha_form , longitud , latitud, comentarios ,telefono from '.$this->nombreTabla.' WHERE  month(fecha_form) = :mes    and estado = 1 and estatus = 0  and id_usuario = '.$id_usuario.' ORDER BY fecha_form  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':mes', $mes, PDO::PARAM_STR );
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function BusquedaEspecificaCompleta($fecha_inicio , $fechaFinal,$id_usuario ){
		$conexion = $this->conn;
		$sth = $conexion->prepare('SELECT id_form, nombre , fecha_form , longitud , latitud, comentarios ,telefono from '.$this->nombreTabla.' WHERE  fecha_form BETWEEN :fechai and :fechaf   and estado = 1 and estatus = 0  and id_usuario = '.$id_usuario.' ORDER BY fecha_form  ASC', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':fechai', $fecha_inicio , PDO::PARAM_STR );
		$sth->bindParam(':fechaf',  $fechaFinal, PDO::PARAM_STR );
		$sth->execute();
		$row = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	
	}


}
?>