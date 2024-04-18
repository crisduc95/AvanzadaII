<?php


class ModeloSistema {

    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    
    // Método para consultar los sistemas
    public function consultarSistema() {
        global $conexion;
        $query = "SELECT * FROM sistema";
        $resultado = mysqli_query($conexion, $query);
        $vec=[];
        while($row = mysqli_fetch_assoc($resultado)) {
            $vec[] = $row;
        }
        return $vec;
    }
    
    // Método para insertar un sistema
    public function insertarSistema($nombre, $apellido, $email_corporativo, $password, $activo) {
        global $conexion;
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $apellido = mysqli_real_escape_string($conexion, $apellido);
        $email_corporativo = mysqli_real_escape_string($conexion, $email_corporativo);
        $password = mysqli_real_escape_string($conexion, $password);
        $activo = mysqli_real_escape_string($conexion, $activo);
        
        $query = "INSERT INTO sistema (nombre, apellido, email_corporativo, password, activo) 
                  VALUES ('$nombre', '$apellido', '$email_corporativo', '$password', '$activo')";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para eliminar un sistema
    public function eliminarSistema($id) {
        global $conexion;
        $query = "DELETE FROM sistema WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }
    
    // Método para filtrar los sistemas
    public function filtrarSistema($filtro) {
        global $conexion;
        $filtro = mysqli_real_escape_string($conexion, $filtro);
        $query = "SELECT * FROM sistema WHERE nombre LIKE '%$filtro%' OR apellido LIKE '%$filtro%' OR email_corporativo LIKE '%$filtro%'";
        $resultado = mysqli_query($conexion, $query);
        return $resultado;
    }

    // Método para editar un sistema
    public function editarSistema($id, $nombre, $apellido, $email_corporativo, $password, $activo) {
        global $conexion;
        $id = mysqli_real_escape_string($conexion, $id);
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $apellido = mysqli_real_escape_string($conexion, $apellido);
        $email_corporativo = mysqli_real_escape_string($conexion, $email_corporativo);
        $password = mysqli_real_escape_string($conexion, $password);
        $activo = mysqli_real_escape_string($conexion, $activo);

        $query = "UPDATE sistema SET nombre='$nombre', apellido='$apellido', email_corporativo='$email_corporativo', password='$password', activo='$activo' WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        $response = [];

        if ($resultado) {
            $response["resultado"] = "OK";
            $response["mensaje"] = "El sistema ha sido actualizado";
        } else {
            $response["resultado"] = "Error";
            $response["mensaje"] = "No se pudo actualizar el sistema";
        }
        
        return $response;
    }
}
?>
