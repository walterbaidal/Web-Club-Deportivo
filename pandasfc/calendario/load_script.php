<?php

//load.php


include("../database.php");
$data = array();
$query = "SELECT * FROM evento ORDER BY idEvento";
$result = $mysqli->query($query);

$row = $result->fetch_array(MYSQLI_ASSOC);

foreach($result as $row)
{

	$tipo = $row["idTipoEvento"];

	switch($tipo) {
		case 1:
			$tipo_evento = "Cena";
			$color = 'purple';
			break;
		case 2:
			$tipo_evento = "Fiesta";
			$color = 'light-blue';
			break;
		case 3:
			$tipo_evento = "Reunion";
			$color = 'green';
			break;
		case 4:
			$tipo_evento = "Liga";
			$color = 'black';
			break;
		case 5:
			$tipo_evento = "Copa";
			$color = 'red';
			break;
		case 6:
			$tipo_evento = "Torneo";
			$color = 'grey';
			break;
	}

	$data[] = array(
		'id'   => $row["idEvento"],
		'title'   => $row["titulo"],
		'description' => $row['titulo'],
		'start'   => $row["fecha"],
		'time'   => $row["hora"],
		'id_type' => $tipo,
		'type' => $tipo_evento,
		'color' => $color
	);

}

echo json_encode($data); 

?>