<?php
// Permitir el acceso desde cualquier origen (CORS)
header('Access-Control-Allow-Origin: *');
// Permitir ciertos encabezados
header('Access-Control-Allow-Headers: Origin, X-Requestd-With, Content-Type, Accept');

// Incluir el archivo de conexión y el modelo Animal
include '../conexion.php';
include '../modelos/animales.php';

// Crear una instancia del modelo Animal
$modeloAnimal = new ModeloAnimal($conexion);

// Verificar si se recibió la acción
if (isset($_GET['accion'])) {
    // Obtener la acción
    $accion = $_GET['accion'];

    // Según la acción recibida, realizar una tarea específica
    switch ($accion) {
        case 'consultar':
            // Consultar todos los animales
            $animales = $modeloAnimal->consultarAnimales();
            // Devolver los resultados en formato JSON
            echo json_encode($animales);
            break;

        case 'insertar':
            // Obtener los datos del nuevo animal del cuerpo de la solicitud POST
            $nombre = $_POST['nombre'];
            $raza = $_POST['raza'];
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];
            $descripcion = $_POST['descripcion'];
            $foto = $_POST['foto'];
            $estado = $_POST['estado'];
            $id_usuario_protector = $_POST['id_usuario_protector'];

            // Insertar un nuevo animal con los datos recibidos
            $resultado = $modeloAnimal->insertarAnimal($nombre, $raza, $edad, $sexo, $descripcion, $foto, $estado, $id_usuario_protector);
            // Devolver el resultado de la inserción en formato JSON
            echo json_encode($resultado);
            break;

        case 'eliminar':
            // Obtener el ID del animal a eliminar de los parámetros de la URL
            $id_animal = $_GET['id_animal'];
            // Eliminar el animal con el ID especificado
            $resultado = $modeloAnimal->eliminarAnimal($id_animal);
            // Devolver el resultado de la eliminación en formato JSON
            echo json_encode($resultado);
            break;

        case 'filtrar':
            // Obtener el filtro de búsqueda de los parámetros de la URL
            $filtro = $_GET['filtro'];
            // Filtrar los animales según el criterio especificado
            $resultado = $modeloAnimal->filtrarAnimales($filtro);
            // Devolver los resultados del filtrado en formato JSON
            echo json_encode($resultado);
            break;

        case 'editar':
            // Verificar si se recibieron los datos necesarios para la edición
            if (isset($_POST['id'], $_POST['nombre'], $_POST['raza'], $_POST['edad'], $_POST['sexo'], $_POST['descripcion'], $_POST['foto'], $_POST['estado'], $_POST['id_usuario_protector'])) {
                // Obtener los datos del animal a editar del cuerpo de la solicitud POST
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $raza = $_POST['raza'];
                $edad = $_POST['edad'];
                $sexo = $_POST['sexo'];
                $descripcion = $_POST['descripcion'];
                $foto = $_POST['foto'];
                $estado = $_POST['estado'];
                $id_usuario_protector = $_POST['id_usuario_protector'];
            
                // Editar el animal con los datos recibidos
                $resultado = $modeloAnimal->editarAnimal($id, $nombre, $raza, $edad, $sexo, $descripcion, $foto, $estado, $id_usuario_protector);
                // Devolver el resultado de la edición en formato JSON
                echo json_encode($resultado);
            } else {
                // Si no se recibieron todos los datos necesarios, devolver un mensaje de error en formato JSON
                echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionaron todos los datos necesarios para editar el animal'));
            }
            break;
            

        default:
            // Si la acción no es reconocida, devolver un mensaje de error en formato JSON
            echo json_encode(array('mensaje' => 'Acción no válida'));
            break;
    }
} else {
    // Si no se especificó ninguna acción, devolver un mensaje de advertencia en formato JSON
    echo json_encode(array('mensaje' => 'No se especificó ninguna acción'));
}
?>
