<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['id'] ) ) {

	$id_usuario = $_SESSION['id'];
    $votado = false;
	include("database.php");

	if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['player']) and isset($_POST['votacion']) ) {
		// username and password sent from form 

		$player = $mysqli->real_escape_string($_POST['player']);
		$votacion = $mysqli->real_escape_string ($_POST['votacion']); 

		$sql1 = "update ranking set puntuacionacumaluda = puntuacionacumaluda + '$votacion' where idUsuario = '$player'";
		$update_ranking = $mysqli->prepare($sql1);
		$update_ranking->execute();

		$sql2 = "update usuario set votado = 1 where idUsuario = '$id_usuario'";
		$update_votacion = $mysqli->prepare($sql2);
		$update_votacion->execute();


		header("location: menu.php?votado=true");
		$votado = true;
		$_SESSION['votado'] = 1;
   }

	$sql = "select idUsuario, nombre from usuario where idTipoUsuario = 2";
	$mysqli->multi_query($sql);



?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu Pandas F.C</title>
	<link rel="stylesheet" type="text/css" href="css/carousel-votar.css"/>
	<link rel="stylesheet" type="text/css" href="css/navbar.css"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>

	<style type="text/css">
		.align-img {
			margin-bottom: 3%;
		}


		.grid-container { height: 100%; margin: 0; }

		

		.grid-container *:after { 
		 position: absolute;
		 top: 0;
		 left: 0;
		}

		.grid-container {
		  display: grid;
		  grid-template-columns: 1fr;
		  grid-template-rows: 1fr 1fr;
		  grid-template-areas: "Perfil" "Ranking";
		}

		.Perfil { grid-area: Perfil; }

		.Ranking { grid-area: Ranking; }

		.carousel {
		  margin: 1.5rem;
		}
		.carousel-inner {
		  height: auto;
		}

		.carousel-control-prev {
		  margin-left: -65px;
		}

		.carousel-control-next {
		  margin-right: -65px;
		}
		
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
	</style>



	<div class="container">
		<div class="toast" style="position: absolute; top: 0; right: 0;" data-autohide="false">
			<div class="toast-header">

				<strong class="mr-auto">Votación</strong>
				<small>3 sec ago</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="toast-body">
				Tu votación se ha realizado con éxito
				<img class="align-img rounded mr-2" width="20px" src="https://image.flaticon.com/icons/svg/753/753318.svg">
			</div>
		</div>

		<?php $opcion = 1; ?>
	  	<?php include 'navbar.php';?>
	

		<div class="row">
			<div class="col-md-6"> 	
				<div class="mt-2 card">
					<div class="card-body">
						<div class="float-left">
							<h5 class="card-title">Calendario</h5>
							<p class="card-text">This is some text within a card body.</p>	
						</div>
							
						<img class ="float-right" src="https://www.freeiconspng.com/uploads/calendar-image-png-3.png" style="width: 20%;">			
					</div>	
				</div>
			</div>


			<div class="col-md-6">
				<div class="mt-2 card">
					<div class="card-body">
						<h1 class="text-center">Proximo partido  <?php echo($_SESSION['tipo_usuario']); ?></h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
						<?php if ($_SESSION['votado'] == 0 and $_SESSION['tipo_usuario'] == 2 ) { ?>
						<div class="text-center">
							<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#VotarModal">
							  	¡Votar al mejor jugador!
							</button>
						</div>
						<?php } ?>

						<div class="modal fade" id="VotarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						      	<div class="text-center">
						        	<h5 class="modal-title" id="exampleModalLabel"><b>¡Vota al mejor jugador del último partido!</b></h5>
						        </div>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      	<form action = "" method = "post" class="needs-validation" novalidate>
							      	<div class="modal-body">
								      	<div class="text-center">
						        			<h5>Selecciona al jugador</h5>
						        		</div>

					        			
											<div class="container-fluid">
											    <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="false">
											        <div class="carousel-inner row w-10 mxauto" role="listbox">
														<?php 
															$i = 0;
															do {
																if($result = $mysqli->store_result()) {
														 			while ($user = $result->fetch_row()) {
													 	?>
												            <div class="carousel-item col-md-4 <?php if($i == 0) { echo "active"; } ?>">
												                <div class="form-check">
												                	<label class="image-radio" title="<?php echo $user[1]; ?>">
												                		
															  			<input class="form-check-input" type="radio" name="player" id="exampleRadios1" value="<?php echo $user[0]; ?>" <?php if($i == 0) { echo "checked"; } ?>>
															  			<img class="img-fluid mx-auto d-bloc" src="images/jugador/<?php echo $user[0]; ?>.png" alt="slide <?php echo $i; ?>">
															  		</label>
																</div>
																<div class="text-center">
																	<label class="form-check-label" for="exampleRadios1">
																		<?php echo $user[1]; ?>
															  		</label>
															  	</div>
												            </div>

												   		<?php 		
																	$i++;
																	}
																	$result->free();
																}
																
															} while($mysqli->next_result());
												 		?>

											        </div>
												        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
												        	<img src="CDI/CDI/6 - Entrenamiento/Anterior.png" width="30px">
												            <i class="fa fa-chevron-left fa-lg text-muted"></i>
												            <span class="sr-only">Previous</span>
												        </a>
												        <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
												        	<img src="CDI/CDI/6 - Entrenamiento/Siguiente.png" width="30px">

												            <i class="fa fa-chevron-right fa-lg text-muted"></i>
												            <span class="sr-only">Next</span>
												        </a>
											    </div>
											</div>
											<hr>
											<div class="text-center">
							        			<h5>Selecciona puntuación</h5>
							        		</div>

											<div class="d-flex justify-content-center my-4">
											  	<div class="range-field w-75">
											    	<input id="slider11" name="votacion" class="form-control-range border-0" type="range" min="1" max="10" />
											 	</div>
											  	<span class="font-weight-bolder text-primary ml-2 valueSpan" style="margin-top: -5px; font-size: 20px;"></span>
											</div>
									</div>
								      	
						      		<div class="modal-footer">
							        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal">
							        		<img src="CDI/CDI/3 - Menú principal - Jugador/Votar.png" width="18" height="18" class="d-inline-block align-items-center align-img">
								        	Votar
								        	
								        </button>
							      	</div>

							      	<!-- Modal -->
									<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog modal-sm" role="document">
									    <div class="modal-content" style="margin-top: 50%;">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Votación</h5>
									      </div>
									      <div class="modal-body">
									        ¿Estás seguro que deseas votar a este jugador?
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
									        <button type="submit" class="btn btn-success">Si</button>
									      </div>
									    </div>
									  </div>
									</div>
								</form>						      
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">

			<div class="col-md-3">
				<div class="mt-2 card notificacion">
					<div class="card-body">
						<h5 class="card-title">Notificacion</h5>
						<p class="card-text">This is some text within a card body. This is some text within a card body. This is some text within a card body. This is some text within a card body. This is some text within a card body. </p>	
					</div>	
				</div>
			</div>

			<div class="col-md-3 grid-container">
						<div class="Perfil">
							<div class="mt-2 card">
								<div class="card-body">
									<h5 class="card-title">Perfil</h5>
									<a class="stretched-link" href="perfil.php">
										<img class="mx-auto d-block img-fluid" src="images/jugador/<?php echo ($_SESSION['id']); ?>.png"  alt="Imagen perfil" width="150px">
									</a>
								</div>	
							</div>
						</div>	

					<div class="Ranking">
						<div class="mt-2 card">
							<div class="card-body">
								<h5 class="card-title">Ranking</h5>
								<p class="card-text">This is some text within a card body.</p>	
							</div>	
						</div>
					</div>
			</div>
					
			<div class="col-md-6">
				<div class="mt-2 entrenamiento">
					<div class="card">
							<div class="card-body">
								<h5 class="card-title">Entrenamiento</h5>
								<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		

		<?php if (isset($_GET['votado'])) { ?>
			<script type="text/javascript">
				$(document).ready(function(){
				  $('.toast').toast('show');
				});
			</script>		
		<?php } ?>

	</div>

	

	<script type="text/javascript">
		$('#carouselExample').on('slide.bs.carousel', function (e) {

		    /*

		    CC 2.0 License Iatek LLC 2018
		    Attribution required
		    
		    */

		    var $e = $(e.relatedTarget);
		    
		    var idx = $e.index();
		    console.log("IDX :  " + idx);
		    
		    var itemsPerSlide = 8;
		    var totalItems = $('.carousel-item').length;
		    
		    if (idx >= totalItems-(itemsPerSlide-1)) {
		        var it = itemsPerSlide - (totalItems - idx);
		        for (var i=0; i<it; i++) {
		            // append slides to end
		            if (e.direction=="left") {
		                $('.carousel-item').eq(i).appendTo('.carousel-inner');
		            }
		            else {
		                $('.carousel-item').eq(0).appendTo('.carousel-inner');
		            }
		        }
		    }
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {

		  const $valueSpan = $('.valueSpan');
		  const $value = $('#slider11');
		  $valueSpan.html($value.val());
		  $value.on('input change', () => {

		    $valueSpan.html($value.val());
		  });
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