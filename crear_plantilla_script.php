<?php 

	include("database.php");
	
	if($_SERVER["REQUEST_METHOD"]) {

		$sql = "update plantilla set titular = 1  where idUsuario = 4 or idUsuario = 13 or idUsuario = 16 or idUsuario = 2 or idUsuario = 8  or idUsuario = 15 or idUsuario = 6 or idUsuario = 7 or idUsuario = 14 or idUsuario = 10 or idUsuario = 3;";
		$result = $mysqli->prepare($sql);
		$result->execute();

		$sql2 = "update partido set plantilla_creada = 1 where idPartido = 1";
		$result2 = $mysqli->prepare($sql2);
		$result2->execute();

		header("location: plantilla.php?creada=true");
	}

?>