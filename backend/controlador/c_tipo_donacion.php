<?php
// Permitir el acceso desde cualquier origen (CORS)
header('Access-Control-Allow-Origin: *');
// Permitir ciertos encabezados
header('Access-Control-Allow-Headers: Origin, X-Requestd-With, Content-Type, Accept');

// Incluir el archivo de conexión y el modelo TipoDonacion
include '../conexion.php';
include '../modelos/tipo_donacion.php';

// Crear una instancia del modelo TipoDonacion
$modeloTipoDonacion = new ModeloTipoDonacion($conexion);

// Verificar si se recibió la acción
if (isset($_GET['accion'])) {
    // Obtener la acción
    $accion = $_GET['accion'];

    // Según la acción recibida, realizar una tarea específica
    switch ($accion) {
        case 'consultar':
            // Consultar todos los tipos de donación
            $tiposDonacion = $modeloTipoDonacion->consultarTipoDonacion();
            // Devolver los resultados en formato JSON
            echo json_encode($tiposDonacion);
            break;

        case 'insertar':
            // Obtener los datos del nuevo tipo de donación del cuerpo de la solicitud POST
            $id_alimento = $_POST['id_alimento'];
            $id_medicamento = $_POST['id_medicamento'];
            $id_otro = $_POST['id_otro'];

            // Insertar un nuevo tipo de donación con los datos recibidos
            $resultado = $modeloTipoDonacion->insertarTipoDonacion($id_alimento, $id_medicamento, $id_otro);
            // Devolver el resultado de la inserción en formato JSON
            echo json_encode($resultado);
            break;

        case 'eliminar':
            // Obtener el ID del tipo de donación a eliminar de los parámetros de la URL
            $id = $_GET['id'];
            // Eliminar el tipo de donación con el ID especificado
            $resultado = $modeloTipoDonacion->eliminarTipoDonacion($id);
            // Devolver el resultado de la eliminación en formato JSON
            echo json_encode($resultado);
            break;

        case 'filtrar':
            // Obtener el filtro de búsqueda de los parámetros de la URL
            $filtro = $_GET['filtro'];
            // Filtrar los tipos de donación según el criterio especificado
            $resultado = $modeloTipoDonacion->filtrarTipoDonacion($filtro);
            // Devolver los resultados del filtrado en formato JSON
            echo json_encode($resultado);
            break;

        case 'editar':
            // Verificar si se recibieron los datos necesarios para la edición
            if (isset($_POST['id'], $_POST['id_alimento'], $_POST['id_medicamento'], $_POST['id_otro'])) {
                // Obtener los datos del tipo de donación a editar del cuerpo de la solicitud POST
                $id = $_POST['id'];
                $id_alimento = $_POST['id_alimento'];
                $id_medicamento = $_POST['id_medicamento'];
                $id_otro = $_POST['id_otro'];
            
                // Editar el tipo de donación con los datos recibidos
                $resultado = $modeloTipoDonacion->editarTipoDonacion($id, $id_alimento, $id_medicamento, $id_otro);
                // Devolver el resultado de la edición en formato JSON
                echo json_encode($resultado);
            } else {
                // Si no se recibieron todos los datos necesarios, devolver un mensaje de error en formato JSON
                echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionaron todos los datos necesarios para editar el tipo de donación'));
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
