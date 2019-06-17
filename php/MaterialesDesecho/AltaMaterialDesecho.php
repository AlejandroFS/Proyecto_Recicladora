<?php
include 'MaterialDesecho.php';
include '../Utilidad.php';
include '../Database/Conexion.php';

// Objetos
// El proposito de este archivo es el de dar de alta un MaterialDesecho
$Utilidad = new Utilidad (); // Objeto que contiene utilidades de uso general

$Conexion = new Conexion (); // Se crea objeto de conexion a bd.

$MaterialDesecho = new MaterialDesecho ( $Conexion->getConexion () ); // Se crea un objeto de tipo MaterialDesecho

$string = "string";
$int = "int";
$double = "double";

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	
	if (! isset ( $_POST ['id_material'] )) {
		
		$nombre_material = $Utilidad->test_input ( $_POST ["nombre_material"] );
		$precio_kg_compra = $Utilidad->test_input ( $_POST ["precio_kg_compra"] );
		$precio_kg_venta = $Utilidad->test_input ( $_POST ["precio_kg_venta"] );

		
		$arrayValues = array (
				'nombre_material' => $nombre_material,
				'precio_kg_compra' => $precio_kg_compra,
				'precio_kg_venta' => $precio_kg_venta,
				'estado' => 1 
		);
		
		$arrayTiposDatos = array (
				'nombre_material' => $string,
				'precio_kg_compra' => $int,
				'precio_kg_venta' => $int,
				'estado' => $int 
		);
		
		$respuesta = $MaterialDesecho->registrarMaterialDesecho ( $arrayValues, $arrayTiposDatos );
		if ($respuesta) {
			$respuesta = json_encode ( array (
					'respuesta' => 'Material de Desecho registrado' 
			) );
		} else {
			
			$respuesta = json_encode ( array (
					'respuesta' => 'No se ha podido registrar al Materialde Desecho' 
			) );
		}
		ob_clean ();
		echo $respuesta;
	} else {
		$id = $Utilidad->test_input ( $_POST ["id_material"] );
		$nombre_material = $Utilidad->test_input ( $_POST ["nombre_material"] );
		$precio_kg_compra = $Utilidad->test_input ( $_POST ["Precio_kg_compra"] );
		$precio_kg_venta = $Utilidad->test_input ( $_POST ["Precio_kg_venta"] );

		
		$arrayValues = array (
				'nombre_material' => $nombre_material,
				'precio_kg_compra' => $precio_kg_compra,
				'precio_kg_venta' => $precio_kg_venta,
				'estado' => 1 
		);
		
		$arrayTiposDatos = array (
				'nombre_material' => $string,
				'precio_kg_compra' => $int,
				'precio_kg_venta' => $int,
				'estado' => $int 
		);
		
		$respuesta = $MaterialDesecho->editarMaterialDesecho( $arrayValues, $arrayTiposDatos , $id );
		if ($respuesta) {
			$respuesta = json_encode ( array (
					'respuesta' => 'Material de Desecho editado' 
			) );
		} else {
			
			$respuesta = json_encode ( array (
					'respuesta' => 'No se ha podido registrar al Materialde Desecho' 
			) );
		}
		ob_clean ();
		echo $respuesta;
	}
}

