<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $bd = "proyecto_adopcion";

    $conexion = mysqli_connect($servidor,$usuario,$clave) or die("No encontro el server");
    mysqli_select_db($conexion,$bd) or die("no enconetro la BD");
    #mysqli_set_charset($conexion,"utf-8");
    //echo "conexion extosa";
?>
