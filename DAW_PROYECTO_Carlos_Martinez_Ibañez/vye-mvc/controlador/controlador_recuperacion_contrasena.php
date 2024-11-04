<?php
    // Controlador para recuperar la contraseña

    require_once '../modelo/conexion.php';

    //Almacenar errores
    $errors = array();
    //verificar si se ha pulsado el botón de recuperar
    if(!empty($_POST)){
        //Recuperar los datos del formulario
        $email = $mysqli->real_escape_string($_POST['email']);
        //verificar si el email es válido
        if(!isEmail($email)){
            $errors[] = "El email no es válido, ingrese un email válido.";
        }
            //verificar si el email existe
            if(emailExiste($email)){
                $user_id = getValor('id', 'email', $email);
                $user_id = getValor('nombre', 'email', $email);
                //generamos un token
                $token =generateToken($email);
                //Creamos la url para restablecer la contraseña
                $url = 'http://localhost/Proyecto/vista/restablecer_contrasena.php?email='.$email.'&token='.$token;
                $asunto = 'Recuperar contraseña';
                $cuerpo = "Hola $nombre, para recuperar tu contraseña haz click en este enlace <a href='$url'>Recuperar contraseña</a>";
                //Enviar email
                if(enviarEmail($email, $asunto, $cuerpo)){
                    $sql = "INSERT INTO recuperacion_contrasena (id_usuario, token) VALUES ($user_id, '$token')";
                    $mysqli->query($sql);
                    echo "Te hemos enviado un email con las instrucciones para recuperar tu contraseña";
                    exit;
                    } else {
                        $errors[] = "Error al enviar el email";
                    }  
            } else {
                $errors[] = "El email no existe";      
            }
    }
?>