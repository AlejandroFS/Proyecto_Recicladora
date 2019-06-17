<?php 
$urlReco = htmlspecialchars('php/Recolecciones/AltaRecoleccion.php');
?>
$(document).ready(function(e){
	
	$('#formRecoleccion').on('submit', function(e){
	e.preventDefault();
	    var values = $('#formRecoleccion').serializeObject();
	    values.longitud = longitud;
	    values.latitud = latitud;
        console.log(values);
        $.ajax({
					  method: "Post",
					  dataType: "json",
					  url: "<?php echo $urlReco ;?>",
					  data: values,
					  success: function(data){
					   $('#estatusRegistro').addClass('label label-info  tLetra');
					  $('#estatusRegistro').text('Nos pondremos en contacto con el telefono ingresado, gracias!');
             		  setTimeout(function(){ 
		               $('#formRecoleccion').trigger("reset");
		               $('#estatusRegistro').text(' ');
		               $('#estatusRegistro').removeClass('label-warning  label-info tLetra');
		               }, 3000);
					 
					 		}
					});
	});
});
