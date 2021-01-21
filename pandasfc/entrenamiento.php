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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>

	<style type="text/css">

		.current {
			background-color: grey;
		}

		.navbar-nav > li:hover, .navbar-default .navbar-nav > li:focus {
		    background-color: grey !important;
		}

		.navbar {
			padding: 0 !important;
		}

		.nav-item > a{
			margin: 0.4rem;
		}

		html, body {
		    height:100%;
		}


		body {
			background-image: url("https://media.contentapi.ea.com/content/dam/ea/fifa/fifa-20/global-assets/common/featuredimage.png.adapt.crop191x100.1200w.png");
			background-repeat: no-repeat;
			background-size: cover;
	 		background-attachment: fixed;
		}
		.container {
		    padding-top: 5%;

		}
	</style>

	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link d-flex align-items-center" href="menu.php">
		        	<img src="CDI/CDI/Home.png" width="18" height="18" class="d-inline-block" alt="">
		        	&nbsp;Home
		        </a>
		      </li>

		      <li class="nav-item">
		        <a class="nav-link  d-flex align-items-center" href="calendario.php">
		        	<img src="CDI/CDI/3 - Menú principal - Jugador/Calendario.png" width="18" height="18" class="d-inline-block" alt="">
		        	&nbsp;Calendario
		        	
		    	</a>
		      </li>

		      <li class="nav-item">
		        <a class="nav-link d-flex align-items-center" href="notificacion.php">
		        	<img src="CDI/CDI/3 - Menú principal - Jugador/Notificacion.png" width="18" height="18" class="d-inline-block" alt="">
		        	&nbsp;Notificacion
		        	
		        </a>
		      </li>

		      <?php 
		      	if ($_SESSION['tipo_usuario'] == 2) {
		      ?>

		      <li class="nav-item">
		        <a class="nav-link d-flex align-items-center" href="perfil.php">
		        	<img src="CDI/CDI/3 - Menú principal - Jugador/Perfil.png" width="18" height="18" class="d-inline-block" alt="">
		        	&nbsp;Perfil</a>
		      </li>

		      <li class="nav-item">
		        <a class="nav-link d-flex align-items-center" href="ranking.php">
		        	<img src="CDI/CDI/3 - Menú principal - Jugador/Ranking.png" width="18" height="18" class="d-inline-block" alt="">
		        	&nbsp;Ranking</a>
		        	
		      </li>

		      <?php 
		      	} else {
		      ?>

		      <li class="nav-item">
		        <a class="nav-link d-flex align-items-center" href="plantilla.php">
		        	<img src="CDI/CDI/3 - Menú principal - Entrenador/Plantilla.png" width="18" height="18" class="d-inline-block" alt="">
		        	&nbsp;Plantilla</a>
		      </li>

		      <?php 
		      	}
		      ?>

		      <li class="nav-item active current">
		        <a class="nav-link disabled d-flex align-items-center" href="entrenamiento.php">
		        	<img src="CDI/CDI/3 - Menú principal - Jugador/Entrenamiento.png" width="18" height="18" class="d-inline-block" alt="">
		        	&nbsp;Entrenamiento</a>
		        	<span class="sr-only">(current)</span>
		      </li>
		    </ul>
		    <ul class="navbar-nav ml-auto">
				<a class="navbar-brand" href="logout_script.php" >
				    Desconectar
				    <img src="CDI/CDI/Cerrar Sesión.png" width="18" height="18" class="d-inline-block" alt="">
			  	</a>
			</ul>
		  </div>
		</nav>
	</div>

	<?php if() ?>
	ENTRENADOR
	
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