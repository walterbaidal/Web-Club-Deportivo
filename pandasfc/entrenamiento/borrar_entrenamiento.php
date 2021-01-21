<?php
    if (isset($_POST['id'])) {

        include("../database.php");
        $id =  $_POST['id'];
        $borrar = "delete from usuarioejercicio where idUsuarioEjercicio = '$id'";
        $borrado = $mysqli->prepare($borrar);
        $borrado->execute();

        header("location: entrenador.php?borrado=true");

    }
?>