<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['id'] ) ) {

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
		  outline: 4px solid blue;
		}

		.form-check {
			padding-left: 0 !important;
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
				<form action="sistema_seleccionado_script.php" method="post">		
					<h2 class="float-left">Paso 1 de 2</h2>		
					<br><br>	
					<div class="container-fluid text-center"> 
						<hr>
						<h3>Seleccionar sistema de juego</h3>
					    		
					    		<br>
						<div class="row">
				            <div class="col-md-4">
				                <div class="form-check">
				                	<label class="image-radio" title="0">
							  			<input class="form-check-input" type="radio" name="plantilla" id="exampleRadios1" value="433"  required>
							  			<img class="img-fluid mx-auto d-bloc" src="images//sistemas/433.png" width="80%" alt="0">
							  		</label>
								</div>
								<div class="text-center">
									<label class="form-check-label" for="exampleRadios1">
										<b style="font-size: 20px;">Sistema de juego 4-3-3</b>
									</label>
							  	</div>
						  	</div>
				          

				           	<div class="col-md-4">
				                <div class="form-check">
				                	<label class="image-radio" title="1">
							  			<input class="form-check-input" type="radio" name="plantilla" id="exampleRadios1" value="424" checked required>
							  			<img class="img-fluid mx-auto d-bloc" src="images/sistemas/424.png " width="80%" alt="1">
							  		</label>
								</div>
								<div class="text-center">
									<label class="form-check-label" for="exampleRadios1">
										<b style="font-size: 20px;">Sistema de juego 4-2-4</b>
									</label>
							  	</div>
						  	</div>
				          

				           	<div class="col-md-4">
				                <div class="form-check">
				                	<label class="image-radio" title="2">
							  			<input class="form-check-input" type="radio" name="plantilla" id="exampleRadios1" value="442" required>
							  			<img class="img-fluid mx-auto d-bloc" src="images//sistemas/442.png " width="80%" alt="2">
							  		</label>
								</div>
								<div class="text-center">
									<label class="form-check-label" for="exampleRadios1">
										<b style="font-size: 20px;">Sistema de juego 4-4-2</b>
									</label>
							  	</div>
						  	</div>
					  	</div>
					  	<br><br>
					  	<div class="float-left">
						  	<a href="javascript:history.back()" class="btn btn-primary">
								<img src="CDI/CDI/6 - Entrenamiento/Volver atrás.png" class="d-inline-block align-items-center align-img" width="20" height="20" alt="">
								Volver a plantilla
							</a>
						</div>
						<div class="text-right">
							<button type="submit"  class="btn btn-primary">Siguiente</button>
						</div>
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