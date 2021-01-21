<?php
    if (isset($_POST['plantilla'])) {
    	$plantilla = $_POST['plantilla'];

        header("location: seleccionar_jugadores.php?plantilla=$plantilla");

    }
?>