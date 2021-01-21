<?php
    if (isset($_POST['id'])) {

        include("../database.php");
        $id =  $_POST['id'];
        $borrar = "update usuarioejercicio set usuarioejercicio.realizado = 1 where usuarioejercicio.idEjercicio = '$id'";
        $borrado = $mysqli->prepare($borrar);
        $borrado->execute();

        header("location: jugador.php");

    }
?>