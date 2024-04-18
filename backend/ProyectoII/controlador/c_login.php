<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

    include_once '../conexion2.php';
    include_once '../modelo/m_login.php';

    // Obtener los datos del formulario o petición
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    $contrasena = isset($_GET['contrasena']) ? $_GET['contrasena'] : '';

    // Crear una instancia del modelo M_login
    $login = new M_login($conexion2);

    // Consultar el usuario administrador utilizando el método consultarUsuarioAdministrador
    $vec = $login->consultarUsuarioAdministrador($email, $contrasena);

    // Convertir el resultado a formato JSON y enviarlo como respuesta
    $datosj = json_encode($vec);
    header('Content-Type: application/json');
    echo $datosj;
?>
