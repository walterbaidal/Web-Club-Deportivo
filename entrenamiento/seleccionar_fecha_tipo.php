<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

include("../database.php");

if ( isset( $_SESSION['id'] ) and isset($_GET['player']) ) {
	$player_id = $_GET['player']; 
	$sql = "select idUsuario, nombre, apellidos from usuario where idUsuario = '$player_id'";
	$result = $mysqli->prepare($sql);
  	$result->execute();
  	$row = $result->get_result();
  	$user = $row->fetch_object();



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

		li:hover {
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

				<h2 class="float-left">Paso 2 de 4</h2>		
				<br><br>					
				<div class="container-fluid text-center"> 
					<hr>
					<h3>Selecciona la fecha y el tipo de entrenamiento</h3>
					<br>
					<form action="jugador_hora_tipo_seleccionado_script.php" method="post">	
						<div class="row">
							<div class="col-md-4">
								<h5 class="card-title text-center">Jugador seleccionado</h5>
								<img class="mx-auto d-block img-fluid" src="../images/jugador/<?php echo $user->idUsuario; ?>.png"  alt="Imagen perfil" width="150px" style="margin: 5%;">
								<p class="card-text text-center"><?php echo $user->nombre; echo " "; echo $user->apellidos ?></p>
								<input type="hidden" name="id" value="<?php echo $user->idUsuario ?>">
							</div>
							<div class="col-md-4">
								<h5 class="card-title text-center">Seleccionar fecha y hora</h5>
								<div class="card-text text-center">
									<input type="datetime-local" name="fecha" required>
								</div>

							</div>
							<div class="col-md-4">
								<h5 class="card-title text-center">Seleccionar tipo de entrenamiento</h5>
								<div class="text-center">
									<ul class="list-group radio-group">
									  <li class="list-group-item radio selected" data-value="1">General</li>
									  <li class="list-group-item radio" data-value="2">Específico</li>
									  <input type="hidden" id="radio-value" name="tipo_entrenamiento" value="1" required/>
									</ul>
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
							<button type="submit"  class="btn btn-primary">Seleccionar tipo ejercicio <img src="../CDI/CDI/6 - Entrenamiento/Siguiente2.png" class="d-inline-block align-items-center" width="20" height="20" alt=""></button>
						</div>
					</form>
				</div>
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