<?php


class ModeloTipoDonacion {

    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    
    // Método para consultar los tipos de donación utilizando un INNER JOIN con las tablas relacionadas
    public function consultarTipoDonacion() {
        global $conexion;
        $query = "SELECT td.id, a.nombre_alimento, m.nombre AS nombre_medicamento, o.descripcion AS otra_donacion
                  FROM tipo_donación td
                  LEFT JOIN alimento a ON td.id_alimento = a.id
                  LEFT JOIN medicamento m ON td.id_medicamento = m.id
                  LEFT JOIN otra_donacion o ON td.id_otro = o.id";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para insertar un tipo de donación
    public function insertarTipoDonacion($id_alimento, $id_medicamento, $id_otro) {
        global $conexion;
        $query = "INSERT INTO tipo_donación (id_alimento, id_medicamento, id_otro) 
                  VALUES ($id_alimento, $id_medicamento, $id_otro)";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para eliminar un tipo de donación
    public function eliminarTipoDonacion($id) {
        global $conexion;
        $query = "DELETE FROM tipo_donación WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para filtrar los tipos de donación
    public function filtrarTipoDonacion($filtro) {
        global $conexion;
        $filtro = mysqli_real_escape_string($conexion, $filtro);
        $query = "SELECT td.id, a.nombre_alimento, m.nombre AS nombre_medicamento, o.descripcion AS otra_donacion
                  FROM tipo_donación td
                  LEFT JOIN alimento a ON td.id_alimento = a.id
                  LEFT JOIN medicamento m ON td.id_medicamento = m.id
                  LEFT JOIN otra_donacion o ON td.id_otro = o.id
                  WHERE a.nombre_alimento LIKE '%$filtro%' OR m.nombre LIKE '%$filtro%' OR o.descripcion LIKE '%$filtro%'";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    // Método para editar un tipo de donación
    public function editarTipoDonacion($id, $id_alimento, $id_medicamento, $id_otro) {
        global $conexion;
        $id = mysqli_real_escape_string($conexion, $id);
        $id_alimento = mysqli_real_escape_string($conexion, $id_alimento);
        $id_medicamento = mysqli_real_escape_string($conexion, $id_medicamento);
        $id_otro = mysqli_real_escape_string($conexion, $id_otro);

        $query = "UPDATE tipo_donación SET id_alimento='$id_alimento', id_medicamento='$id_medicamento', id_otro='$id_otro' WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        $response = [];

        if ($resultado) {
            $response["resultado"] = "OK";
            $response["mensaje"] = "El tipo de donación ha sido actualizado";
        } else {
            $response["resultado"] = "Error";
            $response["mensaje"] = "No se pudo actualizar el tipo de donación";
        }

        return $response;
    }
}
?>
