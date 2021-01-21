<?php
   include("database.php");
   session_start();
   $message="";
   
   if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['email']) and isset($_POST['contrasena']) ) {
      // username and password sent from form 
      
      $email = $mysqli->real_escape_string($_POST['email']);
      $contrasena = $mysqli->real_escape_string ($_POST['contrasena']); 
      
      $sql = "SELECT idUsuario, idTipoUsuario, contrasena, votado FROM usuario WHERE email = '$email' and contrasena = '$contrasena'";
      
 		$result = $mysqli->prepare($sql);
 		$result->execute();

		
		$row = $result->get_result();
		$user = $row->fetch_object();
			      	
	
		if($user != NULL){	
			if($user->contrasena == $contrasena) {
				$_SESSION['login_user'] = $email;
				$_SESSION['tipo_usuario'] = $user->idTipoUsuario;
				$_SESSION['id'] = $user->idUsuario;
				$_SESSION['votado'] = $user->votado;
				$mysqli->close();

				header("location: menu.php");
			}
	    } else {
	    	$message = "Usuario o contraseña incorrectos" ;
	    }				
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pandas F.C</title>
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
	        			<img src="images/panda-icon.png" class="mx-auto d-block" width="100" />
	        			<h3>PANDAS FC</h3> 
  					</div>
  					
		      	</div>
		      	<div class="modal-body">
		      		<div class="text-center">
  						<h5>Iniciar sesión</h5>
  					</div>
		        	 <form action = "" method = "post" >

		        	 	<?php if($message!="") { ?>

		        	 	<div class="alert alert-danger" role="alert"> <?php echo $message; ?></div>

		        	 	<?php } ?>

		        	 	<label for="inputEmail">Correo electrónico</label>
			  			<div class="form-group input-group">
			  				<div class="input-group-prepend">
							    <span class="input-group-text" id="emailHelp"><img src="CDI/CDI/1 - Login/Correo Electronico.png"  width="20" height="20"/></span>
				  			</div>
				    		<input type="email" name="email" class="form-control text-center" id="inputEmail" aria-describedby="emailHelp" placeholder="Correo electrónico" required>
				    		<div class="valid-feedback">
						        Correcto!
					      	</div>
					      	<div class="invalid-feedback">
						        Los datos introducidos no son correctos!
					      	</div>
				  		</div>

				  		<label for="inputPassword">Contraseña</label>
				  		<small>(A-Z, a-z, 0-9)</small>

			  			<div class="form-group input-group">
			  				<div class="input-group-prepend">
							    <span class="input-group-text" id="emailHelp"><img src="CDI/CDI/1 - Login/Contraseña.png"  width="20" height="20"/></span>
				  			</div>
				    		<input type="password" name="contrasena" class="form-control text-center" id="inputPassword" placeholder="Contraseña" required>
				    		
				  		</div>


			  			<div class="form-group form-check text-center">
				    		<input type="checkbox" class="form-check-input" id="exampleCheck1">
				    		<label class="form-check-label" for="exampleCheck1">Recuerdame</label>
				  		</div>
				  		<div class="text-center">
				  			<input class="btn btn-primary" type="submit" value="Acceder"/>
				  		</div>
					</form>
		     	 </div>
		      	<div class="modal-footer">
		      		<div class="mx-auto text-center">
			      		<a class="nav-link" href="restablecer_contrasena.php">Restablecer contraseña</a>
			      		<a class="nav-link" href="crear_cuenta.php">Crear cuenta</a>
		      		</div>
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