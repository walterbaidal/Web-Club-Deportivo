<?php

//insert.php

include("../database.php");
if(isset($_POST["title"]) and isset($_POST['type']))	{


	$titulo = $_POST['title'];
	$fecha_old = $_POST['date'];
	$hora =  $_POST['time'];
	$tipo = $_POST['type'];

	
	preg_match('/(\d*):(\d*):(\d*)/', $hora, $hms);


	$fecha_edit = new DateTime($fecha_old);
	$fecha_edit->setTime($hms[1],$hms[2],$hms[3]);
	$fecha = $fecha_edit->format('Y-m-d H:i:s');

	$query = " INSERT INTO evento (titulo, fecha, hora, idTipoEvento)  VALUES ('$titulo', '$fecha', '$hora', '$tipo') ";
	$statement = $mysqli->prepare($query);
	$statement->execute();
}


?>