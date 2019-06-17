<?php

$url = htmlspecialchars ( "../php/Usuarios/VerificaUsuario.php" );
$url2 = htmlspecialchars ( "../php/Usuarios/Registro_Usuario.php" );
?>

<!DOCTYPE html>
<html lang="es">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Formularios Usuariós</title>
<link rel="stylesheet" type="text/css"
	href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/index/index.css">
<script type="text/javascript" src="../js/jquery-1.12.3.js"></script>

<script type="text/javascript" charset="utf-8">


    $(document).ready(function(){
        
    	 
      /*Funcionalidades de comprobacion de email y de nombre de usuario*/





      $("#boton").prop("disabled", true);
        $("#valido0").addClass("label label-success");
        $("#valido1").addClass("label");
        $("#valido1").addClass("label");
        $("#email").on("keydown focusout click input click",function(){
          if ($("#email").val() == "") {

          }else{
            var val = "s";
              $.ajax({
                    url: "<?php echo $url; ?>", 
                    type: "POST",
                    data: {email : $("#email").val()},
                    success: function(data){
                      var resultado = jQuery.parseJSON(data);
                     
                      if(resultado["respuesta"] == "El correo es valido en el formulario."){
                        $("#valido1").text("");
                        $("#boton").prop("disabled", false);
                        $("#valido1").removeClass("label-warning");
                        $("#valido1").addClass("label label-info");
                      }
                      else{
                          $("#valido1").text(resultado["respuesta"]);
                          $("#boton").prop("disabled", true);
                          $("#valido1").addClass("label label-warning");

                      }

                    }
                });
          }
          

        });


        $("#nickname").on("keydown focusout input click",function(){
           if ($("#nickname").val() == "") {

          }else{
                var val = "s";
              $.ajax({
                    url: "<?php echo $url; ?>", 
                    type: "POST",
                    data: {nickname : $("#nickname").val()},
                    success: function(data){
                      var resultado = jQuery.parseJSON(data);
                      
                      if(resultado["respuesta"] == "El nickname es valido en el formulario." && ($("#nickname").val().length)>=6 ){
                        $("#valido2").text(resultado["respuesta"]);
                        $("#boton").prop("disabled", false);
                        $("#valido2").removeClass("label-warning");
                        $("#valido2").addClass("label label-info");
                      }
                      else{
                        if($("#nickname").val().length<6){
                          $("#valido2").text("Utilce al menos 6 caracteres en el nombre de usuario.");
                          $("#boton").prop("disabled", true);
                          $("#valido2").addClass("label label-warning");
                        }
                        else{
                          $("#valido2").text("Nombre de usuario ya en uso en el sistema.");
                          $("#boton").prop("disabled", true);
                          $("#valido2").addClass("label label-warning");
                        }
                      }
                    }
                });
          }
          

        });
    /*////////////////////////////////////////////////////////////////////////////////////*/
        
      /*Envio de datos de un usario nuevo al sistema*/
         

        $("#formularioRegistro").submit(function(e){
            

             var values = $(this).serialize();
             var values = JSON.stringify($("#formularioRegistro").serializeObject());
             var values = jQuery.parseJSON(values);
             e.preventDefault();
                  $.ajax({
                         type: "POST",
                         dataType: "json",
                         url: "<?php echo $url2; ?>",
                         data: values,
                         success:function(data){
                        
                      
                      if(data["respuesta"] == "Usuario registrado"){
                         $("#valido0").text("Usuario registrado correctamente, redireccionando.");

                         setTimeout("redireccionar()", 5000);
                      }else{
                        $("#valido0").text("El usuario no se ha podido registrar, intente de nuevo");
                      }
                         }
                          });

        

              });
        
       /*////////////////////////////////////////////////////////////////////////////////////*/
       
       
      });
/*Metodo que permite convertir un serialize a json*/
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || "");
        } else {
            o[this.name] = this.value || "";
        }
    });
    return o;
};
/*Metodo que permite convertir un serialize a json*/

function redireccionar(){
  window.location="../index.html";
} 
  </script>
  <script charset="utf-8" type="text/javascript" src="Administra.php" ></script>
