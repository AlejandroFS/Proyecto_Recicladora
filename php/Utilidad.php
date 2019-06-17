<?php

  class Utilidad{
  	// Realiza una limpia de cualquier valor que se le ingrese proveniente de un formulario html
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
 	//Realiza una impresion de un array asociativo
		function imprimeArray($arrayUserValuesCopy){
				foreach ($arrayUserValuesCopy as $key => $value) {
					echo "$key -->" . "$value";
					echo "<br>";
				}

		
		}

		function fechaPreparada(){

			return getdate()['year']."/".getdate()['mon']."/".getdate()['mday'];
		}

		 // prepare sql and bind parameters
		function prepareAndBindSql($nombreTabla , $arrayValues){

			$sqlInicio = "INSERT INTO $nombreTabla (";
			$sqlFinal ="(";
			$contador = 0;
			foreach ($arrayValues as $key => $value) {
				if($contador == (count($arrayValues)-1)){
					$sqlInicio.="$key ";
					$sqlFinal.=":$key ";
				}else{
					$sqlInicio.="$key, ";
					$sqlFinal.=":$key, ";
				}
			
				$contador++;
			}
			$sqlInicio.=")";
			$sqlFinal.=")";

			return $sqlInicio." values ".$sqlFinal;
			}
			
			function prepareAndBindSqlEdicion($nombreTabla ,  $tiposDatos, $arrayValues, $id_usuario){
			
				$sqlInicio = "Update ".$nombreTabla. " set ";
				$contador = 0;
				foreach ($arrayValues as $key => $value) {
					if($contador == (count($arrayValues)-1)){
					if($tiposDatos[$key]=='string'){
							$sqlInicio.= $key. '= "' .$arrayValues[$key].'"';
						}else{
						$sqlInicio.= $key. '=' .$arrayValues[$key];}
					}else{
						if($tiposDatos[$key]=='string'){
							$sqlInicio.= $key. '= "' .$arrayValues[$key].'" , ';
						}else{
						$sqlInicio.= $key. '=' .$arrayValues[$key].', ';}
						
					}
						
					$contador++;
				}
				
				$id = substr($nombreTabla ,0,strlen($nombreTabla)-1);
				
				return $sqlInicio.' where id_'.$id.' = '.$id_usuario;
			}
			function prepareAndBindSqlEdicionDiferente($nombreTabla ,$nombre_Id,  $tiposDatos, $arrayValues, $id_usuario){
					
				$sqlInicio = "Update ".$nombreTabla. " set ";
				$contador = 0;
				foreach ($arrayValues as $key => $value) {
					if($contador == (count($arrayValues)-1)){
						if($tiposDatos[$key]=='string'){
							$sqlInicio.= $key. '= "' .$arrayValues[$key].'"';
						}else{
							$sqlInicio.= $key. '=' .$arrayValues[$key];}
					}else{
						if($tiposDatos[$key]=='string'){
							$sqlInicio.= $key. '= "' .$arrayValues[$key].'" , ';
						}else{
							$sqlInicio.= $key. '=' .$arrayValues[$key].', ';}
			
					}
			
					$contador++;
				}
			
				
			
				return $sqlInicio.' where '.$nombre_Id.' = '.$id_usuario;
			}

		public function bindingParameters($arrayValues , $tiposDatos , $stmt){

		
			
			foreach ($arrayValues as $key => $value) {
				
				if( $tiposDatos[$key] == 'int'){

					$stmt->bindParam(':'.$key, $arrayValues [$key], PDO::PARAM_INT);
					//echo ":$key    int -----  $key<br>";
				}else{
					$stmt->bindParam(':'.$key, $arrayValues [$key], PDO::PARAM_STR );
					//echo ":$key strssss  -----   $key <br>";
				}
				
			}
			

		}
		

  }
?>