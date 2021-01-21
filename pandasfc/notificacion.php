<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['id'] ) ) {
	$id = $_SESSION['id'];
	include("database.php");

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		header("location: notificacion.php?enviado=true");
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Menu Pandas F.C</title>
	<link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>

	<style type="text/css">

		.list-group-item {
			padding: .75rem 0.70rem !important;
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

		.autocomplete-items {
			  border: 1px solid #d4d4d4;
			  border-bottom: none;
			  border-top: none;
			  z-index: 99;
			  /*position the autocomplete items to be the same width as the container:*/
			  top: 100%;
			  left: 0;
			  right: 0;
			}

			.autocomplete-items div {
			  padding: 10px;
			  cursor: pointer;
			  background-color: #fff; 
			  border-bottom: 1px solid #d4d4d4; 
			}

			/*when hovering an item:*/
			.autocomplete-items div:hover {
			  background-color: #e9e9e9; 
			}

			/*when navigating through the items using the arrow keys:*/
			.autocomplete-active {
			  background-color: DodgerBlue !important; 
			  color: #ffffff; 
			}


	</style>

	<div class="container">

		<div class="toast" id="toast-enviado" style="position: absolute; top: 0; right: 0;" data-autohide="true" data-delay="3000">
			<div class="toast-header">

				<strong class="mr-auto">Notificación</strong>
				<small>3 sec ago</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="toast-body">
				Tu mensaje ha sido enviado con éxito.
				<img class="align-img rounded mr-2" width="20px" src="https://image.flaticon.com/icons/svg/753/753318.svg">
			</div>
		</div>

		<div class="toast" id="toast-delete" style="position: absolute; top: 0; right: 0;" data-autohide="true" data-delay="3000">
			<div class="toast-header">

				<strong class="mr-auto">Notificación</strong>
				<small>3 sec ago</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="toast-body">
				Tu mensaje ha sido borrado con éxito.
				<img class="align-img rounded mr-2" width="20px" src="https://image.flaticon.com/icons/svg/753/753318.svg">
			</div>
		</div>

		<?php $opcion = 3 ?>
		<?php include 'navbar.php';?>

		<div class="mt-4 card">
				<div class="card-body">
					<div class="float-left">
				  		<h1 class="display-4">Notificaciones</h1>
					</div>
					<div class="float-right">
						<img class="img-fluid" src="CDI/CDI/3 - Menú principal - Jugador/Notificacion.png" width="130px">
					</div>
					
				</div>
		</div>
		

		<div class="mt-4 card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-2">
							<ul class="list-group">
								<div class="list-group" id="list-tab" role="tablist">
							      	<a class="list-group-item list-group-item-action" id="list-redactar-list" data-toggle="list" href="#list-redactar" role="tab" aria-controls="redactar"><img src="CDI/CDI/5 - Notificaciones - Jugador/Redactar.png" width="20" class="img-fluid">
							      		
							        &nbsp;&nbsp;&nbsp;Redactar

							          
							        </a>
							      	<br>
							      	<?php 
							      		$sql = "select count(idMensaje) as 'no_leidos' from mensaje where (idEmisor = '$id' or idReceptor = '$id') and mensaje.leido = 0";
							      		$result = $mysqli->prepare($sql);
								      	$result->execute();
								      	$row = $result->get_result();
								      	$todos = $row->fetch_object();
								      	$result->close();
							      	?>
							      	<a class="list-group-item list-group-item-action active d-flex justify-content-between align-items-center" id="list-todos-list" data-toggle="list" href="#list-todos" role="tab" aria-controls="todos">
							      		
										<img src="CDI/CDI/5 - Notificaciones - Jugador/Todos.png" width="15" class="img-fluid">
							      		Todos
							      		<span class="badge badge-dark badge-pill"><?php echo $todos->no_leidos; ?></span>
							      	</a>
							      	<?php 
							      		$sql = "select count(idMensaje) as 'no_leidos' from mensaje where idEmisor = '$id' and mensaje.leido = 0";
							      		$result = $mysqli->prepare($sql);
								      	$result->execute();
								      	$row = $result->get_result();
								      	$enviados = $row->fetch_object();
								      	$result->close();
							      	?>
							      	<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-enviados-list" data-toggle="list" href="#list-enviados" role="tab" aria-controls="enviados">
							      		
										<img src="CDI/CDI/5 - Notificaciones - Jugador/Enviados.png" width="15" class="img-fluid">
							      		Enviados
										<span class="badge badge-dark badge-pill"><?php echo $enviados->no_leidos; ?></span>
							      	</a>
							      	<?php 
							      		$sql = "select count(idMensaje) as 'no_leidos' from mensaje where idReceptor = '$id' and mensaje.leido = 0";
							      		$result = $mysqli->prepare($sql);
								      	$result->execute();
								      	$row = $result->get_result();
								      	$recibidos = $row->fetch_object();
								      	$result->close();
							      	?>
							      	<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-recibidos-list" data-toggle="list" href="#list-recibidos" role="tab" aria-controls="recibidos">
							      		
										<img src="CDI/CDI/5 - Notificaciones - Jugador/Recibidos.png" width="15" class="img-fluid">
							      		Recibidos
										<span class="badge badge-dark badge-pill"><?php echo $recibidos->no_leidos; ?></span>
							      	</a>
							      	<?php 
							      		$sql = "select count(idMensaje) as 'no_leidos' from mensaje where idEmisor in (select idUsuario from usuario where idTipoUsuario = 2) and idReceptor = '$id' and mensaje.leido = 0;";
							      		$result = $mysqli->prepare($sql);
								      	$result->execute();
								      	$row = $result->get_result();
								      	$jugador = $row->fetch_object();
								      	$result->close();
							      	?>
							      	<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-jugador-list" data-toggle="list" href="#list-jugador" role="tab" aria-controls="jugador">
							      		
										<img src="CDI/CDI/5 - Notificaciones - Jugador/Jugador.png" width="15" class="img-fluid">
							      		Jugador
										<span class="badge badge-dark badge-pill"><?php echo $jugador->no_leidos; ?></span>
							      	</a>

							      	<?php 

							      		if ($_SESSION['tipo_usuario'] == 2 ) {
							      		$sql = "select count(idMensaje) as 'no_leidos' from mensaje where idEmisor in (select idUsuario from usuario where idTipoUsuario = 1) and idReceptor = '$id' and mensaje.leido = 0;";
							      		$result = $mysqli->prepare($sql);
								      	$result->execute();
								      	$row = $result->get_result();
								      	$entrenador = $row->fetch_object();
								      	$result->close();
							      	?>
							      	<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-entrenador-list" data-toggle="list" href="#list-entrenador" role="tab" aria-controls="entrenador">
							      		
										<img src="CDI/CDI/5 - Notificaciones - Jugador/Entrenador.png" width="15" class="img-fluid">
							      		Entrenador
										<span class="badge badge-dark badge-pill"><?php echo $entrenador->no_leidos; ?></span>
							      	</a>
							      	<?php } ?>
							      	
							      	<?php 
							      		$sql = "select count(idMensaje) as 'no_leidos' from mensaje where idEmisor in (select idUsuario from usuario where idTipoUsuario = 5) and idReceptor = '$id' and mensaje.leido = 0;";
							      		$result = $mysqli->prepare($sql);
								      	$result->execute();
								      	$row = $result->get_result();
								      	$presidente = $row->fetch_object();
								      	$result->close();
							      	?>
							      	<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-presidente-list" data-toggle="list" href="#list-presidente" role="tab" aria-controls="presidente">
							      		
										<img src="CDI/CDI/5 - Notificaciones - Jugador/Presidente.png" width="15" class="img-fluid">
							      		Presidente
										<span class="badge badge-dark badge-pill"><?php echo $presidente->no_leidos; ?></span>
							      	</a>
							      	<?php 
							      		$sql = "select count(idMensaje) as 'no_leidos' from mensaje where idEmisor in (select idUsuario from usuario where idTipoUsuario = 3) and idReceptor = '$id' and mensaje.leido = 0;";
							      		$result = $mysqli->prepare($sql);
								      	$result->execute();
								      	$row = $result->get_result();
								      	$servicio_medico = $row->fetch_object();
								      	$result->close();
							      	?>
							      	<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-servicio-medico-list" data-toggle="list" href="#list-servicio-medico" role="tab" aria-controls="servicio-medico">
							      		
										<img src="CDI/CDI/5 - Notificaciones - Jugador/Medico.png" width="15" class="img-fluid">
							      		Médico
										<span class="badge badge-dark badge-pill"><?php echo $servicio_medico->no_leidos; ?></span>
							      	</a>
							      	<?php 
							      		$sql = "select count(idMensaje) as 'no_leidos' from mensaje where idEmisor in (select idUsuario from usuario where idTipoUsuario = 4) and idReceptor = '$id' and mensaje.leido = 0;";
							      		$result = $mysqli->prepare($sql);
								      	$result->execute();
								      	$row = $result->get_result();
								      	$junta_deportiva = $row->fetch_object();
								      	$result->close();
							      	?>
							      	<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-junta-deportiva-list" data-toggle="list" href="#list-junta-deportiva" role="tab" aria-controls="junta-deportida">
							      		
										<img src="CDI/CDI/5 - Notificaciones - Jugador/Junta.png" width="15" class="img-fluid">
							      		Junta
										<span class="badge badge-dark badge-pill"><?php echo $junta_deportiva->no_leidos; ?></span>
							      	</a>
							    </div>
							</ul>
					</div>
					<div class="col-md-10">
						<div class="tab-content" id="nav-tabContent">
					      	<div class="tab-pane fade" id="list-redactar" role="tabpanel" aria-labelledby="list-redactar-list">
					      		<form action="" method="POST" autocomplete="off">
								  	<div class="form-group autocomplete">
									    <label for="exampleFormControlInput1">Correo electrónico</label>
		    							<input id="correo" type="email" class="form-control" id="exampleFormControlInput1" placeholder="nombre@pandasfc.com">
								  	</div>

								  	<div class="form-group">
									    <label for="asunto">Asunto</label>
		    							<input id="correo" type="text" class="form-control" id="asunto" >
								  	</div>
									 	 	
	  								<div class="form-group">
									    <label for="mensaje_contenido">Mensaje</label>
									    <textarea class="form-control" id="mensaje_contenido" rows="6"></textarea>
								  	</div> 	

								  	<div class="form-group">
									    <label for="fichero">Adjuntar fichero</label>
									    <input type="file" class="form-control-file" id="fichero">
								  	</div>

								  	<div class="float-right">
							  		 	<button type="submit" class="btn btn-primary">
						  		 			<img src="CDI/CDI/5 - Notificaciones - Jugador/Enviar.png" width="20" class="img-fluid">
							  				Enviar mensaje
			  							</button>
								  	</div>
					      	</div>

					      	<div class="tab-pane fade show active" id="list-todos" role="tabpanel" aria-labelledby="list-todos-list">
					      		<table class="table table-bordered table-hover">
								  	<thead>
								    	<tr>
								      		<th scope="col-md-1">#</th>
								      		<th scope="col-md-2">Nombre Emisor</th>
								      		<th scope="col-md-2">Apellido Emisor</th>
									      	<th scope="col-md-4">Asunto del correo</th>
									      	<th scope="col-md-2">Fecha</th>
									      	<th scope="col-md-1">Borrar</th>
								    	</tr>
								  	</thead>
								  	<tbody>
								    	<?php 
								    		$sql = "select mensaje.idMensaje, usuario.nombre, usuario.apellidos, mensaje.asunto, mensaje.fechahora, mensaje.texto, mensaje.leido from mensaje join usuario on (mensaje.idEmisor = usuario.idUsuario) where idEmisor = '$id' or idReceptor = '$id' order by mensaje.fechahora desc";
							    			$mysqli->multi_query($sql);
											do {
												if($result = $mysqli->store_result()) {
													$i = 1;
							 						while ($user = $result->fetch_row()) {
						 				?>
						 								<tr>
													      	<td data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>"><?php echo $i; ?></td>
													      	<td data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>"><?php echo $user[1]; ?></td>
													      	<td data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>"><?php echo $user[2]; ?></td>
													      	<td data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>"><?php echo $user[3]; ?></td>
													      	<td data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>"><?php echo $user[4]; ?></td>
														      	<td>
														      		<form action="borrar_mensaje_script.php" method="post">
								    									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmationModal<?php  echo "13"; echo $user[0]; ?>">
														    				<img src="CDI/CDI/4 - Calendario - Entrenador/Borrar.png"  width="18" height="18"/>
														    			</button>

														    			<div class="modal fade" id="confirmationModal<?php  echo "13"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		  <div class="modal-dialog modal-sm" role="document">
																		    <div class="modal-content" style="margin-top: 50%;">
																		      <div class="modal-header">
																		        <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
																		      </div>
																		      <div class="modal-body">
																		        ¿Estás seguro que deseas borrar este mensaje?
																		        <input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																		      </div>
																		      <div class="modal-footer">
																		        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
																		        <button type="submit" class="btn btn-success">Si</button>
																		      </div>
																		    </div>
																		  </div>
																		</div>
													    			</form>
									
														      	</td>
					    								</tr>	

					    								<div class="modal fade" id="msgModal<?php echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  	<div class="modal-dialog" role="document">
														    	<div class="modal-content">
														      		<div class="modal-header">
													       		 		<h5 class="modal-title" id="exampleModalLabel"><?php echo $user[3]; ?></h5>
														       		 	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															          		<span aria-hidden="true">&times;</span>
														       		 	</button>
															      	</div>
															      	<div class="modal-body">
															        	<?php echo $user[5]; ?>
															      	</div>
															      	<div class="modal-footer">
																      	<form action="mensaje_leido_script.php" method="post"> 
																      		<input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																        	<button type="submit" class="btn btn-primary">Marcar como leido</button>
															        	</form>
															      	</div>
														    	</div>
														  	</div>
														</div>
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
					      	<div class="tab-pane fade" id="list-enviados" role="tabpanel" aria-labelledby="list-enviados-list">
					      		<table class="table table-bordered table-hover">
								  	<thead>
								    	<tr>
								      		<th scope="col">#</th>
								      		<th scope="col">Nombre Emisor</th>
								      		<th scope="col">Apellido Emisor</th>
									      	<th scope="col">Asunto del correo</th>
									      	<th scope="col">Fecha</th>
									      	<th scope="col">Borrar</th>
								    	</tr>
								  	</thead>
								  	<tbody>
								    	<?php 
								    		$sql = "select mensaje.idMensaje, usuario.nombre, usuario.apellidos, mensaje.asunto, mensaje.fechahora, mensaje.texto, mensaje.leido from mensaje join usuario on (mensaje.idEmisor = usuario.idUsuario) where idEmisor = '$id' order by mensaje.fechahora asc; ";
							    			$mysqli->multi_query($sql);
											do {
												if($result = $mysqli->store_result()) {
													$i = 1;
							 						while ($user = $result->fetch_row()) {
						 				?>
						 								<tr data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>">
													      	<td><?php echo $i; ?></td>
													      	<td><?php echo $user[1]; ?></td>
													      	<td><?php echo $user[2]; ?></td>
													      	<td><?php echo $user[3]; ?></td>
													      	<td><?php echo $user[4]; ?></td>
														      	<td>
														      		<form action="borrar_mensaje_script.php" method="post">
								    									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmationModal<?php echo $i; echo "13"; echo $user[0]; ?>">
														    				<img src="CDI/CDI/4 - Calendario - Entrenador/Borrar.png"  width="18" height="18"/>
														    			</button>

														    			<div class="modal fade" id="confirmationModal<?php echo $i; echo "13"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		  <div class="modal-dialog modal-sm" role="document">
																		    <div class="modal-content" style="margin-top: 50%;">
																		      <div class="modal-header">
																		        <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
																		      </div>
																		      <div class="modal-body">
																		        ¿Estás seguro que deseas borrar este mensaje?
																		        <input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																		      </div>
																		      <div class="modal-footer">
																		        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
																		        <button type="submit" class="btn btn-success">Si</button>
																		      </div>
																		    </div>
																		  </div>
																		</div>
													    			</form>
														      	</td>
					    								</tr>	

					    								<div class="modal fade" id="msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  	<div class="modal-dialog" role="document">
														    	<div class="modal-content">
														      		<div class="modal-header">
													       		 		<h5 class="modal-title" id="exampleModalLabel"><?php echo $user[3]; ?></h5>
														       		 	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															          		<span aria-hidden="true">&times;</span>
														       		 	</button>
															      	</div>
															      	<div class="modal-body">
															        	<?php echo $user[5]; ?>
															      	</div>
															      	<div class="modal-footer">
																      	<form action="mensaje_leido_script.php" method="post"> 
																      		<input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																        	<button type="submit" class="btn btn-primary">Marcar como leido</button>
															        	</form>
															      	</div>
														    	</div>
														  	</div>
														</div>
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
					      	<div class="tab-pane fade" id="list-recibidos" role="tabpanel" aria-labelledby="list-recibidos-list">
					      		<table class="table table-bordered table-hover">
								  	<thead>
								    	<tr>
								      		<th scope="col">#</th>
								      		<th scope="col">Nombre Emisor</th>
								      		<th scope="col">Apellido Emisor</th>
									      	<th scope="col">Asunto del correo</th>
									      	<th scope="col">Fecha</th>
									      	<th scope="col">Borrar</th>
								    	</tr>
								  	</thead>
								  	<tbody>
								    	<?php 
								    		$sql = "select mensaje.idMensaje, usuario.nombre, usuario.apellidos, mensaje.asunto, mensaje.fechahora, mensaje.texto, mensaje.leido from mensaje join usuario on (mensaje.idEmisor = usuario.idUsuario) where idReceptor = '$id' order by mensaje.fechahora asc; ";
							    			$mysqli->multi_query($sql);
											do {
												if($result = $mysqli->store_result()) {
													$i = 1;
							 						while ($user = $result->fetch_row()) {
						 				?>
						 								<tr data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>">
													      	<td><?php echo $i; ?></td>
													      	<td><?php echo $user[1]; ?></td>
													      	<td><?php echo $user[2]; ?></td>
													      	<td><?php echo $user[3]; ?></td>
													      	<td><?php echo $user[4]; ?></td>
														      	<td>
														      		<form action="borrar_mensaje_script.php" method="post">
								    									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmationModal<?php echo $i; echo "14"; echo $user[0]; ?>">
														    				<img src="CDI/CDI/4 - Calendario - Entrenador/Borrar.png"  width="18" height="18"/>
														    			</button>

														    			<div class="modal fade" id="confirmationModal<?php echo $i; echo "14"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		  <div class="modal-dialog modal-sm" role="document">
																		    <div class="modal-content" style="margin-top: 50%;">
																		      <div class="modal-header">
																		        <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
																		      </div>
																		      <div class="modal-body">
																		        ¿Estás seguro que deseas borrar este mensaje?
																		        <input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																		      </div>
																		      <div class="modal-footer">
																		        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
																		        <button type="submit" class="btn btn-success">Si</button>
																		      </div>
																		    </div>
																		  </div>
																		</div>
													    			</form>
														      	</td>
					    								</tr>	

					    								<div class="modal fade" id="msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  	<div class="modal-dialog" role="document">
														    	<div class="modal-content">
														      		<div class="modal-header">
													       		 		<h5 class="modal-title" id="exampleModalLabel"><?php echo $user[3]; ?></h5>
														       		 	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															          		<span aria-hidden="true">&times;</span>
														       		 	</button>
															      	</div>
															      	<div class="modal-body">
															        	<?php echo $user[5]; ?>
															      	</div>
															      	<div class="modal-footer">
																      	<form action="mensaje_leido_script.php" method="post"> 
																      		<input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																        	<button type="submit" class="btn btn-primary">Marcar como leido</button>
															        	</form>
															      	</div>
														    	</div>
														  	</div>
														</div>
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
					      	<div class="tab-pane fade" id="list-jugador" role="tabpanel" aria-labelledby="list-jugador-list">
					      		<table class="table table-bordered table-hover">
								  	<thead>
								    	<tr>
								      		<th scope="col">#</th>
								      		<th scope="col">Nombre Emisor</th>
								      		<th scope="col">Apellido Emisor</th>
									      	<th scope="col">Asunto del correo</th>
									      	<th scope="col">Fecha</th>
									      	<th scope="col">Borrar</th>
								    	</tr>
								  	</thead>
								  	<tbody>
								    	<?php 
								    		$sql = "select mensaje.idMensaje, usuario.nombre, usuario.apellidos, mensaje.asunto, mensaje.fechahora, mensaje.texto, mensaje.leido from mensaje join usuario on (mensaje.idEmisor = usuario.idUsuario) where idEmisor in (select idUsuario from usuario where idTipoUsuario = 2) and idReceptor = '$id' order by mensaje.fechahora asc; ";
							    			$mysqli->multi_query($sql);
											do {
												if($result = $mysqli->store_result()) {
													$i = 1;
							 						while ($user = $result->fetch_row()) {
						 				?>
						 								<tr data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>">
													      	<td><?php echo $i; ?></td>
													      	<td><?php echo $user[1]; ?></td>
													      	<td><?php echo $user[2]; ?></td>
													      	<td><?php echo $user[3]; ?></td>
													      	<td><?php echo $user[4]; ?></td>
														      	<td>
														      		<form action="borrar_mensaje_script.php" method="post">
								    									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmationModal<?php echo $i; echo "15"; echo $user[0]; ?>">
														    				<img src="CDI/CDI/4 - Calendario - Entrenador/Borrar.png"  width="18" height="18"/>
														    			</button>

														    			<div class="modal fade" id="confirmationModal<?php echo $i; echo "15"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		  <div class="modal-dialog modal-sm" role="document">
																		    <div class="modal-content" style="margin-top: 50%;">
																		      <div class="modal-header">
																		        <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
																		      </div>
																		      <div class="modal-body">
																		        ¿Estás seguro que deseas borrar este mensaje?
																		        <input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																		      </div>
																		      <div class="modal-footer">
																		        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
																		        <button type="submit" class="btn btn-success">Si</button>
																		      </div>
																		    </div>
																		  </div>
																		</div>
													    			</form>
														      	</td>
					    								</tr>	

					    								<div class="modal fade" id="msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  	<div class="modal-dialog" role="document">
														    	<div class="modal-content">
														      		<div class="modal-header">
													       		 		<h5 class="modal-title" id="exampleModalLabel"><?php echo $user[3]; ?></h5>
														       		 	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															          		<span aria-hidden="true">&times;</span>
														       		 	</button>
															      	</div>
															      	<div class="modal-body">
															        	<?php echo $user[5]; ?>
															      	</div>
															      	<div class="modal-footer">
																      	<form action="mensaje_leido_script.php" method="post"> 
																      		<input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																        	<button type="submit" class="btn btn-primary">Marcar como leido</button>
															        	</form>
															      	</div>
														    	</div>
														  	</div>
														</div>
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
					      	<div class="tab-pane fade" id="list-entrenador" role="tabpanel" aria-labelledby="list-entrenador-list">
					      		<table class="table table-bordered table-hover">
								  	<thead>
								    	<tr>
								      		<th scope="col">#</th>
								      		<th scope="col">Nombre Emisor</th>
								      		<th scope="col">Apellido Emisor</th>
									      	<th scope="col">Asunto del correo</th>
									      	<th scope="col">Fecha</th>
									      	<th scope="col">Borrar</th>
								    	</tr>
								  	</thead>
								  	<tbody>
								    	<?php 
								    		$sql = "select mensaje.idMensaje, usuario.nombre, usuario.apellidos, mensaje.asunto, mensaje.fechahora, mensaje.texto, mensaje.leido from mensaje join usuario on (mensaje.idEmisor = usuario.idUsuario) where idEmisor in (select idUsuario from usuario where idTipoUsuario = 1) and idReceptor = '$id' order by mensaje.fechahora asc; ";
							    			$mysqli->multi_query($sql);
											do {
												if($result = $mysqli->store_result()) {
													$i = 1;
							 						while ($user = $result->fetch_row()) {
						 				?>
						 								<tr data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>">
													      	<td><?php echo $i; ?></td>
													      	<td><?php echo $user[1]; ?></td>
													      	<td><?php echo $user[2]; ?></td>
													      	<td><?php echo $user[3]; ?></td>
													      	<td><?php echo $user[4]; ?></td>
														      	<td>
														      		<form action="borrar_mensaje_script.php" method="post">
								    									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmationModal<?php echo $i; echo "16"; echo $user[0]; ?>">
														    				<img src="CDI/CDI/4 - Calendario - Entrenador/Borrar.png"  width="18" height="18"/>
														    			</button>

														    			<div class="modal fade" id="confirmationModal<?php echo $i; echo "16"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		  <div class="modal-dialog modal-sm" role="document">
																		    <div class="modal-content" style="margin-top: 50%;">
																		      <div class="modal-header">
																		        <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
																		      </div>
																		      <div class="modal-body">
																		        ¿Estás seguro que deseas borrar este mensaje?
																		        <input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																		      </div>
																		      <div class="modal-footer">
																		        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
																		        <button type="submit" class="btn btn-success">Si</button>
																		      </div>
																		    </div>
																		  </div>
																		</div>
													    			</form>
														      	</td>
					    								</tr>	

					    								<div class="modal fade" id="msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  	<div class="modal-dialog" role="document">
														    	<div class="modal-content">
														      		<div class="modal-header">
													       		 		<h5 class="modal-title" id="exampleModalLabel"><?php echo $user[3]; ?></h5>
														       		 	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															          		<span aria-hidden="true">&times;</span>
														       		 	</button>
															      	</div>
															      	<div class="modal-body">
															        	<?php echo $user[5]; ?>
															      	</div>
															      	<div class="modal-footer">
																      	<form action="mensaje_leido_script.php" method="post"> 
																      		<input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																        	<button type="submit" class="btn btn-primary">Marcar como leido</button>
															        	</form>
															      	</div>
														    	</div>
														  	</div>
														</div>
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
					      	<div class="tab-pane fade" id="list-presidente" role="tabpanel" aria-labelledby="list-presidente-list">
					      		<table class="table table-bordered table-hover">
								  	<thead>
								    	<tr>
								      		<th scope="col">#</th>
								      		<th scope="col">Nombre Emisor</th>
								      		<th scope="col">Apellido Emisor</th>
									      	<th scope="col">Asunto del correo</th>
									      	<th scope="col">Fecha</th>
									      	<th scope="col">Borrar</th>
								    	</tr>
								  	</thead>
								  	<tbody>
								    	<?php 
								    		$sql = "select mensaje.idMensaje, usuario.nombre, usuario.apellidos, mensaje.asunto, mensaje.fechahora, mensaje.texto, mensaje.leido from mensaje join usuario on (mensaje.idEmisor = usuario.idUsuario) where idEmisor in (select idUsuario from usuario where idTipoUsuario = 5) and idReceptor = '$id' order by mensaje.fechahora asc;";
							    			$mysqli->multi_query($sql);
											do {
												if($result = $mysqli->store_result()) {
													$i = 1;
							 						while ($user = $result->fetch_row()) {
						 				?>
						 								<tr data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>">
													      	<td><?php echo $i; ?></td>
													      	<td><?php echo $user[1]; ?></td>
													      	<td><?php echo $user[2]; ?></td>
													      	<td><?php echo $user[3]; ?></td>
													      	<td><?php echo $user[4]; ?></td>
														      	<td>
														      		<form action="borrar_mensaje_script.php" method="post">
								    									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmationModal<?php echo $i; echo "17"; echo $user[0]; ?>">
														    				<img src="CDI/CDI/4 - Calendario - Entrenador/Borrar.png"  width="18" height="18"/>
														    			</button>

														    			<div class="modal fade" id="confirmationModal<?php echo $i; echo "17"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		  <div class="modal-dialog modal-sm" role="document">
																		    <div class="modal-content" style="margin-top: 50%;">
																		      <div class="modal-header">
																		        <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
																		      </div>
																		      <div class="modal-body">
																		        ¿Estás seguro que deseas borrar este mensaje?
																		        <input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																		      </div>
																		      <div class="modal-footer">
																		        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
																		        <button type="submit" class="btn btn-success">Si</button>
																		      </div>
																		    </div>
																		  </div>
																		</div>
													    			</form>
														      	</td>
					    								</tr>	

					    								<div class="modal fade" id="msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  	<div class="modal-dialog" role="document">
														    	<div class="modal-content">
														      		<div class="modal-header">
													       		 		<h5 class="modal-title" id="exampleModalLabel"><?php echo $user[3]; ?></h5>
														       		 	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															          		<span aria-hidden="true">&times;</span>
														       		 	</button>
															      	</div>
															      	<div class="modal-body">
															        	<?php echo $user[5]; ?>
															      	</div>
															      	<div class="modal-footer">
																      	<form action="mensaje_leido_script.php" method="post"> 
																      		<input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																        	<button type="submit" class="btn btn-primary">Marcar como leido</button>
															        	</form>
															      	</div>
														    	</div>
														  	</div>
														</div>
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
					      	<div class="tab-pane fade" id="list-servicio-medico" role="tabpanel" aria-labelledby="list-servicio-medico-list">
					      		<table class="table table-bordered table-hover">
								  	<thead>
								    	<tr>
								      		<th scope="col">#</th>
								      		<th scope="col">Nombre Emisor</th>
								      		<th scope="col">Apellido Emisor</th>
									      	<th scope="col">Asunto del correo</th>
									      	<th scope="col">Fecha</th>
									      	<th scope="col">Borrar</th>
								    	</tr>
								  	</thead>
								  	<tbody>
								    	<?php 
								    		$sql = "select mensaje.idMensaje, usuario.nombre, usuario.apellidos, mensaje.asunto, mensaje.fechahora, mensaje.texto, mensaje.leido from mensaje join usuario on (mensaje.idEmisor = usuario.idUsuario) where idEmisor in (select idUsuario from usuario where idTipoUsuario = 3) and idReceptor = '$id' order by mensaje.fechahora asc;";
							    			$mysqli->multi_query($sql);
											do {
												if($result = $mysqli->store_result()) {
													$i = 1;
							 						while ($user = $result->fetch_row()) {
						 				?>
						 								<tr data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $i; echo "20"; echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>">
													      	<td><?php echo $i; ?></td>
													      	<td><?php echo $user[1]; ?></td>
													      	<td><?php echo $user[2]; ?></td>
													      	<td><?php echo $user[3]; ?></td>
													      	<td><?php echo $user[4]; ?></td>
														      	<td>
														      		<form action="borrar_mensaje_script.php" method="post">
								    									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmationModal<?php echo $i; echo "18"; echo $user[0]; ?>">
														    				<img src="CDI/CDI/4 - Calendario - Entrenador/Borrar.png"  width="18" height="18"/>
														    			</button>

														    			<div class="modal fade" id="confirmationModal<?php echo $i; echo "18"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		  <div class="modal-dialog modal-sm" role="document">
																		    <div class="modal-content" style="margin-top: 50%;">
																		      <div class="modal-header">
																		        <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
																		      </div>
																		      <div class="modal-body">
																		        ¿Estás seguro que deseas borrar este mensaje?
																		        <input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																		      </div>
																		      <div class="modal-footer">
																		        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
																		        <button type="submit" class="btn btn-success">Si</button>
																		      </div>
																		    </div>
																		  </div>
																		</div>
													    			</form>
														      	</td>
					    								</tr>	

					    								<div class="modal fade" id="msgModal<?php echo $i; echo "20"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  	<div class="modal-dialog" role="document">
														    	<div class="modal-content">
														      		<div class="modal-header">
													       		 		<h5 class="modal-title" id="exampleModalLabel"><?php echo $user[3]; ?></h5>
														       		 	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															          		<span aria-hidden="true">&times;</span>
														       		 	</button>
															      	</div>
															      	<div class="modal-body">
															        	<?php echo $user[5]; ?>
															      	</div>
															      	<div class="modal-footer">
																      	<form action="mensaje_leido_script.php" method="post"> 
																      		<input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																        	<button type="submit" class="btn btn-primary">Marcar como leido</button>
															        	</form>
															      	</div>
														    	</div>
														  	</div>
														</div>
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
					      	<div class="tab-pane fade" id="list-junta-deportiva" role="tabpanel" aria-labelledby="list-junta-deportiva-list">
					      		<table class="table table-bordered table-hover">
								  	<thead>
								    	<tr>
								      		<th scope="col">#</th>
								      		<th scope="col">Nombre Emisor</th>
								      		<th scope="col">Apellido Emisor</th>
									      	<th scope="col">Asunto del correo</th>
									      	<th scope="col">Fecha</th>
									      	<th scope="col">Borrar</th>
								    	</tr>
								  	</thead>
								  	<tbody>
								    	<?php 
								    		$sql = "select mensaje.idMensaje, usuario.nombre, usuario.apellidos, mensaje.asunto, mensaje.fechahora, mensaje.texto, mensaje.leido from mensaje join usuario on (mensaje.idEmisor = usuario.idUsuario) where idEmisor in (select idUsuario from usuario where idTipoUsuario = 4) and idReceptor = '$id' order by mensaje.fechahora asc;";
							    			$mysqli->multi_query($sql);
											do {
												if($result = $mysqli->store_result()) {
													$i = 1;
							 						while ($user = $result->fetch_row()) {
						 				?>
						 								<tr data-toggle="modal" data-id="1" data-target="#msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" class="<?php if ($user[6] == 0) { echo "table-warning"; } else { echo "table-success"; }?>">
													      	<td><?php echo $i; ?></td>
													      	<td><?php echo $user[1]; ?></td>
													      	<td><?php echo $user[2]; ?></td>
													      	<td><?php echo $user[3]; ?></td>
													      	<td><?php echo $user[4]; ?></td>
														      	<td>
														      		<form action="borrar_mensaje_script.php" method="post">
								    									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmationModal<?php echo $i; echo "14"; echo $user[0]; ?>">
														    				<img src="CDI/CDI/4 - Calendario - Entrenador/Borrar.png"  width="18" height="18"/>
														    			</button>

														    			<div class="modal fade" id="confirmationModal<?php echo $i; echo "14"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		  <div class="modal-dialog modal-sm" role="document">
																		    <div class="modal-content" style="margin-top: 50%;">
																		      <div class="modal-header">
																		        <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
																		      </div>
																		      <div class="modal-body">
																		        ¿Estás seguro que deseas borrar este mensaje?
																		        <input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																		      </div>
																		      <div class="modal-footer">
																		        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
																		        <button type="submit" class="btn btn-success">Si</button>
																		      </div>
																		    </div>
																		  </div>
																		</div>
													    			</form>
														      	</td>
					    								</tr>	

					    								<div class="modal fade" id="msgModal<?php echo $i; echo "0"; echo $user[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  	<div class="modal-dialog" role="document">
														    	<div class="modal-content">
														      		<div class="modal-header">
													       		 		<h5 class="modal-title" id="exampleModalLabel"><?php echo $user[3]; ?></h5>
														       		 	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															          		<span aria-hidden="true">&times;</span>
														       		 	</button>
															      	</div>
															      	<div class="modal-body">
															        	<?php echo $user[5]; ?>
															      	</div>
															      	<div class="modal-footer">
																      	<form action="mensaje_leido_script.php" method="post"> 
																      		<input type="hidden" name="msg_id" value="<?php echo $user[0]; ?>">
																        	<button type="submit" class="btn btn-primary">Marcar como leido</button>
															        	</form>
															      	</div>
														    	</div>
														  	</div>
														</div>
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
			</div>
		</div>
	</div>

	<script>
			function autocomplete(inp, arr) {
			  /*the autocomplete function takes two arguments,
			  the text field element and an array of possible autocompleted values:*/
			  var currentFocus;
			  /*execute a function when someone writes in the text field:*/
			  inp.addEventListener("input", function(e) {
			      var a, b, i, val = this.value;
			      /*close any already open lists of autocompleted values*/
			      closeAllLists();
			      if (!val) { return false;}
			      currentFocus = -1;
			      /*create a DIV element that will contain the items (values):*/
			      a = document.createElement("DIV");
			      a.setAttribute("id", this.id + "autocomplete-list");
			      a.setAttribute("class", "autocomplete-items");
			      /*append the DIV element as a child of the autocomplete container:*/
			      
			      this.parentNode.appendChild(a);
			      /*for each item in the array...*/
			      for (i = 0; i < arr.length; i++) {
			        /*check if the item starts with the same letters as the text field value:*/
			        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
			          /*create a DIV element for each matching element:*/
			          b = document.createElement("DIV");
			          /*make the matching letters bold:*/
			          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
			          b.innerHTML += arr[i].substr(val.length);
			          /*insert a input field that will hold the current array item's value:*/
			          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
			          /*execute a function when someone clicks on the item value (DIV element):*/
			          b.addEventListener("click", function(e) {
			              /*insert the value for the autocomplete text field:*/
			              inp.value = this.getElementsByTagName("input")[0].value;
			              /*close the list of autocompleted values,
			              (or any other open lists of autocompleted values:*/
			              closeAllLists();
			          });
			          a.appendChild(b);
			        }
			      }
			  });
			  /*execute a function presses a key on the keyboard:*/
			  inp.addEventListener("keydown", function(e) {
			      var x = document.getElementById(this.id + "autocomplete-list");
			      if (x) x = x.getElementsByTagName("div");
			      if (e.keyCode == 40) {
			        /*If the arrow DOWN key is pressed,
			        increase the currentFocus variable:*/
			        currentFocus++;
			        /*and and make the current item more visible:*/
			        addActive(x);
			      } else if (e.keyCode == 38) { //up
			        /*If the arrow UP key is pressed,
			        decrease the currentFocus variable:*/
			        currentFocus--;
			        /*and and make the current item more visible:*/
			        addActive(x);
			      } else if (e.keyCode == 13) {
			        /*If the ENTER key is pressed, prevent the form from being submitted,*/
			        e.preventDefault();
			        if (currentFocus > -1) {
			          /*and simulate a click on the "active" item:*/
			          if (x) x[currentFocus].click();
			        }
			      }
			  });
			  function addActive(x) {
			    /*a function to classify an item as "active":*/
			    if (!x) return false;
			    /*start by removing the "active" class on all items:*/
			    removeActive(x);
			    if (currentFocus >= x.length) currentFocus = 0;
			    if (currentFocus < 0) currentFocus = (x.length - 1);
			    /*add class "autocomplete-active":*/
			    x[currentFocus].classList.add("autocomplete-active");
			  }
			  function removeActive(x) {
			    /*a function to remove the "active" class from all autocomplete items:*/
			    for (var i = 0; i < x.length; i++) {
			      x[i].classList.remove("autocomplete-active");
			    }
			  }
			  function closeAllLists(elmnt) {
			    /*close all autocomplete lists in the document,
			    except the one passed as an argument:*/
			    var x = document.getElementsByClassName("autocomplete-items");
			    for (var i = 0; i < x.length; i++) {
			      if (elmnt != x[i] && elmnt != inp) {
			        x[i].parentNode.removeChild(x[i]);
			      }
			    }
			  }
			  /*execute a function when someone clicks in the document:*/
			  document.addEventListener("click", function (e) {
			      closeAllLists(e.target);
			  });
			}

			var correos = ["jcarlos.aller@pandasfc.com","luisa.requejo@pandasfc.com","emil.holm@pandasfc.com", "abelen.cerrato@pandasfc.com", "samantha.johnson@pandasfc.com", "agustin.gasco@pandasfc.com", "silvia.porta@pandasfc.com", "julia.berrocal@pandasfc.com", "alfredo.bernad@pandasfc.com", "angeles.barbosa@pandasfc.com", "vicente.platero@pandasfc.com", "hugo.popescu@pandasfc.com", "catalina.acuna@pandasfc.com", "joan.abreu@pandasfc.com", "erika.nonoshita@pandasfc.com", "hugo.casal@pandasfc.com", "teresa.gavira@pandasfc.com", "nicolas.casanova@pandasfc.com", "oliver.anderson@pandasfc.com", "jordi.lorenzo@pandasfc.com", "cristina.viera@pandasfc.com", "ivan.palenzuela@pandasfc.com", "ming.wang@pandasfc.com", "cristobal.blas@pandasfc.com"];

			autocomplete(document.getElementById("correo"), correos);
	</script>

	<?php if (isset($_GET['enviado'])) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
			  $('#toast-enviado').toast('show');
			});
		</script>		
	<?php } ?>

	<?php if (isset($_GET['delete'])) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
			  $('#toast-delete').toast('show');
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