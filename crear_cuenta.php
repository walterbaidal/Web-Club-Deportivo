<!DOCTYPE html>
<html>
<head>
	<title>Pandas F.C</title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="dist/css/bootstrap-select-country.min.css">
</head>
<body>
	<style type="text/css">
		.modal.show {
	 		background-color: #0c0f17d6 !important;
		}

		

		.modal-body {
			padding-left: 3rem;
			padding-right: 3rem;
		}
		
	</style>

	<style>
		.file {
		  visibility: hidden;
		  position: absolute;
		}
	</style>


	

		<div class="modal" id="LoginModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
	        	<div class="modal-header">
	        		<div class="mx-auto text-center">
	        			<img src="images/panda-icon.png" class="mx-auto d-block" width="100" />
	        			<h3>PANDAS FC</h3> 
  					</div>
		      	</div>
		      	<div class="modal-body">
		        	<form action="registro_script.php" method="POST">
		        		<div class="text-center">
		        			<h5>Formulario de registro</h5>
		        		</div>

		        		<!--<div class="form-group">
		        			<label >Imagen de perfil *</label>
			        		<div class="col-sm-6">
						 		<img src="https://placehold.it/80x80" id="preview" class="img-thumbnail">
							</div>

		        			<div>
							  	<div id="msg"></div>
							  	<form method="post" id="image-form">
							    	<input type="file" name="img[]" class="file" accept="image/*">
							    	<div class="input-group my-3">
							      		<input type="text" class="form-control" disabled placeholder="Seleccionar imagen de perfil" id="file">
						      			
						      			<div class="input-group-append">
							        		<button type="button" class="browse btn btn-dark">Elegir</button>
				      					</div>
							    	</div>
							  	</form>
							</div>
						</div>-->

						<div class="form-group">
			  				<label for="inputNombre">Nombre *</label>
				    		<input type="text" class="form-control text-center" name="nombre" d="inputNombre" placeholder="Nombre" maxlength="30" required>
						 </div>		

				  		<div class="form-group">
			  				<label for="inputApellido">Apellidos *</label>
			  				<input type="text" class="form-control text-center" name="apellidos" id="inputApellido" placeholder="Apellidos" maxlength="30" required>
				  		</div>

				  		<div class="form-group">	
				  			<label for="inputCorreo">Correo electrónico *</label>
				  			<input type="email" class="form-control text-center" name="correo" id="inputCorreo" placeholder="Correo electrónico" required>
						 </div>

						<div class="form-group">
				  			<label for="inputContrasena">Contraseña *</label>
				  			<input type="password" class="form-control text-center" name="contrasena" id="inputContrasena" maxlength="16" minlength="8" placeholder="Contraseña" required>
				  			<small id="emailHelp" class="form-text text-muted">(Longitud: 8 a 16 caracteres con formato A-Z. a-z, 0-9)</small>
				  		</div>

						<div class="form-group">
				  			<label for="inputNumeroLicencia">Número de licencia *</label>
				  			<input type="text" class="form-control text-center"  name="licencia" id="inputNumeroLicencia" placeholder="Número de licencia" maxlength="9" required>
						</div>

					  	<div class="form-group">	
				  			<label for="inputTelefono">Tipo de alta *</label>
				  			<select class="form-control" required>
									<option value="1">Entrenador</option>
									<option value="2">Jugador</option>
							</select>
						</div>

						<div class="text-center">
							<label>* TODOS LOS CAMPOS SON OBLIGATORIOS</label>
						</div>

				  		<div class="text-center">
				  			<button type="submit" class="btn btn-primary" >Registrarse</button>
				  		</div>
					</form>
		     	 </div>
		      	<div class="modal-footer">
		      		<div class="mx-auto text-center">
			      		<a class="nav-link" href="index.php">¿Ya tienes una cuenta? Inicia sesión.</a>
		      		</div>
		      	</div>
		    </div>
		  </div>
		</div>

	
	<script>
 		$(document).ready(function() {
       		$('#LoginModal').modal('show');
     	});

     	$(document).on("click", ".browse", function() {
		  var file = $(this).parents().find(".file");
		  file.trigger("click");
		});
		$('input[type="file"]').change(function(e) {
		  var fileName = e.target.files[0].name;
		  $("#file").val(fileName);

		  var reader = new FileReader();
		  reader.onload = function(e) {
		    // get loaded data and render thumbnail.
		    document.getElementById("preview").src = e.target.result;
		  };
		  // read the image file as a data URL.
		  reader.readAsDataURL(this.files[0]);
		});
  	</script>

  
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="src/bootstrap-select-country.js"></script>
	<script src="dist/js/bootstrap-select-country.min.js"></script>
</body>
</html>
