<?php
    if (isset($_POST['id']) and isset($_POST['fecha']) and isset($_POST['tipo_entrenamiento']) and isset($_POST['tipo_ejercicio']) and isset($_POST['ejercicio'])) {

    	include("../database.php");

    	$id = $_POST['id'];
    	$fecha = $_POST['fecha'];
    	$tipo_entrenamiento = $_POST['tipo_entrenamiento'];
    	$tipo_ejercicio = $_POST['tipo_ejercicio'];
    	$ejercicio = $_POST['ejercicio'];

    	$sql = "INSERT INTO usuarioejercicio (idUsuario, idEjercicio, fecha) VALUES ('$id', '$ejercicio', '$fecha')";
    	$result = $mysqli->prepare($sql);
		$result->execute();

		header("location: entrenador.php?creado=true");

    } 
?>