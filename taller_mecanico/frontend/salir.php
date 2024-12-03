<?php
    require '../backend/bd/Conexion.php';
    session_destroy();

    header('Location: ../index.php');
?>
