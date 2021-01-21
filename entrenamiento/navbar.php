<nav class="navbar navbar-expand-lg navbar-light bg-light">		  
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
  	</button>
  	<div class="collapse navbar-collapse" id="navbarNav">
    	<ul class="navbar-nav">
      		<li class="nav-item">
        		<a class="nav-link d-flex align-items-center" href="../menu.php">
        			<img src="../CDI/CDI/Menu/Home.png" width="18" class="d-inline-block" alt="">
        			&nbsp;&nbsp;Inicio
        			
       			 </a>
      		</li>

     	 	<li class="nav-item">
	        	<a class="nav-link d-flex align-items-center" href="../calendario.php">
	        		<img src="../CDI/CDI/Menu/Calendario.png" width="18"  class="d-inline-block" alt="">
	        		&nbsp;&nbsp;Calendario
	    		</a>
      		</li>

      		<li class="nav-item">
        		<a class="nav-link d-flex align-items-center" href="../notificacion.php">
        			<img src="../CDI/CDI/Menu/Notificaciones.png" width="18"  class="d-inline-block" alt="">
        			&nbsp;&nbsp;Notificación
        		</a>
      		</li>

	      	<?php 
	      		if ($_SESSION['tipo_usuario'] == 2) {
	      	?>

      		<li class="nav-item">
		        <a class="nav-link d-flex align-items-center" href="../perfil.php">
		        	<img src="../CDI/CDI/Menu/Perfil.png" width="18"  class="d-inline-block" alt="">
		        	&nbsp;&nbsp;Perfil
		        </a>
      		</li>

      		<li class="nav-item">
        		<a class="nav-link d-flex align-items-center" href="../ranking.php">
        			<img src="../CDI/CDI/Menu/Ranking.png" width="18"  class="d-inline-block" alt="">
        			&nbsp;&nbsp;Ranking
        		</a>
      		</li>

      		<?php 
      			} else {
      		?>

      		<li class="nav-item">
        		<a class="nav-link d-flex align-items-center" href="../plantilla.php">
        			<img src="../CDI/CDI/Menu/Plantilla.png" width="18" height="18" class="d-inline-block" alt="">
        			&nbsp;&nbsp;Plantilla
        		</a>
 		 	</li>

      		<?php 
      			}
      		?>

      		<li class="nav-item active current">
        		<a class="nav-link d-flex align-items-center disabled" href="entrenamiento/<?php if ($_SESSION['tipo_usuario'] == 2) { echo "jugador.php"; } else { echo "entrenador.php"; } ?>">
        			<img src="../CDI/CDI/Menu/Entrenamiento.png" width="18"  class="d-inline-block" alt="">
        			&nbsp;&nbsp;Entrenamiento
              <span class="sr-only">(current)</span>
        		</a>
      		</li>
    	</ul>

    	<ul class="navbar-nav ml-auto">
    		<li class="nav-item">
				<a class="nav-link d-flex align-items-center" href="../logout_script.php" >
			    	Desconectar&nbsp;&nbsp;
			    	<img src="../CDI/CDI/Menu/Desconectar.png" width="18" class="d-inline-block" alt="">
		  		</a>
			</li>
		</ul>
  	</div>
</nav>