<?php
// Permitir el acceso desde cualquier origen (CORS)
header('Access-Control-Allow-Origin: *');
// Permitir ciertos encabezados
header('Access-Control-Allow-Headers: Origin, X-Requestd-With, Content-Type, Accept');

// Incluir el archivo de conexión y el modelo Sistema
require_once '../conexion.php';
require_once '../modelos/sistema.php';

// Crear una instancia del modelo Sistema
$modeloSistema = new ModeloSistema($conexion);

// Verificar si se recibió la acción
if (isset($_GET['accion'])) {
    // Obtener la acción
    $accion = $_GET['accion'];

    // Según la acción recibida, realizar una tarea específica
    switch ($accion) {
        case 'consultar':
            // Consultar todos los sistemas
            $sistemas = $modeloSistema->consultarSistema();
            // Devolver los resultados en formato JSON
            echo json_encode($sistemas);
            break;

        case 'insertar':
            // Obtener los datos del nuevo sistema del cuerpo de la solicitud POST
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email_corporativo = $_POST['email_corporativo'];
            $password = $_POST['password'];
            $activo = $_POST['activo'];

            // Insertar un nuevo sistema con los datos recibidos
            $resultado = $modeloSistema->insertarSistema($nombre, $apellido, $email_corporativo, $password, $activo);
            // Devolver el resultado de la inserción en formato JSON
            echo json_encode($resultado);
            break;

        case 'eliminar':
            // Obtener el ID del sistema a eliminar de los parámetros de la URL
            $id = $_GET['id'];
            // Eliminar el sistema con el ID especificado
            $resultado = $modeloSistema->eliminarSistema($id);
            // Devolver el resultado de la eliminación en formato JSON
            echo json_encode($resultado);
            break;

        case 'filtrar':
            // Obtener el filtro de búsqueda de los parámetros de la URL
            $filtro = $_GET['filtro'];
            // Filtrar los sistemas según el criterio especificado
            $resultado = $modeloSistema->filtrarSistema($filtro);
            // Devolver los resultados del filtrado en formato JSON
            echo json_encode($resultado);
            break;

        case 'editar':
            // Verificar si se recibieron los datos necesarios para la edición
            if (isset($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['email_corporativo'], $_POST['password'], $_POST['activo'])) {
                // Obtener los datos del sistema a editar del cuerpo de la solicitud POST
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $email_corporativo = $_POST['email_corporativo'];
                $password = $_POST['password'];
                $activo = $_POST['activo'];

                // Editar el sistema con los datos recibidos
                $resultado = $modeloSistema->editarSistema($id, $nombre, $apellido, $email_corporativo, $password, $activo);
                // Devolver el resultado de la edición en formato JSON
                echo json_encode($resultado);
            } else {
                // Si no se recibieron todos los datos necesarios, devolver un mensaje de error en formato JSON
                echo json_encode(array('resultado' => 'Error', 'mensaje' => 'No se proporcionaron todos los datos necesarios para editar el sistema'));
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
