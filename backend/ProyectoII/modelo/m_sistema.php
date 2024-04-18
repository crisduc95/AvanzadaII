<?php
class M_usuarios_administradores{
    public $conexion2;

    public function __construct($conexion2) {
        $this->conexion2 = $conexion2;
    }


    // Modelo para consultar usuarios administradores
    public function consultarUsuariosAdministradores() {
        $query = "SELECT * FROM `usuarios_administradores`";
        $resultado = mysqli_query($this->conexion2, $query);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultado)) {
            $vec[] = $row;
        }
        return $vec;
    }

    // Método para insertar un usuario administrador
    public function insertarUsuarioAdministrador($params) {
        $query = "INSERT INTO usuarios_administradores (nombre_usuario, contrasena, nombre, apellido, email, otros_detalles)
                  VALUES ('$params->nombre_usuario', '$params->contrasena', '$params->nombre',
                          '$params->apellido', '$params->email', '$params->otros_detalles')";
        mysqli_query($this->conexion2, $query);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "El usuario administrador ha sido insertado";
        return $vec;
    }

    // Método para eliminar un usuario administrador
    public function eliminarUsuarioAdministrador($id) {
        $query = "DELETE FROM `usuarios_administradores` WHERE id_administrador = $id";
        mysqli_query($this->conexion2, $query);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "El usuario administrador ha sido eliminado";
        return $vec;
    }

    // Método para editar un usuario administrador
    public function editarUsuarioAdministrador($id, $params) {
        // Verificar si se proporcionó una nueva contraseña
        if (!empty($params->contrasena)) {
            // Hashear la nueva contraseña
            $params->contrasena = password_hash($params->contrasena, PASSWORD_DEFAULT);
        }
        
        $query = "UPDATE usuarios_administradores SET
                  nombre_usuario = '$params->nombre_usuario',
                  contrasena = '$params->contrasena',
                  nombre = '$params->nombre',
                  apellido = '$params->apellido',
                  email = '$params->email',
                  otros_detalles = '$params->otros_detalles'
                  WHERE id_administrador = $id";
        mysqli_query($this->conexion2, $query);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "El usuario administrador ha sido editado";
        return $vec;
    }
    // Método para filtrar usuarios administradores
    public function filtrarUsuariosAdministradores($valor) {
        $query = "SELECT * FROM usuarios_administradores WHERE nombre LIKE '%$valor%' OR apellido LIKE '%$valor%' OR email LIKE '%$valor%'";
        $resultado = mysqli_query($this->conexion2, $query);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultado)) {
            $vec[] = $row;
        }
        return $vec;
    }

     // Método para consultar un usuario por nombre de usuario
     public function consultarUsuarioPorNombreUsuario($nombreUsuario) {
        $query = "SELECT * FROM `usuarios_administradores` WHERE nombre_usuario = '$nombreUsuario'";
        $resultado = mysqli_query($this->conexion2, $query);
        $usuario = mysqli_fetch_assoc($resultado);
        return $usuario;
    }

    // Método para consultar un usuario por correo electrónico
    public function consultarUsuarioPorEmail($email) {
        $query = "SELECT * FROM `usuarios_administradores` WHERE email = '$email'";
        $resultado = mysqli_query($this->conexion2, $query);
        $usuario = mysqli_fetch_assoc($resultado);
        return $usuario;
    }
}
?>
