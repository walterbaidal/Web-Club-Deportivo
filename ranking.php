<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();
include("database.php");

if ( isset( $_SESSION['id'] ) ) {
   
   $message="";
   
  
	$id = $_SESSION['id'];

	$sql2 = "select usuario.idUsuario, usuario.nombre, ranking.puntuacionacumaluda from usuario join ranking on usuario.idUsuario = ranking.idUsuario order by puntuacionacumaluda desc limit 1";
	$resultado = $mysqli->prepare($sql2);
	$resultado->execute();
	$row = $resultado->get_result();
	$user_primero = $row->fetch_object();

	$sql = "select nombre, apellidos, foto, puntuacionacumaluda from usuario join ranking on usuario.idUsuario = ranking.idUsuario order by puntuacionacumaluda desc
";
	$mysqli->multi_query($sql);

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
	</style>

	<div class="container">
		<?php $opcion = 5; ?>
		<?php include 'navbar.php';?>

		<div class="mt-4 card">
				<div class="card-body">
					<div class="float-left">
				  		<h1 class="display-4">Ranking</h1>
					</div>
					<div class="float-right">
						<img class="img-fluid" src="CDI/CDI/3 - Menú principal - Jugador/Ranking.png" width="150px">
					</div>
					
				</div>
		</div>

		<div class="mt-4 card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<h1 class="text-center">
							<img src="CDI/CDI/7 - Ranking - Jugador/Top.png" width="40" height="40" class="d-inline-block align-items-center">
							TOP MVP
						</h1>
						<img class="mx-auto d-block img-fluid" src="images/jugador/<?php echo $user_primero->idUsuario; ?>.png"  alt="Imagen perfil" width="150px" style="margin: 5%;">
						<h5 class="card-title text-center"><?php echo $user_primero->nombre; ?></h5>
						<p class="card-text text-center"><?php echo $user_primero->puntuacionacumaluda; ?>&nbsp;puntos en la temporada.</p>
					</div>
					<div class="col-md-6 mt-4">
						<ul class="list-group">
							<?php 
								$i = 1;
								do {
									if($result = $mysqli->store_result()) {
							 			while ($user = $result->fetch_row()) {
						 	?>

						    				<li class="list-group-item"> <div class="float-left"><?php echo $i; echo "º &nbsp;&nbsp;"; echo $user[0] ?></div>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<div class="float-right"><?php echo $user[3] ?></div> </li>

							<?php 		
										$i++;
										}
										$result->free();
									}
									
								} while($mysqli->next_result());
							 ?>
					  	</ul>
				  	</div>
				</div>	
			</div>
		</div>
	</div>

	</div>

	
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