<?php
Class M_adopciones {

    public $conexion2;

    public function __construct($conexion2) {
        $this->conexion2 = $conexion2;
    }

    // Método para consultar todas las adopciones
    public function consultarAdopciones() {
        global $conexion2;
        $query = "SELECT * FROM adopciones";
        $resultado = mysqli_query($conexion2, $query);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultado)) {
            $vec[] = $row;
        }
        return $vec;
    }

    // Método para insertar una adopción
    public function insertarAdopcion($params) {
        global $conexion2;
        $query = "INSERT INTO adopciones (id_interesado, id_animal, fecha_adopcion)
                  VALUES ('$params->id_interesado', '$params->id_animal', '$params->fecha_adopcion')";
        mysqli_query($conexion2, $query);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "La adopción ha sido registrada";
        return $vec;
    }

    // Método para eliminar una adopción
    public function eliminarAdopcion($id) {
        global $conexion2;
        $query = "DELETE FROM adopciones WHERE id_adopcion = $id";
        mysqli_query($conexion2, $query);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "La adopción ha sido eliminada";
        return $vec;
    }

    // Método para editar una adopción
    public function editarAdopcion($id, $params) {
        global $conexion2;
        $query = "UPDATE adopciones SET
                  id_interesado = '$params->id_interesado',
                  id_animal = '$params->id_animal',
                  fecha_adopcion = '$params->fecha_adopcion'
                  WHERE id_adopcion = $id";
        mysqli_query($conexion2, $query);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "La adopción ha sido actualizada";
        return $vec;
    }
    // Método para filtrar adopciones por fecha
// Método para filtrar adopciones por múltiples opciones
public function filtrarAdopciones($filtros) {
    global $conexion2;

    $query = "SELECT * FROM adopciones WHERE 1";

    if (!empty($filtros['id_interesado'])) {
        $query .= " AND id_interesado = {$filtros['id_interesado']}";
    }

    if (!empty($filtros['id_animal'])) {
        $query .= " AND id_animal = {$filtros['id_animal']}";
    }

    if (!empty($filtros['fecha_adopcion'])) {
        $fecha_adopcion = $filtros['fecha_adopcion'];
        $query .= " AND fecha_adopcion = '$fecha_adopcion'";
    }

    $resultado = mysqli_query($conexion2, $query);
    $vec = [];
    while($row = mysqli_fetch_assoc($resultado)) {
        $vec[] = $row;
    }
    return $vec;
}

}
?>
