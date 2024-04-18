<?php
Class M_login{

    public $conexion2;

    public function __construct($conexion2) {
        $this->conexion2 = $conexion2;
    }

    // Modelo para consultar usuarios administradores
    public function consultarUsuarioAdministrador($email, $contrasena) {
        // Primero obtenemos el registro del usuario basado en el email
        $query = "SELECT * FROM `usuarios_administradores` WHERE email='$email'";
        $resultado = mysqli_query($this->conexion2, $query);
        $usuario = mysqli_fetch_assoc($resultado);

        // Inicializamos el array $vec
        $vec = [];

        if ($usuario) {
            // Verificamos si la contraseña coincide utilizando password_verify()
            if (password_verify($contrasena, $usuario['contrasena'])) {
                // La contraseña es válida, agregamos el usuario al array $vec
                $vec[] = $usuario;
            }
        }

        // Verificamos si $vec está vacío para determinar si la contraseña es válida o no
        if (!empty($vec)) {
            // La contraseña es válida
            $vec[0]['validar'] = "valida";
        } else {
            // La contraseña no es válida
            $vec[0]['validar'] = "no valida";
        }

        // Devolvemos el array $vec
        return $vec;
    }
}
?>
