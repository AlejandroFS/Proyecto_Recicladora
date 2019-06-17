<?php
include 'Trabajador.php';
include '../Utilidad.php';
include '../Database/Conexion.php';

//Objetos
//El proposito de este archivo es el de dar de alta un trabajador
$Utilidad = new Utilidad();  //Objeto que contiene utilidades de uso general

$Conexion = new Conexion();  // Se crea objeto de conexion a bd.

$Trabajador = new Trabajador($Conexion->getConexion()); //Se crea un objeto de tipo Trabajador

$string = "string";
$int = "int";
$arrayValues = array(
		'nombre_Trabajador' => 'Marcelino Frias',
		'Fecha_inicio' => '2012/06/26',
		'telefono' => '45213798',
		'email' => 'mfsit@gmail.comm',
		'domicilio' => 'Avenida del sol#4 Ignacio Lopez Rayon CP:60130'
);

$arrayTiposDatos = array('nombre_Trabajador' => $string,
		'Fecha_inicio' => $string,
		'telefono' => $string,
		'email' => $string,
		'domicilio' => $string);

$Trabajador->editarTrabajador($arrayValues  , $arrayTiposDatos ,2);