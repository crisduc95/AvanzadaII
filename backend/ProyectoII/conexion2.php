<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $bd = "adopcion_2";

    $conexion2 = mysqli_connect($servidor,$usuario,$clave) or die("No encontro el server");
    mysqli_select_db($conexion2,$bd) or die("no enconetro la BD");
    #mysqli_set_charset($conexion,"");
    #echo "conexion extosa";
?>
