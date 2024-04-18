<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../conexion2.php';
include '../modelo/m_interesados_adopcion.php';

$control = $_GET['control'];

$interesadosAdopcion = new M_interesados_adopcion($conexion2);

switch ($control) {
    case 'consulta':
        $vec = $interesadosAdopcion->consultarInteresadosAdopcion();
        break;

    case 'insertar':
        $json=file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $interesadosAdopcion->insertarInteresadoAdopcion($params);
        break;

    case 'eliminar':
        $id = $_GET['id'];
        $vec = $interesadosAdopcion->eliminarInteresadoAdopcion($id);
        break;

    case 'editar':
        $json=file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $interesadosAdopcion->editarInteresadoAdopcion($id,$params);
        break;

    default:
        $vec = [];
        break;
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');
?>
