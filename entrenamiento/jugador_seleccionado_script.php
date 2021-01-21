<?php
    if (isset($_POST['player'])) {

    	$player = $_POST['player'];
        header("location: seleccionar_fecha_tipo.php?player=$player");

    } 
?>