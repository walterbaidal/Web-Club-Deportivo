<?php
    if (isset($_POST['msg_id'])) {

        include("database.php");
        $msg_id =  $_POST['msg_id'];
        $borrar = "delete from mensaje where idMensaje = '$msg_id'";
        $borrado = $mysqli->prepare($borrar);
        $borrado->execute();

        header("location: notificacion.php?delete=true");

    }
?>