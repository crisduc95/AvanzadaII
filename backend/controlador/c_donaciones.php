<?php
// Permitir el acceso desde cualquier origen (CORS)
header('Access-Control-Allow-Origin: *');
// Permitir ciertos encabezados
header('Access-Control-Allow-Headers: Origin, X-Requestd-With, Content-Type, Accept');

// Incluir el archivo de conexión y el modelo Donacion
require_once '../conexion.php';
require_once '../modelos/donaciones.php';

// Crear una instancia del modelo Donacion
$modeloDonacion = new ModeloDonacion($conexion);

// Verificar si se recibió la acción
if (isset($_GET['accion'])) {
    // Obtener la acción
    $accion = $_GET['accion'];

    // Según la acción recibida, realizar una tarea específica
    switch ($accion) {
        case 'consultar':
            // Consultar todas las donaciones
            $donaciones = $modeloDonacion->consultarDonaciones();
            // Devolver los resultados en formato JSON
            echo json_encode($donaciones);
            break;

        case 'insertar':
            // Obtener los datos de la nueva donación del cuerpo de la solicitud POST
            $tipo_donacion = $_POST['tipo_donacion'];
            $fecha_donacion = $_POST['fecha_donacion'];
            $id_adoptante = $_POST['id_adoptante'];

            // Insertar una nueva donación con los datos recibidos
            $resultado = $modeloDonacion->insertarDonacion($tipo_donacion, $fecha_donacion, $id_adoptante);
            // Devolver el resultado de la inserción en formato JSON
            echo json_encode($resultado);
            break;

        case 'eliminar':
            // Obtener el ID de la donación a eliminar de los parámetros de la URL
            $id = $_GET['id'];
            // Eliminar la donación con el ID especificado
            $resultado = $modeloDonacion->eliminarDonacion($id);
            // Devolver el resultado de la eliminación en formato JSON
            echo json_encode($resultado);
            break;

        case 'filtrar':
            // Obtener el filtro de búsqueda de los parámetros de la URL
            $filtro = $_GET['filtro'];
            // Filtrar las donaciones según el criterio especificado
            $resultado = $modeloDonacion->filtrarDonaciones($filtro);
            // Devolver los resultados del filtrado en formato JSON
            echo json_encode($resultado);
            break;

        case 'editar':
            // Verificar si se recibieron los datos necesarios para la edición
            if (isset($_POST['id_donacion'], $_POST['tipo_donacion'], $_POST['fecha_donacion'], $_POST['id_adoptante'])) {
                // Obtener los datos de la donación a editar del cuerpo de la solicitud POST
                $id_donacion = $_POST['id_donacion'];
                $tipo_donacion = $_POST['tipo_donacion'];
                $fecha_donacion = $_POST['fecha_donacion'];
                $id_adoptante = $_POST['id_adoptante'];
            
                // Editar la donación con los datos recibidos
                $resultado = $modeloDonacion->editarDonacion($id_donacion, $tipo_donacion, $fecha_donacion, $id_adoptante);
                // Devolver el resultado de la edición en formato JSON
                echo json_encode($resultado);
            } else {
                // Si no se recibieron todos los datos necesarios, devolver un mensaje de error en formato JSON
                echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionaron todos los datos necesarios para editar la donación'));
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
