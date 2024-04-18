<?php


class ModeloMedicamento {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    
    // Método para consultar medicamentos
    public function consultarMedicamentos() {
        global $conexion;
        $query = "SELECT * FROM medicamento";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para insertar un medicamento
    public function insertarMedicamento($nombre, $cantidad, $fecha_caducidad, $descripcion) {
        global $conexion;
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $cantidad = mysqli_real_escape_string($conexion, $cantidad);
        $fecha_caducidad = mysqli_real_escape_string($conexion, $fecha_caducidad);
        $descripcion = mysqli_real_escape_string($conexion, $descripcion);
        
        $query = "INSERT INTO medicamento (nombre, cantidad, fecha_caducidad, descripcion) 
                  VALUES ('$nombre', '$cantidad', '$fecha_caducidad', '$descripcion')";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para eliminar un medicamento
    public function eliminarMedicamento($id) {
        global $conexion;
        $query = "DELETE FROM medicamento WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para filtrar medicamentos
    public function filtrarMedicamentos($filtro) {
        global $conexion;
        $filtro = mysqli_real_escape_string($conexion, $filtro);
        $query = "SELECT * FROM medicamento WHERE nombre LIKE '%$filtro%' OR descripcion LIKE '%$filtro%'";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }

    // Método para editar un medicamento
    public function editarMedicamento($id, $nombre, $cantidad, $fecha_caducidad, $descripcion) {
        global $conexion;
        $id = mysqli_real_escape_string($conexion, $id);
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $cantidad = mysqli_real_escape_string($conexion, $cantidad);
        $fecha_caducidad = mysqli_real_escape_string($conexion, $fecha_caducidad);
        $descripcion = mysqli_real_escape_string($conexion, $descripcion);

        $query = "UPDATE medicamento SET nombre='$nombre', cantidad='$cantidad', fecha_caducidad='$fecha_caducidad', descripcion='$descripcion' WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        $response = [];

        if ($resultado) {
            $response["resultado"] = "OK";
            $response["mensaje"] = "El medicamento ha sido actualizado";
        } else {
            $response["resultado"] = "Error";
            $response["mensaje"] = "No se pudo actualizar el medicamento";
        }
        
        return $response;
    }
}
?>
