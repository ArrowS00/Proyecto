<?php
// Controlador para registrar un usuario
include_once '..\modelo\conexion.php';
include_once '..\modelo\funciones.php';

//Verificar si se ha pulsado el botón de registro
if(!empty($_POST["registro"])) {
    //verificar si los campos obligatorios no están vacío
    if (!empty($_POST["nombre"]) && !empty($_POST["apellidos"]) && !empty($_POST["usuario"]) && !empty($_POST["email"]) && !empty($_POST["pass"])) {
        // Sanitizar los datos de entrada y asi evitar inyecciones SQL
        $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
        $apellidos = filter_var($_POST["apellidos"], FILTER_SANITIZE_STRING);
        $usuario = filter_var($_POST["usuario"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $pass = filter_var($_POST["pass"], FILTER_SANITIZE_STRING);
        
        // Validar el correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alerta">Formato de correo electrónico inválido</div>';
        } 
        // Validar la contraseña
        else {
            $pattern = "/^.{8,}$/";
            if (!preg_match($pattern, $pass)) {
                echo '<div class="alerta">Contraseña mínimo 8 caracteres.</div>';
            } 
            else {
                // Cifrar la contraseña
                $pass = password_hash($pass, PASSWORD_DEFAULT);

                $usuarioRegistro = new usuarioRegistro();
                $resultado = $usuarioRegistro->registroUsuario($nombre, $apellidos, $usuario, $email, $pass, 2);
                if ($resultado) {
                    echo '<div class="completo">Usuario registrado correctamente</div>';
                } else {
                    echo "Error: " . $resultado;
                }
            }
        }
    } else {
        echo '<div class="alerta">Rellene todos los campos</div>';
    }
}
?>