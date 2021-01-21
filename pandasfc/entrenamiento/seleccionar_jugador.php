<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

include("../database.php");

if ( isset( $_SESSION['id'] ) ) {
	$sql = "select idUsuario, nombre from usuario where idTipoUsuario = 2";
	$mysqli->multi_query($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu Pandas F.C</title>
	<link rel="stylesheet" href="../css/navbar.css"/>
	<link rel="stylesheet" type="text/css" href="../css/carousel-votar.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>

	<style type="text/css">

		.carousel {
		  margin: 1.5rem;
		}
		.carousel-inner {
		  height: auto;
		  margin-left: 10px;
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
		<?php $opcion = 7; ?>
		<?php include 'navbar.php';?>

		<div class="mt-4 pb-4 pt-2 card">
			<div class="card-body">
				<div class="float-left">
			  		<h1 class="display-4">Entrenamiento</h1>
				</div>
				<div class="float-right">
					<img class="img-fluid" src="../CDI/CDI/3 - Menú principal - Jugador/Entrenamiento.png" width="150px">
				</div>
				
			</div>
		</div>

		<div class="mt-4 card">
			<div class="card-body">	
				<h2 class="float-left">Paso 1 de 4</h2>		
					<br><br>
				
				<form action="jugador_seleccionado_script.php" method="post">					
					<div class="container-fluid text-center"> 
						<hr>
						<h3>Selecciona el jugador al que asignar un entrenamiento</h3>
						<br>
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
						                		
									  			<input class="form-check-input" type="radio" name="player" id="exampleRadios1" value="<?php echo $user[0]; ?>" required <?php if($i == 0) { echo "checked"; } ?>>
									  			<img style="width: 80%;" class="img-fluid mx-auto d-bloc" src="../images/jugador/<?php echo $user[0]; ?>.png" alt="slide <?php echo $i; ?>">
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
					        	<img src="../CDI/CDI/6 - Entrenamiento/Anterior.png" width="30px">
					            <i class="fa fa-chevron-left fa-lg text-muted"></i>
					            <span class="sr-only">Previous</span>
					        </a>
					        <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
					        	<img src="../CDI/CDI/6 - Entrenamiento/Siguiente.png" width="30px">

					            <i class="fa fa-chevron-right fa-lg text-muted"></i>
					            <span class="sr-only">Next</span>
					        </a>
				    </div>
				</div>

				<div class="float-left">
				  	<a href="javascript:history.back()" class="btn btn-primary">
						<img src="../CDI/CDI/6 - Entrenamiento/Volver atrás.png" class="d-inline-block align-items-center" width="20" height="20" alt="">
						Volver a entrenamiento
					</a>
				</div>
				<div class="text-right">
					<button type="submit"  class="btn btn-primary">Seleccionar fecha y tipo</button>
				</div>	
			</form>
				  	
				
			</div>
		</div>
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