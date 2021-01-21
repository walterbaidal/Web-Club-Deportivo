
<?php

//insert.php

include("../database.php");
if(isset($_POST["id"]) and isset($_POST['title']) and isset($_POST['date']) and isset($_POST['time']) and isset($_POST['type']))	{

	$id = $_POST['id'];
	$titulo = $_POST['title'];
	$fecha_completa = $_POST['date'];
	$hora =  $_POST['time'];
	$tipo = $_POST['type'];

	$fecha_old = new DateTime($fecha_completa);
	$fecha_new = $fecha_old->format('Y-m-d');

	preg_match('/(\d*):(\d*):(\d*)/', $hora, $hms);

	$fecha_edit = new DateTime($fecha_new);
	$fecha_edit->setTime($hms[1],$hms[2],$hms[3]);
	$fecha = $fecha_edit->format('Y-m-d H:i:s');

	$query = " UPDATE evento SET titulo = '$titulo', fecha = '$fecha', hora = '$hora', idTipoEvento = '$tipo' WHERE idEvento = $id";
	$statement = $mysqli->prepare($query);
	$statement->execute();
}


?>