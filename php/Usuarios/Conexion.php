<?php

	class Conexion{

		private $servername = "localhost";
		private $username = "root";
		private $password = "";
		private $dbname = "recicladora";
		private $conn = null;

		function __construct() {

			try {

			    $this->conn = new PDO("mysql:host=localhost;dbname=recicladora", $this->username, $this->password,array('charset'=>'utf8'));
			    // set the PDO error mode to exception
			    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			   echo "Connected successfully";
			    
			    }

			catch(PDOException $e){
			   echo "Connection failed: " . $e->getMessage();
			    }
      	
   		}

   		/*Cierra la conexion*/
   		public function closeConexion(){
   			 $this->conn = null;
   		}
   		
   		/*Obtiene la conexion*/
   		public function getConexion(){

   			return  $this->conn;
   		}


	}

?>