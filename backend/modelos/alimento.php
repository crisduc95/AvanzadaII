
<?php
    class ModeloAlimento {
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        // Método para consultar alimentos
        public function consultarAlimentos() {
            global $conexion;
            $query = "SELECT * FROM alimento";
            $resultado = mysqli_query($conexion, $query);
            $vec = [];

            while ($row = mysqli_fetch_assoc($resultado)) {
                $vec[] = $row;
            }
            return $vec;
        }

        // Método para insertar un alimento
        public function insertarAlimento($nombre, $cantidad, $caducidad, $cachorros) {
            global $conexion;
            $nombre = mysqli_real_escape_string($conexion, $nombre);
            $cantidad = mysqli_real_escape_string($conexion, $cantidad);
            $caducidad = mysqli_real_escape_string($conexion, $caducidad);
            $cachorros = mysqli_real_escape_string($conexion, $cachorros);

            $query = "INSERT INTO alimento (nombre_alimento, cantidad, caducidad, cachorros) VALUES ('$nombre', $cantidad, '$caducidad', $cachorros)";
            $resultado = mysqli_query($conexion, $query);
            return $resultado;
        }

        // Método para eliminar un alimento
        public function eliminarAlimento($id) {
            global $conexion;
            $query = "DELETE FROM alimento WHERE id = $id";
            $resultado = mysqli_query($conexion, $query);
            return $resultado;
        }

        // Método para filtrar alimentos
        public function filtrarAlimentos($filtro) {
            global $conexion;
            $filtro = mysqli_real_escape_string($conexion, $filtro);
            $query = "SELECT * FROM alimento WHERE nombre_alimento LIKE '%$filtro%'";
            $resultado = mysqli_query($conexion, $query);
            return $resultado;
        }

        // Método para editar un alimento
        public function editarAlimento($id, $nombre, $cantidad, $caducidad, $cachorros) {
            global $conexion;
            $id = mysqli_real_escape_string($conexion, $id);
            $nombre = mysqli_real_escape_string($conexion, $nombre);
            $cantidad = mysqli_real_escape_string($conexion, $cantidad);
            $caducidad = mysqli_real_escape_string($conexion, $caducidad);
            $cachorros = mysqli_real_escape_string($conexion, $cachorros);

            $query = "UPDATE alimento SET nombre_alimento='$nombre', cantidad=$cantidad, caducidad='$caducidad', cachorros=$cachorros WHERE id = $id";
            $resultado = mysqli_query($conexion, $query);
            $vec = [];
            $vec["resultado"] = "OK";
            $vec["mensaje"] = "El alimento ha sido actualizado";
            return $vec;
        }
    }

?>