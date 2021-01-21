<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['id'] ) ) {
	include("database.php");
	$query = "select plantilla_creada, idPartido from partido where idPartido = 1 limit 1";
	$result = $mysqli->prepare($query);
	$result->execute();
	$row = $result->get_result();
	$partido = $row->fetch_object();

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

		.radio.selected{
		    border-color: blue;
		}

		[type=radio] { 
		  position: absolute;
		  opacity: 0;
		  width: 0;
		  height: 0;
		}

		/* IMAGE STYLES */
		[type=radio] + img {
		  cursor: pointer;
		}

		/* CHECKED STYLES */
		[type=radio]:checked + img {
		  outline: 2px solid #f00;
		}

		.form-check {
			padding-left: 0 !important;
		}

	</style>

	<div id="myBtn" title="Scroll para más" >Más info abajo</div>

	    <script>

	      var div = document.getElementById('myBtn');
	      if (div.scrollTop == 0) {
	        document.getElementById("myBtn").style.display = "block";
	      }

	      window.onscroll = function () { scrollFunction() };

	      function scrollFunction() {
	        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	          document.getElementById("myBtn").style.display = "none";
	        } else {
	          document.getElementById("myBtn").style.display = "block";
	        }
	      }
	  	</script>

	<div class="container">

		<div class="toast" id="toast-recordatorio" id="toast-perfil" style="position: absolute; top: 0; right: 0;" data-autohide="true" data-delay="3000">
			<div class="toast-header">

				<strong class="mr-auto">Plantilla</strong>
				<small>3 sec ago</small>
			</div>
			<div class="toast-body">
				Se ha enviado un mensaje de recordatorio a los jugadores.
				<img class="align-img rounded mr-2" width="20px" src="https://image.flaticon.com/icons/svg/753/753318.svg">
			</div>
		</div>

		<div class="toast" id="toast-borrado" id="toast-perfil" style="position: absolute; top: 0; right: 0;" data-autohide="true" data-delay="3000">
			<div class="toast-header">

				<strong class="mr-auto">Plantilla</strong>
				<small>3 sec ago</small>
			</div>
			<div class="toast-body">
				La plantilla ha sido borrada con éxito.
				<img class="align-img rounded mr-2" width="20px" src="https://image.flaticon.com/icons/svg/753/753318.svg">
			</div>
		</div>

		<div class="toast" id="toast-creada" id="toast-perfil" style="position: absolute; top: 0; right: 0;" data-autohide="true" data-delay="3000">
			<div class="toast-header">

				<strong class="mr-auto">Plantilla</strong>
				<small>3 sec ago</small>
			</div>
			<div class="toast-body">
				La plantilla se ha creado correctamente.
				<img class="align-img rounded mr-2" width="20px" src="https://image.flaticon.com/icons/svg/753/753318.svg">
			</div>
		</div>

		<?php $opcion = 6; ?>
		<?php include 'navbar.php';?>

		<div class="mt-4 card">
			<div class="card-body">
				<div class="float-left">
			  		<h1 class="display-4">Plantilla</h1>
				</div>
				<div class="float-right">
					<img class="img-fluid" src="CDI/CDI/3 - Menú principal - Entrenador/Plantilla.png" width="70px">
				</div>
			</div>
		</div>


		<div class="mt-4 card">
			<div class="card-body">
				<h2 class="card-title float-left">Creación de plantilla</h2> 
				<?php if ($partido->plantilla_creada == 1) { ?>
					<form action="borrar_plantilla_script.php" method="post">
						<button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#confirmationModal">
		    				<img src="CDI/CDI/4 - Calendario - Entrenador/Borrar.png"  width="18" height="18"/>&nbsp; Borrar plantilla
		    			</button>

		    			<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-sm" role="document">
						    <div class="modal-content" style="margin-top: 50%;">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Plantilla</h5>
						      </div>
						      <div class="modal-body">
						        ¿Estás seguro que deseas borrar esta plantilla? <br> No podrás recuperarla.
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-danger" data-dismiss="modal">
						        	<img src="CDI/CDI/8 - Plantilla - Entrenador/No disponible.png" class="d-inline-block align-items-center align-img" width="13" height="13" alt="">
							        No
							    </button>
						        <button type="submit" class="btn btn-success">
						        	<img src="CDI/CDI/8 - Plantilla - Entrenador/DisponibleBlanco.png" class="d-inline-block align-items-center align-img" width="13" height="13" alt="">
							        Si
							    </button>
						      </div>
						    </div>
						  </div>
						</div>
	    			</form>
	    		<?php } ?>
				<br><br><br>
					<div class="row">
						<?php if ($partido->plantilla_creada == 0) { ?>
							<div class="col-md-6">
								<div class="text-center">
									<h5 class="card-title">Se necesita un mínimo de 13 jugadores disponibles para poder crear una plantilla.</h5>
									<br>
									<form action="seleccionar_sistema_juego.php" methor="POST">
										<button type="submit" class="btn btn-outline-primary" 

											<?php if ( isset($_SESSION['disponibilidad'])) { ?>  
													enabled
											<?php } else { ?> 
													disabled 
											<?php } ?>

											>Crear plantilla</button>
									</form>
									<br>
									<div class="form-text text-muted"><b>¡Aún no se ha creado ninguna plantilla!</b></div>
								</div>
							</div>
							<div class="col-md-6">
								<h5 class="card-title text-center">Número de jugadores disponibles:

									<?php if ( isset($_SESSION['disponibilidad'])) { ?> 
										<span class="badge badge-pill badge-success"> 14 / 17 
									<?php } else { ?> 
										<span class="badge badge-pill badge-warning"> 0 / 17 
									<?php } ?>

								</span> (Min: 13)</h5>
								<br>
								<div class="text-center">
									<div class="btn-group-vertical">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" <?php if ( isset($_SESSION['disponibilidad'])) { echo "disabled"; } else { echo "enabled"; } ?>>
	  										Comprobar disponibilidad
										</button>
										<br>
										<button type="submit"  class="btn btn-secondary" data-toggle="modal" data-target="#recordatorioModal" <?php if ( isset($_SESSION['disponibilidad'])) { echo "enabled"; } else { echo "disabled"; } ?>>Enviar recordatorio</button>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="col-md-6">
								<div class="text-center">
									<h5 class="card-title">Plantilla para el próximo encuentro.</h5>
									<br>
									<img src="images/sistemas/433.png" alt="">
							
									<br>
									<br>
									<div class="form-text text-muted"><b>La plantilla seleccionada para el próximo encuentro es la 4-3-3.</b></div>
								</div>
							</div>
							<div class="col-md-3">
								<h5 class="card-title text-center">Jugadores titulares</h5>

								<div class="list-group">
									<?php 
										$query = "select usuario.nombre, usuario.apellidos, titular, posicion from usuario 
													join plantilla on (usuario.idUsuario = plantilla.idUsuario) 
													where usuario.idUsuario != 5 and usuario.idUsuario != 9 and usuario.idUsuario != 12 and titular = 1";
										$mysqli->multi_query($query);
										do {
									        if ($result = $mysqli->store_result()) {
									            while ($user = $result->fetch_row()) { 
					            	?>
 										<a href="#" class="list-group-item list-group-item-action <?php if ($user[2] == 0) echo "list-group-item-dark"; ?>">
 											<?php echo $user[0]; echo " "; echo $user[1];?>
 												
										</a>
 									<?php 
 									 			}
									            $result->close();
									        }
								    	} while ($mysqli->next_result());
								 	?>
 								</div>

							</div>
							<div class="col-md-3">
								<h5 class="card-title text-center">Jugadores suplentes</h5>

								<div class="list-group">
									<?php 
										$query = "select usuario.nombre, usuario.apellidos, titular, posicion from usuario 
													join plantilla on (usuario.idUsuario = plantilla.idUsuario) 
													where usuario.idUsuario != 5 and usuario.idUsuario != 9 and usuario.idUsuario != 12 and titular = 0";
										$mysqli->multi_query($query);
										do {
									        if ($result = $mysqli->store_result()) {
									            while ($user = $result->fetch_row()) { 
					            	?>
 										<a href="#" class="list-group-item list-group-item-action <?php if ($user[2] == 0) echo "list-group-item-action"; ?>">
 											<?php echo $user[0]; echo " "; echo $user[1];?>
 												
										</a>
 									<?php 
 									 			}
									            $result->close();
									        }
								    	} while ($mysqli->next_result());
								 	?>
 								</div>
							</div>
						<?php } ?>

						
					</div>
				
			</div>


		</div>

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Comprobación de disponibilidad</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        Se va a enviar un mensaje a todos los jugadores para confirmar la disponibilidad al siguiente encuentro. ¿Estás seguro que deseas realizar esta acción?
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <form action="disponibilidad_script.php" method="post">
		       		<button type="submit" class="btn btn-primary">Confirmar</button>
		       	</form>
		      </div>
		    </div>
		  </div>
		</div>


		<div class="modal fade" id="recordatorioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Recordatorio</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        Se va a enviar un mensaje a todos los jugadores para recordarles que tienen partido próximamente. ¿Estás seguro que deseas realizar esta acción?
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <form action="recordatorio_script.php" method="post">
		       		<button type="submit" class="btn btn-primary">Confirmar</button>
		       	</form>
		      </div>
		    </div>
		  </div>
		</div>


	</div>

	<?php if (isset($_GET['recordatorio'])) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
			  $('#toast-recordatorio').toast('show');
			});
		</script>		
	<?php } ?>

	<?php if (isset($_GET['creada'])) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
			  $('#toast-creada').toast('show');
			});
		</script>		
	<?php } ?>

	<?php if (isset($_GET['delete'])) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
			  $('#toast-borrado').toast('show');
			});
		</script>		
	<?php } ?>
	<script>
		$('.radio-group .radio').click(function(){
	    $(this).parent().find('.radio').removeClass('selected');
	    $(this).addClass('selected');
	    var val = $(this).attr('data-value');
	    //alert(val);
	    $(this).parent().find('input').val(val);
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


