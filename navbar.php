<nav class="navbar navbar-expand-lg navbar-light bg-light">		  
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
  	</button>
  	<div class="collapse navbar-collapse" id="navbarNav">
    	<ul class="navbar-nav">
      		<li class="nav-item <?php if ($opcion == 1) { echo "active current"; } ?>">
        		<a class="nav-link d-flex align-items-center <?php if ($opcion == 1) { echo "disabled"; } ?>" href="menu.php">
        			<img src="CDI/CDI/Menu/Home.png" width="18" class="d-inline-block" alt="">
        			&nbsp;&nbsp;Inicio
        				<?php if ($opcion == 1) { ?>
        					<span class="sr-only">(current)</span>
        				<?php  } ?>
       			 </a>
      		</li>

     	 	<li class="nav-item <?php if ($opcion == 2) { echo "active current"; } ?>">
	        	<a class="nav-link d-flex align-items-center <?php if ($opcion == 2) { echo "disabled"; } ?>" href="calendario.php">
	        		<img src="CDI/CDI/Menu/Calendario.png" width="18"  class="d-inline-block" alt="">
	        		&nbsp;&nbsp;Calendario
	        			<?php if ($opcion == 2) { ?>
        					<span class="sr-only">(current)</span>
        				<?php  } ?>
	    		</a>
      		</li>

      		<li class="nav-item <?php if ($opcion == 3) { echo "active current"; } ?>">
        		<a class="nav-link d-flex align-items-center <?php if ($opcion == 3) { echo "disabled"; } ?>" href="notificacion.php">
        			<img src="CDI/CDI/Menu/Notificaciones.png" width="18"  class="d-inline-block" alt="">
        			&nbsp;&nbsp;Notificación
        				<?php if ($opcion == 3) { ?>
        					<span class="sr-only">(current)</span>
        				<?php  } ?>
        		</a>
      		</li>

	      	<?php 
	      		if ($_SESSION['tipo_usuario'] == 2) {
	      	?>

      		<li class="nav-item <?php if ($opcion == 4) { echo "active current"; } ?>">
		        <a class="nav-link d-flex align-items-center <?php if ($opcion == 4) { echo "disabled"; } ?>" href="perfil.php">
		        	<img src="CDI/CDI/Menu/Perfil.png" width="18"  class="d-inline-block" alt="">
		        	&nbsp;&nbsp;Perfil
		        		<?php if ($opcion == 4) { ?>
        					<span class="sr-only">(current)</span>
        				<?php  } ?>
		        </a>
      		</li>

      		<li class="nav-item <?php if ($opcion == 5) { echo "active current"; } ?>">
        		<a class="nav-link d-flex align-items-center <?php if ($opcion == 5) { echo "disabled"; } ?>" href="ranking.php">
        			<img src="CDI/CDI/Menu/Ranking.png" width="18"  class="d-inline-block" alt="">
        			&nbsp;&nbsp;Ranking
        				<?php if ($opcion == 5) { ?>
        					<span class="sr-only">(current)</span>
        				<?php  } ?>
        		</a>
      		</li>

      		<?php 
      			} else {
      		?>

      		<li class="nav-item <?php if ($opcion == 6) { echo "active current"; } ?>">
        		<a class="nav-link d-flex align-items-center <?php if ($opcion == 6) { echo "disabled"; } ?>" href="plantilla.php">
        			<img src="CDI/CDI/Menu/Plantilla.png" width="18" height="18" class="d-inline-block" alt="">
        			&nbsp;&nbsp;Plantilla
        				<?php if ($opcion == 6) { ?>
        					<span class="sr-only">(current)</span>
        				<?php  } ?>
        		</a>
 		 	</li>

      		<?php 
      			}
      		?>

      		<li class="nav-item">
        		<a class="nav-link d-flex align-items-center" href="entrenamiento/<?php if ($_SESSION['tipo_usuario'] == 2) { echo "jugador.php"; } else { echo "entrenador.php"; } ?>">
        			<img src="CDI/CDI/Menu/Entrenamiento.png" width="18"  class="d-inline-block" alt="">
        			&nbsp;&nbsp;Entrenamiento
        		</a>
      		</li>
    	</ul>

    	<ul class="navbar-nav ml-auto">
    		<li class="nav-item">
				<a class="nav-link d-flex align-items-center" href="logout_script.php" >
			    	Desconectar&nbsp;&nbsp;
			    	<img src="CDI/CDI/Menu/Desconectar.png" width="18" class="d-inline-block" alt="">
		  		</a>
			</li>
		</ul>
  	</div>
</nav>