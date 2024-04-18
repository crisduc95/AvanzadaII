
<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

    include '../conexion2.php';
    include '../modelo/m_sistema.php';

    $control = $_GET['control'];

    $usuariosAdministradores = new M_usuarios_administradores($conexion2);

    switch ($control) {
        case 'consulta':
            $vec = $usuariosAdministradores->consultarUsuariosAdministradores();
            break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);

            // Verificar si el nombre de usuario ya existe
            $usuarioExistente = $usuariosAdministradores->consultarUsuarioPorNombreUsuario($params->nombre_usuario);
            if ($usuarioExistente) {
                $vec = [];
                $vec['resultado'] = "error";
                $vec['mensaje'] = "El nombre de usuario ya existe";
                echo json_encode($vec);
                exit;
            }

            // Verificar si el correo electrónico ya existe
            $emailExistente = $usuariosAdministradores->consultarUsuarioPorEmail($params->email);
            if ($emailExistente) {
                $vec = [];
                $vec['resultado'] = "error";
                $vec['mensaje'] = "El correo electrónico ya está registrado";
                echo json_encode($vec);
                exit;
            }

            // Encriptar la contraseña antes de almacenarla
             $params->contrasena = password_hash($params->contrasena, PASSWORD_DEFAULT);

            $vec = $usuariosAdministradores->insertarUsuarioAdministrador($params);
            break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $usuariosAdministradores->eliminarUsuarioAdministrador($id);
            break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id'];
            $vec = $usuariosAdministradores->editarUsuarioAdministrador($id, $params);
            break;

        case 'filtro':
            $valor = $_GET['valor'];
            $vec = $usuariosAdministradores->filtrarUsuariosAdministradores($valor);
            break;

        default:
            $vec = [];
            break;
    }

    $datosj = json_encode($vec);
    echo $datosj;
    header('Content-Type: application/json');
?>

