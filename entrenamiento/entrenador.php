<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

include("../database.php");


if ( isset( $_SESSION['id'] ) ) {


	$tab = "&nbsp;&nbsp;";
	$sql = "select usuario.nombre, usuario.apellidos, tipoentrenamiento.nombreTipoEntrenamiento, ejercicio.nombreEjercicio, usuarioejercicio.fecha, usuarioejercicio.idUsuarioEjercicio 
			from usuario, ejercicio, usuarioejercicio, tipoentrenamiento, tipoejercicio 
			where usuario.idUsuario = usuarioejercicio.idUsuario 
			and ejercicio.idEjercicio = usuarioejercicio.idEjercicio 
			and tipoentrenamiento.idTipoEntrenamiento = ejercicio.idTipoEntrenamiento 
			and tipoejercicio.idTipoEjercicio = ejercicio.idTipoEjercicio
			order by usuario.apellidos;";


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


	<div class="container">

		<div class="toast" id="toast-creado" style="position: absolute; top: 0; right: 0;" data-autohide="true" data-delay="3000">
			<div class="toast-header">

				<strong class="mr-auto">Entrenamiento</strong>
				<small>3 sec ago</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="toast-body">
				El entrenamiento ha sido creado con éxito.
				<img class="align-img rounded mr-2" width="20px" src="https://image.flaticon.com/icons/svg/753/753318.svg">
			</div>
		</div>

		<div class="toast" id="toast-borrado" style="position: absolute; top: 0; right: 0;" data-autohide="true" data-delay="3000">
			<div class="toast-header">

				<strong class="mr-auto">Entrenamiento</strong>
				<small>3 sec ago</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="toast-body">
				El entrenamiento ha sido borrado con éxito.
				<img class="align-img rounded mr-2" width="20px" src="https://image.flaticon.com/icons/svg/753/753318.svg">
			</div>
		</div>

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
					<div>
							<h2 class="float-left card-title">Lista de entrenamientos (Ordenados por apellidos)</h2>
							
								<a href="seleccionar_jugador.php" class="btn btn-primary float-right">Crear nuevo entrenamiento</a>
							
						</div>
						<br><br>
						<br>
						<div class="container-fluid">

							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th scope="col">Nombre</th>
										<th scope="col">Apellidos</th>
										<th scope="col">Tipo entrenamiento</th>
										<th scope="col">Ejercicio</th>
										<th scope="col">Fecha</th>
										<th scope="col">Borrar</th>
									</tr>
								</thead>
								<tbody>
							<?php 
								$i = 0;
								do {
									if($result = $mysqli->store_result()) {
										
							 			while ($user = $result->fetch_row()) {
						 	?>
						 				<tr>
									      	<td><?php echo $user[0]; ?></td>
									      	<td><?php echo $user[1]; ?></td>
									      	<td><?php echo $user[2]; ?></td>
									      	<td><?php echo $user[3]; ?></td>
									      	<td><?php echo $user[4]; ?></td>
									      	<td>
									      		<form action="borrar_entrenamiento.php" method="post">
			    									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmationModal<?php echo $i;  ?>">
									    				<img src="../CDI/CDI/4 - Calendario - Entrenador/Borrar.png"  width="18" height="18"/>
									    			</button>

									    			<div class="modal fade" id="confirmationModal<?php echo $i;  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													  <div class="modal-dialog modal-sm" role="document">
													    <div class="modal-content" style="margin-top: 50%;">
													      <div class="modal-header">
													        <h5 class="modal-title" id="exampleModalLabel">Entrenamiento</h5>
													      </div>
													      <div class="modal-body">
													        ¿Estás seguro que deseas borrar este entrenamiento?
													        <input type="hidden" name="id" value="<?php echo $user[5]; ?>">
													      </div>
													      <div class="modal-footer">
													        <button type="button" class="btn btn-danger" data-dismiss="modal">
													        	<img src="../CDI/CDI/8 - Plantilla - Entrenador/No disponible.png" class="d-inline-block align-items-center align-img" width="13" height="13" alt="">
														        No
														    </button>
													        <button type="submit" class="btn btn-success">
													        	<img src="../CDI/CDI/8 - Plantilla - Entrenador/DisponibleBlanco.png" class="d-inline-block align-items-center align-img" width="13" height="13" alt="">
														        Si
														    </button>
													      </div>
													    </div>
													  </div>
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
					  	<br>
	 	
				
			</div>
		</div>
	</div>

	<?php if (isset($_GET['creado'])) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
			  $('#toast-creado').toast('show');
			});
		</script>		
	<?php } ?>

	<?php if (isset($_GET['borrado'])) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
			  $('#toast-borrado').toast('show');
			});
		</script>		
	<?php } ?>


	
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