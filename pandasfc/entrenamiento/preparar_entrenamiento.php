<?php
    if (isset($_POST['id']) and isset($_POST['fecha']) and isset($_POST['tipo_entrenamiento']) and isset($_POST['tipo_ejercicio'])) {

    	$id = $_POST['id'];
    	$fecha = $_POST['fecha'];
    	$tipo = $_POST['tipo_entrenamiento'];
    	$ejercicio = $_POST['tipo_ejercicio'];

        header("location: confirmar_entrenamiento.php?id=$id&fecha=$fecha&tipo=$tipo&ejercicio=$ejercicio");

    } 
?>