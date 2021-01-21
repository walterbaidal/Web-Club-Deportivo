<?php
    if (isset($_POST['msg_id'])) {

        include("database.php");
        $msg_id =  $_POST['msg_id'];
        $borrar = "update mensaje set mensaje.leido = 1 where mensaje.idMensaje = '$msg_id'";
        $borrado = $mysqli->prepare($borrar);
        $borrado->execute();

        header("location: notificacion.php");

    }
?>