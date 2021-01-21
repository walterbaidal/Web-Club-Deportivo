<?php
    if (isset($_POST['id']) and isset($_POST['fecha']) and isset($_POST['tipo_entrenamiento'])) {

    	$id = $_POST['id'];
    	$fecha = $_POST['fecha'];
    	$tipo = $_POST['tipo_entrenamiento'];

        header("location: seleccionar_tipo_ejercicio.php?id=$id&fecha=$fecha&tipo=$tipo");

    } 
?>