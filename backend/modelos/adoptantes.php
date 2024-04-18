<?php
    Class Adoptantes{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

       // Método para consultar adoptantes con un INNER JOIN
        public function consultarAdoptantes() {
        global $conexion;
        $query = "SELECT adoptantes.*, animales.nombre AS nombre_animal FROM adoptantes
              INNER JOIN animales ON adoptantes.id = animales.id_usuario_protector";
        $resultado = mysqli_query($conexion, $query);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultado)) {
            $vec[] = $row;
        }
        return $vec;
        }


    // Método para insertar un adoptante
    public function insertarAdoptante($nombre, $apellido, $direccion, $telefono, $email) {
        global $conexion;
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $apellido = mysqli_real_escape_string($conexion, $apellido);
        $direccion = mysqli_real_escape_string($conexion, $direccion);
        $telefono = mysqli_real_escape_string($conexion, $telefono);
        $email = mysqli_real_escape_string($conexion, $email);

        $query = "INSERT INTO adoptantes (nombre, apellido, direccion, telefono, email) VALUES ('$nombre', '$apellido', '$direccion', '$telefono', '$email')";
        $vec = mysqli_query($conexion, $query);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "El adoptante ha sido guardado";
        return $vec;
    }

    // Método para eliminar un adoptante
    public function eliminarAdoptante($id) {
        global $conexion;
        $query = "DELETE FROM adoptantes WHERE id = $id";
        $vec = mysqli_query($conexion, $query);
        $vec = [];
        $vec["resultado"] = "OK";
        $vec["mensaje"] = "La categoria ha sido eliminada";
        return $vec;
    }

    // Método para filtrar adoptantes
    public function filtrarAdoptantes($filtro) {
        global $conexion;
        $filtro = mysqli_real_escape_string($conexion, $filtro);
        $query = "SELECT * FROM adoptantes WHERE nombre LIKE '%$filtro%' OR apellido LIKE '%$filtro%' OR direccion LIKE '%$filtro%' OR telefono LIKE '%$filtro%' OR email LIKE '%$filtro%'";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }

    // Método para editar un adoptante
    public function editarAdoptante($id, $nombre, $apellido, $direccion, $telefono, $email) {
        global $conexion;
        $id = mysqli_real_escape_string($conexion, $id);
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $apellido = mysqli_real_escape_string($conexion, $apellido);
        $direccion = mysqli_real_escape_string($conexion, $direccion);
        $telefono = mysqli_real_escape_string($conexion, $telefono);
        $email = mysqli_real_escape_string($conexion, $email);

        $query = "UPDATE adoptantes SET nombre='$nombre', apellido='$apellido', direccion='$direccion', telefono='$telefono', email='$email' WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        $vec = [];
        $vec["resultado"] = "OK";
        $vec["mensaje"] = "El adoptante ha sido actualizado";
        return $vec;
    }

}
?>