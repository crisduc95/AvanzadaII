<?php
// Permitir el acceso desde cualquier origen (CORS)
header('Access-Control-Allow-Origin: *');
// Permitir ciertos encabezados
header('Access-Control-Allow-Headers: Origin, X-Requestd-With, Content-Type, Accept');

// Incluir el archivo de conexión y el modelo OtraDonacion
require_once '../conexion.php';
require_once '../modelos/otra_donacion.php';

// Crear una instancia del modelo OtraDonacion
$modeloOtraDonacion = new ModeloOtraDonacion($conexion);

// Verificar si se recibió la acción
if (isset($_GET['accion'])) {
    // Obtener la acción
    $accion = $_GET['accion'];

    // Según la acción recibida, realizar una tarea específica
    switch ($accion) {
        case 'consultar':
            // Consultar todas las otras donaciones
            $otrasDonaciones = $modeloOtraDonacion->consultarOtraDonacion();
            // Devolver los resultados en formato JSON
            echo json_encode($otrasDonaciones);
            break;

        case 'insertar':
            // Obtener los datos de la nueva otra donación del cuerpo de la solicitud POST
            $descripcion = $_POST['descripcion'];
            $fecha_donacion = $_POST['fecha_donacion'];
            $id_adoptante = $_POST['id_adoptante'];

            // Insertar una nueva otra donación con los datos recibidos
            $resultado = $modeloOtraDonacion->insertarOtraDonacion($descripcion, $fecha_donacion, $id_adoptante);
            // Devolver el resultado de la inserción en formato JSON
            echo json_encode($resultado);
            break;

        case 'eliminar':
            // Obtener el ID de la otra donación a eliminar de los parámetros de la URL
            $id = $_GET['id'];
            // Eliminar la otra donación con el ID especificado
            $resultado = $modeloOtraDonacion->eliminarOtraDonacion($id);
            // Devolver el resultado de la eliminación en formato JSON
            echo json_encode($resultado);
            break;

        case 'filtrar':
            // Obtener el filtro de búsqueda de los parámetros de la URL
            $filtro = $_GET['filtro'];
            // Filtrar las otras donaciones según el criterio especificado
            $resultado = $modeloOtraDonacion->filtrarOtraDonacion($filtro);
            // Devolver los resultados del filtrado en formato JSON
            echo json_encode($resultado);
            break;

        case 'editar':
            // Verificar si se recibieron los datos necesarios para la edición
            if (isset($_POST['id'], $_POST['descripcion'], $_POST['fecha_donacion'], $_POST['id_adoptante'])) {
                // Obtener los datos de la otra donación a editar del cuerpo de la solicitud POST
                $id = $_POST['id'];
                $descripcion = $_POST['descripcion'];
                $fecha_donacion = $_POST['fecha_donacion'];
                $id_adoptante = $_POST['id_adoptante'];
            
                // Editar la otra donación con los datos recibidos
                $resultado = $modeloOtraDonacion->editarOtraDonacion($id, $descripcion, $fecha_donacion, $id_adoptante);
                // Devolver el resultado de la edición en formato JSON
                echo json_encode($resultado);
            } else {
                // Si no se recibieron todos los datos necesarios, devolver un mensaje de error en formato JSON
                echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionaron todos los datos necesarios para editar la otra donación'));
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
