<!DOCTYPE html>
<html>
<head>
	<title>Restablecer contraseña</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>
	<style type="text/css">
		.modal.show {
	 		background-color: #0c0f17d6 !important;
		}

		
	</style>
	

		<div class="modal" id="LoginModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
	        	<div class="modal-header">
	        		<div class="mx-auto text-center">
	        			<h5 class="modal-title">Restablecer contraseña</h5>
      					<img src="CDI/CDI/1 - Login/Contraseña.png" width="50" style="margin-top: 10px;" />
      					
  						<label class="text-muted" style="margin-top: 20px;">Introduce aquí tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</label>
  					</div>
		      	</div>
		      	<div class="modal-body">
		        	<form action="correo_enviado.php" class="needs-validation" novalidate>
			  			<div class="form-group text-center">
				    		<input type="email" class="form-control text-center" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo electrónico" required>
					      	<div class="invalid-feedback">
						        El formato del correo no es correcto.
					      	</div>		
				  		</div>
				  		<div class="text-center">
				  			<input type="submit" class="btn btn-primary" value="Enviar correo electrónico" role="button">
				  		</div>
					</form>
		     	 </div>
		    </div>
		  </div>
		</div>

	
	<script>
 		$(document).ready(function() {
       		$('#LoginModal').modal('show');
     	});
  	</script>

  	<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

  
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>