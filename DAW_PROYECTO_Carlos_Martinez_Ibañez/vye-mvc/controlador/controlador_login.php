<?php
    // Controlador para iniciar sesión
    $mysqli = new mysqli('localhost', 'root', 'arrows22', 'vye');
 
    //verificamos la conexión con la bbd
    if ($mysqli->connect_error) {
        die('Error de Conexión (' . $mysqli->connect_errno . ') '. $msyqli->connect_error);
    }

    //verificamos si se ha pulsado el botón de iniciar sesión
    if($_POST){
        //Recuperamos los datos del formulario
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $pass = isset($_POST['password']) ? $_POST['password'] : null;
        // Verificar si algún campo está vacío
        if(empty($email) || empty($pass)) {
            $_SESSION['error_message'] = 'Completa todos los campos, por favor.';
            return;
        }
        //consulta para recuperar los datos del usuario
        $sql = "SELECT id, pass, apellidos, usuario, nombre, rol FROM usuarios WHERE email = '$email'";
        $resultado = $mysqli->query($sql);
        $num = $resultado->num_rows;
        //verificar si se ha encontrado el usuario
        if($num>0){
            //Recuperamos los datos del usuario
            $row = $resultado->fetch_assoc();
            $pass_bd = $row['pass'];

            //verificamos si la contraseña es correcta y coinciden
            if(password_verify($pass, $pass_bd)){
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['apellidos'] = $row['apellidos'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['rol'] = $row['rol'];

                // Creamos una cookie de 86400 = 1 día, valor "/" para que la cookie esté disponible en todo el sitio
                setcookie("usuario", $_SESSION['usuario'], time() + 86400, "/");  

                //Actualizamos la fecha de última conexión en la base de datos
                $fechaActual = date('Y-m-d H:i:s');
                $sql = "UPDATE usuarios SET ultimaConexion = '$fechaActual' WHERE id = " . $row['id'];
                $resultado = $mysqli->query($sql);
                if ($mysqli->query($sql) === TRUE) {
                    echo "Registro actualizado correctamente";
                } else {
                    echo "Error actualizando registro: " . $mysqli->error;
                }
            
                //redirección a la página de inicio
                header("Location: ..\index.php");

                }else{
                    $_SESSION['error_message'] = 'Por favor, introduzca una contraseña correcta.';
                }
                
            }else{
                $_SESSION['error_message'] = 'Por favor, introduzca un Email válido.';
        }

    }  
?>




