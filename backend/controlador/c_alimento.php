<?php
// Permitir el acceso desde cualquier origen (CORS)
header('Access-Control-Allow-Origin: *');
// Permitir ciertos encabezados
header('Access-Control-Allow-Headers: Origin, X-Requestd-With, Content-Type, Accept');

// Incluir el archivo de conexión y el modelo Alimento
include "../conexion.php";
include "../modelos/alimento.php";

// Crear una instancia del modelo Alimento
$modeloAlimento = new ModeloAlimento($conexion);

// Verificar si se recibió la acción
if (isset($_GET['accion'])) {
    // Obtener la acción
    $accion = $_GET['accion'];

    // Según la acción recibida, realizar una tarea específica
    switch ($accion) {
        case 'consultar':
            // Consultar todos los alimentos
            $alimentos = $modeloAlimento->consultarAlimentos();
            // Devolver los resultados en formato JSON
            echo json_encode($alimentos);
            break;

        case 'insertar':
            // Obtener los datos del nuevo alimento del cuerpo de la solicitud POST
            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $caducidad = $_POST['caducidad'];
            $cachorros = $_POST['cachorros'];

            // Insertar un nuevo alimento con los datos recibidos
            $resultado = $modeloAlimento->insertarAlimento($nombre, $cantidad, $caducidad, $cachorros);
            // Devolver el resultado de la inserción en formato JSON
            echo json_encode($resultado);
            break;

        case 'eliminar':
            // Obtener el ID del alimento a eliminar de los parámetros de la URL
            $id = $_GET['id'];
            // Eliminar el alimento con el ID especificado
            $resultado = $modeloAlimento->eliminarAlimento($id);
            // Devolver el resultado de la eliminación en formato JSON
            echo json_encode($resultado);
            break;

        case 'filtrar':
            // Obtener el filtro de búsqueda de los parámetros de la URL
            $filtro = $_GET['filtro'];
            // Filtrar los alimentos según el criterio especificado
            $resultado = $modeloAlimento->filtrarAlimentos($filtro);
            // Devolver los resultados del filtrado en formato JSON
            echo json_encode($resultado);
            break;

        case 'editar':
            // Verificar si se recibieron los datos necesarios para la edición
            if (isset($_POST['id'], $_POST['nombre'], $_POST['cantidad'], $_POST['caducidad'], $_POST['cachorros'])) {
                // Obtener los datos del alimento a editar del cuerpo de la solicitud POST
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $cantidad = $_POST['cantidad'];
                $caducidad = $_POST['caducidad'];
                $cachorros = $_POST['cachorros'];

                // Editar el alimento con los datos recibidos
                $resultado = $modeloAlimento->editarAlimento($id, $nombre, $cantidad, $caducidad, $cachorros);
                // Devolver el resultado de la edición en formato JSON
                echo json_encode($resultado);
            } else {
                // Si no se recibieron todos los datos necesarios, devolver un mensaje de error en formato JSON
                echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionaron todos los datos necesarios para editar el alimento'));
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
