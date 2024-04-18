<?php


    class ModeloAnimal {

        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        // Método para consultar animales con un INNER JOIN
        public function consultarAnimales() {
            global $conexion;
            $query = "SELECT animales.*, adoptantes.nombre AS nombre_adoptante, adoptantes.apellido AS apellido_adoptante
                    FROM animales 
                    INNER JOIN adoptantes ON animales.id_usuario_protector = adoptantes.id";
            $resultado = mysqli_query($conexion, $query);
            return $resultado;
        }

        // Método para insertar un animal
        public function insertarAnimal($nombre, $raza, $edad, $sexo, $descripcion, $foto, $estado, $id_usuario_protector) {
            global $conexion;
            $nombre = mysqli_real_escape_string($conexion, $nombre);
            $raza = mysqli_real_escape_string($conexion, $raza);
            $edad = mysqli_real_escape_string($conexion, $edad);
            $sexo = mysqli_real_escape_string($conexion, $sexo);
            $descripcion = mysqli_real_escape_string($conexion, $descripcion);
            $foto = mysqli_real_escape_string($conexion, $foto);
            $estado = mysqli_real_escape_string($conexion, $estado);
            $id_usuario_protector = mysqli_real_escape_string($conexion, $id_usuario_protector);

            $query = "INSERT INTO animales (nombre, raza, edad, sexo, descripcion, foto, estado, id_usuario_protector) 
                    VALUES ('$nombre', '$raza', $edad, '$sexo', '$descripcion', '$foto', '$estado', $id_usuario_protector)";
            $resultado = mysqli_query($conexion, $query);
            return $resultado;
        }

        // Método para eliminar un animal
        public function eliminarAnimal($id_animal) {
            global $conexion;
            $query = "DELETE FROM animales WHERE id_animal = $id_animal";
            $resultado = mysqli_query($conexion, $query);
            return $resultado;
        }

        // Método para filtrar animales
        public function filtrarAnimales($filtro) {
            global $conexion;
            $filtro = mysqli_real_escape_string($conexion, $filtro);
            $query = "SELECT * FROM animales WHERE nombre LIKE '%$filtro%' OR raza LIKE '%$filtro%' OR descripcion LIKE '%$filtro%' OR estado LIKE '%$filtro%'";
            $resultado = mysqli_query($conexion, $query);
            return $resultado;
        }

        // Método para editar un animal
        public function editarAnimal($id, $nombre, $raza, $edad, $sexo, $descripcion, $foto, $estado, $id_usuario_protector) {
            $id = mysqli_real_escape_string($this->conexion, $id);
            $nombre = mysqli_real_escape_string($this->conexion, $nombre);
            $raza = mysqli_real_escape_string($this->conexion, $raza);
            $edad = mysqli_real_escape_string($this->conexion, $edad);
            $sexo = mysqli_real_escape_string($this->conexion, $sexo);
            $descripcion = mysqli_real_escape_string($this->conexion, $descripcion);
            $foto = mysqli_real_escape_string($this->conexion, $foto);
            $estado = mysqli_real_escape_string($this->conexion, $estado);
            $id_usuario_protector = mysqli_real_escape_string($this->conexion, $id_usuario_protector);

            $query = "UPDATE animales SET nombre='$nombre', raza='$raza', edad=$edad, sexo='$sexo', descripcion='$descripcion', foto='$foto', estado='$estado', id_usuario_protector=$id_usuario_protector WHERE id_animal = $id";
            $resultado = mysqli_query($this->conexion, $query);
            
            if ($resultado) {
                $vec = [];
                $vec["resultado"] = "OK";
                $vec["mensaje"] = "El animal ha sido actualizado";
            } else {
                $vec = [];
                $vec["resultado"] = "Error";
                $vec["mensaje"] = "Error al actualizar el animal: " . mysqli_error($this->conexion);
            }
            
            return $vec;
        }
}
?>
