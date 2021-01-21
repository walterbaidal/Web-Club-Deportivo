<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();
include("../database.php");

if ( isset( $_SESSION['id'] ) ) {

	$sql = "select tipoentrenamiento.nombreTipoEntrenamiento, ejercicio.nombreEjercicio, usuarioejercicio.fecha, usuarioejercicio.idEjercicio
            from usuario, ejercicio, usuarioejercicio, tipoentrenamiento, tipoejercicio 
            where usuario.idUsuario = usuarioejercicio.idUsuario 
            and ejercicio.idEjercicio = usuarioejercicio.idEjercicio 
            and tipoentrenamiento.idTipoEntrenamiento = ejercicio.idTipoEntrenamiento 
            and tipoejercicio.idTipoEjercicio = ejercicio.idTipoEjercicio
            and usuarioejercicio.idUsuario = 2
            and usuarioejercicio.realizado = 0";

    $mysqli->multi_query($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu Pandas F.C</title>
	<link rel="stylesheet" href="../css/navbar.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>

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
		
		<div class="mt-4 mb-4 card">
			
			<div class="container" style="padding-top: 1%;">
				<div class="card-body"> 
					<div class="float-right">
						<h2>SEMANA DEL 20 AL 24 DE ABRIL</h2>
					</div>
					<br><br>
					<h3 class="card-title mt-2">Ejercicios por hacer</h3>


					<table class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Tipo entrenamiento</th>
								<th scope="col">Nombre de ejercicio</th>
								<th scope="col">Fecha</th>
								<th scope="col">Marcar como realizado</th>
							</tr>
						</thead>
						<tbody>

					<?php 
						$i = 1;
						do {
							if($result = $mysqli->store_result()) {
					 			while ($user = $result->fetch_row()) {
				 	?>
				 		
			 				<tr>
						      	<td><?php echo $user[0]; ?></td>
						      	<td><?php echo $user[1]; ?></td>
						      	<td><?php echo $user[2]; ?></td>
								<td>
									<form action="marcar_entrenamiento_script.php" method="post">
										<div class="text-center">
											<button type="submit" class="btn btn-success" name="id" value="<?php echo $user[3]; ?>">
						    					<img src="../CDI/CDI/8 - Plantilla - Entrenador/DisponibleBlanco.png" width="18"/>
						    				</button>
						    			</div>
					    			</form>
				    			</td>
							</tr>
					<?php 		
								$i++;
								}
								$result->free();
							}
							
						} while($mysqli->next_result());
				 	?>
				 		</tbody>
					</table>
				</div>
				
				<hr>

				
				<div class="card-body">
					<h3 class="card-title">Ejercicios realizados</h3>
					<table class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Tipo entrenamiento</th>
								<th scope="col">Nombre de ejercicio</th>
								<th scope="col">Fecha</th>
								<th scope="col">Desmarcar como realizado</th>
							</tr>
						</thead>
						<tbody>
					<?php 
					$sql = "select tipoentrenamiento.nombreTipoEntrenamiento, ejercicio.nombreEjercicio, usuarioejercicio.fecha, usuarioejercicio.idEjercicio
				            from usuario, ejercicio, usuarioejercicio, tipoentrenamiento, tipoejercicio 
				            where usuario.idUsuario = usuarioejercicio.idUsuario 
				            and ejercicio.idEjercicio = usuarioejercicio.idEjercicio 
				            and tipoentrenamiento.idTipoEntrenamiento = ejercicio.idTipoEntrenamiento 
				            and tipoejercicio.idTipoEjercicio = ejercicio.idTipoEjercicio
				            and usuarioejercicio.idUsuario = 2
				            and usuarioejercicio.realizado = 1";

				    $mysqli->multi_query($sql);
						$i = 1;
						do {
							if($result = $mysqli->store_result()) {
					 			while ($user = $result->fetch_row()) {
				 	?>
				 		
		 				<tr>
					      	<td><?php echo $user[0]; ?></td>
					      	<td><?php echo $user[1]; ?></td>
					      	<td><?php echo $user[2]; ?></td>
							<td>
								<form action="desmarcar_entrenamiento_script.php" method="post">
									<div class="text-center">
										<button type="submit" class="btn btn-danger" name="id" value="<?php echo $user[3]; ?>">
					    					<img src="../CDI/CDI/8 - Plantilla - Entrenador/No disponible.png" width="14" height="14"/>
					    				</button>
					    			</div>
				    			</form>
			    			</td>
						</tr>
					<?php 		
								$i++;
								}
								$result->free();
							}
							
						} while($mysqli->next_result());
				 	?>
				 		</tbody>
					</table>

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