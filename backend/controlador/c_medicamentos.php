<?php
// Permitir el acceso desde cualquier origen (CORS)
header('Access-Control-Allow-Origin: *');
// Permitir ciertos encabezados
header('Access-Control-Allow-Headers: Origin, X-Requestd-With, Content-Type, Accept');

// Incluir el archivo de conexión y el modelo Medicamento
require_once '../conexion.php';
require_once '../modelos/medicamentos.php';

// Crear una instancia del modelo Medicamento
$modeloMedicamento = new ModeloMedicamento($conexion);

// Verificar si se recibió la acción
if (isset($_GET['accion'])) {
    // Obtener la acción
    $accion = $_GET['accion'];

    // Según la acción recibida, realizar una tarea específica
    switch ($accion) {
        case 'consultar':
            // Consultar todos los medicamentos
            $medicamentos = $modeloMedicamento->consultarMedicamentos();
            // Devolver los resultados en formato JSON
            echo json_encode($medicamentos);
            break;

        case 'insertar':
            // Obtener los datos del nuevo medicamento del cuerpo de la solicitud POST
            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $fecha_caducidad = $_POST['fecha_caducidad'];
            $descripcion = $_POST['descripcion'];

            // Insertar un nuevo medicamento con los datos recibidos
            $resultado = $modeloMedicamento->insertarMedicamento($nombre, $cantidad, $fecha_caducidad, $descripcion);
            // Devolver el resultado de la inserción en formato JSON
            echo json_encode($resultado);
            break;

        case 'eliminar':
            // Obtener el ID del medicamento a eliminar de los parámetros de la URL
            $id = $_GET['id'];
            // Eliminar el medicamento con el ID especificado
            $resultado = $modeloMedicamento->eliminarMedicamento($id);
            // Devolver el resultado de la eliminación en formato JSON
            echo json_encode($resultado);
            break;

        case 'filtrar':
            // Obtener el filtro de búsqueda de los parámetros de la URL
            $filtro = $_GET['filtro'];
            // Filtrar los medicamentos según el criterio especificado
            $resultado = $modeloMedicamento->filtrarMedicamentos($filtro);
            // Devolver los resultados del filtrado en formato JSON
            echo json_encode($resultado);
            break;

        case 'editar':
            // Verificar si se recibieron los datos necesarios para la edición
            if (isset($_POST['id'], $_POST['nombre'], $_POST['cantidad'], $_POST['fecha_caducidad'], $_POST['descripcion'])) {
                // Obtener los datos del medicamento a editar del cuerpo de la solicitud POST
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $cantidad = $_POST['cantidad'];
                $fecha_caducidad = $_POST['fecha_caducidad'];
                $descripcion = $_POST['descripcion'];
            
                // Editar el medicamento con los datos recibidos
                $resultado = $modeloMedicamento->editarMedicamento($id, $nombre, $cantidad, $fecha_caducidad, $descripcion);
                // Devolver el resultado de la edición en formato JSON
                echo json_encode($resultado);
            } else {
                // Si no se recibieron todos los datos necesarios, devolver un mensaje de error en formato JSON
                echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionaron todos los datos necesarios para editar el medicamento'));
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
