<?php

class ModeloDonacion {
    
    public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

    // Método para consultar donaciones con INNER JOIN
    public function consultarDonaciones() {
        global $conexion;
        $query = "SELECT donaciones.*, adoptantes.nombre AS nombre_adoptante, adoptantes.apellido AS apellido_adoptante
                  FROM donaciones 
                  INNER JOIN adoptantes ON donaciones.id_adoptante = adoptantes.id";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para insertar una donación
    public function insertarDonacion($tipo_donacion, $fecha_donacion, $id_adoptante) {
        global $conexion;
        $tipo_donacion = mysqli_real_escape_string($conexion, $tipo_donacion);
        $fecha_donacion = mysqli_real_escape_string($conexion, $fecha_donacion);
        $id_adoptante = mysqli_real_escape_string($conexion, $id_adoptante);
        
        $query = "INSERT INTO donaciones (tipo_donacion, fecha_donacion, id_adoptante) 
                  VALUES ($tipo_donacion, '$fecha_donacion', $id_adoptante)";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para eliminar una donación
    public function eliminarDonacion($id) {
        global $conexion;
        $query = "DELETE FROM donaciones WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para filtrar donaciones
    public function filtrarDonaciones($filtro) {
        global $conexion;
        $filtro = mysqli_real_escape_string($conexion, $filtro);
        $query = "SELECT * FROM donaciones WHERE tipo_donacion LIKE '%$filtro%' OR fecha_donacion LIKE '%$filtro%'";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }

    // Método para editar una donación
    public function editarDonacion($id_donacion, $tipo_donacion, $fecha_donacion, $id_adoptante) {
        global $conexion;
        $id_donacion = mysqli_real_escape_string($conexion, $id_donacion);
        $tipo_donacion = mysqli_real_escape_string($conexion, $tipo_donacion);
        $fecha_donacion = mysqli_real_escape_string($conexion, $fecha_donacion);
        $id_adoptante = mysqli_real_escape_string($conexion, $id_adoptante);

        $query = "UPDATE donaciones SET tipo_donacion='$tipo_donacion', fecha_donacion='$fecha_donacion', id_adoptante=$id_adoptante WHERE id = $id_donacion";
        $resultado = mysqli_query($conexion, $query);
        $response = [];

        if ($resultado) {
            $response["resultado"] = "OK";
            $response["mensaje"] = "La donación ha sido actualizada";
        } else {
            $response["resultado"] = "Error";
            $response["mensaje"] = "No se pudo actualizar la donación";
        }
        
        return $response;
    }
}
?>
