<?php
Class M_interesados_adopcion{

    public $conexion2;

    public function __construct($conexion2) {
        $this->conexion2 = $conexion2;
    }

    //Modelo para consultar interesados en adopción
    public function consultarInteresadosAdopcion() {
        global $conexion2;
        $query = "SELECT * FROM `interesados_adopcion`";
        $resultado = mysqli_query($conexion2, $query);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultado)) {
            $vec[] = $row;
        }
        return $vec;
    }

    // Método para insertar un interesado en adopción
    public function insertarInteresadoAdopcion($params) {
        global $conexion2;
        $query = "INSERT INTO interesados_adopcion (nombre, apellido, email, telefono, ciudad, otros_detalles)
        VALUES ('$params->nombre', '$params->apellido', '$params->email', '$params->telefono', '$params->ciudad',
                '$params->otros_detalles');
        ";
        $resultado = mysqli_query($conexion2, $query);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje']="El interesado ha sido insertado";
        return $vec;
    }

    // Método para eliminar un interesado en adopción
    public function eliminarInteresadoAdopcion($id) {
        global $conexion2;
        $query="DELETE FROM `interesados_adopcion` WHERE id_interesado = $id";
        $resultado = mysqli_query($conexion2, $query);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje']="El interesado ha sido eliminado";
        return $vec;
    }

    // Método para editar un interesado en adopción
    public function editarInteresadoAdopcion($id, $params) {
        global $conexion2;
        $query = "UPDATE interesados_adopcion SET
                  nombre = '$params->nombre',
                  apellido = '$params->apellido',
                  email = '$params->email',
                  telefono = '$params->telefono',
                  ciudad = '$params->ciudad',
                  otros_detalles = '$params->otros_detalles'
                  WHERE id_interesado = $id";
        mysqli_query($conexion2, $query);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El interesado ha sido editado";
        return $vec;
    }
}
?>
