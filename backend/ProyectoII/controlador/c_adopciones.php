
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../conexion2.php';
include '../modelo/m_adopciones.php';

$control = $_GET['control'];

$adopciones = new M_adopciones($conexion2);

switch ($control) {
    case 'consulta':
        $vec = $adopciones->consultarAdopciones();
        break;

    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $adopciones->insertarAdopcion($params);
        break;

    case 'eliminar':
        $id = $_GET['id'];
        $vec = $adopciones->eliminarAdopcion($id);
        break;

    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $adopciones->editarAdopcion($id, $params);
        break;

    case 'filtrar':
        $filtros = json_decode(file_get_contents('php://input'), true);
        $vec = $adopciones->filtrarAdopciones($filtros);
        break;

    default:
        $vec = [];
        break;
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');
?>
