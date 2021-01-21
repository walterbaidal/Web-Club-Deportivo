<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();
include("database.php");

if ( isset( $_SESSION['id'] ) ) {

	$id = $_SESSION['id'];

	if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['foto'])) {
		header("location: perfil.php?foto=true");
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
	      // username and password sent from form 
			$id = $_SESSION['id'];
			$direccion = $mysqli->real_escape_string($_POST['direccion']);
			$telefono = $mysqli->real_escape_string ($_POST['telefono']); 
			$correo = $mysqli->real_escape_string ($_POST['correo']);
			$peso = $mysqli->real_escape_string ($_POST['peso']); 
			$sanciones = $mysqli->real_escape_string ($_POST['sanciones']);
			$lesiones = $mysqli->real_escape_string ($_POST['lesiones']); 


			$sql = "update usuario set direccion = '$direccion', telefono = '$telefono', email = '$correo' , peso = '$peso' , sanciones =  $sanciones, lesiones = $lesiones where idUsuario = '$id'";
			$result = $mysqli->prepare($sql);
			$result->execute();

			header("location: perfil.php?editado=true");
			$editado = true;
			$_SESSION['editado'] = 1;
	      
	}
}

if ( isset( $_SESSION['id'] ) ) {

   
   $message="";
   
  
	$id = $_SESSION['id'];

	$sql = "select nombre, apellidos, lugarnacimiento, fechanacimiento, direccion, telefono, email, foto, numerolicencia, posicion, altura, peso, sanciones, lesiones from usuario where idTipoUsuario = '$id'";
	$result = $mysqli->prepare($sql);
	$result->execute();
	$row = $result->get_result();
	$user = $row->fetch_object();
		
	$mysqli->close();

?>



<!DOCTYPE html>
<html>
<head>
	<title>Menu Pandas F.C</title>
	<link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>

	<style type="text/css">		
		.align-img {
			margin-bottom: 3%;
		}


		.navbar {
			padding: 0 !important;
		}

		.nav-item > a{
			margin: 0.4rem;
		}

		.container {
		    padding-top: 5%;
		}

		.jumbotron {
			margin-top: 2rem;
		}

		.file {
		  visibility: hidden;
		  position: absolute;
		}
	</style>



	<div class="container">
		<div class="toast" id="toast-perfil" style="position: absolute; top: 0; right: 0;" data-autohide="true" data-delay="3000">
			<div class="toast-header">

				<strong class="mr-auto">Editar perfil</strong>
				<small>3 sec ago</small>
			</div>
			<div class="toast-body">
				Se han editado los datos correctamente.
				<img class="align-img rounded mr-2" width="20px" src="https://image.flaticon.com/icons/svg/753/753318.svg">
			</div>
		</div>

		<div class="toast" id="toast-foto" style="position: absolute; top: 0; right: 0;" data-autohide="true" data-delay="3000">
			<div class="toast-header">

				<strong class="mr-auto">Editar foto</strong>
				<small>3 sec ago</small>
			</div>
			<div class="toast-body">
				Se ha editado la foto correctamente.
				<img class="align-img rounded mr-2" width="20px" src="https://image.flaticon.com/icons/svg/753/753318.svg">
			</div>
		</div>

		<?php $opcion = 4; ?>
		<?php include 'navbar.php';?>

		<div class="mt-4 card">
				<div class="card-body">
					<span class="float-left" height="100%">
			  			<h1 class="display-4">Perfil</h1>
			  			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-top: 5px;">
 							<img src="CDI/CDI/9 - Perfil - Jugador/Editar.png" width="18" height="18" class="d-inline-block align-items-center align-img" alt="">
		        			&nbsp;Editar perfil
						</button>
					</span>
					<div class="float-right">
						<img src="images/jugador/<?php echo ($_SESSION['id']); ?>.png"  alt="Imagen perfil" width="100px">
						<br>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fotoModal" style="margin-top: 5px;">
							<img src="CDI/CDI/9 - Perfil - Jugador/Editar.png" width="18" height="18" class="d-inline-block align-items-center align-img" alt="">&nbsp;Editar foto
						</button>
						<div class="modal fade" tabindex="-1" id="fotoModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-sm">
						    <div class="modal-content">
						    	<div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Editar foto</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          	<span aria-hidden="true">&times;</span>
							        </button>
						      	</div>
						      	<form action=" " method="post" id="image-form">
							    	<div class="modal-body">

								      	<div class="col-sm-12">
									 		<img src="images/jugador/<?php echo ($_SESSION['id']); ?>.png"  alt="Imagen perfil" id="preview" class="img-thumbnail">
										</div>

					        			<div>
										  	<div id="msg"></div>
										  	
										    	<input type="file" name="img[]" class="file" accept="image/*">
										    	<div class="input-group my-3">
										      		<input type="text" class="form-control" disabled placeholder="Seleccionar imagen de perfil" id="file">
									      			
									      			<div class="input-group-append">
										        		<button type="button" class="browse btn btn-dark">Elegir</button>
							      					</div>

							      					<input type="hidden" name="foto" value="1">
										    	</div>
										  	
										</div>
											</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">
								        	<img src="CDI/CDI/9 - Perfil - Jugador/GuardarCambios.png" width="18" height="18" class="d-inline-block align-items-center align-img">
								        	&nbsp;Guardar cambios 
								        </button>
							        </div>
						       	</form>
						    </div>
						  </div>
						</div>
						
					</div>
					
		  			
				</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="mt-4 card">
					<div class="card-body">
						<h5 class="card-title">
							<img src="CDI/CDI/9 - Perfil - Jugador/Datos personales.png" width="20" height="20" class="d-inline-block align-items-center" style="margin-right: 2px; margin-bottom: 4px;">
		        			Datos personales 
		        		</h5>
					</div>

					<ul class="list-group list-group-flush mb-2">
					    <li class="list-group-item"><b>Nombre:</b> <?php echo $user->nombre; ?></li>
					    <li class="list-group-item"><b>Lugar de nacimiento:</b> <?php echo $user->lugarnacimiento; ?></li>
					    <li class="list-group-item"><b>Fecha de nacimiento:</b> <?php echo $user->fechanacimiento; ?></li>
					    <li class="list-group-item"><b>Dirección:</b> <?php echo $user->direccion; ?></li>
					    <li class="list-group-item"><b>Teléfono:</b> <?php echo $user->telefono; ?></li>
					    <li class="list-group-item"><b>Correo electrónico:</b> <?php echo $user->email; ?></li>
				  	</ul>
				</div>
			</div>

			<div class="col-md-6">
				<div class="mt-4 card">
					<div class="card-body">
						<h5 class="card-title">
							 <img src="CDI/CDI/9 - Perfil - Jugador/Datos Deportivos.png" width="20" height="20" class="d-inline-block align-items-center" style="margin-right: 2px; margin-bottom: 4px;">
							Datos deportivos
						</h5>
					</div>

					<ul class="list-group list-group-flush mb-2">
					    <li class="list-group-item"><b>Posición de juego:</b> <?php echo $user->posicion; ?></li>
					    <li class="list-group-item"><b>Número de licencia:</b> <?php echo $user->numerolicencia; ?></li>
					    <li class="list-group-item"><b>Altura:</b> <?php echo $user->altura; ?></li>
					    <li class="list-group-item"><b>Peso:</b> <?php echo $user->peso; ?></li>
					    <li class="list-group-item"><b>Sanciones:</b> <?php echo $user->sanciones; ?></li>
					    <li class="list-group-item"><b>Lesiones:</b> <?php echo $user->lesiones; ?></li>
				  	</ul>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Editar perfil</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form action ="" method = "post">
	      	<div class="modal-body">
    		
	        	<label for="direccion">Dirección</label>
	  			<div class="form-group input-group">
	  				<div class="input-group-prepend">
					    <span class="input-group-text"><img src="CDI/CDI/9 - Perfil - Jugador/Direccion.png"  width="20" height="20"/></span>
		  			</div>
	    			<input type="text" name="direccion" class="form-control text-center" id="direccion-input" aria-describedby="direccion" placeholder="Dirección" maxlength="35" value="<?php echo $user->direccion; ?>" required>
	    			<button type="button" class="btn btn-secondary" id="direccion" onclick="resetInput(this.id)" data-toggle="tooltip" data-placement="bottom" title="Limpiar campo de texto">
	    				<img src="CDI/CDI/9 - Perfil - Jugador/Borrar.png"  width="18" height="18"/>
	    			</button>
		    		<div class="valid-feedback">
				        Correcto!
			      	</div>
			      	<div class="invalid-feedback">
				        Este campo no puede estar vacio.
			      	</div>
		  		</div>

		  		<label for="telefono">Teléfono</label>
	  			<div class="form-group input-group">
	  				<div class="input-group-prepend">
					    <span class="input-group-text"><img src="CDI/CDI/9 - Perfil - Jugador/Telefono.png"  width="20" height="20"/></span>
		  			</div>
		    		<input type="number" name="telefono" class="form-control text-center" id="telefono-input" placeholder="Teléfono" maxlength="9" value="<?php echo $user->telefono; ?>" required>
		    		<button type="button" class="btn btn-secondary" id="telefono" onclick="resetInput(this.id)" data-toggle="tooltip" data-placement="bottom" title="Limpiar campo de texto">
		    			<img src="CDI/CDI/9 - Perfil - Jugador/Borrar.png"  width="18" height="18"/>
		    		</button>
		    		<div class="valid-feedback">
				        Correcto!
			      	</div>
			      	<div class="invalid-feedback">
				        Este campo no puede estar vacio.
				    </div>
		  		</div>

		  		<label for="correo">Correo electrónico</label>
	  			<div class="form-group input-group">
	  				<div class="input-group-prepend">
					    <span class="input-group-text"><img src="CDI/CDI/1 - Login/Correo Electronico.png"  width="20" height="20"/></span>
		  			</div>
		    		<input type="email" name="correo" class="form-control text-center" id="correo-input" aria-describedby="correo" maxlength="35" placeholder="Correo Electronico" value="<?php echo $user->email; ?>" required>
		    		<button type="button" class="btn btn-secondary" id="correo" onclick="resetInput(this.id)" data-toggle="tooltip" data-placement="bottom" title="Limpiar campo de texto">
		    			<img src="CDI/CDI/9 - Perfil - Jugador/Borrar.png"  width="18" height="18"/>
		    		</button>
		    		<div class="valid-feedback">
				        Correcto!
			      	</div>
			      	<div class="invalid-feedback">
				        Los datos introducidos no son correctos!
			      	</div>
		  		</div>

				<label for="correo">Peso</label>
		  		<div class="form-group input-group">
	  				<div class="input-group-prepend">
					    <span class="input-group-text"><img src="CDI/CDI/9 - Perfil - Jugador/Peso.png"  width="20" height="20"/></span>
		  			</div>
	    			<input type="text" name="peso" class="form-control text-center" id="peso-input" aria-describedby="peso" placeholder="Peso" maxlength="6" value="<?php echo $user->peso; ?>" required>
	    			<button type="button" class="btn btn-secondary" id="peso" onclick="resetInput(this.id)" data-toggle="tooltip" data-placement="bottom" title="Limpiar campo de texto">
	    				<img src="CDI/CDI/9 - Perfil - Jugador/Borrar.png"  width="18" height="18"/>
	    			</button>
		    		<div class="valid-feedback">
				        Correcto!
			      	</div>
			      	<div class="invalid-feedback">
				        Este campo no puede estar vacio!
			      	</div>
		  		</div>

		  		<label for="telefono">Sanciones</label>
	  			<div class="form-group input-group">
	  				<div class="input-group-prepend">
					    <span class="input-group-text"><img src="CDI/CDI/8 - Plantilla - Entrenador/SancionNegro.png"  width="23" /></span>
		  			</div>
		    		<input type="number" name="sanciones" class="form-control text-center" id="sanciones-input" placeholder="Sanciones" maxlength="5" value="<?php echo $user->sanciones; ?>" required>
		    		<button type="button" class="btn btn-secondary" id="sanciones" onclick="resetInput(this.id)" data-toggle="tooltip" data-placement="bottom" title="Limpiar campo de texto">
		    			<img src="CDI/CDI/9 - Perfil - Jugador/Borrar.png"  width="18" height="18"/>
		    		</button>
		    		<div class="valid-feedback">
				        Correcto!
			      	</div>
			      	<div class="invalid-feedback">
				        Este campo no puede estar vacio.
				    </div>
		  		</div>

		  		<label for="telefono">Lesiones</label>
	  			<div class="form-group input-group">
	  				<div class="input-group-prepend">
					    <span class="input-group-text"><img src="CDI/CDI/8 - Plantilla - Entrenador/Lesionado.png"  width="20" height="20"/></span>
		  			</div>
		    		<input type="number" name="lesiones" class="form-control text-center" id="lesiones-input" placeholder="Lesiones" maxlength="5" value="<?php echo $user->lesiones; ?>" required>
		    		<button type="button" class="btn btn-secondary" id="lesiones" onclick="resetInput(this.id)" data-toggle="tooltip" data-placement="bottom" title="Limpiar campo de texto">
		    			<img src="CDI/CDI/9 - Perfil - Jugador/Borrar.png"  width="18" height="18"/>
		    		</button>
		    		<div class="valid-feedback">
				        Correcto!
			      	</div>
			      	<div class="invalid-feedback">
				        Este campo no puede estar vacio.
				    </div>
		  		</div>
	        
	      </div>
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">
		        	<img src="CDI/CDI/9 - Perfil - Jugador/GuardarCambios.png" width="18" height="18" class="d-inline-block align-items-center align-img">
		        	&nbsp;Guardar cambios 
		        	
		        </button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>

	<?php if (isset($_GET['editado'])) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
			  $('#toast-perfil').toast('show');
			});
		</script>		
	<?php } ?>

	<?php if (isset($_GET['foto'])) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
			  $('#toast-foto').toast('show');
			});
		</script>		
	<?php } ?>

	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})

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

	<script type="text/javascript">
		function resetInput(id) {
	 		document.getElementById(id+"-input").value="";
		}
	</script>

	<script>
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
</body>
</html>

<?php

} else {
    // Redirect them to the login page
    header("Location: index.php");
}

?>