<?php
// Controlador para modificar un usuario
ob_start(); // Activar almacenamiento en búfer de salida

//comprobar si se ha pulsado el botón de modificar
if (!empty($_POST["boton_modificar"])) { 
    //comprobar si los campos obligatorios no están vacíos
    if (!empty($_POST["nombre"]) && !empty($_POST["apellidos"]) && !empty($_POST["usuario"]) && !empty($_POST["email"])) {
        //Cogemos los datos del formulario
        $id=$_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $sexo = $_POST['sexo'];
        $pais = $_POST['pais'];



        $conexion = crearConexion();
        //consulta para modificar el usuario
        $consulta = $conexion->prepare("UPDATE usuarios SET id = ?, nombre = ?, apellidos = ?, usuario = ?, email = ?, fechaNacimiento = ?, sexo = ?, pais = ? WHERE id = ?");
        $consulta->bind_param("isssssssi", $id, $nombre, $apellidos, $usuario, $email, $fechaNacimiento, $sexo, $pais, $id);
        $resultado = $consulta->execute();
        
        
        //Mostrar mensaje de éxito o error
        if ($resultado==1) {
            $_SESSION['cambios_realizados'] = true;
            header("Location: ../vista/usuario.php");
            exit; // Finalizo el script después de una redirección
        } else {
            echo '<div class="alerta">Error al modificar usuario</div>';
        }

    } else {
        echo '<div class="alerta">Rellene todos los campos</div>';
    }
}

ob_end_flush(); // Enviar contenido del búfer de salida y desactivarlo
?>