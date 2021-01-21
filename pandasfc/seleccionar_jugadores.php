<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();
include("database.php");
if ( isset( $_SESSION['id'] )  and isset($_GET['plantilla'])  ) {
	$plantilla =  $_GET['plantilla']; 

	if($plantilla == '433'){
		$titulo = "4-3-3";
		$mensaje = "Selecciona 3 delanteros, 3 mediocentros, 4 defensas y 1 portero.";
	} elseif ($plantilla == '424') {
		$titulo = "4-2-4";
		$mensaje = "Selecciona 4 delanteros, 2 mediocentros, 4 defensas y 1 portero.";
	} elseif ($plantilla == "442") {
		$titulo = "4-4-2";
		$mensaje = "Selecciona 2 delanteros, 4 mediocentros, 4 defensas y 1 portero.";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu Pandas F.C</title>
	<link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" type="text/css" href="css/carousel-votar.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>

	<style type="text/css">

		
		.image-radio {
			margin-top: .5rem;
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

		.btn:focus {
 			outline: none !important;
		}
	</style>

	<div class="container">
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


		<div class="mt-4 card mb-4">
			<div class="card-body">	
				<h2 class="float-left">Paso 2 de 2</h2>		
					<br><br>	
				<div class="container-fluid text-center"> 
					<hr>
					<h4 class="text-right" style="margin-right: 1%;"><?php echo $mensaje; ?></h4>
					<br>

					<div class="row">
							<div class="col-md-3 text-center">
								
								<img src="images/sistemas/<?php echo $plantilla; ?>.png" width="150" alt="" class="mb-3">

								<h5 class="card-title">Sistema de juego seleccionado: <?php echo $titulo; ?></h5>
							</div>
						
			
							<div class="col-md-2 offset-md-1">
								<div class="text-center">
									<h5>DELANTEROS</h5>
									<div class="btn-group-vertical btn-group-toggle" data-toggle="buttons">
										<?php 
											$query = "select usuario.idUsuario, usuario.nombre, estadojugador.sancionado, estadojugador.lesionado, estadojugador.ausente from usuario join estadojugador on (usuario.idUsuario = estadojugador.idUsuario) where posicion = 'Delantero'";
											$mysqli->multi_query($query);
											do {
										        if ($result = $mysqli->store_result()) {
										            while ($user = $result->fetch_row()) {
										?>
														<label class="btn btn-outline-primary btn-block">
									    					<input type="checkbox" name="options" id="option1" value="<?php echo $user[0] ?>" autocomplete="off" <?php if($user[2] == 1 or $user[3] == 1 or $user[4] == 1) { echo "class='disabled' disabled";} ?>> 
									    					<div class="float-left"><?php echo $user[1];?></div>
									    					&nbsp;&nbsp;&nbsp;&nbsp;

									    					<div class="float-right">
									    						<?php 
									    							if($user[2] == 1){
									    						?>	
									    							<img src="CDI/CDI/8 - Plantilla - Entrenador/SancionadoWhite.png" width="20" alt="">
									    						<?php  
									    							} elseif ($user[3] == 1) {
									    						?>
																	<img src="CDI/CDI/8 - Plantilla - Entrenador/Lesionado.png" width="20" alt="">
																<?php
									    							} elseif ($user[4] == 1){
									    					 	?>
									    							<img src="CDI/CDI/8 - Plantilla - Entrenador/Ausente.png" width="17" alt="">
										    					<?php 
										    						} else {
										    					?>
																	<img src="CDI/CDI/8 - Plantilla - Entrenador/Disponible.png" width="20" alt="">
										    					<?php 
										    						}
										    					?>

									    					</div>
									  					</label>
										<?php
										            }
										            $result->close();
										        }
									    	} while ($mysqli->next_result());
									 	?>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="text-center">
									<h5>MEDIOCENTRO</h5>
									<div class="btn-group-vertical btn-group-toggle" data-toggle="buttons">
										<?php 
											$query = "select usuario.idUsuario, usuario.nombre, estadojugador.sancionado, estadojugador.lesionado, estadojugador.ausente from usuario join estadojugador on (usuario.idUsuario = estadojugador.idUsuario) where posicion = 'Mediocentro';";
											$mysqli->multi_query($query);
											do {
										        if ($result = $mysqli->store_result()) {
										            while ($user = $result->fetch_row()) {
										?>
														<label class="btn btn-outline-primary btn-block">
									    					<input type="checkbox" name="options" id="option1" value="<?php echo $user[0] ?>" autocomplete="off" <?php if($user[2] == 1 or $user[3] == 1 or $user[4] == 1) { echo "class='disabled' disabled";} ?>> 
									    					<div class="float-left"><?php echo $user[1];?></div>
									    					&nbsp;&nbsp;&nbsp;&nbsp;
									    					<div class="float-right">
									    						<?php 
									    							if($user[2] == 1){
									    						?>	
									    							<img src="CDI/CDI/8 - Plantilla - Entrenador/SancionadoWhite.png" width="20" alt="">
									    						<?php  
									    							} elseif ($user[3] == 1) {
									    						?>
																	<img src="CDI/CDI/8 - Plantilla - Entrenador/Lesionado.png" width="20" alt="">
																<?php
									    							} elseif ($user[4] == 1){
									    					 	?>
									    							<img src="CDI/CDI/8 - Plantilla - Entrenador/Ausente.png" width="17" alt="">
										    					<?php 
										    						} else {
										    					?>
																	<img src="CDI/CDI/8 - Plantilla - Entrenador/Disponible.png" width="20" alt="">
										    					<?php 
										    						}
										    					?>
									    					</div>
									  					</label>
										<?php
										            }
										            $result->close();
										        }
									    	} while ($mysqli->next_result());
									 	?>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="text-center">
									<h5>DEFENSAS</h5>
									<div class="btn-group-vertical btn-group-toggle" data-toggle="buttons">
										<?php 
											$query = "select usuario.idUsuario, usuario.nombre, estadojugador.sancionado, estadojugador.lesionado, estadojugador.ausente from usuario join estadojugador on (usuario.idUsuario = estadojugador.idUsuario) where posicion = 'Defensa';";
											$mysqli->multi_query($query);
											do {
										        if ($result = $mysqli->store_result()) {
										            while ($user = $result->fetch_row()) {
										?>
														<label class="btn btn-outline-primary btn-block">
									    					<input type="checkbox" name="options" id="option1" value="<?php echo $user[0] ?>" autocomplete="off" <?php if($user[2] == 1 or $user[3] == 1 or $user[4] == 1) { echo "class='disabled' disabled";} ?>> 
									    					<div class="float-left"><?php echo $user[1];?></div>
									    					&nbsp;&nbsp;&nbsp;
									    					<div class="float-right">
									    						<?php 
									    							if($user[2] == 1){
									    						?>	
									    							<img src="CDI/CDI/8 - Plantilla - Entrenador/SancionadoWhite.png" width="20" alt="">
									    						<?php  
									    							} elseif ($user[3] == 1) {
									    						?>
																	<img src="CDI/CDI/8 - Plantilla - Entrenador/Lesionado.png" width="20" alt="">
																<?php
									    							} elseif ($user[4] == 1){
									    					 	?>
									    							<img src="CDI/CDI/8 - Plantilla - Entrenador/Ausente.png" width="17" alt="">
										    					<?php 
										    						} else {
										    					?>
																	<img src="CDI/CDI/8 - Plantilla - Entrenador/Disponible.png" width="20" alt="">
										    					<?php 
										    						}
										    					?>
									    					</div>
									  					</label>
										<?php
										            }
										            $result->close();
										        }
									    	} while ($mysqli->next_result());
									 	?>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="text-center">
									<h5>PORTEROS</h5>
									<div class="btn-group-vertical btn-group-toggle" data-toggle="buttons">
										<?php 
											$query = "select usuario.idUsuario, usuario.nombre, estadojugador.sancionado, estadojugador.lesionado, estadojugador.ausente from usuario join estadojugador on (usuario.idUsuario = estadojugador.idUsuario) where posicion = 'Portero';";
											$mysqli->multi_query($query);
											do {
										        if ($result = $mysqli->store_result()) {
										            while ($user = $result->fetch_row()) {
										?>
														<label class="btn btn-outline-primary btn-block">
									    					<input type="checkbox" name="options" id="option1" value="<?php echo $user[0] ?>" autocomplete="off" <?php if($user[2] == 1 or $user[3] == 1 or $user[4] == 1) { echo "class='disabled' disabled";} ?>> 
									    					<div class="float-left"><?php echo $user[1];?></div>
									    					&nbsp;&nbsp;&nbsp;&nbsp;
									    					<div class="float-right">
									    						<?php 
									    							if($user[2] == 1){
									    						?>	
									    							<img src="CDI/CDI/8 - Plantilla - Entrenador/SancionadoWhite.png" width="20" alt="">
									    						<?php  
									    							} elseif ($user[3] == 1) {
									    						?>
																	<img src="CDI/CDI/8 - Plantilla - Entrenador/Lesionado.png" width="20" alt="">
																<?php
									    							} elseif ($user[4] == 1){
									    					 	?>
									    							<img src="CDI/CDI/8 - Plantilla - Entrenador/Ausente.png" width="17" alt="">
										    					<?php 
										    						} else {
										    					?>
																	<img src="CDI/CDI/8 - Plantilla - Entrenador/Disponible.png" width="20" alt="">
										    					<?php 
										    						}
										    					?>
									    					</div>
									  					</label>
										<?php
										            }
										            $result->close();
										        }
									    	} while ($mysqli->next_result());
									 	?>
									</div>
								</div>
							</div>
					</div>
					
					<br>	


				  	<div class="float-left">
					  	<a href="javascript:history.back()" class="btn btn-primary">
							<img src="CDI/CDI/6 - Entrenamiento/Volver atrás.png" class="d-inline-block align-items-center" width="20" height="20" alt="">
							Volver a seleccion de sistema
						</a>
					</div>
					<div class="text-right">
						<form action="crear_plantilla_script.php" method="post">
							<button type="submit"  class="btn btn-primary">Crear plantilla</button>
						</form>
					</div>	
							
			</div>
		</div>
	</div>


	<script>
		$("input:checkbox").click(function() {
		var bol = $("input:checkbox:checked").length >= 11;     
		$("input:checkbox").not(":checked").attr("disabled",bol);
		$("input:checkbox").not(":checked").parentElement.attr("class", "disabled")
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