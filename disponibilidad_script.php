<?php
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$_SESSION['disponibilidad'] = 1;

		header("location: menu.php?disponibilidad=true");
	}

?>