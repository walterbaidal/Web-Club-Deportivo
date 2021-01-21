<?php

include("../database.php");
if(isset($_POST["id"])) {
 	
 	$id = $_POST["id"];
	$query = "DELETE from evento WHERE idEvento = '$id'";
	$statement = $mysqli->prepare($query);
	$statement->execute();
}

?>