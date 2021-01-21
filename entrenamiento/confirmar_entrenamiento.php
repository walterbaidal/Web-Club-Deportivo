<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

include("../database.php");

if ( isset( $_SESSION['id'] ) and isset($_GET['id']) and isset($_GET['fecha']) and isset($_GET['tipo']) and isset($_GET['ejercicio']) ) {

	$fecha = $_GET['fecha'];
	$tipo_entrenamiento = $_GET['tipo'];
	$id = $_GET['id'];
	$idEjercicio = $_GET['ejercicio'];
	$entrenamiento = "";

	if($tipo_entrenamiento == 1) {
		$entrenamiento = 'General';
	} else {
		$entrenamiento = 'Específico';
	}
	
	$sql = "select usuario.nombre, usuario.apellidos from usuario where idUsuario = '$id'";
	$result = $mysqli->prepare($sql);
	$result->execute();
	$row = $result->get_result();
	$user = $row->fetch_object();
	$result->close();

	$sql2 = "select idEjercicio, nombreEjercicio from ejercicio where idTipoEjercicio = '$idEjercicio'";
	$mysqli->multi_query($sql2);





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
		.radio.selected{
		    border-color: #007bff;
		    background-color: #007bff;
		    color: white;
		}

		.grupo>li:hover {
			color: white;
			cursor: pointer;
			background-color: #007bff;
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

					<h2 class="float-left">Paso 4 de 4</h2>		
					<br><br>					
					<div class="container-fluid text-center"> 
						<hr>
						<form action="guardar_entrenamiento.php" method="post">	
								<div class="row">

									<div class="col-md-4">
										<div class="text-center">
											<h3 class="text-center">Resumen</h3>
											<br>
											<div class="text-center">
												<ul class="list-group">
												  <li class="text-left list-group-item"><b>Jugador:</b> <?php echo $user->nombre; echo " "; echo $user->apellidos ?></li>
												  <li class="text-left list-group-item"><b>Fecha:</b> <?php echo $fecha; ?></li>
												  <li class="text-left list-group-item"><b>Tipo entrenamiento:</b> <?php echo $entrenamiento; ?></li>
												</ul>
											</div>
										</div>
										<div class="form-group">
											<input type="hidden" name="id" value="<?php echo $id; ?>">
											<input type="hidden" name="fecha" value="<?php echo $fecha; ?>">						
											<input type="hidden" name="tipo_entrenamiento" value="<?php echo $tipo_entrenamiento; ?>">
											<input type="hidden" name="tipo_ejercicio" value="<?php echo $idEjercicio; ?>">
										</div>
									</div>
									<div class="col-md-8">
										<div class="text-center">
											<h3 class="text-center">Selecciona un ejercicio:</h3>
											<br>
											<div class="text-center">
												<ul class="list-group radio-group grupo">
													<?php 
														$i = 0;
														do {
															if($resultado = $mysqli->store_result()) {
													 			while ($row_ejercicio = $resultado->fetch_row()) {
												 	?>

												    				<li class="list-group-item radio <?php if ($i == 0) { echo "selected";} ?>" data-value="<?php echo $row_ejercicio[0]; ?>"><?php echo $row_ejercicio[1]; ?></li>

													<?php 		
																if ($i == 0) { $value = $row_ejercicio[0]; }
																$i++;
																}
																$resultado->free();
															}
															
														} while($mysqli->next_result());
													 ?>


												  
												  <input type="hidden" id="radio-value" name="ejercicio" value="<?php echo $value; ?>" required/>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="float-left">
								  	<a href="javascript:history.back()" class="btn btn-primary">
										<img src="../CDI/CDI/6 - Entrenamiento/Volver atrás.png" class="d-inline-block align-items-center" width="20" height="20" alt="">
										Volver a seleccionar jugador
									</a>
								</div>

								<div class="text-right">
									<button type="submit"  class="btn btn-primary">Crear entrenamiento  <img src="../CDI/CDI/Menu/Entrenamiento.png" class="d-inline-block align-items-center"  width="25" alt=""></button>
								</div>	
						</form>
					</div>
				</div>
			</div>



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