</head>
<body>
	<div class="row">
		<div class="col-sm-12 container panel panel-primary">



			<form id="formRegistro" action="#" class="controlPanel">
				<label id="estatusRegistro"></label>
				<div class="form-group">
					<label for="nombre">Nombre completo del trabajador:</label> <input
						type="text" class="form-control" maxlength="60"
						placeholder="Ingrese el nombre completo del trabajador" autofocus
						required name="nombre">
				</div>

				<div class="form-group">
					<label>Fecha inicio de labores del trabajador:</label> <input
						type="date" class="form-control"
						placeholder="Fecha en la que inicio a labores el trabajador"
						required name="fecha_inicio" value="2013-01-08">
				</div>

				<div class="form-group">
					<label>Telefono del trabajador:</label> <input type="tel"
						class="form-control" maxlength="10"
						placeholder="Ingrese algun telefono de contacto del trabajador"
						required name="telefono">

				</div>

				<div class="form-group">
					<label for="text">Correo electronico del trabajador:*</label> <input
						type="email" class="form-control" maxlength="40"
						placeholder="Ingrese el correo electronico del trabajador."
						name="email">

				</div>

				<div class="form-group">
					<label>Domicilio del trabajador:</label> <input type="text"
						class="form-control" maxlength="100"
						placeholder="Ingrese el domicilio del trabajador" required
						name="domicilio">
				</div>

				<button type="submit" id="botonAlta" class="btn btn-default">Registrar
					Trabajador</button>

			</form>





		</div>
		<div class="col-sm-12 container panel panel-primary">
			<form id="formListado" action="#" class="controlPanel ">
			<table class="table table-striped"><caption>Operaciones</caption><thead> <tr> <th><button type="button" class="btn btn-primary" id="botnGeneral">Act.</button></th> <th> <input class="form-control" id="botonNombre" maxlength="60" placeholder="Ingrese nombre" type="text"></th> <th> <input class="form-control" id="botonanulidad" maxlength="4" placeholder="Ingrese un año especifico" type="text"></th> <th> <input class="form-control" id="botonMensualidad" maxlength="13" placeholder="Ingrese un mes especifico" type="text"></th> <th><label>Busqueda entre fechas --&gt;</label></th> <th> <input class="form-control" maxlength="13" id="fechaInicio" placeholder="Fecha inicial" type="date"></th> <th> <input class="form-control" maxlength="13" id="fechaFinal" placeholder="Fecha final" type="date"></th> <th><button type="button" class="btn btn-success" id="botonEspecifico">Busqueda entre fechas.</button></th> </tr> </thead></table>
			<table class="table table-striped" id="tableValores">
			<caption>Listado</caption>
			<thead>
					
				</thead>
				
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Fecha Registro</th>
						<th>Telefono</th>
						<th>Email</th>
						<th>Domicilio</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>

				<tbody>

					<tr>
						<td><label
							class="form-control table-striped table-hover visualizacion">1</label>
						</td>
						<td><input type="text" readonly class="form-control visualizacion"
							maxlength="60"
							placeholder="Ingrese el nombre completo del trabajador" autofocus
							required name="nombre"></td>
						<td><input type="date" readonly class="form-control visualizacion"
							placeholder="Fecha en la que inicio a labores el trabajador"
							required name="fecha_inicio"></td>
						<td><input type="tel" readonly class="form-control visualizacion"
							maxlength="10"
							placeholder="Ingrese algun telefono de contacto del trabajador"
							required name="telefono"></td>
						<td><input type="email" readonly
							class="form-control visualizacion" maxlength="40"
							placeholder="Ingrese el correo electronico del trabajador."
							name="email"></td>
						<td><input type="text" readonly class="form-control visualizacion"
							maxlength="100" placeholder="Ingrese el domicilio del trabajador"
							required name="domicilio"></td>
						<td>
							<button type="button" class="btn btn-warning" role="editar" value="0">Editar Trabajador</button>
						</td>
						<td>
							<button type="button" class="btn btn-danger"  role="eliminar" value = '0'>Eliminar Trabajador</button>
							
						</td>
					</tr>

				</tbody>
			</table>

</form>
















</div>
			<div class="col-sm-6"></div>
		</div>
		<div class="row">
			<div class="col-sm-6"></div>
			<div class="col-sm-6"></div>
		</div>

</body>
</html>