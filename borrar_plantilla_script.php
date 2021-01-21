<?php
    if ($_SERVER["REQUEST_METHOD"]) {

        include("database.php");
        $borrar = "UPDATE partido SET plantilla_creada = 0 WHERE idPartido = 1;";
        $borrado = $mysqli->prepare($borrar);
        $borrado->execute();

        header("location: plantilla.php?delete=true");

    }
?>