<?php

class ModeloOtraDonacion {
    
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    // Método para consultar otras donaciones
    public function consultarOtraDonacion() {
        global $conexion;
        $query = "SELECT * FROM otra_donacion";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para insertar una otra donación
    public function insertarOtraDonacion($descripcion, $fecha_donacion, $id_adoptante) {
        global $conexion;
        $descripcion = mysqli_real_escape_string($conexion, $descripcion);
        $fecha_donacion = mysqli_real_escape_string($conexion, $fecha_donacion);
        $id_adoptante = mysqli_real_escape_string($conexion, $id_adoptante);
        
        $query = "INSERT INTO otra_donacion (descripcion, fecha_donacion, id_adoptante) 
                  VALUES ('$descripcion', '$fecha_donacion', $id_adoptante)";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para eliminar una otra donación
    public function eliminarOtraDonacion($id) {
        global $conexion;
        $query = "DELETE FROM otra_donacion WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para filtrar otras donaciones
    public function filtrarOtraDonacion($filtro) {
        global $conexion;
        $filtro = mysqli_real_escape_string($conexion, $filtro);
        $query = "SELECT * FROM otra_donacion WHERE descripcion LIKE '%$filtro%' OR fecha_donacion LIKE '%$filtro%'";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }

    // Método para editar una otra donación
    public function editarOtraDonacion($id, $descripcion, $fecha_donacion, $id_adoptante) {
        global $conexion;
        $id = mysqli_real_escape_string($conexion, $id);
        $descripcion = mysqli_real_escape_string($conexion, $descripcion);
        $fecha_donacion = mysqli_real_escape_string($conexion, $fecha_donacion);
        $id_adoptante = mysqli_real_escape_string($conexion, $id_adoptante);

        $query = "UPDATE otra_donacion SET descripcion='$descripcion', fecha_donacion='$fecha_donacion', id_adoptante=$id_adoptante WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        $response = [];

        if ($resultado) {
            $response["resultado"] = "OK";
            $response["mensaje"] = "La otra donación ha sido actualizada";
        } else {
            $response["resultado"] = "Error";
            $response["mensaje"] = "No se pudo actualizar la otra donación";
        }
        
        return $response;
    }
}
?>
