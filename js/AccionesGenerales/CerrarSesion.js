
  	$(document).ready(function(){
  	
  	  $('body').on('click', '#cerrarSesion', function() {
  		  console.log('click-cerrando');
  		$.ajax({
			  type: "POST",
			  url: url4,
			  data: '',
			  success: function(e){
				  redireccionar();
				
				  }
			});
  	});
  		
  	  	});
  			function redireccionar(){
	  		location.href = "http://localhost/Proyecto_Recicladora/index.php";
	  	  	}