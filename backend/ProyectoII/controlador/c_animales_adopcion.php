<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

    include '../conexion2.php';
    include '../modelo/m_animales_adopcion.php';

    $control = $_GET['control'];

    $animalesAdopcion = new M_animales_adopcion($conexion2);

    switch ($control) {
        case 'consulta':
            $vec = $animalesAdopcion->consultarAnimalesAdopcion();
            break;

        case 'insertar':
            $json=file_get_contents('php://input');
            //$json = '{"nombre":"Kali2" , "especie":"Gato" ,"raza":"Bombay" , "edad":3 , "genero":"F" ,
            //    "descripcion":"Gato negro , ojos amarillos" , "foto":"RUTA" , "estado":"Disponible" , "otros_detalles":"Gata negra hermosa"}';
            $params = json_decode($json);
            $vec = $animalesAdopcion->insertarAnimalAdopcion($params);
            break;
        case 'eliminar':
            $id = $_GET['id'];
            $vec = $animalesAdopcion->eliminarAnimalesAdopcion($id);
            break;
        case 'editar':
            $json=file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id'];
            $vec = $animalesAdopcion->editarAnimalesAdopcion($id,$params);
            break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $animalesAdopcion->filtrarAnimalesAdopcion($dato);
            break;

        }



        $datosj = json_encode($vec);
        echo $datosj;
        header('Content-Type: application/json');


?>