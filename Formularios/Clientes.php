
<?php
$url = htmlspecialchars ( "../php/Usuarios/VerificaUsuario.php" );
$url2 = htmlspecialchars ( "../php/Usuarios/Registro_Usuario.php" );
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Formularios Usuarios</title>
<link rel="stylesheet" type="text/css"
	href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/index/index.css">
<script type="text/javascript" src="../js/jquery-1.12.3.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>

<script type="text/javascript">
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
</head>
<body>
	<div class="row">
		<div class="col-sm-6 container panel panel-primary">
			////aqui cortar y agregar hideElement
			<div class="controlPanel  " id="divEdicion">
				<form id="formularioEdicionProv" action="#">
					<label id="estatusEdicion">Editando</label> <label
						id="idEdicionCliente">#</label>
					<div class="form-group">
						<label for="nombre">Nombre del cliente:</label> <input
							type="text" class="form-control" maxlength="50"
							placeholder="Ingrese el nombre del Cliente" autofocus required
							name="nombre_Cliente" id="nombreCliente">
					</div>
					<div class="form-group">
						<label for="nombre">RFC del Cliente:</label> <input type="text"
							class="form-control" maxlength="15"
							placeholder="Ingrese el RFC del Cliente" autofocus required
							name="rfc" id="rfcCliente">
					</div>
					<div class="form-group">
						<label for="tel">Telefono del Cliente:</label> <input type="tel"
							class="form-control" maxlength="15"
							placeholder="Ingrese el telefono del Cliente." name="telefono"
							id="telefonoCliente">
					</div>
					<div class="form-group">
						<label for="email">Correo electronico:</label> <input type="email"
							class="form-control" id="emailEdicion" maxlength="40"
							placeholder="Ingrese algun correo electronico." required
							name="email"> <label id="validoEmailFormEdit"></label>
					</div>
					<div class="form-group">
						<label for="text">Nickname del Cliente:</label> <input
							type="text" class="form-control" id="nicknameEdicion"
							maxlength="15" placeholder="nickname del Cliente" required
							name="nickname"> <label id="validoNicknameForm"></label>
					</div>
					<div class="form-group">
						<label for="psw">Contraseña:</label> <input type="password"
							class="form-control" maxlength="20"
							placeholder="Contraseña del Cliente." required name="password"
							id="passwordEdicion">
					</div>
					<div class="form-group">
						<label for="nombre">URL de imagen de perfil:</label> <input
							type="text" class="form-control" maxlength="150"
							placeholder="Ingrese url de imagen de perfil" autofocus required
							name="url_image" id="imageEdicion">
					</div>
					<div class="form-group resetDisplay">
						<label for="sel1">Tipo de Cliente:</label> <select
							class="form-control" id="list1Edicion" name="listatipo">
							<option value="1">Comercial</option>
							<option value="2">Industrial</option>
						</select>
					</div>
					<br>
					<button type="submit" id="botonFormularioEdicion"
						class="btn btn-default" disabled>Editar al Cliente</button>
				</form>
			</div>
			



		</div>
		<div class="col-sm-6">B</div>
	</div>
	<div class="row">
		<div class="col-sm-6 container panel panel-primary">

			<form id="formularioRegistro" action="#">
				<label id="valido0"></label>
				<div class="form-group">
					<label for="nombre">Nombre del cliente:</label> <input
						type="text" class="form-control" maxlength="50"
						placeholder="Ingrese el nombre del cliente" autofocus required
						name="nombre_Cliente">
				</div>
				<div class="form-group">
					<label for="nombre">RFC del Cliente:</label> <input type="text"
						class="form-control" maxlength="20"
						placeholder="Ingrese el RFC del cliente" autofocus required
						name="rfc">
				</div>
				<div class="form-group">
					<label for="nombre">URL de imagen de perfil:</label> <input
						type="text" class="form-control" maxlength="150"
						placeholder="Ingrese url de imagen de perfil" autofocus 
						name="url_image">
				</div>
				<div class="form-group">
					<label for="tel">Telefono del cliente:</label> <input type="tel"
						class="form-control" maxlength="15"
						placeholder="Ingrese el telefono del cliente." name="telefono">
				</div>

				<div class="form-group">
					<label for="email">Correo electronico:</label> <input type="email"
						class="form-control" id="email" maxlength="40"
						placeholder="Ingrese algun correo electronico." required
						name="email"> <label id="valido1"></label>
				</div>

				<div class="form-group">
					<label for="text">Nickname del cliente:</label> <input
						type="text" class="form-control" id="nickname" maxlength="15"
						placeholder="nickname del cliente" required name="nickname"> <label
						id="valido2"></label>
				</div>

				<div class="form-group">
					<label for="psw">Contraseña:</label> <input type="password"
						class="form-control" maxlength="20"
						placeholder="Contraseña del Cliente." required name="password">
				</div>
				<div class="form-group resetDisplay">
					<label for="sel1">Tipo de Cliente:</label> <select
						class="form-control" id="list1" name="listatipo">
						<option value="1">Comercial</option>
						<option value="2">Industrial</option>
					</select>
				</div>
				<br>

				<button type="submit" id="boton" class="btn btn-default">Registra al
					Cliente</button>

			</form>


		</div>
		<div class="col-sm-6">B</div>
	</div>


	<div class="row">
		<div class="col-sm-6"></div>
		<div class="col-sm-6"></div>
	</div>

</body>
</html>