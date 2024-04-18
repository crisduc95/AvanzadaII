
<?php
Class M_animales_adopcion{

    public $conexion2;

    public function __construct($conexion2) {
        $this->conexion2 = $conexion2;
    }

    //Modelo para consultar animales para adoptar
    public function consultarAnimalesAdopcion() {
        global $conexion2;
        $query = "SELECT * FROM `animales_adopcion`";
        $resultado = mysqli_query($conexion2, $query);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultado)) {
            $vec[] = $row;
        }
        return $vec;
    }

    // Método para insertar un animal para adoptante
    public function insertarAnimalAdopcion($params) {
        global $conexion2;
        $query = "INSERT INTO animales_adopcion (nombre, especie, raza, edad, genero, descripcion, foto, estado, otros_detalles)
        VALUES ('$params->nombre', '$params->especie', '$params->raza', $params->edad, '$params->genero',
                '$params->descripcion', '$params->foto', '$params->estado', '$params->otros_detalles');
        ";
        $resultado = mysqli_query($conexion2, $query);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje']="El animal ha sido insertado";
        return $vec;

    }

    // Método para eliminar un animal para adoptar
    public function eliminarAnimalesAdopcion($id) {
        global $conexion2;
        $query="DELETE FROM `animales_adopcion` WHERE id_animal = $id";
        $resultado = mysqli_query($conexion2, $query);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje']="El animal ha sido eliminado";
        return $vec;
    }


    // Método para filtrar un animal para adoptar
    public function filtrarAnimalesAdopcion($valor) {
        global $conexion2;
        $query="SELECT * FROM animales_adopcion WHERE nombre LIKE '%$valor%'";
        $resultado = mysqli_query($this->$conexion2, $query);
        $vec=[];
        while($row=mysqli_fetch_array( $resultado)) {
            $vec[] = $row;
        }
        return $vec;

    }

    // Método para editar un animal para adoptar
    public function editarAnimalesAdopcion($id, $params) {
        global $conexion2;
        $query = "UPDATE animales_adopcion SET
                  nombre = '$params->nombre',
                  especie = '$params->especie',
                  raza = '$params->raza',
                  edad = $params->edad,
                  genero = '$params->genero',
                  descripcion = '$params->descripcion',
                  foto = '$params->foto',
                  estado = '$params->estado',
                  otros_detalles = '$params->otros_detalles'
                  WHERE id_animal = $id";
        mysqli_query($conexion2, $query);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El animal ha sido editado";
        return $vec;
    }


}

?>
