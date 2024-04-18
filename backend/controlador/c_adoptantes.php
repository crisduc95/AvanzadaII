<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
    header('Content-Type: application/json');

    include '../conexion.php';
    include '../modelos/adoptantes.php';

    $adoptantes = new Adoptantes($conexion);

    if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    switch ($accion) {
        case 'consultar':
        $adoptantes = $adoptantes->consultarAdoptantes();
        echo json_encode($adoptantes);
        break;

        case 'insertar':
        // Manejar la inserción de un nuevo adoptante
        if (isset($_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'], $_POST['email'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];

            $resultado = $adoptantes->insertarAdoptante($nombre, $apellido, $direccion, $telefono, $email);
            echo json_encode($resultado);
        } else {
            echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionaron todos los datos necesarios para insertar el adoptante'));
        }
        break;

        case 'eliminar':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $vec = $adoptantes->eliminarAdoptante($id);
            echo json_encode($resultado);
        } else {
            echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionó el ID del adoptante a eliminar'));
        }
        break;

        case 'editar':
        // Manejar la edición de un adoptante
        if (isset($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'], $_POST['email'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];

            $resultado = $adoptantes->editarAdoptante($id, $nombre, $apellido, $direccion, $telefono, $email);
            echo json_encode($resultado);
        } else {
            echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionaron todos los datos necesarios para editar el adoptante'));
        }
        break;

        case 'filtrar':
        if (isset($_GET['filtro'])) {
            $filtro = $_GET['filtro'];
            $resultado = $adoptantes->filtrarAdoptantes($filtro);
            echo json_encode($resultado);
        } else {
            echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionó el filtro de búsqueda'));
        }
        break;

        default:
        echo json_encode(array('mensaje' => 'Acción no válida'));
        break;
    }
    } else {
    echo json_encode(array('mensaje' => 'No se especificó ninguna acción'));
    }
?>
